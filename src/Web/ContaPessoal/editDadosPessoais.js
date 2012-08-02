$(document).ready(function(){
$.validator.addMethod("equalTo", function(value, element, param){
		
		return (value == $(param).val());
		
		});

$.validator.addMethod("verifyLogin", function(value, element, params){
	var result = ajaxCheckLogin(element); // método ajax que será descrito a seguir
	return (params == eval(result)); // usa-se eval porque o ajax retorna uma string e params é um boolean, então o eval resolve isso.

	});



$("#registerForm").validate({

		
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

		email : {
			email : "Endereço de email não é válido."
		},
		email_alt : {
			email : "Endereço de email não é válido."
		},
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
