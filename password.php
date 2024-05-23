<?php
$password =12345678;
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash."<br/>";
$dec = password_verify($password, $hash);
echo $dec;

?>