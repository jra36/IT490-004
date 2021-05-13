<?
session_start();
session_unset();
session_destroy();
die(header("Location: http://app-load-balancer-818186467.us-east-2.elb.amazonaws.com/~ubuntu/app/register.php"));
?>
