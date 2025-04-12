<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Empresta Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <h2><a href="cadastrar_livros.php"><i class="fa-solid fa-arrow-left"></i></a> Cadastrar Estante</h2>

        <form name="formulario" action="inserir_estante.php" method="post" onsubmit="return validarFormulario()">

            <br>

            <div class="form-group">
                <label for="nome">Nome:<span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="Digite a identificação da estante..." name="nome">
                <div class="invalid-feedback">Este campo é obrigatório!</div>
            </div>

            <div class="d-flex">
                <div class="form-group flex-grow-1">
                    <label for="tipoAcervo">Tipo de Acervo:<span class="required">*</span></label>
                    <select class="form-control" name="tipoAcervo">
                        <option value="">Selecione o Acervo</option>
                        <option value="Livros">Livros</option>
                    </select>
                    <div class="invalid-feedback">Este campo é obrigatório!</div>
                </div>
            </div>

            <div class="form-group">
                <label for="observacao">Observação:</label>
                <textarea class="form-control" id="observacao" rows="3" name="observacao"  maxlength="120"
                    placeholder="Escreva algo significativo..."></textarea>
            </div>


            <div class="btn-container">

                <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao Menu</a>
                <button type="submit" id="botao" class="btn btn-success btn-lg">Cadastrar</button>
                <a href="listar_estante.php" role="button" class="btn btn-info btn-lg">Listar</a>

            </div>

        </form>
    </div>

    <script>
        function validarFormulario() {
            const nome = document.querySelector('input[name="nome"]');
            const tipoAcervo = document.querySelector('select[name="tipoAcervo"]');
            const feedbackNome = nome.nextElementSibling;
            const feedbackTipoAcervo = tipoAcervo.nextElementSibling;
            let isValid = true;

            if (!nome.value.trim() || nome.value.trim().length < 3) {
                nome.classList.add('is-invalid');
                feedbackNome.style.display = 'block';
                isValid = false;
            } else {
                nome.classList.remove('is-invalid');
                feedbackNome.style.display = 'none';
            }

            if (tipoAcervo.value == "") {
                tipoAcervo.classList.add('is-invalid');
                feedbackTipoAcervo.style.display = 'block';
                isValid = false;
            } else {
                tipoAcervo.classList.remove('is-invalid');
                feedbackTipoAcervo.style.display = 'none';
            }

            return isValid;
        }
    </script>

</body>

</html>