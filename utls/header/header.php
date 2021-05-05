


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
        <?php echo '<img id="imgQB" src="';
        echo $path . '" width="12%"> ';?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="signIn/signIn.php">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Se connecter</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>