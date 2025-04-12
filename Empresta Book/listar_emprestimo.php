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
        var resposta = confirm("Deseja remover esse registro?");
        if (resposta == true) {
            window.location.href = "deletar_emprestimo.php?id="+id;
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

 .btn-primary, .btn-success{

    color: white;
    font-size: 17px;
   

     }

     .bibliotecario {
    word-break: break-word;
    max-width: 100px;
    white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis; 
}
.data {
    word-break: break-word;
    max-width: 20px;
}
.livro {
    word-break: break-word;
    max-width: 250px;
    white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis; 
}

.leitor {
    word-break: break-word;
    max-width: 200px;
    white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis; 
}

.unidade {
    word-break: break-word;
    max-width: 10px;
}

.Acao {
    word-break: break-word;
    max-width: 120px;
}

</style>
<body>


    <div class="container-fluid" style="padding: 20px;">

   
    <a href="menu.php">
    <h2><i class="fa-solid fa-arrow-left"></i></a>Lista de Emprestimo:</h2>
   
        <br>

        <table id="table_id" class="table table-striped  table-hover">

            <thead>

          
            <tr style="background-color:rgb(29, 29, 29); color: white;">

            
                <th scope="col">Item </th>
                <th scope="col">Data do Empréstimo </th>
                <th scope="col">Data da Entrega</th>
                <th scope="col">Status</th>
                <th scope="col">Leitor</th>
                <th scope="col">Livro</th>
                <th scope="col">Usuário</th>
                <th scope="col">Ação</th>

                </tr>

</thead>



<?php
    include 'conexao.php';
    

    // Consulta SQL com JOIN para buscar os dados relacionados

    $sql = "
    SELECT 
        e.id, e.dataEmprestimo, e.dataDevolucao, e.status_livro, e.unidade, 
        l.nome AS leitor_nome, 
        lv.titulo AS livro_titulo, 
        b.nome AS bibliotecario_nome
    FROM Emprestimo e
    JOIN Leitor l ON e.leitor_emprestimo = l.id
    JOIN Livro lv ON e.livro_emprestimo = lv.id
    JOIN Bibliotecario b ON e.bibliotecario_emprestimo = b.id
    ";

    $busca = mysqli_query($conec, $sql);

    while ($array = mysqli_fetch_array($busca)) {

        $id = $array['id'];
        $data_emprestimo = $array['dataEmprestimo'];
        $data_entrega = $array['dataDevolucao'];
        $status_livro = $array['status_livro'];
        $unidade = $array['unidade'];
        $leitor_nome = $array['leitor_nome']; // Nome do Leitor
        $livro_titulo = $array['livro_titulo']; // Título do Livro
        $bibliotecario_nome = $array['bibliotecario_nome']; // Nome do Bibliotecário

        // Definir a cor da linha com base no status

        if ($status_livro == "Pendente") {
            $row_class = "table-danger"; 
        } elseif ($status_livro == "Devolvido") {
            $row_class = "table-success"; 
        } elseif ($status_livro == "Emprestado") {
            $row_class = "table-primary";
        } else {
            $row_class = ""; 
        }
?>
<tr class="<?php echo $row_class; ?>">

<td class="unidade" style="vertical-align: inherit;"> <?php echo $unidade ?> </td>
<td class="data" style="vertical-align: inherit;"> <?php echo $data_emprestimo ?> </td>
<td class="data" style="vertical-align: inherit;"> <?php echo $data_entrega ?> </td>
<td style="vertical-align: inherit;"> <?php echo $status_livro ?> </td>
<td class="leitor" style="vertical-align: inherit;"> <?php echo $leitor_nome ?> </td>
<td class="livro" style="vertical-align: inherit;"> <?php echo $livro_titulo ?> </td>
<td class="bibliotecario" style="vertical-align: inherit;"> <?php echo $bibliotecario_nome ?> </td>

<td style="vertical-align: inherit;">


<?php

// Ajuste para desativar o botão
    
    $disabled_devolver = ($status_livro == "Devolvido") ? "disabled" : "";
?>

<a href="devolver_livro.php?id=<?php echo $id ?>">
    <button type="button" class="btn btn-success btn-sm" <?php echo $disabled_devolver; ?>>
        <i class="fas fa-check"></i>
    </button>
</a>

&nbsp;

<a href="ver_emprestimo.php?id=<?php echo $id ?>">
    <button type="button" class="btn btn-info btn-sm">
        <i class="bi bi-eye"></i>
    </button>
</a>

&nbsp;

<a href="editar_emprestimo.php?id=<?php echo $id ?>">
    <button type="button" class="btn btn-warning btn-sm" <?php echo $disabled_devolver; ?>>
        <i class="bi bi-pencil-square"></i>
    </button>
</a>

&nbsp;

<?php

// Ajuste para desativar o botão

    $disabled_pendente = ($status_livro == "Pendente") ? "disabled" : "";

    $disabled_emprestado = ($status_livro == "Emprestado") ? "disabled" : "";

    
?>



<button type="button" <?php echo $disabled_emprestado ?> onclick="confirmacao(<?php echo $id?>)" class="btn btn-danger btn-sm"  <?php echo $disabled_pendente; ?>>
    <i class="bi bi-trash"></i>
</button>

</td>
</tr>

<?php } ?>


</table>

<div style="text-align: right; margin-top:20px;">

<a href="cadastrar_registroE.php" role="button" class="btn btn-success btn-lg">Registrar Emprestimo</a>

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