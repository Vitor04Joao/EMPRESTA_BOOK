<?php
session_start();
include 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Verifica se o ID do empréstimo foi enviado corretamente
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    die("Erro: ID do empréstimo inválido.");
}

$id_emprestimo = intval($_POST['id']);

// Define o fuso horário e obtém a data atual no formato YYYY-MM-DD
date_default_timezone_set('America/Sao_Paulo');
$data_atual_devolucao = date('Y-m-d');

// Atualiza o status do livro para "Devolvido"
$status_livro = "Devolvido";


$sql_buscar_livro = "SELECT livro_emprestimo, unidade FROM Emprestimo WHERE id = ?";
$stmt_buscar_livro = mysqli_prepare($conec, $sql_buscar_livro);
mysqli_stmt_bind_param($stmt_buscar_livro, "i", $id_emprestimo);
mysqli_stmt_execute($stmt_buscar_livro);
mysqli_stmt_bind_result($stmt_buscar_livro, $livro_id, $unidade);
mysqli_stmt_fetch($stmt_buscar_livro);
mysqli_stmt_close($stmt_buscar_livro);


if (!$livro_id) {
    die("Erro: Empréstimo não encontrado.");
}

// Obtém a quantidade atual do livro
$sql_quantidade = "SELECT quantidade FROM Livro WHERE id = ?";
$stmt_quantidade = mysqli_prepare($conec, $sql_quantidade);
mysqli_stmt_bind_param($stmt_quantidade, "i", $livro_id);
mysqli_stmt_execute($stmt_quantidade);
mysqli_stmt_bind_result($stmt_quantidade, $quantidade_livro);
mysqli_stmt_fetch($stmt_quantidade);
mysqli_stmt_close($stmt_quantidade);


$nova_quantidade = $quantidade_livro + $unidade;

// Atualiza a quantidade do livro no estoque
$sql_atualizar_livro = "UPDATE Livro SET quantidade = ? WHERE id = ?";
$stmt_atualizar_livro = mysqli_prepare($conec, $sql_atualizar_livro);
mysqli_stmt_bind_param($stmt_atualizar_livro, "ii", $nova_quantidade, $livro_id);
if (!mysqli_stmt_execute($stmt_atualizar_livro)) {
    die("Erro ao atualizar a quantidade do livro: " . mysqli_error($conec));
}
mysqli_stmt_close($stmt_atualizar_livro);

// Atualiza o status do empréstimo e a data de devolução
$sql_atualizar_emprestimo = "UPDATE Emprestimo SET status_livro = ?, data_atual_devolucao = ? WHERE id = ?";
$stmt_atualizar_emprestimo = mysqli_prepare($conec, $sql_atualizar_emprestimo);
mysqli_stmt_bind_param($stmt_atualizar_emprestimo, "ssi", $status_livro, $data_atual_devolucao, $id_emprestimo);
if (!mysqli_stmt_execute($stmt_atualizar_emprestimo)) {
    die("Erro ao atualizar o status do empréstimo: " . mysqli_error($conec));
}
mysqli_stmt_close($stmt_atualizar_emprestimo);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: linear-gradient(to right, #ffffff 0%, #7DD3EF 35%, rgb(0, 172, 230) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 500px;
            margin-top: 30px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #343a40;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 10px;
            font-size: 20px;
            width: 405px;
            align-items: center;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>
<?php
    
    $usuario = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
    }

    ?>
<body>
    <div class="container">
        <div class="text-center">
            <img src="IMG/success.png" alt="Success" width="35px">
            <h2><?php echo "Dados atualizados com sucesso!!"; ?></h2>
            <div style="padding-top: 20px;">
                <a href="listar_emprestimo.php" role="button" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
</body>
</html>