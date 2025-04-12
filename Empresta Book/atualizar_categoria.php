<?php

include 'conexao.php';


$id_categoria = $_POST['id_categoria']?? null;
$descricao = $_POST['descricao']?? '';


// Verifica se o ID foi passado corretamente
if (!$id_categoria) {
    die("Erro: 'id' não fornecido.");
}


$sql = "UPDATE Categoria SET descricao = ? WHERE id = ?";


$stmt = mysqli_prepare($conec, $sql);
mysqli_stmt_bind_param($stmt, "si", $descricao, $id_categoria);

$executar = mysqli_stmt_execute($stmt);

// Verifica se a atualização foi tudo ok
if ($executar) {
    echo "";
} else {
    echo "<script>alert('Erro ao atualizar! Tente novamente.'); window.history.back();</script>";
}

mysqli_stmt_close($stmt);
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
<body>

<?php
    session_start();
    $usuario = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
    }

    ?>

    <div class="container">
        <div class="text-center">

        <img src="IMG/success.png"  alt="Success" width="35px">


            <h2> <?php  echo "Dados atualizados com sucesso!!";  ?></h2>

        
            <div style="padding-top: 20px;">
                <a href="listar_categoria.php" role="button" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </div>
</body>
</html>