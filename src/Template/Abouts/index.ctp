<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		
		
	</head>
	<body>
		<header>
			À propos
		</header>
		
		
		<h2>Oussama Youcef Bokari</h2>
		<h2>Applications Internet (4205B7MO - Automne 2018)</h2>
		<h2>Automne 2018, Collège Montmorency</h2>
                <h2>GitHub:</h2>
                <a href="https://github.com/ycfos13579/CakePHP/">Mon dépôt sur github.</a>
               
                <p>l'intérêt de ce prototype d'application web : cette application permet d'ajouter des adresses, des clients, des employés et des fichiers et les dtocker dans sur une base de donées. Elle peut etre utlisé dans plusieurs domaines comme par Example les banques. </p>
		<p>L'admin à le droit de tout faire.</br>L'employé peut tout faire sauf supprimer.</br>Le client peut juste voir.
                </br> Pour tester le fonctionnement de l'interface AngularJS et le modèle "CRUD" monopage veuillez cliquer sur "List Accounts"
                après l'authentification avec un utlisateur admin. </br>Pour tester le fonctionnement du cliquer-glisser pour ajouter une image veuillez cliquer sur "List files"
                après l'authentification avec un utlisateur admin.  
                </br> En ce qui concerne les listes dynamiques, on doit juste cliquer sur le lien en haut des pages.
                </br> Le démarrage de session avec un jeton JWT m'a créé des bogues que je n'ai pas pu régler donc je l'ai retiré pour permettre le fonctionnement du reste de l'application.
                </br> Le Captcha n'est pas fait car je n'ai pas réussi à faire la partie JWT.
                

                <h2>Le diagramme de la base de données actuelle utilisée par mon application:</h2> 
		<?php
                        echo $this->Html->image('maBdTp2.PNG', [
                            "alt" => 'maBd',
                            "width" => "750px",
                            "height" => "450px"
                        ]);
                        ?>
		<h2>Le diagramme original à partir duquel ma BD a été conçue:</h2>
                
                
                <?php
                        echo $this->Html->image('bdOriginale.PNG', [
                            "alt" => 'bdOriginale',
                            "width" => "420px",
                            "height" => "250px"
                        ]);
                        ?>
		
	</body>
</html>