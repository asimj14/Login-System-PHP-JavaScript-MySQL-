<?php
//logout page
//when logout destroy the whole session
session_start();
session_destroy();
header("location: index.php");
?>