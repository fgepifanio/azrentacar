<?php
//require_once(dirname(__FILE__)."/Interface.php");

	//CLASS THAT CREATES A CONNECTION TO A DB AUTOMATICALY AFTER INSTANTIATION
	//IT AS THE SPECIAL FUNCTION OF CHOOSING A CONNECTION TYPE DEPENDING ON THE
	//CONFIGURATION
	class Database{

		private $connection;
		private $host = "mysql:dbname=azrentac_db;host=localhost"; //MySQL- Server name; ODBC- DNS name; PDO- DNS;
		private $username = "root"; //Flavio || David = 'root'; Servidor = 'azrentac_user'
		private $password = ""; //Flávio = ''; David = 'root'; Servidor = 'azrentacar2012'
		private $database = "azrentac_db";
                private $server = "localhost";
		private $lastInsertedIds;
		private $transactionMode = false;
		private $failedQuery = true;
		private $lastQuery;
		private $databaseType = 3; //DEFINE THE TYPE OF DATABASE CONNECTION 1-MYSQL; 2-ODBC; 3-PDO
		private $SQLType; //IF IT'S 1-MYSQL OR 2-SQL SERVER
		private $audit = false;//ACTIVATES AUDIT IF TRUE
		private $auditLastId = true;//SUPPORT TO SKIP GETTING THE LAST ID OF AUDIT
		private $auditTable = "auditoria";//NAME OF THE AUDIT TABLE

		private $failedToInsert = 'Não foi possivel inserir o registo na base de dados, caso o problema persista, contacte o suporte da AZrentacar';
		private $failedToConnect = 'Não foi possivel ligar à base de dados, caso o problema persista, contacte o suporte da AZrentacar';
		private $failedToSelect = 'Não foi possivel pesquisar os dados, caso o problema persista, contacte o suporte da AZrentacar';
		private $failedToUpdate = 'Não foi possivel actualizar o registo, caso o problema persista, contacte o suporte da AZrentacar';

		//CONSTRUCTOR CONNECTS TO THE DATABASE
		public function Database($host = "", $username = "", $password = "", $database = ""){

			$this->failedQuery = true;

			if($host != "") $this->host = $host;
			if($username != "") $this->username = $username;
			if($password != "") $this->password = $password;
			if($database != "") $this->database = $database;
			
			switch($this->databaseType){

				case 1:
				$this->connection = mysqli_connect($this->server, $this->username, $this->password, $this->database) or $this->reportQueryError(print_r(mysqli_connect_error(), true), '',1,$this->failedToConnect);
					$this->SQLType = 1;
					break;

				case 2:
				$this->connection = odbc_connect($this->host, $this->username, $this->password) or $this->reportQueryError(odbc_errormsg(), '',1,$this->failedToConnect);
					$result = @odbc_data_source( $this->connection, SQL_FETCH_FIRST );

					while($result)
					{
						if (strtolower($this->host) == strtolower($result['server'])) {
							
							if(strpos($result['description'], "MySQL") === false)
								$this->SQLType = 2;
							else
								$this->SQLType = 1;

							break;
						}
						else
							$result = @odbc_data_source( $this->connection, SQL_FETCH_NEXT );
					}
					break;

				case 3:
					try {
						$this->connection = new PDO($this->host, $this->username, $this->password);

						if($this->connection->getAttribute(constant("PDO::ATTR_DRIVER_NAME")) != "mysql")
							$this->SQLType = 2;
						else
							$this->SQLType = 1;
						
					} catch (PDOException $e) {
					$this->reportQueryError($e->getMessage(), '',1,$this->failedToConnect);
					}
					break;
			}
		}

		//MAKES A SELECT QUERY TO THE DB, RETURNS AN ARRAY WITH THE RESULT IF
		//SUCCESSFUL, AND AN ARRAY WITH THE INDEX 0 WITH FALSE IF IT RETURNS NO VALUES
	public function SQLSelect($colunas, $tabelas = null, $condicoes = array(''), $extras = ""){

			$this->failedQuery = true;
			$row = array();
			$row[] = array();
			$index = 0;
			$query = "";

			$counter = count($colunas);

			for($indexQuery = 0; $indexQuery < $counter; $indexQuery++){

				if($indexQuery != 0)
					$query .= " UNION ALL ";

				if($condicoes[$indexQuery] == "")
					$where = "";
				else
					$where = "WHERE $condicoes[$indexQuery]";

				$query .= "SELECT $colunas[$indexQuery] ";
				if(isset($tabelas[$indexQuery]))
					$query .= "FROM $tabelas[$indexQuery] $where";
			}

			$query .= " $extras";

			
			$this->lastQuery = $query;

			switch($this->databaseType){

				case 1:
				$result = mysqli_query($this->connection, $query) or $this->reportQueryError(mysqli_error($this->connection), $query, 2, $this->failedToSelect);
					while($temp = mysqli_fetch_assoc($result)){
						$row[$index] = $temp;
						//$row[] = array();
						$index++;
					}
					break;

				case 2:
				$result = odbc_exec($this->connection, $query) or $this->reportQueryError(odbc_errormsg(), $query, 2,$this->failedToSelect);
				while(($temp = odbc_fetch_array($result))!=false){
						$row[$index] = $temp;
						//$row[] = array();
						$index++;
					}
					break;

				case 3:
				$result = $this->connection->query($query) or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2,$this->failedToSelect);
				while($temp = $result->fetch(PDO::FETCH_ASSOC)){
						$row[$index] = $temp;
						//$row[] = array();
						$index++;
					}
					break;
			}
			
		array_walk($row, stripslashes);
			return $row;
		}
		
		//EXECUTES STORED PROCEDURES
		public function SQLExecProc($function, $arguments){

			$this->failedQuery = true;
			$row = array();
			$row[] = array();
			$index = 0;
			$loopOnce = 0;

			if($this->SQLType == 1){

				$query = "CALL $function($arguments[0]";
				
				foreach($arguments as $arg){

					if($loopOnce == 0){

						$loopOnce++;
						continue;
					}

					$query .= " ,$arg";
				}
					$query .= ")";
			}
			else{

				$query = "EXEC $function $arguments[0]";

				foreach($arguments as $arg){

					if($loopOnce == 0){

						$loopOnce++;
						continue;
					}

					$query .= " ,$arg";
				}
			}
			
			$this->lastQuery = $query;
			
			switch($this->databaseType){
				
				case 1:
				mysqli_multi_query($this->connection, $query) or $this->reportQueryError(mysqli_error($this->connection), $query, 2,$this->failedToSelect);
					
					do{

						if($result = mysqli_store_result($this->connection)){

							while($temp = mysqli_fetch_assoc($result)){

								$row[$index] = $temp;
								//$rowr[] = array();
								$index++;
							}
						}
					}while($result = mysqli_next_result($this->connection));
					break;

				case 2:
				$result = odbc_exec($this->connection, $query) or $this->reportQueryError(odbc_errormsg(), $query, 2,$this->failedToSelect);
					while($temp = odbc_fetch_array($result)){
						$row[$index] = $temp;
						//$row[] = array();
						$index++;
					}
					odbc_free_result($result);
					break;

				case 3:
				$result = $this->connection->query($query) or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2,$this->failedToSelect);
					while($temp = $result->fetch(PDO::FETCH_ASSOC)){
						$row[$index] = $temp;
						//$row[] = array();
						$index++;
					}
					$result->closeCursor();
					break;
			}

			return $row;
		}

		//EXECUTES A QUERY TO THE DATABASE, PREFERABLY A INSERT, AND REGISTERS THE ID OF THE INSERT
		public function SQLInsert($tabela, $colunas, $valores){

			$this->failedQuery = true;

			$query = "INSERT INTO $tabela ($colunas) VALUES($valores)";
			

			$this->lastQuery = $query;

			switch($this->databaseType){

				case 1:
				$result = mysqli_query($this->connection, $query) or $this->reportQueryError(mysqli_error(), $query, 2,$this->failedToInsert);
				if($this->auditLastId)
					$this->lastInsertedIds = mysqli_insert_id($this->connection) or $this->reportQueryError(mysqli_error(), '', 1,$this->failedToInsert);
					break;

				case 2:
				$result = odbc_exec($this->connection, $query) or $this->reportQueryError(odbc_errormsg(), $query, 2,$this->failedToInsert);

					if($this->auditLastId){

						$lastId = $this->SQLSelect("SELECT max(id) AS ID FROM $tabela");

						$this->lastInsertedIds = $row_id[0]["ID"];
					}
					break;

				case 3:
					
				$result = $this->connection->query($query) or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2,$this->failedToInsert);
					
				if($this->auditLastId)
						$this->lastInsertedIds = $this->connection->lastInsertId();
					break;
			}
