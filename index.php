<!DOCTYPE html> 
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <title>Gestion des abonnés</title>
       <link rel="shortcut icon" href="../img/mobile/favicon.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
    </head>
    <body>
        <div data-role="page">
 
            <div data-role="header">
                <h1>Gestion des abonnés</h1>
            </div><!-- /Entete de la page -->
 
            <div data-role="content">
                <form action="accueil.php" method="post">
                    <fieldset data-role="fieldcontain">
                        <caption>Connexion</caption>
                        <p>
                            <label for="email">Email :</label>
                            <input type="text" name="email" id="email" />
                        </p>
                        <p>
                            <label for="pwd">Mot de passe :</label>
                            <input type="password" name="pwd" id="pwd" />
                        </p>
                        <p>
                            <input type="submit" value="Valider" data-theme="b" />
                        </p>
                    </fieldset>
                </form>
            </div><!-- /Formulaire de connexion -->
 
            <div data-role="footer">
                <h4>&copy; <a href="http://www.mobile-tuts.com" title="Mobile-tuts! Actualités et tutoriels autour du mobile">Mobile-tuts!</a> 2011</h4>
            </div><!-- /Pied de page -->
 
        </div><!-- /Page Login -->
    </body>
</html>