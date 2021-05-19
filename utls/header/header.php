


<?php
$path = "img/logo2.png";
if(!realpath($path)){
    while(realpath($path)){
        $path = "../" . $path;
    }
}
?>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="http://quickbaluchonservice.site/QuickBaluchon/#"><img id="imgQB" src="../img/logo2.png" width="12%"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../signUp/signUp.php">S'inscrire</a>
                    </li>
                    <?php
                        if(isset($_SESSION["status"]) && $_SESSION["status"] == 3) {
                            echo'
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                    </li>';
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../signIn/signIn.php">Se connecter</a>
                    </li>
                    <?php
                    if(isset($_SESSION["id_session"])) {
                        echo '
                        <li class="nav-item">
                            <a class="nav-link" href="../signOut/signOut.php">Se déconnecter</a>
                        </li>';
                    }?>
                </ul>
            </div>
        </nav>
    </header>