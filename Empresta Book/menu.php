<?php
include 'conexao.php';

if (isset($conec)) {
    // Se a data de devolução já passou e o status ainda for "Emprestado", mudar para "Pendente"
    $sql_update = "UPDATE Emprestimo 
                   SET status_livro = 'Pendente' 
                   WHERE dataDevolucao < CURDATE() 
                   AND status_livro = 'Emprestado'";

    if ($conec->query($sql_update) === TRUE) {
        echo "";
    } else {
        echo "Erro ao atualizar status para Pendente: " . $conec->error;
    }

    // Se a data de devolução ainda não venceu e o status for "Pendente", mudar para "Emprestado"
    $sql_update = "UPDATE Emprestimo 
                   SET status_livro = 'Emprestado' 
                   WHERE dataDevolucao >= CURDATE() 
                   AND status_livro = 'Pendente'";

    if ($conec->query($sql_update) === TRUE) {
        echo "";
    } else {
        echo "Erro ao atualizar status para Emprestado: " . $conec->error;
    }
} else {
    echo "Erro: Conexão não estabelecida.";
}



// Array de consultas SQL para buscar a quantidade de cada emprestimo por status

$queries = [
    'livros' => "SELECT COUNT(*) AS total FROM Livro",
    'emprestimos' => "SELECT COUNT(*) AS total FROM Emprestimo",
    'leitores' => "SELECT COUNT(*) AS total FROM Leitor",
    'emprestados' => "SELECT COUNT(*) AS total FROM Emprestimo WHERE status_livro = 'Emprestado'",
    'pendentes' => "SELECT COUNT(*) AS total FROM Emprestimo WHERE status_livro = 'Pendente'",
    'devolvidos' => "SELECT COUNT(*) AS total FROM Emprestimo WHERE status_livro = 'Devolvido'"
];

// Executa as consultas e armazena os resultados
$dados = [];
foreach ($queries as $key => $sql) {
    $result = $conec->query($sql); 
    $dados[$key] = ($result) ? $result->fetch_assoc()["total"] : 0;
}

