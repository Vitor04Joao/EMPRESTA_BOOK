<?php
include 'conexao.php';

// Verifica se os campos estão definidos no POST antes de acessá-los
$id_emprestimo = isset($_POST['id']) ? intval($_POST['id']) : null;
$data_entrega = isset($_POST['data_entrega']) ? $_POST['data_entrega'] : null;


// Verifica se algum dos campos essenciais está faltando
if (!$id_emprestimo || !$data_entrega) {
    die("Erro: Dados ausentes. Verifique se todos os campos foram preenchidos corretamente.");
}

// Recuperar a data de empréstimo
$sql_emprestimo = "SELECT dataEmprestimo FROM Emprestimo WHERE id = ?";
$stmt_emprestimo = mysqli_prepare($conec, $sql_emprestimo);
if ($stmt_emprestimo === false) {
    die("Erro ao preparar consulta do empréstimo: " . mysqli_error($conec));
}

mysqli_stmt_bind_param($stmt_emprestimo, "i", $id_emprestimo);
mysqli_stmt_execute($stmt_emprestimo);
$result_emprestimo = mysqli_stmt_get_result($stmt_emprestimo);

if ($row_emprestimo = mysqli_fetch_assoc($result_emprestimo)) {
    $data_emprestimo = $row_emprestimo['dataEmprestimo']; 
} else {
    die("Erro: Empréstimo não encontrado.");
}
mysqli_stmt_close($stmt_emprestimo);

// Validar se a data de devolução não é menor que a data de empréstimo
if (strtotime($data_entrega) < strtotime($data_emprestimo)) {
    die("Erro: A data de devolução não pode ser anterior à data de empréstimo.");
}

// Atualizar os dados do empréstimo (apenas a data de devolução)
$sql_update_emprestimo = "UPDATE Emprestimo SET dataDevolucao = ? WHERE id = ?";
$stmt_update_emprestimo = mysqli_prepare($conec, $sql_update_emprestimo);
if ($stmt_update_emprestimo === false) {
    die("Erro ao preparar atualização do empréstimo: " . mysqli_error($conec));
}

mysqli_stmt_bind_param($stmt_update_emprestimo, "si", $data_entrega, $id_emprestimo);

if (mysqli_stmt_execute($stmt_update_emprestimo)) {
    echo "";
} else {
    die("Erro ao atualizar o empréstimo: " . mysqli_error($conec));
}

mysqli_stmt_close($stmt_update_emprestimo);
mysqli_close($conec);
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
    session_start();
    $usuario = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
    }

    ?>
<body>
    <div class="container">
        <div class="text-center">
            <img src="IMG/success.png" alt="Success" width="35px">
            <h2><?php echo "Dados atualizados com sucesso!!";?></h2>
            <div style="padding-top: 20px;">
                <a href="listar_emprestimo.php" role="button" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
</body>
</html>