<?php

include 'conexao.php'; 

$id = $_GET['id'];  




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    
    <style>
        #container {
            width: 470px;
        }

        .IMG {
            display: flex;
            justify-content: space-between;
        }

        .d-flex{
            justify-content: space-between;
        }

        .FgID{
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 95px;
        }

        .FgNome{
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 400px;
        }

        .Fg1{
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 350px;
        }

        .Fg2{
            display: flex;
            flex-direction: column;
            align-items: right;
            width: 170px;
        }

        .cor{
            color:rgb(1, 113, 161);
            font-size: 17px;
        }

        .FgSenha{
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 258px;
        }

        .FgSenha2{
            display: flex;
            flex-direction: column;
            align-items: left;
            width: 258px;
        }

        .btn-primary, .btn-success, .btn-info{
            font-size: 17px;
        }

        .required {
            color: red;
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
    include 'cabecalho.php';
    ?>

    <div class="container" style="margin-top: 40px" id="container">
        <a href="listar_autor.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a>Dados dos Autores:</h2>

        <form name="formulario"  method="post" style="margin-top: 20px">


        <?php

        

$sql = "SELECT * FROM Autor WHERE id = $id ";

 $buscar = mysqli_query($conec,$sql);
 $array = mysqli_fetch_array($buscar); 

$id = $array ['id'];
$nome = $array['nome'];
$dataNascimento = $array ['dataNascimento'];
$paisNascimento = $array ['paisNascimento'];


     ?>


            <div class="d-flex">
                <div class="FgNome">
                    <label >Nome:</label>
                    <input type="Text" class="form-control" name="nome" value = "<?php echo $nome ?>" readonly>
                </div>
            </div>

            <br>

            <div class="Fg2">
                <label >Data de Nascimento:</label>
                <input type="date" class="form-control" name="dataNascimento" value = "<?php echo $dataNascimento ?>" readonly>
            </div>

            <br>

            <div class="FgNome">
                    <label >País de Nascimento:</label>
                    <input type="Text" class="form-control" name="paisNascimento" value = "<?php echo $paisNascimento ?>" readonly>
                </div>

                <br>

            <div style="text-align: right;">
                <a href="listar_autor.php" role="button" class="btn btn-primary btn-sm" style="margin-top: 275px">Voltar</a>
            </div>

        </form>
    </div>
</body>
</html>
