<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>

<script>
    function confirmacao(id) {
        if (id && confirm("Deseja remover esse registro?")) {
            window.location.href = "deletar_estante.php?id=" + id;
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
    
 .btn-danger, .btn-info {
    color: black;
    font-size: 17px;
}

 .btn-warning {
    color: black;
    font-size: 17px;
}

 .btn-warning:hover {
    color: rgb(255, 255, 255);
    text-decoration: none;
}

 .btn-primary, .btn-success {
    color: white;
    font-size: 17px;
}

.obs {
    word-break: break-word;
    max-width: 250px; 
    white-space: nowrap; 
    overflow: hidden;
    text-overflow: ellipsis; 
}
</style>

<body>
    <div class="container-fluid" style="padding: 20px;">
        <a href="menu.php">
        <h2><i class="fa-solid fa-arrow-left"></i></a>Lista das Estantes:</h2>
        <br><br>

        <table id="table_id" class="table table-striped table-hover">

            <thead>

           
            <tr style="background-color:rgb(29, 29, 29); color: white;">

                    <th scope="col">Nome</th>
                    <th scope="col">Tipo de Acervo</th>
                    <th scope="col">Observação</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>

            <?php
            include 'conexao.php';
            $sql = "SELECT * FROM Estante";
            $busca = mysqli_query($conec, $sql);

            while ($array = mysqli_fetch_array($busca)) {
                $id = $array['id'];
                $nome = $array['nome'];
                $tipoAcervo = $array['tipoAcervo'];
                $observacao = $array['observacao'];
            ?>
            <tr>
                <td style="vertical-align: inherit;"> <?php echo $nome ?> </td>
                <td style="vertical-align: inherit;"> <?php echo $tipoAcervo ?> </td>
                <td class="obs" style="vertical-align: inherit;"> <?php echo $observacao ?> </td>
                <td style="vertical-align: inherit;">
                    
                    
                  
                  
               
                    <a href="editar_estante.php?id=<?php echo $id ?>">
                        <button type="button" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>
                    
                    &nbsp&nbsp
                    <button type="button"  onclick="confirmacao(<?php echo $id ?>)" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>

            <?php } ?>
        </table>

        <div style="text-align: right; margin-top:20px;">
            <a href="adicionar_estante.php" role="button" class="btn btn-success btn-lg">Cadastrar Estante</a>
            &nbsp;
            <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao menu</a>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

        <script>
            $(document).ready(function() {
                $('#table_id').DataTable({
                    "language": {
                        "lengthMenu": "Mostrando _MENU_ registros por página",
                        "zeroRecords": "Nada encontrado",
                        "info": "Mostrando _PAGE_ de _PAGES_",
                        "infoEmpty": "Nenhum registro encontrado",
                        "search": "Pesquisar:",
                        "paginate": {
                            "next": "Próximo",
                            "previous": "Anterior",
                            "first": "Primeiro",
                            "last": "Último"
                        }
            },
            "pageLength": 25 
        });
    });
        </script>
    </div>
</body>
</html>
