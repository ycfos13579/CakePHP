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
               
                <p>Cette application permet d'ajouter des adresses, des clients, des employés et des fichiers et les dtocker dans sur une base de donées. Elle peut etre utlisé dans plusieurs domaines comme par Example les banques. </p>
		<p>L'admin à le droit de tout faire.</br>L'employé peut tout faire sauf supprimer.</br>Le client peut juste voir.
                </br>Pour vérifier les éxigence de l'API et l'admin veuillez cliquer sur "List Accounts"
                après l'authentification avec un utlisateur admin. </br>L'impression en pdf est se trouve avec le reste des actions appliquées sur "Adresses".  
                </br> En ce qui concerne l'autocoplete et les listes dynamiques, on doit juste cliquer sur les liens en haut des pages.
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