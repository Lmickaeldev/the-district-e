function validate()
{
//ce sont ces deux variables qui vont stocker les messages d'erreur pour l'email et le mot de passe 
var errorEmail="";
var errorPass="";


var email = document.getElementById( "inputEmail" );
if( email.value == "" || email.value.indexOf( "@" ) == -1 )
{
  
  errorEmail = "Vous devez saisir un email valide";
  document.getElementById( "error_email" ).innerHTML = errorEmail;
  return false;
}

var password = document.getElementById( "inputPassword" );
if( password.value == "" || password.value < 6 )
{
 
  errorPass = "Mot de passe incorrect!";
  document.getElementById( "error_pass" ).innerHTML = errorPass;
  return false;
}

else
{
  return true;
}
}

