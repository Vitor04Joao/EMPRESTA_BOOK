<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Empresta Book</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <style>
    body {
      background-image: linear-gradient(to right, #ffffff 0%, #7DD3EF 35%, rgb(0, 172, 230) 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }

    .btn-primary {
      border-radius: 10px;
      font-size: 20px;
      width: 200px;
      align-items: center;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .box {
      background-color: white;
      border-radius: 15px;
      padding: 30px;
      width: 520px;
      height: 560px;
    }

    .link-container {
      text-align: center;
    }

    .link {
      display: inline-block;
      margin: 0 20px;
    }

    p {
      font-size: 19px;
      color: rgb(126, 132, 135);
    }

    .form-group {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-group input {
    width: 295px; 
    height: 62px; 
    padding-left: 15px;
}


.input-error::placeholder {
  display: block;
   
    font-size: 14px;
    color: red;
    margin-top: 5px;
    width: 100%;
    }


    .invalid-feedback {
    display: block;
    text-align: center;
    font-size: 14px;
    color: red;
    margin-top: 5px;
    width: 100%;
}


  </style>

</head>

<body>

  <div class="container">

    <div class="box">
      <div style="text-align: center;">
        <img src="IMG/logo2.png" alt="logo" width="349px" style="margin-top: 10px;">
      </div>

      <form id="loginForm" action="validaUsuario.php" method="post" style="margin-top: 20px;">
        <div class="form-group">
         
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="USUÁRIO" autocomplete="off" >
        <div class="invalid-feedback"></div>  
        </div>

        <div class="form-group">
          
          <input type="password" name="senha" id="senha" class="form-control" pattern=".{6,}" maxlength="6" placeholder="SENHA" autocomplete="off" >
           <div class="invalid-feedback"></div>  
        </div>

       

        <div style="text-align: center;">
          <button class="btn btn-primary" type="submit">ACESSAR</button>

          <br><br><br>

          <div class="link-container">
            <div class="link">
              <p><a href="recuperarSenha.php">Esqueceu sua senha?</a></p>
              <p class="test">Ainda não tem uma conta?<a href="cadastrar_usuario.php"> Clique aqui!</a></p>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
      let valid = true;

      function validarCampo(input, mensagemErro) {
        if (input.value.trim() === "") {
          input.classList.add('is-invalid');
          input.nextElementSibling.textContent = mensagemErro;
          valid = false;
        } else {
          input.classList.remove('is-invalid');
          input.nextElementSibling.textContent = "";
        }
      }

      const usuarioInput = document.getElementById('usuario');
      const senhaInput = document.getElementById('senha');

      validarCampo(usuarioInput, "Preencha o usuário.");
      validarCampo(senhaInput, "Preencha a senha de 6 digitos!");

      // Validação específica para a senha (Campos obrigatorios)

      if (usuarioInput.value.includes(" ")) {
        usuarioInput.classList.add('is-invalid');
        usuarioInput.nextElementSibling.textContent = "A usuário não pode conter espaços.";
        valid = false;
        
      }

      if (senhaInput.value.includes(" ")) {
        senhaInput.classList.add('is-invalid');
        senhaInput.nextElementSibling.textContent = "A senha não pode conter espaços.";
        valid = false;
      }

      // Impede o envio do formulário caso apresente erros

      if (!valid) {
        event.preventDefault();
      }
    });
  </script>



</body>

</html>
