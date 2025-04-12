<?php
include 'conexao.php'; // Incluir arquivo de conexão

$id = $_GET['id'];  // Recebe o ID do livro a ser excluído

// Verifica se o ID é válido
if (!isset($id) || !is_numeric($id)) {
    header("Location: listar_livros.php?erro=ID inválido");
    exit();
}

try {
    // Verifica se o livro está vinculado a algum empréstimo
    $sql_verificar = "SELECT COUNT(*) FROM Emprestimo WHERE livro_emprestimo = ?";
    $stmt_verificar = $conec->prepare($sql_verificar);
    $stmt_verificar->bind_param("i", $id);
    $stmt_verificar->execute();
    $stmt_verificar->bind_result($contagem);
    
    // Processa o resultado da consulta
    $stmt_verificar->fetch();
    $stmt_verificar->free_result();  // Libera o resultado da consulta para poder executar outro comando

    if ($contagem > 0) {
        // O livro está vinculado a um empréstimo
        $erro_msg = "Livro não pode ser excluído por estar vinculado a empréstimos.";
    } else {
        // O livro não está vinculado a nenhum empréstimo, pode ser excluído
        $sql = "DELETE FROM Livro WHERE id = ?";
        $stmt = $conec->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $sucesso = true;
            // Redireciona para a lista de livros
            header("Location: listar_livros.php?sucesso=Livro excluído com sucesso");
            exit();
        } else {
            throw new Exception("Erro ao excluir o livro.");
        }
    }
} catch (mysqli_sql_exception $e) {
    $erro_msg = "Erro ao excluir o livro: " . $e->getMessage();
}
?>


<?php if (isset($erro_msg)): ?>
    <h2 class="error"><?= $erro_msg ?></h2>
<?php endif; ?>

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
            font-size: 18px;
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
            <a href="listar_livros.php" role="button" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</body>
</html>
