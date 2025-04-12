<?php
include 'conexao.php';

$id_prateleira = $_GET['id'];  

session_start();
$usuario = $_SESSION['usuario'];

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}

// Buscar dados da prateleira selecionada
$sql = "SELECT * FROM Prateleira WHERE id = $id_prateleira";
$buscar = mysqli_query($conec, $sql);
$array = mysqli_fetch_array($buscar);

$id_prateleira = $array['id'];
$numero = $array['numero'];
$observacao = $array['observacao'];
$id_estante = $array['estante_id']; // Corrigido o nome do campo
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
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

<?php include 'cabecalho.php'; ?>

<div class="container" id="container" style="margin-top: 40px">
    <a href="listar_prateleira.php">
        <h2><i class="fa-solid fa-arrow-left"></i></a>Editar Prateleira:</h2>

        <form name="formulario" action="atualizar_prateleira.php" method="post" onsubmit="return validarFormulario()">
    <!-- ID da prateleira (escondido) -->
    <input type="hidden" name="id" value="<?php echo $id_prateleira; ?>" readonly>

    <br>
    <div class="form-group">
        <label>Identificação:<span class="required">*</span></label>
        <input type="text" class="form-control" name="numero" value="<?php echo $numero ?>"
               placeholder="Digite a identificação da prateleira...">
        <div class="invalid-feedback">Este campo é obrigatório!</div>
    </div>

    <div class="form-group">
        <label>Estante:<span class="required">*</span></label>
        <select class="form-control" name="id_estante">
            <option value="">Selecione uma opção</option>
            <?php
            $sql = "SELECT * FROM Estante ORDER BY nome ASC";
            $buscar = mysqli_query($conec, $sql);
            while ($array = mysqli_fetch_array($buscar)) {
                $id_opcao = $array['id']; 
                $nome_estante = $array['nome'];
                $selected = ($id_estante == $id_opcao) ? 'selected' : ''; 
            ?>
                <option value="<?php echo $id_opcao; ?>" <?php echo $selected; ?>><?php echo $nome_estante; ?></option>
            <?php } ?>
        </select>
        <div class="invalid-feedback">Selecione uma opção!</div>
    </div>

    <div class="form-group">
        <label for="observacao">Observação:</label>
        <textarea class="form-control" id="observacao" rows="3" name="observacao" maxlength="120"
                  placeholder="Escreva algo significativo..."><?php echo $observacao ?></textarea>
    </div>

    <div class="btn-container">
        <a href="listar_prateleira.php" role="button" class="btn btn-primary btn-lg">Voltar</a>
        <button type="submit" id="botao" class="btn btn-warning btn-lg">Atualizar</button>
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

        const estanteSelect = document.querySelector('select[name="id_estante"]');
        validarSelect(estanteSelect);

        return isValid;
    }
</script>

</body>
</html>
