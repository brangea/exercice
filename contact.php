<!DOCTYPE html>
<html>


<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="accueil.css" />
	<link rel="icon" type="image/ico" href="1logo/favicon.ico" />
	<STYLE> 
.bouton {   
background-color: green;  
border-color: #BCB6E2 #BCB6E2 #A8A2CC #A8A2CC;  
 color:white;
 width:195px;
  height:60px;
 border-color:green;
 font-size:19px;
border-top-width: thin;  
border-right-width: thin;  
border-bottom-width: thin;  
border-left-width: thin 
} 
</STYLE>
	<title>IBI SO</title>
</head>


<body>


<div id="entete_gauche">
<br><h2><img src="1logo/logo A3bis.JPG" alt="drapeau" height="170"/> <h2>
</div>

<div id="entete_droite">
<br><br><br><br><br>
Aide et Soutien des Tradipraticiens en santé mentale du Pays Dogon (MALI)</font>

</div>




<div id="corps_droit">
<br>



  <nav>		
  


 
    <ul>
    
   <br>
        <div id="image_header"><br>

</div><br>


        <li><a href="index.html">Accueil</a>
      
        <li><a href="accueil.html">Présentation</a>

        <li><a href="tradipraticiens.html">Tradipraticiens</a>
     
         <li><a href="histoiredeau.html">Histoire d'eau</a>

        <li><a href="contact.php">Contact</a>
   
         <li><a href="Photo pays.html">Pays Dogon</a>
      
	     <li><a href="liens.html">Liens<font color="black"></font></a></li>
	       
        



                   
    
</nav>

<h2><INPUT type="button" onclick="document.location.href='vdon.php';" value="Faire un don" class="bouton" > </h2>

 <br><blockquote><hr></blockquote>
		<blockquote><b><font color="#B22222"">CONTACT</font></b><br>
		<hr><br><br>
 <p><font color="white"> ...........................</font><font color="black">Merci de remplir tous les champs !</font></p>
<?php
/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
*/
// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
$destinataire = 'association.ibi.so@free.fr';
 $site='www.ibiso-tradipraticiens.com';
 
// copie ? (envoie une copie au visiteur)
$copie = 'oui'; // 'oui' ou 'non'
 
// Messages de confirmation du mail
$message_envoye = "Votre message nous est bien parvenu !";
$message_non_envoye = "L'envoi du mail est KO !, merci de le renouveler SVP.";
 
// Messages d'erreur du formulaire
$message_erreur_formulaire = "";
$message_formulaire_invalide = "Tous les champs ne sont pas remplis ou  l'adresse email est invalide, merci de recommencer !";
 
/*
	********************************************************************************************
	FIN DE LA CONFIGURATION
	********************************************************************************************
*/





 
// on teste si le formulaire a été soumis
if (!isset($_POST['envoi']))
{
	// formulaire non envoyé
	echo '<p><font color="GREY"><b>'.$message_erreur_formulaire.'</b></font></p>'."\n";
}
else
{
	/*
	 * cette fonction sert à nettoyer et enregistrer un texte
	 */
	function Rec($text)
	{
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}
 
		$text = nl2br($text);
		return $text;
	};
 
	/*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
	function IsEmail($email)
	{
		$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
		return (($value === 0) || ($value === false)) ? false : true;
	}
 
	// formulaire envoyé, on récupère tous les champs.
	$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
	$prenom   = (isset($_POST['prenom']))   ? Rec($_POST['prenom'])   : '';
	$pays   = (isset($_POST['pays']))   ? Rec($_POST['pays'])   : '';
	$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
	$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
	$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
 
	// On va vérifier les variables et l'email ...
	$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
 
	if (($nom != '') && ($prenom != '') && ($pays != '') && ($email != '') && ($objet != '') && ($message != ''))
	{
		// les 4 variables sont remplies, on génère puis envoie le mail
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:'.$nom.' <'.$email.'>' . "\r\n" .
					'Reply-To:'.$email. "\r\n" .
					'X-Mailer:PHP/'.phpversion();
 
		// envoyer une copie au visiteur ?
		if ($copie == 'oui')
		{
			$cible = $destinataire.','.$email;
		}
		else
		{
			$cible = $destinataire;
		};
 
		// Remplacement de certains caractères spéciaux
		$message = str_replace("&#039;","'",$message);
		$message = str_replace("&#8217;","'",$message);
		$message = str_replace("&quot;",'"',$message);
		$message = str_replace('<br>','',$message);
		$message = str_replace('<br />','',$message);
		$message = str_replace("&lt;","<",$message);
		$message = str_replace("&gt;",">",$message);
		$message = str_replace("&amp;","&",$message);
 
		
// Envoi du mail
		if (mail($cible, $objet, $message, $headers))
		{
			echo '<p><font color="white">...........................</font><font color="green"><b>'.$message_envoye.'</b></font></p>'."\n";
		}
		else
		{
			echo '<p><font color="white">...........................</font><font color="red"><b>'.$message_non_envoye.'</b></font></p>'."\n";
		};
	}
	else
	{
		// une des 3 variables (ou plus) est vide ...
		echo '<p><font color="white">...........................</font><font color="red"><b>'.$message_formulaire_invalide.' </b></font></p>'."\n";
	};
}; // fin du if (!isset($_POST['envoi']))
  
?>
<form id="contact" method="post" action="contact.php">



	<br><br>
		<label for="nom"><font color="black">Nom</font></label><input type="text" id="nom" name="nom" tabindex="1" /><br>
		<label for="nom"><font color="black">Prenom</font></label><input type="text" id="prenom" name="prenom" tabindex="1" /><br>
			<label for="nom"><font color="black">Pays</font></label><input type="text" id="pays" name="pays" tabindex="1" /><br>
		<label for="email"><font color="black">Email</font></label><input type="text" id="email" name="email" tabindex="2" /><br>

 

		<label for="objet"><font color="black">Objet</font></label><input type="text" id="objet" name="objet" tabindex="3" /><br>
		<label for="message"><font color="black">Message</font> </label><textarea id="message" name="message" tabindex="4" cols="30" rows="8"></textarea><br>

 
<input type="submit" name="envoi" value="Envoyer" />
		
</form>

<br><br><br><br>


<br><br>


<hr>
<h2><font color="tan"><b><font color="#B22222"">
<font size ="2">Siège de l'association IBI SO  -
<font size="2">  18 avenue du Bel Air   - 
<font size="2"> 75012 Paris   - 
<font size="2"> France</adress>
<br><font size="2"><u>Président Robert FEISS  </u></font><br> 
Association de loi 1901 -
R.N.A : W751220337  -
J.O du 13/07/2013 -
N° siret : 794 386 896 00011</font></adress>
</div>
</body>
</html>