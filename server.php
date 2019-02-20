<?php
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


    $status = true;
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)) {
        $status = false;
    }

    if($status) {
        $sql = "SELECT * FROM users WHERE email = :email and password=:password limit 1";
        $rows = $pdo->prepare($sql);
        $rows->execute(['email' => $email, 'password'=>md5($password)]);

        $userData = $rows->fetch();
        // var_dump($userData);

        if($userData) {
            session_start();

            $id = $userData['id'];
            $email = $userData['email'];
            $fio = $userData['fio'];
            $role_id = $userData['role_id'];

            // if(empty($_SESSION['id'])) {
                $_SESSION['id'] = $id;
            // }
            // if(empty($_SESSION['email'])) {
                $_SESSION['email'] = $email;
            // }
            // if(empty($_SESSION['fio'])) {
                $_SESSION['fio'] = $fio;
            // }
            // if(empty($_SESSION['role_id'])) {
                $_SESSION['role_id'] = $role_id;
            // }

            $last_date = date('Y-m-d');
            $sql = "UPDATE users SET last_enter_date = :last_date WHERE id = :id";
            $rows = $pdo->prepare($sql);
            $rows->execute(['last_date' => $last_date, 'id' => $id]);

            //получаю роль
            $sql = "SELECT * FROM roles WHERE id = :role_id";
            $rolesRows = $pdo->prepare($sql);
            $rolesRows->execute(['role_id' => $role_id]);

            $userData = $rolesRows->fetch();

            // if(empty($_SESSION['translit'])) {
                $_SESSION['translit'] = $userData['translit'];
            //}

            $answer = $userData['translit'];
            // $answer = 'OK';
        } else {
            $answer = 'no user';
        }
    }

    echo json_encode(compact(['status'], ['email'], ['password'], ['rows'], ['answer']));
?>