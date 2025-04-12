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

        #container {
            width: 770px;
            border-radius: 15px;
            margin-top: 20px;
            padding: 20px; 
          
        }

        .d-flex{
            justify-content: space-between;
            
        }
 
        .btn-container {
            display: flex;
            justify-content: flex-end;
           
        }

        .btn {
        
            margin-top: 30px;
        }

            .FgNome{
            display: flex;
            flex-direction: column;
            width: 485px;
            
            }

            .data{
            display: flex;
            flex-direction: column;
            margin-left: 15px;
            width: 234px;
            
            }

            .igual{
            display: flex;
            flex-direction: column;
            width: 234px;
            
            
            }

            .Fg2{
            display: flex;
            flex-direction: column;
            width: 365px;
            
          
            }

            .Fg3{
            display: flex;
            flex-direction: column;
            width: 365px;
            
            margin-left: 10px;
          
            }
            .senha{
            display: flex;
            flex-direction: column;
            width: 365px;
                       
            }

            .btn-container {
            text-align: right;
            position: fixed;
            bottom: 20px;
            right: 26%;
            width: 100%;
            }

            .NVsenha{
            display: flex;
            flex-direction: column;
            width: 365px;
            
            margin-left: 10px;
            }

            .busca{
            display: flex;
            margin-top:5px;
            margin-left:100px;
            flex-direction: column;
            align-items: left;
            width: 150px;
            height: 32px;
 
                }

      
    </style>
</head>

