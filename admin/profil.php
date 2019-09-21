<?php

ob_start();
session_start();

require_once '../dbcon.php';
require_once '../common-asserts/functions.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}


$message_sous_titre = "Mettre à jour mon profil";
// tester si on vient d'une demande de modification //
if(isset($_POST['submit_update_profile'])){
   // modifier le   lesadmins //
  // modifier le client //
  $stmt = $bdd->prepare("UPDATE `lesadmins`   
              SET `nom` = ?,
                  `prenom` = ?,
                  `admin_pseudo` = ?,
                  `admin_email` = ?
            WHERE `id_admin` = ? ");
  $stmt->execute([$_POST['nom'],$_POST['prenom'],$_POST['admin_pseudo'],$_POST['admin_email'],$_SESSION['admin_id']]);

  $message_sous_titre = "Le profil a été mis à jour avec succès!";

}

$req_admin = $bdd->query("SELECT * FROM lesadmins WHERE id_admin =" . $_SESSION['admin_id']);
$reqinfo = $req_admin->fetch();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include_once 'head.php'; ?>
</head>
<body>
    <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">

      <div class="logo">
        <a href="https://www.tic-tac-cartegrise.fr/admin/index.php" class="simple-text logo-normal">
          <img src="https://www.tic-tac-cartegrise.fr/partenaire/images/logo.png" width="180" height="50" alt="Tic-Tac Carte Grise">
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item  ">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
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
        -->
        </ul>
      </div>
  </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">Profil Administrateur</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
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
                  <a class="dropdown-item" href="#">Profils</a>
                  <a class="dropdown-item" href="#">Réglage</a>
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
            <div class="col-md-10">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Mon Profil</h4>
                  <p class="card-category"><?php echo '"'.$message_sous_titre.'"'; ?> </p>
                </div>
                <div class="card-body">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Pseudo</label>
                          <input type="text" class="form-control" name="admin_pseudo" required value=<?php echo '"'.$reqinfo['admin_pseudo'].'"'; ?> >
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" class="form-control" name="admin_email" required value=<?php echo '"'.$reqinfo['admin_email'].'"'; ?> >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nom</label>
                          <input type="text" class="form-control" name="nom" required value=<?php echo '"'.$reqinfo['nom'].'"'; ?> >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Prénom</label>
                          <input type="text" class="form-control" name="prenom" required value=<?php echo '"'.$reqinfo['prenom'].'"'; ?> >
                        </div>
                      </div>
                    </div>
                    <button type="submit" name="submit_update_profile" class="btn btn-primary pull-right">Confirmer</button>
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
  <script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>
    <?php include_once 'footer.php'; ?>

</body>
</html>