// Fecha a conexão
if (isset($conec)) {
    $conec->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> 
    <title>Empresta Book</title>
    
    <style>
        body {
            font-family: 'Roboto', sans-serif; 
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        .dashboard {
            display: flex;
            justify-content: space-between; 
            padding: 20px;
        }

        .container2 {
            display: flex;
            flex-wrap: wrap;
            background-color: rgb(242, 242, 242);
            justify-content: center;
            width: 50%;
            margin-left:10px;
            margin-right: 10px;
            margin-top:30px;
            max-width: 720px;
            height: 438px;
            align-content: flex-start;
            padding: 10px;
            border-radius: 8px;
        }

        .box01 {
            background: white;
            padding: 20px;
            margin: 5px;
            margin-top:20px;
            width:220px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .box02 a.btn,
        .box02 .menu-item-has-children {
            display: block;
            max-width: 280px;
            margin-bottom: 5px;
            line-height: 15px;
        }

        .box02 {
            background: white;
            padding: 20px;
            margin: 10px;
            margin-top:20px;
            width: 310px;
            height: 280px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           
        }


        .total {
            color: red;
            font-size: 27px;
            
            
        }

        .TEST{
            text-align: center;
            font-size: 25px;
            color: red;
        }

        .card01 {
        background: white;
        padding: 20px;
        width: 92%;
        margin-top: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .card01 .btn {
        flex: 1;
        max-width: 290px;
        font-size: 16px;
        padding: 9px;
        border-radius: 5px;
    }

        .card02 {
            background: white;
            padding: 10px;
            width: 97%;
            margin-top:10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h4{
            text-align: center;
        }
        .left{
            text-align: left;
        }

        img{
            text-align: center;
            align-items:center;
        }
       
        .mover{
            margin-left: 35%;
            
        }
        
    </style>
</head>

<body>

<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'cabecalho.php';


?>

<div class="dashboard">

    <!-- LADO ESQUERDO DO MENU -->

    <div class="container2">
        <div class="card01">
            <a href="cadastrar_registroE.php" class="btn btn-dark"><i class="fas fa-registered"></i>&nbsp; Registrar Empréstimos</a>
            <a href="listar_emprestimo.php" class="btn btn-dark"><i class="fas fa-list"></i>&nbsp; Listar Empréstimos</a>
        </div>
   
            
        

   
    <div class="box02">

            <h4 class="left"> Cadastrar</h4>

            <a href="cadastrar_livros.php" class="btn btn-dark"><i class="fa-solid fa-book"></i>&nbsp; Livros</a>
            <a href="cadastrar_leitores.php" class="btn btn-dark"><i class="fas fa-book-reader"></i>&nbsp; Leitores</a>
            <a href="adicionar_autor.php" class="btn btn-dark"><i class="fa-solid fa-pencil"></i>&nbsp; Autores</a>
            
            <li class="menu-item menu-item-has-children">

            
<p class="btn btn-dark">  <i class="fas fa-ellipsis-h"></i></p>


<ul class="sub-menu">

<li class="menu-item">
<a href="adicionar_categoria.php" ><i class="fas fa-list-ol"></i>&nbsp; Categoria</a>
</li>

<li class="menu-item">
<a href="adicionar_estante.php" ><i class=" fas fa-align-justify"></i>&nbsp;  Estante</a>
</li>

<li class="menu-item">
<a href="adicionar_prateleira.php" ><i class=" fas fa-bars"></i>&nbsp; Prateleira</a>  
</li>

</li>
</ul>
</li>


        </div>

  <div class="box02">

            <h4 class="left">Listar</h4>

            <a href="listar_livros.php" class="btn btn-dark"><i class="fa-solid fa-book"></i>&nbsp; Livros</a>
            <a href="listar_leitores.php" class="btn btn-dark"><i class="fas fa-book-reader"></i>&nbsp; Leitores</a>
            <a href="listar_autor.php" class="btn btn-dark"><i class="fa-solid fa-pencil"></i>&nbsp; Autores</a>

            <li class="menu-item menu-item-has-children">

            <p class="btn btn-dark">  <i class="fas fa-ellipsis-h"></i></p>

<ul class="sub-menu">

  <li class="menu-item">
    <a href="listar_categoria.php" > <i class="fas fa-list-ol"></i>&nbsp; Categoria</a>
  </li>
 	
  <li class="menu-item">
    <a href="listar_estante.php" >  <i class=" fas fa-align-justify"></i>&nbsp; Estante</a>
  </li>

  <li class="menu-item">
    <a href="listar_prateleira.php" >  <i class="fas fa-bars"></i>&nbsp; Prateleira</a>  
  </li>

  </li>
</ul>
</li>
        </div>
    </div>

        <!-- LADO DIREITO DO MENU -->

    <div class="container2">

    <div class="box01">
    
    <img src="IMG/livro.png"  width="35px" style="display: block; margin: auto;">

            <h4 >  LIVROS</h4>
            <p class="TEST">Total:  &nbsp;<span class="total"><?php echo $dados['livros']; ?></span></p>
        </div>
        <div class="box01">

        <img src="IMG/emprest.png"  width="35px" style="display: block; margin: auto;"> 
        
            <h4> EMPRÉSTIMOS</h4>
            <p class="TEST">Total:    &nbsp;<span class="total"><?php echo $dados['emprestimos']; ?></span></p>
        </div>

        <div class="box01">

        <img src="IMG/leitor.png"  width="35px" style="display: block; margin: auto;">

            <h4>  LEITORES</h4>
            <p class="TEST">Total:    &nbsp;<span class="total"><?php echo $dados['leitores']; ?></span></p>
        </div>


        <div class="card02">

            

            <h4>Relatório dos Empréstimo</h4><br>

            <h6><img class="mover" src="IMG/azul.png"  width="20px"> &nbsp; &nbsp; EMPRESTADOS:  &nbsp;<span class="total"><?php echo $dados['emprestados']; ?></span></h6>
            <h6><img class="mover" src="IMG/vermelho.png"  width="20px"> &nbsp; &nbsp; PENDENTES: &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;<span class="total"><?php echo $dados['pendentes']; ?></span></h6>
            <h6><img class="mover" src="IMG/verde.png"  width="20px"> &nbsp; &nbsp; DEVOLVIDOS:   &nbsp; &nbsp;&nbsp;&nbsp;<span class="total"><?php echo $dados['devolvidos']; ?></span></h6>

            
        </div>
    </div>
</div>





<?php include 'rodape.php'; ?>

</body>
</html>
