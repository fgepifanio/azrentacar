<?php
require_once ('Database.php');
require_once ('Client.php');

class Gestor {
	public static function getClientes() {
	}
	
	private static $db;
	#DATABASE
	public function init() {
		self::$db = new Database ();
	}
	
	public static function getConnection() {
		return self::$db;
	}
	
	#CLIENT FUNCTIONS
	public static function getClienteByUsername($username, $password) {
		
		$password = sha1 ( $password );
		$user = self::$db->SqlSelect ( array ('*' ), array ('cliente' ), array ("username='{$username}' AND password='{$password}'" ) );
		if (! empty ( $user [0] )) {
			$client = new Client ( $user [0], 1 );
			return $client;
		} else {
			return '';
		}
	
	}
	
	public static function getClienteById($id) {
		
	
		$user = self::$db->SqlSelect ( array ('*' ), array ('cliente' ), array ("id='{$id}'" ) );
		if (! empty ( $user [0] )) {
			$client = new Client ( $user [0], 1 );
			return $client;
		} else {
			return '';
		}
	
	}
	public static function checkCliente($username) {
		
		$password = sha1 ( $password );
		$user = self::$db->SqlSelect ( array ('*' ), array ('cliente' ), array ("username='{$username}' " ) );
		return $user [0];
	
	}
	
	public static function getCategoriasCarta() {
		
		$categorias = self::$db->SQLSelect ( array ('categoria' ), array ('categoria_carta' ) );
		return $categorias;
	}
	
	public static function getCars($free = null) {
		$cars [0] ['brand'] = 'Peugeot';
		$cars [0] ['model'] = '203';
		$cars [0] ['doors'] = '4';
		$cars [0] ['transmission'] = 'Manual';
		$cars [0] ['minAge'] = '19';
		$cars [0] ['baseExtras'] [] = 'Ar Condicionado';
		$cars [0] ['baseExtras'] [] = 'Quilometragem ilimitada';
		
		$cars [1] ['brand'] = 'Fiat';
		$cars [1] ['model'] = '200';
		$cars [1] ['doors'] = '4';
		$cars [1] ['transmission'] = 'Manual';
		$cars [1] ['minAge'] = '19';
		$cars [1] ['baseExtras'] [] = 'Ar Condicionado';
		$cars [1] ['baseExtras'] [] = 'Quilometragem ilimitada';
		
		$cars [2] ['brand'] = 'BMW';
		$cars [2] ['model'] = '325';
		$cars [2] ['doors'] = '4';
		$cars [2] ['transmission'] = 'Autom&aacute;tica';
		$cars [2] ['minAge'] = '19';
		$cars [2] ['baseExtras'] [] = 'Ar Condicionado';
		$cars [2] ['baseExtras'] [] = 'Quilometragem ilimitada';
		
		return $cars;
	}
	
	public static function getFreeCars() {
		return Gestor::getCars ( 1 );
	}
	
	public static function getChargedItems($dados) {
		$result = array ();
		$index = 0;
		$datediff = strtotime ( $dados ['data_entrega'] ) - strtotime ( $dados ['data_levantamento'] );
		$reservationDuration = floor ( $datediff / (60 * 60 * 24) );
		if ($reservationDuration == 0)
			$reservationDuration = 1;
		$result [$index] ['description'] = $dados ['descriptionCar' . $dados ['idCar']] . " (" . $reservationDuration . " dias)";
		$result [$index] ['value'] = Gestor::calculateCarReservationValue ( $dados ['idCar'], $reservationDuration );
		
		foreach ( $dados ['extras'] as $extra ) {
			$index ++;
			$result [$index] ['description'] = $extra ['description' . $extra ['idExtra']];
			$result [$index] ['value'] = Gestor::calculateExtraReservationValue ( $extra ['idExtra'], $reservationDuration );
		}
		
		return $result;
	}
	
	public static function calculateCarReservationValue($idCar, $duration) {
		return $duration;
	}
	
	public static function calculateExtraReservationValue($idExtra, $duration) {
		return $duration;
	}

}

Gestor::init ();