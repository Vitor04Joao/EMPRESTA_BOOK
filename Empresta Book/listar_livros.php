<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"&gt;>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"&gt;>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"&gt;>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"> </head>

</head>

<script>

function confirmacao(id) {
            var resposta = confirm("Deseja remover esse livro?");
            if (resposta == true) {
                window.location.href = "deletar_livro.php?id=" + id;
            }
        }

</script>



<?php
session_start();
$usuario = $_SESSION['usuario'];
$nivel = $_SESSION['nivel'];

if (!isset($_SESSION['usuario'])){
    header('Location: login.php');

}


include 'cabecalho.php';
?>

<style>
  
  
 .btn-danger, .btn-info{
      
      color: black;
      align-items: center;
      font-size: 17px;
    
    }
    
    .btn-warning{
      
      color: black;
      align-items: center;
      font-size: 17px;
      

    }

    .btn-warning:hover{
      
      color:rgb(255, 255, 255);
      text-decoration: none;

    }

 .btn-primary, .btn-success, .btn-dark{

    color: white;
    font-size: 17px;
   

     }

     .autor {
    word-break: break-word;
    max-width: 190px; 
    white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis; 
}
.qtdd {
    word-break: break-word;
    max-width: 25px;
}
.titulo{
    word-break: break-word;
    max-width: 190px; 
    white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis;}

    .edt{
    word-break: break-word;
    max-width: 150px; 
    white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis;}

   .isbn{
    word-break: break-word;
    max-width: 98px;
    
   }

   .data{
    word-break: break-word;
    max-width: 20px;
    
   }

   .acao{
    word-break: break-word;
    max-width: 120px;

   }

</style>
<body>


    <div class="container-fluid" style="padding: 20px;">

   
    <a href="menu.php">
    <h2><i class="fa-solid fa-arrow-left"></i></a>Lista de Livros:</h2>
   
        <br>

        <table id="table_id" class="table table-striped  table-hover">

            <thead>

          
            <tr style="background-color:rgb(29, 29, 29); color: white;">

                <th scope="col">ISBN</th>
                <th scope="col">Titulo</th>
                <th scope="col">Lançamento</th>
                <th scope="col">Autor</th>
                <th scope="col">Editora</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Ação</th>

                </tr>

</thead>


<?php
include 'conexao.php';

$sql = "SELECT L.*, 
            (SELECT COUNT(*) FROM Emprestimo WHERE livro_emprestimo = L.id 
             AND status_livro IN ('pendente', 'emprestado', 'devolvido')) AS tem_emprestimo
        FROM Livro L";
$busca = mysqli_query($conec, $sql);

?>

<?php while ($array = mysqli_fetch_array($busca)) { 
    $id = $array['id'];
    $isbn = $array['isbn'];
    $titulo = $array['titulo'];
    $dataPublicacao = $array['dataPublicacao'];
    $editora = $array['editora'];
    $quantidade = $array['quantidade'];
    
    $tem_emprestimo = $array['tem_emprestimo'];
    $desabilita_excluir = ($tem_emprestimo > 0) ? "disabled" : "";
    
    // Buscar os autores do livro
    $sql_autores = "SELECT A.nome FROM Autor A
                    INNER JOIN AutoresDoLivro AL ON A.id = AL.autor_id
                    WHERE AL.livro_id = $id";
    $busca_autores = mysqli_query($conec, $sql_autores);
    
    $autores = array();
    while ($autor_array = mysqli_fetch_array($busca_autores)) {
        $autores[] = $autor_array['nome'];
    }
    $autores_livro = implode(", ", $autores);
?>

<tr>
    <td  class="isbn" style="vertical-align: inherit;"> <?php echo $isbn ?> </td>
    <td class="titulo" style="vertical-align: inherit;"> <?php echo $titulo ?> </td>
    <td class="data" style="vertical-align: inherit;"> <?php echo $dataPublicacao ?> </td>
    <td class="autor" style="vertical-align: inherit;"> <?php echo $autores_livro; ?> </td>
    <td class="edt" style="vertical-align: inherit;"> <?php echo $editora ?> </td>
    <td class="qtdd" style="vertical-align: inherit;"> <?php echo $quantidade ?> </td>
    <td class="acao" style="vertical-align: inherit;">
   

<?php

//Ajuste para desativar o botão

$desabilita_emprestimo = "";
if ($quantidade == 0 )
    $desabilita_emprestimo = "disabled";

    
?>

<a href="cadastrar_emprestimo.php?id=<?php echo $id ?>">
    <button type="button" <?php echo $desabilita_emprestimo ?> class="btn btn-dark btn-sm">
    <i class="bi bi-arrow-down-up"></i>

    </button>
</a>

<a href="ver_livros.php?id=<?php echo $id ?>">
    <button type="button" class="btn btn-info btn-sm">
        <i class="bi bi-eye"></i>
    </button>
</a>



<a href="editar_livro.php?id=<?php echo $id ?>">
    <button type="button" class="btn btn-warning btn-sm">
        <i class="bi bi-pencil-square"></i>
    </button>
</a>



<button type="button" <?php echo $desabilita_excluir; ?> onclick="confirmacao(<?php echo $id; ?>)" class="btn btn-danger btn-sm">
<i class="bi bi-trash"></i>
</button>



</td>
</tr>

<?php } ?>


</table>

<div style="text-align: right; margin-top:20px;">

<a href="cadastrar_livros.php" role="button" class="btn btn-success btn-lg">Cadastrar Livros</a>

&nbsp;

<a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao menu</a>

</div>


            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<script>

$('document').ready(function(){
 $('#table_id').DataTable({

    "language":{
        "lengthMenu": "Mostrando _MENU_ registros por página",
        "zeroRecords": "Nada encontrado",
        "info": "Mostrando _PAGE_ de _PAGES_",
        "inforEmpty": "Nenhunm registro encontrado",
        "search": "Pesquisar:",

        "paginate": {
            
            "next": "Próximo",
            "previous": "Anterior",
            "fist": "Primeiro",
            "last": "Último"
        }
            },
            "pageLength": 25 
        });
    });

</script>

</body>
</html>