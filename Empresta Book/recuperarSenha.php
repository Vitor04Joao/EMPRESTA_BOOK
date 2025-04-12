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
        <form id="recuperacaoForm" action="verificar_dados.php" method="post">

    <div class="img-header">
            <h2>Recuperação de Senha</h2>

        </div>

        <h6>Informe seus dados para recuperar sua senha</h6>
        


            <div class="form-group">
                <label for="nome" class="form-label">Nome completo:<span class="required">*</span></label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" 
                oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
                <div class="invalid-feedback"></div> </div>

            <div class="form-group">
                <label for="cpf" class="form-label">CPF:<span class="required">*</span></label>
                <input type="text" class="form-control" id="cpf" name="cpf"   pattern=".{14}" maxlength="14"
                    placeholder="xxx.xxx.xxx-xx" inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')"> 
                    <div class="invalid-feedback"></div>
            </div>

            <div class="form-group">
                    <label for="dataNascimento" class="form-label">Data de Nascimento:<span class="required">*</span></label>
                    <input type="date" class="form-control" id="dataNascimento" min="1500-01-01" max="2023-12-31" name="dataNascimento"
                        placeholder="Data de Nascimento" >
                    <div class="invalid-feedback"></div>
                </div>
            

            <div class="form-group">
                <label for="email" class="form-label">E-mail:<span class="required">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" >
                <div class="invalid-feedback"></div>
            </div>
            
            <div class="btn-container">

            <a href="login.php" role="button" class="btn btn-outline-primary btn-lg">Cancelar</a>

                <button type="submit" class="btn btn-success btn-lg">Verificar Dados</button>

            </div>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("recuperacaoForm");

        form.addEventListener("submit", function (event) {
            let isValid = true;

            function validarCampo(input, errorMessage) {
                const errorSpan = input.nextElementSibling;

                if (input.value.trim() === "") {
                    input.classList.add("is-invalid");
                    errorSpan.textContent = errorMessage;
                    isValid = false;
                } else {
                    input.classList.remove("is-invalid");
                    errorSpan.textContent = "";
                }
            }

            const nomeInput = document.getElementById("nome");
            const dataNascimentoInput = document.getElementById("dataNascimento");
            const cpfInput = document.getElementById("cpf");
            const emailInput = document.getElementById("email");

            // Validação dos campos obrigatórios
            validarCampo(nomeInput, "O nome é obrigatório.");
            validarCampo(dataNascimentoInput, "A data de nascimento é obrigatória.");
            validarCampo(cpfInput, "O CPF é obrigatório.");
            validarCampo(emailInput, "O email é obrigatório.");

            // Validação do CPF
            const cpfNumerico = cpfInput.value.replace(/\D/g, "");
            if (cpfNumerico.length !== 11) {
                cpfInput.classList.add("is-invalid");
                cpfInput.nextElementSibling.textContent = "O CPF deve ter 11 dígitos.";
                isValid = false;
            }

            // Validação do Email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value) && emailInput.value.trim() !== "") {
                emailInput.classList.add("is-invalid");
                emailInput.nextElementSibling.textContent = "Por favor, insira um email válido.";
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        // Função para formatar CPF (000.000.000-00)
        function formatarCPF(cpf) {
            cpf = cpf.replace(/\D/g, ""); 
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            return cpf;
        }

        
        document.getElementById("cpf").addEventListener("input", function (e) {
            e.target.value = formatarCPF(e.target.value);
        });

        
        document.getElementById("cpf").value = formatarCPF(document.getElementById("cpf").value);
    });
</script>


</body>

</html>