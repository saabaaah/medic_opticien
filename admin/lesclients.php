<?php
ob_start();
session_start();
require_once '../dbcon.php';
require_once '../common-asserts/functions.php';

if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$requete_clients = $bdd->query("SELECT * FROM client WHERE 1");

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
          <li class="nav-item ">
            <a class="nav-link" href="./index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item  active">
            <a class="nav-link" href="./lesclients.php">
              <i class="material-icons">person</i>
              <p>Clients</p>
            </a>
          </li>
          <li class="nav-item  ">
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
            <a class="navbar-brand" href="index.php">Dashboard</a>/ Clients
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Les clients</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Date
                        </th>
                        <th>
                          Nom du client
                        </th>
                        <th>
                          Demarche
                        </th>
                        <th>
                          Prix
                        </th>
                        <th>
                          Statut
                        </th>
                      </thead>

                      <tbody>
                        <?php 
                        // parcourir et afficher la liste des client de ce partenaire //
                        while ($tmp_client = $requete_clients->fetch()) {
                           echo '
                           <tr>
                            <td >
                              '.substr($tmp_client['date_creation'],0,10).'
                            </td>
                            <td>
                              '.$tmp_client['nom'].' '.$tmp_client['prenom'].'
                            </td>
                            <td>
                              '.demarche_text($tmp_client['demarche']).'
                            </td>
                            <td >
                              '.$tmp_client['prix'].'
                            </td>
                            <td>
                              '.status_text($tmp_client['status']).'
                            </td>                            
                            <td class="text-primary">
                            <a href="client.php?id='.$tmp_client['id'].'">Voir</a>
                            </td>
                          </tr>
                           ';
                        }
                        ?>
                        
                      </tbody>
                    </table>
                    <!--
                    <div class="pagination">
                      <a href="#">&laquo;</a>
                      <a href="#">1</a>
                      <a class="active" href="#">2</a>
                      <a href="#">3</a>
                      <a href="#">4</a>
                      <a href="#">5</a>
                      <a href="#">6</a>
                      <a href="#">&raquo;</a>
                    </div>
                  -->
                  </div>
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