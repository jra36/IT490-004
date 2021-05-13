<?
session_start();
session_unset();
session_destroy();
die(header("Location: register.php"))
exit();
?>
