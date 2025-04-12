<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

     <title>Empresta Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <style>
         #container {
            width: 470px;
            margin-top: 38px;
           
        }

        .igual{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 400px;
}

.btn-container {
            text-align: right;
            position: fixed;
            bottom: 20px;
            right: 37%;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $usuario = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
    }

    include 'cabecalho.php';
    ?>

    <div class="container" style="margin-top: 40px" id="container">
        <a href="cadastrar_livros.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a>Cadastrar Autores:</h2>

        <form name="formulario" action="inserir_autores.php" method="post" style="margin-top: 20px" onsubmit="return validarFormulario()">

            <div class="d-flex">
                <div class="igual">
                    <label >Nome:<span class="required">*</span></label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o Nome do autor.."
                    oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
                    <small class="invalid-feedback">Este campo é obrigatório.</small>
                </div>
            </div>

            <div class="igual">
                <label >Data de Nascimento:<span class="required">*</span></label>
                <input type="date" class="form-control" name="dataNascimento" min="1500-01-01" max="2023-12-31" placeholder="Data de Nascimento..">
                <small class="invalid-feedback">Este campo é obrigatório.</small>
            </div>

            <div class="igual">
                <label >País de Nascimento:<span class="required">*</span></label>
                <input type="text" class="form-control" name="paisNascimento"  placeholder="País de Nascimento.."
                oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
                <small class="invalid-feedback">Este campo é obrigatório.</small>
            </div>

            <div class="btn-container">
                <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao Menu</a>
                
                <button type="submit" id="botao" class="btn btn-success btn-lg">Cadastrar</button>
               
                <a href="listar_autor.php" role="button" class="btn btn-info btn-lg">Listar</a>
            </div>
        </form>
    </div>
  
    <script>
        function validarFormulario() {
            let isValid = true;

            
            const nome = document.querySelector('input[name="nome"]');
            const dataNascimento = document.querySelector('input[name="dataNascimento"]');
            const paisNascimento = document.querySelector('input[name="paisNascimento"]');

            // Função para validar campo vazio
            function validarCampo(campo) {
                const feedback = campo.nextElementSibling;
                if (campo.value.trim() === "") {
                    campo.classList.add('is-invalid');
                    feedback.style.display = 'block';
                    isValid = false;
                } else {
                    campo.classList.remove('is-invalid');
                    feedback.style.display = 'none';
                }
            }

            // Validar cada campo
            validarCampo(nome);
            validarCampo(dataNascimento);
            validarCampo(paisNascimento);

            return isValid; 
        }
    </script>
</body>
</html>
