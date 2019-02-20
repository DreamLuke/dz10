<?php
	session_start();

    $translit = $_SESSION['translit'];

    if($translit == 'admin') {
		header('Location: ./users_list.php');
    } else {
		header('Location: ./profile.php');
    }
?>




