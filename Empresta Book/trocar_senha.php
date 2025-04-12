<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: linear-gradient(to right, #ffffff 0%, #7DD3EF 35%, rgb(0, 172, 230) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0px;
        }

        #container {
            width: 467px;
            background-color: white;
            padding: 20px;
            border-radius: 15px;
        }

        .img-header {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-group {
            margin-bottom: 0px;
        }

        .form-label {
            font-size: 17px;
            color: rgb(1, 113, 161);
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
        }

        .btn {
            margin-left: 10px;
            margin-top: 17px;
        }

        h2 {
            font-family: 'roboto', sans-serif;
        }

        h6 {
            color: rgba(13, 130, 189, 0.76);
            text-align: center;
        }

        .is-invalid .invalid-feedback {
            display: block; 
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="img-header">
            <h2>Trocar Senha</h2>
        </div>
        <h6>Digite sua nova senha.</h6>
        <form action="atualizar_senha.php" method="post" id="changePasswordForm">
            <input type="hidden" name="cpf" value="<?php echo $_GET['cpf']; ?>">

            <div class="form-group">
                <label for="nova_senha" class="form-label">Nova Senha:</label>
                <input type="password" class="form-control"  pattern=".{6}"  maxlength="6"  name="nova_senha" id="nova_senha" placeholder="Nova Senha" >
                <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                <label for="confirmar_senha" class="form-label">Confirmar Senha:</label>
                <input type="password" class="form-control"  pattern=".{6}"  maxlength="6"  name="confirmar_senha" id="confirmar_senha"
                    placeholder="Confirmar Senha" >
                <div class="invalid-feedback"></div>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-success btn-lg">Atualizar Senha</button>
            </div>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script>
    const form = document.getElementById('changePasswordForm');

    form.addEventListener('submit', function (event) {
        const novaSenhaInput = document.getElementById('nova_senha');
        const confirmarSenhaInput = document.getElementById('confirmar_senha');

        // Limpar erros anteriores
        novaSenhaInput.classList.remove('is-invalid');
        confirmarSenhaInput.classList.remove('is-invalid');
        novaSenhaInput.nextElementSibling.textContent = '';
        confirmarSenhaInput.nextElementSibling.textContent = '';

        let hasError = false; 

        // Validação de comprimento da senha
        if (novaSenhaInput.value.length < 6) {
            event.preventDefault();
            novaSenhaInput.classList.add('is-invalid');
            novaSenhaInput.nextElementSibling.textContent = 'A senha deve ter 6 caracteres.';
            
            hasError = true;
        }

        // Validação de espaços nos campos das senhas
        if (novaSenhaInput.value.includes(" ")) {
            event.preventDefault();
            novaSenhaInput.classList.add('is-invalid');
            novaSenhaInput.nextElementSibling.textContent = "A senha não pode conter espaços.";
            confirmarSenhaInput.nextElementSibling.textContent = 'A senha não pode conter espaços.';
            hasError = true;
        }

        // Validação de senhas iguais
        if (novaSenhaInput.value !== confirmarSenhaInput.value) {
            event.preventDefault();
            novaSenhaInput.classList.add('is-invalid');
            confirmarSenhaInput.classList.add('is-invalid');
            novaSenhaInput.nextElementSibling.textContent = 'As senhas não coincidem.';
            confirmarSenhaInput.nextElementSibling.textContent = 'As senhas não coincidem.';
            hasError = true;
        }

        if(hasError){
            confirmarSenhaInput.classList.add('is-invalid');
        }

    });
</script>
</body>

</html>