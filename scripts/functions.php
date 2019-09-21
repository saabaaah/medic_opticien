<?php

// verifier si on vient de lancer un calcul //
 if(isset($_POST['action_add_client']))
 {
 	// recuperer les données //
 	/*
 	$addresse_exp = $_POST['addresse_exp'];
 	$ville_exp = $_POST['ville_exp'];
 	$pays_exp = $_POST['pays_exp'];
 	$addresse_des = $_POST['addresse_des'];
 	$ville_des = $_POST['ville_des'];
 	$pays_des = $_POST['pays_des'];
 	$zip_des = $_POST['zip_des'];
 	$zip_exp = $_POST['zip_exp'];
 	$largeur = $_POST['largeur'];
 	$longueur = $_POST['longueur'];
 	$hauteur = $_POST['hauteur'];
 	$poids = $_POST['poids'];*/

	// lancer une requete  au serveur de calcul des frais //

	// sauvegarder ces données //
	$id_client = addClient($_POST);
	if ($id_client) {
		echo "Bienvenu cher ".$id_client;
 	}else{
 		echo "Erreur lors la sauvegarde!";
 	}
 }

//////////////////////// fct colis  ///////////////////////

function addClient($_POST) {
	echo "<br>- addClient <br>";
	print_r($_POST);
    global $bdd;

    $stmt = $bdd->prepare('INSERT INTO `client`(`nom`, `prenom`, `date_naissance`,`email`, `adresse`, `societe`, `carte_m_recto`, `carte_m_verso`)
    	VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param(
    	"ssssssss",
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['date_naissance'],
        $_POST['email'],
        $_POST['adresse'],
        $_POST['societe'],
        $_POST['carte_m_recto'],
        $_POST['carte_m_verso']
    );
    $stmt->execute();

    echo "<br>- addClient : exec <br>";

    $stmt->close();

    echo "<br>- addClient : ".$bdd->insert_id." <br>";

    return $bdd->insert_id;
}

?>