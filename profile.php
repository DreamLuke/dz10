<?php
	session_start();

	if ($_SESSION['translit'] != 'User' ) {
		header('Location: ./index.php');
		exit;
	}
	echo 'Информация для Пользователя' . '<br><br>';

	echo $_REQUSET['fio'];
?>

<form action='' method='POST' id='profile-form'>
    <div>
        <label for='edit_role'>Роль</label>
        <input type='text' id='edit_role' name='edit_role'>
    </div>
    <br>
    <div>
        <label for='edit_password'>Пароль</label>
        <input type='text' id='edit_password' name='edit_password'>
    </div>
    <br>
    <div>
        <label for='edit_fio'>ФИО</label>
        <input type='text' id='edit_fio' name='edit_fio'>
    </div>
    <br>
    <div>
        <input type='submit'>
    </div>
    <br>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>
    $(function() {
        $('#profile-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: 'POST',
                url: '/edit_profile.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(data)
                {
                    //alert(data['edit_fio']);
                    document.location.href = './index.php';
                }
            });
        });
    });
</script>



