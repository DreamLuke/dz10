<?php
	session_start();

    $host = 'localhost';
    $db = 'joins';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);


    $id = $_SESSION['id'];

    $edit_role = $_POST['edit_role'];
    $edit_password = $_POST['edit_password'];
    $edit_fio = $_POST['edit_fio'];

    if(!empty($edit_role) && filter_var($edit_role, FILTER_VALIDATE_INT) && $edit_role > 0) {
        $sql = "UPDATE users SET role_id=:edit_role WHERE id = :id";
        $rows = $pdo->prepare($sql);
        $rows->execute(['edit_role' => $edit_role, 'id' => $id]);
    }

    if(!empty($edit_password)) {
        $sql = "UPDATE users SET password=:password WHERE id = :id";
        $rows = $pdo->prepare($sql);
        $rows->execute(['password' => md5($edit_password), 'id' => $id]);
    }

     if(!empty($edit_fio)) {
        $sql = "UPDATE users SET fio=:fio WHERE id = :id";
        $rows = $pdo->prepare($sql);
        $rows->execute(['fio' => $edit_fio, 'id' => $id]);
    }

    echo json_encode(compact(['edit_role'], ['edit_password'], ['edit_fio']));
?>




