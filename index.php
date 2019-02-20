<form id="form" method="post">
    <div>
        <label for="email">e-mail</label>
        <div>
            <input
                type="text"
                class=""
                id="email"
                name="email"
                value=""
            >
        </div>
    </div>
    <br>

    <div>
        <label for="password">Пароль</label>
        <div>
            <input
                type="password"
                class=""
                id="password"
                name="password"
                value=""
            >
        </div>
    </div>    
    <br>

    <div>
        <button type="submit">Войти</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>
    $(function() {
        $("#form").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: "POST",
                url: '/server.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(data)
                {
                    if(data.status) {
                        document.location.href = './auth_redirect.php';
                        // alert(data['answer']);
                    } else {

                    }
                }
            });
        });
    });
</script>