<body>
    <?php
    session_start();
    $usuario = $_SESSION['usuario'];

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }

    include 'cabecalho.php';
    ?>

    <div class="container" id="container">
        <?php
        include 'conexao.php';
        $sql = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario'";
        $busca = mysqli_query($conec, $sql);

        while ($array = mysqli_fetch_array($busca)) {
            $id = $array['id'];
            $nome = $array['nome'];
            $email = $array['email'];
            $telefone = $array['telefone'];
            $dataNascimento = $array['dataNascimento'];
            $cpf = $array['cpf'];
            $nivel = $array['nivel'];
            ?>
              
              <div >
        <a href="usuario.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a>  Meu Perfil</h2>
        </div>

            <form action="atualizar_usuario.php" method="post"  id="cadastroForm" style="margin-top: 24px">

               
                    <div >
                       
                        <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>" readonly>
                    </div>



                    <div class="form-row">
                    <div class="FgNome">

                    <label for="nome" class="form-label">Nome:<span class="required">*</span></label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome ?>" 
                        oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
                        <div class="invalid-feedback"></div>

                    </div>

                    <div class="data">
                    <label for="dataNascimento" class="form-label">Data de Nascimento:<span class="required">*</span></label>
                        <input type="date" class="form-control" id="dataNascimento" min="1500-01-01" max="2023-12-31" name="dataNascimento" value="<?php echo $dataNascimento ?>">
                        <div class="invalid-feedback"></div>
                    </div>

                </div>


                <div class="d-flex" >
              
              <div class="igual">
              
              <label for="cpf" class="form-label">CPF:<span class="required">*</span></label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cpf ?>" 
                        maxlength="14"  pattern=".{14}" placeholder="xxx.xxx.xxx-xx" inputmode="numeric" 
        oninput="this.value = this.value.replace(/\D/g, '')" readonly >
                        <div class="invalid-feedback"></div>
          </div>
       
       
                     <div class="igual">
                 
                     <label for="telefone" class="form-label">Telefone:<span class="required">*</span></label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $telefone ?>"
                        pattern=".{15}" maxlength="15" placeholder="(xx) xxxxx-xxxx" inputmode="numeric"
                        oninput="this.value = this.value.replace(/\D/g, '')">

                        <div class="invalid-feedback"></div>
              
                             </div>
                 
                     <div class="igual">
       
                     <label for="email" class="form-label">E-mail:<span class="required">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        <div class="invalid-feedback"></div>
                    </div>
                 </div>

            
                <div class="form-row">
                   
                    <div class="Fg2">
                    <label for="usuario" class="form-label">Usuário:<span class="required">*</span></label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario ?>" readonly>
                        <div class="invalid-feedback"></div>
                    </div>

                   
                    <div class="Fg3">
                        <label for="nivel" class="form-label">Função:</label>
                        <input type="text" class="form-control" id="nivel" name="nivel" value="<?php
                                if ($nivel == 1) {
                                    echo "Bibliotecário";
                                } elseif ($nivel == 2) {
                                    echo "Test";
                                }
                                ?>" readonly>
                    </div>


                </div>
<br>
                <h4> Minha Senha </h4>



<?php

include 'conexao.php';

// Ajuste para ativar os botões se a senha for validada no banco
// Já Começa desabilitado
$desabilita = "disabled"; 

if (isset($_POST['senhaAtual'])) {
    $usuario = $_SESSION['usuario'];
    $senhaAtual = md5($_POST['senhaAtual']); // Criptografando a senha com algoritimos MD5
    
    // Verificar a senha no banco de dados

    $sql = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario' AND senha = '$senhaAtual'";
    $result = mysqli_query($conec, $sql);
    
    if (mysqli_num_rows($result) > 0) {

        // Senha correta, habilita os campos para alterar a senha

        echo json_encode(['status' => 'success']);
    } else {
        
        echo json_encode(['status' => 'error', 'message' => 'Senha atual incorreta.']);
    }
}
?>

<div class="form-row">
    <div class="senha">
        <label for="senhaAtual" class="form-label">Senha Atual:<span class="required">*</span></label>
        <input type="password" class="form-control" pattern=".{6}" maxlength="6" id="senhaAtual" name="senhaAtual" placeholder="Digite sua senha atual">
        <div id="mensagemErro" style="color: red; font-size: 14px; margin-top: 5px;"></div>
        <div id="mensagemSucesso" style="color: green; font-size: 14px; margin-top: 5px;"></div>
    </div>
    <div class="busca">
        <button type="button" id="verificarSenha" class="btn btn-warning btn-ms">Verificar</button>
    </div>
</div>

<div class="form-row">
    <div class="senha">
        <label for="CSenha" class="form-label">Confirmar senha:<span class="required">*</span></label>
        <input type="password" class="form-control" pattern=".{6}" maxlength="6" id="CSenha" name="CSenha" placeholder="******" disabled>
        <div id="mensagemErro" style="color: red; font-size: 14px; margin-top: 5px;"></div>
        <div id="mensagemSucesso" style="color: green; font-size: 14px; margin-top: 5px;"></div>
    </div>
    
    <div class="NVsenha">
        <label for="Nvsenha" class="form-label">Nova Senha:<span class="required">*</span></label>
        <input type="password" class="form-control" pattern=".{6}" maxlength="6" id="Nvsenha" name="Nvsenha" placeholder="******" disabled>
        <div id="mensagemErro" style="color: red; font-size: 14px; margin-top: 5px;"></div>
        <div id="mensagemSucesso" style="color: green; font-size: 14px; margin-top: 5px;"></div>
    </div>
</div>


                </div>


            <?php } ?>

                <div class="btn-container">
                    <a href="usuario.php" role="button" class="btn btn-primary btn-lg">Voltar</a>&nbsp;&nbsp;
                    <button type="submit" id="botao" class="btn btn-warning btn-lg">Atualizar</button>
                </div>

            </form>
    </div>

    <script>
  document.getElementById('cadastroForm').addEventListener('submit', function(event) {
    let isValid = true;

    function validarCampo(input, mensagem) {
        if (input.value.trim() === "") {
            input.classList.add('is-invalid');
            input.nextElementSibling.textContent = mensagem || "Este campo é obrigatório.";
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
            input.nextElementSibling.textContent = "";
        }
    }

    // Validação dos campos obrigatórios
    validarCampo(document.getElementById('nome'), "O nome é obrigatório.");
    validarCampo(document.getElementById('cpf'), "O CPF é obrigatório.");
    validarCampo(document.getElementById('telefone'), "O telefone é obrigatório.");
    validarCampo(document.getElementById('dataNascimento'), "A data de nascimento é obrigatória.");
    validarCampo(document.getElementById('email'), "O email é obrigatório.");

    let senha = document.getElementById('Nvsenha').value;
    let confirmSenha = document.getElementById('CSenha').value;

    // Só validar as senhas se os campos estiverem habilitados
    if (!document.getElementById('Nvsenha').disabled && !document.getElementById('CSenha').disabled) {
        // Validação das senhas
        let mensagemErro = document.getElementById('mensagemErro');
        let mensagemSucesso = document.getElementById('mensagemSucesso');
        mensagemErro.textContent = "";
        mensagemSucesso.textContent = "";

        if (senha.trim() === "" || confirmSenha.trim() === "") {
            mensagemErro.textContent = "A nova senha e a confirmação não podem estar vazias.";
            isValid = false;
        } else if (senha !== confirmSenha) {
            mensagemErro.textContent = "As senhas não coincidem. Tente novamente.";
            isValid = false;
        }

        // Verificar se a senha tem espaços
        if (senha.includes(" ") || confirmSenha.includes(" ")) {
            mensagemErro.textContent = "As senhas não podem conter espaços.";
            isValid = false;
        }
    }

    let emailInput = document.getElementById('email');
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value.trim())) {
        emailInput.classList.add('is-invalid');
        emailInput.nextElementSibling.textContent = "Insira um email válido.";
        isValid = false;
    }

    if (!isValid) event.preventDefault();
});

document.getElementById('verificarSenha').addEventListener('click', function() {
    const senhaAtual = document.getElementById('senhaAtual').value.trim();
    const mensagemErro = document.getElementById('mensagemErro');
    const mensagemSucesso = document.getElementById('mensagemSucesso');
    
    mensagemErro.textContent = "";
    mensagemSucesso.textContent = "";

    if (!senhaAtual) {
        mensagemErro.textContent = "A senha atual não pode estar vazia.";
        return;
    }
    if (senhaAtual.includes(" ")) {
        mensagemErro.textContent = "A senha atual não pode conter espaços.";
        return;
    }

    fetch('verificar_senha.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'senhaAtual=' + encodeURIComponent(senhaAtual)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('CSenha').disabled = false;
            document.getElementById('Nvsenha').disabled = false;
            document.getElementById('botao').disabled = false;
            mensagemSucesso.textContent = "Senha verificada! Pode alterar.";
        } else {
            mensagemErro.textContent = data.message;
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    
// Remove tudo que não for número para realizar a mascara de CPF/ Telefone

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