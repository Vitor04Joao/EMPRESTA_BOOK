<?php
include 'conexao.php';

$cpf = $_POST['cpf'];
$nova_senha = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if ($nova_senha === $confirmar_senha) {
    $senha_hash = md5($nova_senha); 

    $sql = "UPDATE Bibliotecario SET senha = ? WHERE cpf = ?";
    $stmt = mysqli_prepare($conec, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $senha_hash, $cpf);

        if (mysqli_stmt_execute($stmt)) {
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
                        <img src="IMG/success.png" alt="Success" width="35px">
                        <h2>Senha atualizada com sucesso!</h2>
                        <div style="padding-top: 20px;">
                            <a href="login.php" role="button" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "Erro ao atualizar a senha: " . mysqli_error($conec);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta: " . mysqli_error($conec);
    }
} else {
    echo "As senhas não coincidem.";
}

mysqli_close($conec);
?>