


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
        <a href="http://localhost:8888/"><img id="imgQB" src="../img/logo2.png" width="12%"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../signIn/signIn.php">Se connecter</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>