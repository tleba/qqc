<?php

if ( $config['user_remember'] == '1' ) {
    Remember::del();
}

unset($_SESSION['uid']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['emailverified']);
unset($_SESSION['photo']);
unset($_SESSION['fname']);
unset($_SESSION['gender']);

session_write_close();
header('Location: ' .$config['BASE_URL']);
die();
?>
