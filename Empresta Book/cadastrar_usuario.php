<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Empresta Book</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">

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
            margin-top: 10px;
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
            margin-top: 10px;
        }

        h2 {
            font-family: 'NomeDaFonte', sans-serif;
        }

        h6{
           
            color: rgba(13, 130, 189, 0.76);
            text-align:center;
        }
    </style>

</head>

<body>

<div class="container" id="container">
        <div class="img-header">
            <h2>CRIAR CADASTRO</h2>
       
        </div>

        <h6>Crie sua conta para acessar os serviços</h6>
        <form action="inserir_usuario.php" method="post" id="cadastroForm">

        <div class="form-group">
    <label for="nome" class="form-label">Nome:<span class="required">*</span></label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo"
        oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
    <div class="invalid-feedback"></div>
</div>

            <div class="form-row">
            <div class="form-group col-md-6">
    <label for="cpf" class="form-label">CPF:<span class="required">*</span></label>
    <input type="text" class="form-control" id="cpf" name="cpf" pattern=".{14}" maxlength="14"
        placeholder="xxx.xxx.xxx-xx" inputmode="numeric"
        oninput="this.value = this.value.replace(/\D/g, '')">
    <div class="invalid-feedback"></div>
</div>
                <div class="form-group col-md-6">
                    <label for="dataNascimento" class="form-label">Data de Nascimento:<span class="required">*</span></label>
                    <input type="date" class="form-control" id="dataNascimento" min="1500-01-01" max="2023-12-31" name="dataNascimento"
                        placeholder="Data de Nascimento" >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefone" class="form-label">Telefone:<span class="required">*</span></label>
                    <input type="text" class="form-control" id="telefone" name="telefone" 
                    pattern=".{15}" maxlength="15" placeholder="(xx) xxxxx-xxxx"  inputmode="numeric"
                        oninput="this.value = this.value.replace(/\D/g, '')">
                        
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group col-md-6">
                    <label for="nivel" class="form-label">Função:<span class="required">*</span></label>
                    <select class="form-control" id="nivel" name="nivel" >
                        <option value="">Selecione o nível</option>
                        <option value="1">Bibliotecario</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email" class="form-label">E-mail:<span class="required">*</span></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group col-md-6">
                    <label for="usuario" class="form-label">Usuário:<span class="required">*</span></label>
                    <input type="text" class="form-control" id="usuario" minlength="6" name="usuario" placeholder="Usuário" >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="senha" class="form-label">Crie uma Senha:<span class="required">*</span></label>
                    <input type="password" class="form-control"  pattern=".{6}"  maxlength="6"  id="senha" name="senha" placeholder="Senha" >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group col-md-6">
                    <label for="CSenha" class="form-label">Confirmar senha:<span class="required">*</span></label>
                    <input type="password" class="form-control"  pattern=".{6}"  maxlength="6"  id="CSenha" name="CSenha"
                        placeholder="Confirma senha" >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="btn-container">

            <a href="login.php" role="button" class="btn btn-outline-primary btn-lg">Cancelar</a>
                <button type="submit" id="botao" class="btn btn-success btn-lg">Cadastrar</button>
                
            </div>
        </form>
    </div>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
   const form = document.getElementById('cadastroForm');

form.addEventListener('submit', function (event) {

    function validarCampo(input) {
        if (input.value.trim() === "") {
            input.classList.add('is-invalid');
            input.nextElementSibling.textContent = "Este campo é obrigatório.";
            event.preventDefault();
            return false;
        } else {
            input.classList.remove('is-invalid');
            input.nextElementSibling.textContent = "";
            return true;
        }
    }
  
    const nomeInput = document.getElementById('nome');
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');
    const dataNascimentoInput = document.getElementById('dataNascimento');
    const nivelInput = document.getElementById('nivel');
    const usuarioInput = document.getElementById('usuario');
    const emailInput = document.getElementById('email');
    const senhaInput = document.getElementById('senha');
    const confirmarSenhaInput = document.getElementById('CSenha');

    validarCampo(nomeInput);
    validarCampo(cpfInput);
    validarCampo(telefoneInput);
    validarCampo(dataNascimentoInput);
    validarCampo(nivelInput);
    validarCampo(usuarioInput);
    validarCampo(emailInput);
    validarCampo(senhaInput);
    validarCampo(confirmarSenhaInput);

   // Validação do usuário
if (usuarioInput.value.trim() === "") {
    event.preventDefault();
    usuarioInput.classList.add('is-invalid');
    usuarioInput.nextElementSibling.textContent = "O usuário é obrigatório.";
} else if (usuarioInput.value.includes(" ")) {
    event.preventDefault();
    usuarioInput.classList.add('is-invalid');
    usuarioInput.nextElementSibling.textContent = "O usuário não pode conter espaços.";
} else {
    usuarioInput.classList.remove('is-invalid');
    usuarioInput.nextElementSibling.textContent = "";
}
    // Validação de e-mail
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value)) {
        event.preventDefault();
        emailInput.classList.add('is-invalid');
        emailInput.nextElementSibling.textContent = "Por favor, insira um endereço de email válido.";
    } else {
        emailInput.classList.remove('is-invalid');
        emailInput.nextElementSibling.textContent = "";
    }

    // Validação da senha (exatamente 6 caracteres e sem espaços)
    if (senhaInput.value.length !== 6 || senhaInput.value.includes(" ")) {
        event.preventDefault();
        senhaInput.classList.add('is-invalid');
        senhaInput.nextElementSibling.textContent = "A senha deve conter 6 caracteres.";
    } else {
        senhaInput.classList.remove('is-invalid');
        senhaInput.nextElementSibling.textContent = "";
    }

    // Validação de confirmação de senha (mesmo critério da senha)
    if (confirmarSenhaInput.value.length !== 6 || confirmarSenhaInput.value.includes(" ")) {
        event.preventDefault();
        confirmarSenhaInput.classList.add('is-invalid');
        confirmarSenhaInput.nextElementSibling.textContent = "A senha deve conter 6 caracteres.";
    } else {
        confirmarSenhaInput.classList.remove('is-invalid');
        confirmarSenhaInput.nextElementSibling.textContent = "";
    }

    // Verificar se as senhas coincidem
    if (senhaInput.value !== confirmarSenhaInput.value) {
        event.preventDefault();
        senhaInput.classList.add('is-invalid');
        confirmarSenhaInput.classList.add('is-invalid');
        senhaInput.nextElementSibling.textContent = 'As senhas não coincidem.';
        confirmarSenhaInput.nextElementSibling.textContent = 'As senhas não coincidem.';
    }
});

document.addEventListener("DOMContentLoaded", function () {
    function formatarCPF(cpf) {
        cpf = cpf.replace(/\D/g, ""); 
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        return cpf;
    }

    function formatarTelefone(telefone) {
        telefone = telefone.replace(/\D/g, ""); 
        telefone = telefone.replace(/^(\d{2})(\d)/, "($1) $2");
        telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");
        return telefone;
    }

    document.getElementById("cpf").addEventListener("input", function (e) {
        e.target.value = formatarCPF(e.target.value);
    });

    document.getElementById("telefone").addEventListener("input", function (e) {
        e.target.value = formatarTelefone(e.target.value);
    });

    // Aplica a máscara nos valores vindos do banco de dados
    document.getElementById("cpf").value = formatarCPF(document.getElementById("cpf").value);
    document.getElementById("telefone").value = formatarTelefone(document.getElementById("telefone").value);
});

</script>

</body>

</html>