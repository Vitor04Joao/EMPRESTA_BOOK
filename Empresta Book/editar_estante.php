<?php
include 'conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger' role='alert'>ID inválido!</div>";
    exit();
}

$id_estante = $_GET['id'];

$sql = "SELECT * FROM Estante WHERE id = $id_estante ";

$buscar = mysqli_query($conec, $sql);
$array = mysqli_fetch_array($buscar);

if (!$array) {
    echo "<div class='alert alert-danger' role='alert'>Estante não encontrada!</div>";
    exit();
}

$nome_estante = $array['nome'];
$tipoAcervo = $array['tipoAcervo'];
$observacao = $array['observacao'];

?>

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

    <div class="container" style="margin-top: 40px" id="container">
        <a href="listar_estante.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a>Dados das Estantes:</h2>
        </a>

        <form name="formulario" action="atualizar_estantes.php" method="post" style="margin-top: 20px"
            onsubmit="return validarFormulario()">

            <div class="FgID">
                <input type="hidden" class="form-control" name="id_estante" value="<?php echo $id_estante ?>" readonly>
            </div>

            <div class="form-group">
                <label>Nome:<span class="required">*</span></label>
                <input type="Text" class="form-control" name="nome" value="<?php echo $nome_estante ?>"
                    placeholder="Digite a identificação da estante...">
                <div class="invalid-feedback">Este campo é obrigatório!</div>
            </div>

            <div class="d-flex">
                <div class="form-group flex-grow-1">
                    <label for="tipoAcervo">Tipo de Acervo:</label>
                    <select class="form-control" name="tipoAcervo">
                        <option value="">Selecione o Acervo</option>
                        <option value="Livros" <?php if ($tipoAcervo == 'Livros') echo 'selected'; ?>>Livros</option>
                    </select>
                    <div class="invalid-feedback">Este campo é obrigatório!</div>
                </div>
            </div>

            <div class="form-group">
                <label for="observacao">Observação:</label>
                <textarea class="form-control" id="observacao" rows="3" name="observacao"  maxlength="120"
                placeholder="Escreva algo significativo..."><?php echo $observacao ?></textarea>
            </div>

            <div class="btn-container">

                <a href="listar_estante.php" role="button" class="btn btn-primary btn-lg">Voltar </a>
                <button type="submit" id="botao" class="btn btn-warning btn-lg">Atualizar</button>

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