<?php
ob_start();
session_start();
require_once '../dbcon.php';
require_once '../common-asserts/functions.php';

if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}


// recuperer le client //
if (isset($_GET["id"]) and $_GET["id"].is_numeric()){
  $id_client=floatval($_GET["id"]);

  // verifier cette id //
  $requete_client = $bdd->query("SELECT * FROM client WHERE id =".$id_client);

  if( $data_client = $requete_client->fetch()){
    // le client est bien accédé // 

  }else{
    header("Location: lesclients.php");
    exit;
  }

}else{
    header("Location: lesclients.php");
    exit;
}


require_once 'actions_admin.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include_once 'head.php'; ?>
</head>
<body>
<div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="https://www.tic-tac-cartegrise.fr/admin/index.php" class="simple-text logo-normal">
          <img src="https://www.tic-tac-cartegrise.fr/partenaire/images/logo.png" width="180" height="50" alt="Tic-Tac Carte Grise">
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item   ">
            <a class="nav-link" href="./index.html">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="./lesclients.php">
              <i class="material-icons">person</i>
              <p>Clients</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./lespartenaires.php">
              <i class="material-icons">content_paste</i>
              <p>Partenaire</p>
            </a>
          </li>
          <!-- 
          <li class="nav-item ">
            <a class="nav-link" href="./typography.html">
              <i class="material-icons">library_books</i>
              <p>Professionel</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./icons.html">
              <i class="material-icons">bubble_chart</i>
              <p>Icons</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./map.html">
              <i class="material-icons">location_ons</i>
              <p>Maps</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./notifications.html">
              <i class="material-icons">notifications</i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./rtl.html">
              <i class="material-icons">language</i>
              <p>RTL Support</p>
            </a>
          </li>
          <li class="nav-item active-pro ">
            <a class="nav-link" href="./upgrade.html">
              <i class="material-icons">unarchive</i>
              <p>Upgrade to PRO</p>
            </a>
          </li>
        -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="index.php">Dashboard</a>/ 
            <a class="navbar-brand" href="lesclients.php">Clients</a>/
            <?php  echo $data_client['nom'].' '.$data_client['prenom']; ?>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="profil.php">Profil</a>
                  <a class="dropdown-item" href="#">Réglages</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="deconnect.php">Deconnexion</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
     <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title"><b> <?php echo $data_client['nom'].' '.$data_client['prenom']; ?></h4>
                  <p class="card-category"><i><?php echo demarche_text($data_client['demarche']); ?></i></b></p>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Date de création</label>
                          <input type="text" name="date_creation" class="form-control" value=<?php echo '"'.$data_client['date_creation'].'"' ?>   disabled>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Prix</label>
                          <input type="text" class="form-control" name="prix" value=<?php echo '"'.$data_client['prix'].' €"' ?> disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Etat de paiement</label>
                          <input type="text" name="payer" class="form-control" value=<?php echo '"'.$data_client['payer'].'"' ?> disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nom</label>
                          <input type="text" class="form-control" value=<?php echo '"'.$data_client['nom'].'"' ?> disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Prénom</label>
                          <input type="text" class="form-control" value=<?php echo '"'.$data_client['prenom'].'"' ?> disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Courrier électronique</label>
                          <input type="email" name="email" class="form-control" value=<?php echo '"'.$data_client['email'].'"' ?> disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Téléphone</label>
                          <input type="text" name="numero" class="form-control" value=<?php echo '"'.$data_client['numero'].'"' ?> disabled>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
                          <input type="text" name="status" class="form-control" value=<?php echo '"'.status_text($data_client['status']).'"' ?> disabled>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Démarche</label>
                          <input type="text" name="demarche" class="form-control" value=<?php echo '"'.demarche_text($data_client['demarche']).'"'; ?> disabled>
                        </div>
                      </div>
                    </div>                    
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">Type</label>
                          <input type="text" name="type" class="form-control" value=<?php echo '"'.type_text($data_client['type']).'"'; ?> disabled>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Puissance fiscale</label>
                          <input type="text" name="cv" class="form-control" value=<?php echo '"'.$data_client['cv']." CV".'"'; ?> disabled>
                        </div>
                      </div>
                    </div>                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Département</label>
                          <input type="text" name="departement" class="form-control" value=<?php echo '"'.departement_text($data_client['departement']).'"'; ?> disabled>
                        </div>
                      </div>
                      <?php 
                      if (!empty($data_client['circulation'])){

                        ?>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mise en circulation</label>
                          <input type="text" name="circulation" class="form-control" value=<?php echo '"'.$data_client['circulation'].'"'; ?> disabled>
                        </div>
                      </div>
                      <?php 
                       }

                        ?>
                    </div>                   
                    <div class="row">
                       <?php 
                      if (!empty($data_client['energie'])){

                        ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Energie</label>
                          <input type="text" name="energie" class="form-control" value=<?php echo '"'.energie_text($data_client['energie']).'"'; ?> disabled>
                        </div>
                      </div>
                       <?php 
                      }
                      if (!empty($data_client['ptac'])){

                        ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">PTAC</label>
                          <input type="text" name="ptac" class="form-control" value=<?php echo '"'.ptac_text($data_client['ptac']).'"'; ?> disabled>
                        </div>
                      </div>
                      <?php 
                      }
                      if (!empty($data_client['co2'])){

                        ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">CO2</label>
                          <input type="text" name="co2" class="form-control" value=<?php echo '"'.$data_client['co2'].'"'; ?> disabled>
                        </div>
                      </div>
                       <?php 
                      }
                      if (!empty($data_client['modele'])){

                        ?>
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Modèle</label>
                          <input type="text" name="modele" class="form-control" value=<?php echo '"'.modele_text($data_client['modele']).'"'; ?> disabled>
                        </div>
                      </div>
                       <?php 
                      }
                      if (!empty($data_client['immatriculation'])){

                        ?>
                        <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Immatriculation</label>
                          <input type="text" name="immatriculation" class="form-control" value=<?php echo '"'.$data_client['immatriculation'].'"'; ?> disabled>
                        </div>
                      </div>
                       <?php 
                       }
                        ?>
                    </div>
                    <input type="hidden" name="id" required value=<?php echo '"'.$data_client['id'].'"'; ?> >
                    <?php 
                    if ($data_client['status'] == 'en_cours'){
                      // afficher le boutton confirmer & bloquer//
                      ?>
                      <button type="submit" name="submit_confirm_client" class="btn btn-primary pull-right">Traiter</button>
                      <button type="submit" name="submit_suspend_client" class="btn pull-left">Suspendre</button>

                    <?php 
                    } else{
                      // sinon afficher l'état //
                      echo "<p> Ce client est ".status_text($data_client['status'])."  </p>";
                    }

                    ?>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script> Tic-Tac Carte grise ,  
            <a href="https://samseo.fr/" target="_blank">Agence SAMSEO</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
  
  	<?php include_once 'footer.php'; ?>

</body>
</html>