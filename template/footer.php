<style>
.error{border-color: red !important;}
.valid{border-color: green !important;}
</style>

<script type="text/javascript" src="/carl500/style/js/jquery.validate.js"></script>
<style type="text/css">
//* { font-family: Verdana; font-size: 96%; }
//label { width: 10em; float: left; }
//label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
//p { clear: both; }
//.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>

<script>
$.validator.addMethod("notNumber", function(value, element, param) {
                       var reg = /[0-9]/;
                       if(reg.test(value)){
                             return false;
                       }else{
                               return true;
                       }
                }, "Number is not permitted");

jQuery.extend(jQuery.validator.messages, {
    required: "Ce champ est requis.",
    remote: "Please fix this field.",
    email: "Please enter a valid email address.",
    url: "Please enter a valid URL.",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Entrez un nombre valide.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

$(document).ready(function(){
	$("#commentForm").validate({ 
		errorClass: "error",
  		validClass: "valid",
  		highlight: function( element, errorClass, validClass ) {
    		$(element).addClass(errorClass).removeClass(validClass);
  		},
  		unhighlight: function( element, errorClass, validClass ) {
    		$(element).removeClass(errorClass).addClass(validClass);
  		}
	});
});
</script>

	</div>

	<div id="pied_de_page" class="non-printable">

    
	</div>
</body>
</html>
