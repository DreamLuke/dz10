<?php
	session_start();

	if ($_SESSION['translit'] != 'admin' ) {
		header('Location: ./index.php');
		exit;
	}
	echo 'Информация для Админа (если Вы не Админ - закройте глаза)' . '<br><br>';

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

    $sql = "SELECT * FROM users ORDER BY fio ASC";
	$rows = $pdo->query($sql);
?>

<table>
<?php
	while($user = $rows->fetch()) {
?>
    <tr>
        <td><?php echo ' | ' . $user['role_id'] . ' | ' ?></td>
        <td><?php echo $user['password'] . ' | ' ?></td>
        <td><?php echo $user['fio'] . ' | ' ?></td>
        <td><a href='edit_users.php?id=<?php echo $user['id']; ?>'>edit</a></td>
    </tr>
<?php
}
?>
</table>


