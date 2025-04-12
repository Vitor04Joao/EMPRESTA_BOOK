<?php
include 'conexao.php'; // Incluir arquivo de conexão

$id = $_GET['id'];  // Recebe o ID do leitor a ser excluído

// Verifica se o ID é válido
if (!isset($id) || !is_numeric($id)) {
    header("Location: listar_leitores.php?erro=ID inválido");
    exit();
}

try {
    // Prepara a query para excluir o leitor
    $sql = "DELETE FROM Leitor WHERE id = ?";
    $stmt = $conec->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $sucesso = true;
    } else {
        throw new Exception("Erro ao excluir o leitor.");
    }
} catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
        $erro_msg = "leitor não pode ser excluído por estar vinculado a empréstimos.";
    } else {
        $erro_msg = "Erro ao excluir o leitor: " . $e->getMessage();
    }
}
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
            text-align: center;
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
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .error {
            color: black;
           
        }

        img {
            width: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($sucesso) && $sucesso): ?>
            <img src="IMG/success.png" alt="Success">
            <h2>Registro excluído com sucesso!</h2>
        <?php else: ?>
            <img src="IMG/erro.png" alt="Erro">
            <h2 class="error"><?= $erro_msg ?? "Ocorreu um erro inesperado." ?></h2>
        <?php endif; ?>

        <div style="padding-top: 20px;">
            <a href="listar_leitores.php" role="button" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</body>
</html>
