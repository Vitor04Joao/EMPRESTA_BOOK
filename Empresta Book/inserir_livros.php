<?php

include 'conexao.php';

$sucesso = false;
$erro_msg = "";

if (isset($_POST['isbn']) && isset($_POST['titulo']) && isset($_POST['dataPublicacao']) && isset($_POST['editora']) 
    && isset($_POST['quantidade']) && isset($_POST['obs']) && isset($_POST['id_categoria'])) {

    $isbn = mysqli_real_escape_string($conec, $_POST['isbn']);
    $titulo = mysqli_real_escape_string($conec, $_POST['titulo']);
    $dataPublicacao = mysqli_real_escape_string($conec, $_POST['dataPublicacao']);
    $editora = mysqli_real_escape_string($conec, $_POST['editora']);
    $quantidade = mysqli_real_escape_string($conec, $_POST['quantidade']);
    $obs = mysqli_real_escape_string($conec, $_POST['obs']);
    $id_categoria = mysqli_real_escape_string($conec, $_POST['id_categoria']);

    // Verifica se já existe um livro com o mesmo ISBN
    $sql_verificar_isbn = "SELECT isbn FROM Livro WHERE isbn = '$isbn'";
    $resultado_isbn = mysqli_query($conec, $sql_verificar_isbn);

    if (mysqli_num_rows($resultado_isbn) > 0) {
        $erro_msg = "Já existe um livro cadastrado com esse ISBN!";
    } else {
        // Inserir livro na tabela Livro
        $sql_livro = "INSERT INTO Livro (isbn, titulo, dataPublicacao, editora, quantidade, obs, categoria_id)
                      VALUES ('$isbn', '$titulo', '$dataPublicacao', '$editora', '$quantidade', '$obs', '$id_categoria')";

        if (mysqli_query($conec, $sql_livro)) {
            $livro_id = mysqli_insert_id($conec); // Pega o ID do livro inserido
            $sucesso = true;

            // Inserir o livro na tabela Livro_Prateleira
            if (isset($_POST['id_prateleira'])) {
                $id_prateleira = mysqli_real_escape_string($conec, $_POST['id_prateleira']);
                $sql_livro_prateleira = "INSERT INTO Livro_Prateleira (livro_id, prateleira_id) 
                                         VALUES ('$livro_id', '$id_prateleira')";
                if (!mysqli_query($conec, $sql_livro_prateleira)) {
                    $erro_msg = "Erro ao associar livro à prateleira.";
                    $sucesso = false;
                }
            }

           // Inserir os autores do livro na tabela AutoresDoLivro
if (isset($_POST['autores_ids'])) {
    // Verificar se o valor é uma string e então transformá-lo em array
    $autores_ids = explode(',', $_POST['autores_ids']);  // Transforma a string em um array, separando pelos IDs

    // Garantir que a variável seja um array válido
    if (is_array($autores_ids)) {
        foreach ($autores_ids as $autor_id) {
            $autor_id = trim($autor_id); // Remover espaços extras ao redor do ID, caso existam
            // Inserir o autor no relacionamento com o livro
            $sql_autor_livro = "INSERT INTO AutoresDoLivro (livro_id, autor_id) 
                                VALUES ('$livro_id', '$autor_id')";
            if (!mysqli_query($conec, $sql_autor_livro)) {
                $erro_msg = "Erro ao associar autor ao livro.";
                $sucesso = false;
                break;
            }
        }
    } else {
        // Caso autores_ids não seja um array válido
        $erro_msg = "Erro: IDs de autores inválidos.";
        $sucesso = false;
    }
}

            
            // if (isset($id_estante)) {
            //     $sql_estante_livro = "INSERT INTO Livro_Estante (livro_id, estante_id) 
            //                           VALUES ('$livro_id', '$id_estante')";
            //     if (!mysqli_query($conec, $sql_estante_livro)) {
            //         $erro_msg = "Erro ao associar livro à estante.";
            //         $sucesso = false;
            //     }
            // }

        } else {
            $erro_msg = "Erro ao cadastrar o livro.";
        }
    }
} else {
    $erro_msg = "Erro: Dados do formulário incompletos.";
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
        <?php if ($sucesso): ?>
            <img src="IMG/success.png" alt="Success">
            <h2>Livro cadastrado com sucesso!</h2>
        <?php else: ?>
            <img src="IMG/erro.png" alt="Erro">
            <h2 class="error"><?= $erro_msg ?? "Ocorreu um erro inesperado." ?></h2>
        <?php endif; ?>

        <div style="padding-top: 20px;">
            <a href="cadastrar_livros.php" role="button" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</body>
</html>