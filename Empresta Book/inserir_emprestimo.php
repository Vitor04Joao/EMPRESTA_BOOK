<?php

include 'conexao.php';

// Recuperar dados do formulário
$data_emprestimo = date("Y-m-d");
$data_entrega = $_POST['data_entrega'];
$status_livro = $_POST['status_livro'];
$unidade = $_POST['unidade'];
$id_livro = $_POST['id_livro'];
$id = $_POST['id'];
$id_bibliotecario = $_POST['id_bibliotecario'];

// Verificar se a data de devolução foi fornecida no formulário
if (!empty($_POST['data_entrega'])) {
    $data_entrega = $_POST['data_entrega'];
} else {
    // Caso não tenha sido fornecida, define a data de devolução para 7 dias após o empréstimo
    $data_entrega = date('Y-m-d', strtotime($data_emprestimo . ' + 7 days'));
}

// Recuperar a quantidade atual do livro
$sql_quantidade = "SELECT quantidade FROM Livro WHERE id = '$id_livro'";
$result = mysqli_query($conec, $sql_quantidade);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $quantidade_atual = $row['quantidade'];

    // Verificar se a quantidade disponível é suficiente para o empréstimo
    if ($quantidade_atual - $unidade >= 0) {
        // Subtrair a quantidade e atualizar no banco de dados
        $nova_quantidade = $quantidade_atual - $unidade;
        $sql_update = "UPDATE Livro SET quantidade = '$nova_quantidade' WHERE id = '$id_livro'";
        $update_result = mysqli_query($conec, $sql_update);
        
        if ($update_result) {
            // Registrar o empréstimo
            $sql = "INSERT INTO Emprestimo (dataEmprestimo, dataDevolucao, status_livro, unidade, livro_emprestimo, leitor_emprestimo, bibliotecario_emprestimo)
                    VALUES ('$data_emprestimo', '$data_entrega', '$status_livro', '$unidade', '$id_livro', '$id', '$id_bibliotecario')";

            $inserir = mysqli_query($conec, $sql);

            if ($inserir) {
                echo "";
            } else {
                echo "Erro ao registrar o empréstimo. Tente novamente.";
            }
        } else {
            echo "Erro ao atualizar a quantidade do livro no estoque.";
        }
    } else {
        echo "Erro: Quantidade disponível do livro insuficiente para o empréstimo.";
    }
} else {
    echo "Erro ao consultar a quantidade disponível do livro.";
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
<body>
    <div class="container">
        <div class="text-center">

        <img src="IMG/success.png"  alt="Success" width="35px">

            <h2>Emprestimo realizado com sucesso!!</h2>
            <div style="padding-top: 20px;">
                <a href="menu.php" role="button" class="btn btn-primary">Voltar ao menu</a>
            </div>
        </div>
    </div>
</body>
</html>
      
      