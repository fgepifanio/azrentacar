$(document).ready(function(){


$("#createCondutor").validate({

	rules : {


		
		nome: {
			required: true
		},
		data_nascimento: {
			required: true
		},

		telefone : {
			minlength : 9,
			digits : true

		}

		


	},

	messages : {

		nome : {
			required: "Por favor insira o seu nome"
		},
		data_nascimento: {
			required: "Por favor insira a sua Data de Nascimento"
		},
		
		telefone : {
			minlength : "São necessários pelo menos 9 algarismos",
			digits : "O número de telefone só pode conter digitos"
		}
	}
}
)

})