/*
			if($this->audit){

				$dataAfter = $this->SQLSelect(array("*"),
											  array("$tabela"),
											  array("id = '$this->lastInsertedIds'"));

				$this->audit = false;
				$this->auditLastId = false;

				$this->autoAudit($query, $dataAfter);
			}*/

			return $result;
		}

		//FUNCTION GENERALLY USED TO EXECUTE UPDATES
		public function SQLUpdate($tabela, $colsvals, $condicoes = "", $innerJoins = ""){

			$this->failedQuery = true;

			if($this->audit){

				$condicoesAudit = $condicoes;
				
				$tabelaAudit = "$tabela".(($innerJoins != "") ? "INNER JOIN $innerJoins" : "");

				$dataBefore = $this->SQLSelect(array("*"),
											  array("$tabelaAudit"),
											  array("$condicoesAudit"));
			} 

			$condicoes = ($condicoes != "") ? "WHERE $condicoes" : "";
			
			if($this->SQLType == 1){
				
				$innerJoins = ($innerJoins != "") ? "INNER JOIN $innerJoins" : "";
				$query = "UPDATE $tabela $innerJoins SET $colsvals $condicoes";
			}
			else{
				
				$innerJoins = ($innerJoins != "") ? "FROM $tabela INNER JOIN $innerJoins" : "";
				$query = "UPDATE $tabela SET $colsvals $innerJoins $condicoes";
			}

			$this->lastQuery = $query;

			switch($this->databaseType){

				case 1:
				$result = mysqli_query($this->connection, $query) or $this->reportQueryError(mysqli_error(), $query, 2,$this->failedToUpdate);
					break;

				case 2:
					$result = odbc_exec($this->connection, $query) or $this->reportQueryError(odbc_errormsg(), $query, 2,$this->failedToUpdate);
					break;

				case 3:
					$result = $this->connection->query($query) or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2,$this->failedToUpdate);
					break;
			}

			if($this->audit){

				$dataAfter = $this->SQLSelect(array("*"),
											  array("$tabelaAudit"),
											  array("$condicoesAudit"));

				$this->audit = false;

				$this->autoAudit($query, $dataAfter, $dataBefore);
			}

			return $result;
		}

		//EXECUTES A QUERY THAT DELETES ROWS
		public function SQLDelete($tabela, $condicoes){

			$this->failedQuery = true;

			$query = "DELETE FROM $tabela WHERE $condicoes";

			$this->lastQuery = $query;

			if($this->audit){

				$dataBefore = $this->SQLSelect(array("*"),
											  array("$tabela"),
											  array("$condicoes"));
			}

			switch($this->databaseType){

				case 1:
					$result = mysqli_query($this->connection, $query) or $this->reportQueryError(mysqli_error(), $query, 2);
					break;

				case 2:
					$result = odbc_exec($this->connection, $query) or $this->reportQueryError(odbc_errormsg(), $query, 2);
					break;

				case 3:
					$result = $this->connection->query($query) or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2);
					break;
			}

			if($this->audit){

				$this->audit = false;

				$this->autoAudit($query, "", $dataBefore);
			}

			return $result;
		}

		//FUNTION THAT MAKES AN AUTOMATIC AUDIT
		private function autoAudit($query, $dataAfter = "", $dataBefore = ""){

			/*if($this->SQLType == 1)
				$date = "NOW()";
			else
				$date = "GETDATE()";

			$query = str_replace("'", "\"", $query);

			$this->SQLInsert($this->auditTable,
							 "dados_anteriores, dados_actuais, query, data, utilizador",
							 "'".serialize($dataBefore)."', '".serialize($dataAfter)."', '".$this->formatBadQuery($query)."', $date, '".$_SESSION["User"]->getId()."'");

			$this->audit = true;
			$this->auditLastId = true;*/
		}

		//RETURNS THE LAST INSERTED ID
		public function getLastId(){

			return $this->lastInsertedIds;
		}

		//RETURNS TRUE IF LAST QUERY WAS SUCCESSFUL ELSE FALSE
		public function hadSuccess(){

			return $this->failedQuery;
		}

		//RETURNS THE LAST EXECUTED QUERY
		public function showPreviousQuery(){

			return $this->lastQuery;
		}

		//STARTS THE TRANSACTION MODE
		public function beginTransaction(){

			$this->failedQuery = true;

			switch($this->databaseType){

				case 1:
					mysqli_query($this->connection, "BEGIN") or $this->reportQueryError(mysqli_error(), "BEGIN", 2);
					break;

				case 2:
					odbc_autocommit($this->connection, false) or $this->reportQueryError(odbc_errormsg(), "", 2);
					break;

				case 3:
					$this->connection->beginTransaction() or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2);
					break;
			}

			$this->transactionMode = true;
		}

		//COMMITS A TRANSACTION
		public function commit(){
			
			$this->failedQuery = true;
			
			switch($this->databaseType){
				
				case 1:
					mysqli_query($this->connection, "COMMIT") or $this->reportQueryError(mysqli_error(), "COMMIT", 2);
					break;
				
				case 2:
					odbc_commit($this->connection) or $this->reportQueryError(odbc_errormsg(), "", 2);
					break;

				case 3:
					$this->connection->commit()  or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2);
					break;
			}
			
			$this->transactionMode = false;
		}

		//ROLLBACK A TRANSACTION
		private function rollback(){

			$this->failedQuery = true;

			switch($this->databaseType){

				case 1:
					mysqli_query($this->connection, "ROLLBACK") or $this->reportQueryError(mysqli_error(), "ROLLBACK", 2);
					break;

				case 2:
					odbc_rollback($this->connection) or $this->reportQueryError(odbc_errormsg(), "", 2);
					break;

				case 3:
					$this->connection->rollBack() or $this->reportQueryError(implode(":", $this->connection->errorInfo()), $query, 2);
					break;
			}

			$this->transactionMode = false;
		}

		//FUNCTION THAT WRITES TO A LOG FILE THE ERROR OF A QUERY
	private function reportQueryError($error, $query, $type,$userError = 'Erro de base de dados nÃ£o categorizado'){

			if($this->transactionMode){

				$this->transactionMode = false;
				$this->rollback();
			}

			$message = "[".date("d-m-Y H:i:s")."]: ".$error."\nQUERY: ".$this->formatBadQuery($query)." \nPAGE: ".$_SERVER['PHP_SELF']."\n\n";
			
			//$errorMail['query'] = $message;
		//$errorMail['session'] = $_SESSION;
		//$errorMail['post'] = $_POST;
		//$errorMail['get'] = $_GET;
		
		//Mail::sendMailError($errorMail,'HelpDesk-LOG: Query - Arrays');
		//unset($errorMail);
		
		file_put_contents("../Logs/QueryErrors.txt", $message, FILE_APPEND);
			$this->failedQuery = false;
		throw new exception ($userError);
		}

		//FORMATS THE QUERY SO IT CAN BE WRITTEN IN THE QUERIES ERROR LOG
		private function formatBadQuery($query){

			$query = str_replace("  ", "", $query);
			$query = str_replace("\n", " ", $query);
			$query = str_replace("  ", " ", $query);

			return $query;
		}

		//FUNCTION THAT CLOSES THE DATABASE CONNECTION
		public function CloseDB(){

			$this->failedQuery = true;

			switch($this->databaseType){

				case 1:
					mysqli_close($this->connection);
					break;

				case 2:
					odbc_close($this->connection);
					break;

				case 3:
					$this->connection = NULL;
					break;
			}
		}
	}
	
try{
	$db = new Database(); //INITIALIZING THE CLASS
	
}catch(exception $e){
	echo utf8_decode($e->getMessage());
	die();
}
	
?>