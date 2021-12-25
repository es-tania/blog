<?php 
// On initialise une session
session_start();
// On la détruit pour que l'utilisateur soit déconnecté
session_destroy();
header('location:index.php');
?>