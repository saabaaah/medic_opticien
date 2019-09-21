<?php 
$message_sous_titre ="";



/////////////////////////////////CLIENT/////////////////////////////////////////

// tester si on vient d'une demande de confirmation //
if(isset($_POST['submit_confirm_client'])){
  // recuperer le client //
  if (isset($_POST["id"]) and $_POST["id"].is_numeric()){
    $id_client=$_POST["id"];

    // verifier cette id //
    $requete_part = $bdd->query("SELECT * FROM client WHERE id =".$id_client);

    if( $data_client = $requete_part->fetch()){
		// le client est bien accédé // 
		// modifier le client //
		$stmt = $bdd->prepare("UPDATE `client`   
						        SET `status` = 'traite'
						      	WHERE `id` = ? ");

		$stmt->execute([$_POST['id']]);
		$data_client['status'] = 'traite';
		$message_sous_titre = "Ce client est traité!";

    }else{
      header("Location: lesclients.php");
      exit;
    }

  }else{
      header("Location: lesclients.php");
      exit;
  }
  
}


// tester si on vient d'une demande de suspense //
if(isset($_POST['submit_suspend_client'])){
  // recuperer le client //
  if (isset($_POST["id"]) and $_POST["id"].is_numeric()){
    $id_client=floatval($_POST["id"]);

    // verifier cette id //
    $requete_part = $bdd->query("SELECT * FROM client WHERE id =".$id_client);
  	if( $data_client = $requete_part->fetch()){
		// le client est bien accédé // 
		// modifier le client //
		$stmt = $bdd->prepare("UPDATE `client`   
						        SET `status` = 'suspendu'
						      	WHERE `id` = ? ");

		$stmt->execute([$_POST['id']]);
		$data_client['status'] ='suspendu';
		$message_sous_titre = "Ce client est suspendu!";
    }else{
      header("Location: lesclients.php");
      exit;
    }

  }else{
      header("Location: lesclients.php");
      exit;
  }
}



?>