<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empresta Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        #container {
            width: 470px;
            margin-top: 38px;
        }

        textarea {
            resize: vertical;
        }

        .d-flex {
            justify-content: space-between;
        }

        .btn-container {
            text-align: right;
            position: fixed;
            bottom: 20px;
            right: 37%;
            width: 100%;
        }

        .FgID {
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 95px;
        }

        .btn-add-estante {
            margin-left: 10px;
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

    <div class="container" id="container" style="margin-top: 40px">
        <a href="cadastrar_livros.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a>Cadastrar Prateleira:</h2>

        <form name="formulario" action="inserir_prateleira.php" method="post" onsubmit="return validarFormulario()">
            <br>
            <div class="form-group">
                <label>Identificação:<span class="required">*</span></label>
                <input type="text" class="form-control" name="numero" placeholder="Digite a identificação da prateleira...">
                <div class="invalid-feedback">Este campo é obrigatório!</div>
            </div>

            <div class="form-group">


                <label>Estante:<span class="required">*</span></label>
            
              
                <select class="form-control" id="descricao" name="descricao" onchange="atualizarIdEstante()">
                <option value="">Selecione uma opção</option>
                <?php
                include 'conexao.php';
                $sql = "SELECT * FROM Estante ORDER BY nome ASC";
                $buscar = mysqli_query($conec, $sql);
                while ($array = mysqli_fetch_array($buscar)) {
                    $id_estante = $array['id'];
                    $nome = $array['nome'];
                ?>
                    <option value="<?php echo $id_estante ?>"><?php echo $nome ?></option>
                <?php } ?>
            </select>
                    
                    <div class="invalid-feedback"></div>
                   
            </div>

<!-- Passar o id da estante selecionada o select  -->

<input type="hidden" class="form-control" id="id_estante" name="id_estante">


            <div class="form-group">
                <label for="observacao">Observação:</label>
                <textarea class="form-control" id="observacao" rows="3" name="observacao" maxlength="120" placeholder="Escreva algo significativo..."></textarea>
            </div>

            <div class="btn-container">
                <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao Menu</a>
                &nbsp;
                <button type="submit" id="botao" class="btn btn-success btn-lg">Cadastrar</button>
                &nbsp;
                <a href="listar_prateleira.php" role="button" class="btn btn-info btn-lg">Listar</a>
            </div>
        </form>
    </div>

    <script>
function atualizarIdEstante() {
        let select = document.getElementById('descricao');
        let idEstanteInput = document.getElementById('id_estante');
        idEstanteInput.value = select.value; 
    }

        function validarFormulario() {
            let isValid = true;

        
            function validarCampo(input) {
                const feedback = input.nextElementSibling;
                if (input.value.trim() === "") {
                    input.classList.add('is-invalid');
                    feedback.textContent = "Este campo é obrigatório!";
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                    feedback.textContent = "";
                }
            }

          
            function validarSelect(select) {
                const feedback = select.nextElementSibling;
                if (!select.value || select.value === "") {
                    select.classList.add('is-invalid');
                    feedback.textContent = "Selecione uma opção!";
                    isValid = false;
                } else {
                    select.classList.remove('is-invalid');
                    feedback.textContent = "";
                }
            }

          
            const numeroInput = document.querySelector('input[name="numero"]');
            validarCampo(numeroInput);

            
            const estanteSelect = document.querySelector('select[name="descricao"]');
            validarSelect(estanteSelect);

            return isValid; 
        }
    </script>
</body>
</html>
