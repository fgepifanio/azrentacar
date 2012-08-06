$(document).ready(function(){
$.validator.addMethod("equalTo", function(value, element, param){
		
		return (value == $(param).val());
		
		});

$("#changePassForm").validate({

	rules : {


		password: {
			required: true
			
		},
		
		password_again: {
			required: true,
			equalTo: "#password"
			
		}

	},

	messages : {

		password: {
			required: "Digite uma nova password."
		},
		password_again: {
			required: "Repita a sua nova password.",
			equalTo: "A password n&atilde;o &eacute; igual a anterior."
		}		

	}
}
)

})