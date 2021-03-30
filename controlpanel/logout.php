<?php
session_start();   //start The session
session_unset();   // unset The Data
session_destroy(); // Destroy The Session

header('Location: dlogin.php');
