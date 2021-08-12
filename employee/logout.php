<?php
//End the sessions...
session_unset();
session_destroy();

header("Location: login.php");
?>