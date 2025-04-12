<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    
    header('Location: login.php');
    exit();
}

include 'conexao.php'; 


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger' role='alert'>ID inválido!</div>";
    exit();
}

$id = intval($_GET['id']); 
$usuario = $_SESSION['usuario']; 

// Consulta SQL para buscar o livro

$sql = "SELECT * FROM Livro WHERE id = ?";
$stmt = mysqli_prepare($conec, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $array = mysqli_fetch_assoc($result);

      $isbn = $array['isbn'];
        $titulo = $array['titulo'];
        $dataPublicacao = $array['dataPublicacao'];
        $editora = $array['editora'];
        $quantidade = $array['quantidade'];
        $obs = $array['obs'];
       

} else {
    echo "<div class='alert alert-danger' role='alert'>Livro não encontrado!</div>";
    exit();
}


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


// Buscar a categoria do livro
$sql_categoria = "SELECT C.descricao FROM Categoria C
                  INNER JOIN Livro L ON C.id = L.categoria_id
                  WHERE L.id = $id";
$busca_categoria = mysqli_query($conec, $sql_categoria);

if ($categoria_array = mysqli_fetch_array($busca_categoria)) {
    $categoria_livro = $categoria_array['descricao'];
} else {
    $categoria_livro = "Categoria não encontrada"; 

}

// Buscar a Estante e Prateleira em que o livro está
$sql_estante_prateleira = "SELECT E.nome AS nome_estante, P.numero AS numero_prateleira
                            FROM Livro_Prateleira LP
                            INNER JOIN Prateleira P ON LP.prateleira_id = P.id
                            INNER JOIN Estante E ON P.estante_id = E.id
                            WHERE LP.livro_id = $id";
$busca_estante_prateleira = mysqli_query($conec, $sql_estante_prateleira);

if ($estante_prateleira_array = mysqli_fetch_assoc($busca_estante_prateleira)) {
    $nome_estante = $estante_prateleira_array['nome_estante'];
    $numero_prateleira = $estante_prateleira_array['numero_prateleira'];
} else {
    $nome_estante = "Estante não encontrada";
    $numero_prateleira = "Prateleira não encontrada";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
  
    <style>
       

 
       #container {
        width: 770px;
    }


.d-flex{
    justify-content: space-between;
    
}


.B{
  
  display: flex;
  flex-direction: column;
  align-items: left;
  margin-top: 46px;
  margin-left: 2px;
  margin-right: 2px;
}


.igual{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 234px;
}

.isbn{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 190px;
}

.edtr{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 358px;
}

.qtdd{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 105px;
}


.grande{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 530px;
}

.center{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 238px;
}

.telaCheia{
    display: flex;
  flex-direction: column;
  align-items: left;
  width: 742px;

}


.B{
  
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 36px;
  margin-top: 40px;
  
}

    </style>
</head>
<body>
    <?php include 'cabecalho.php'; ?>

    <div class="container" style="margin-top: 20px" id="container">
        <a href="listar_livros.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a> Dados do Livro:</h2>

        <form name="formulario" method="post" style="margin-top: 20px">
         

            <div class="d-flex">
                <div class="isbn">
                    <label>ISBN:</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $isbn; ?>" readonly>
                </div>
                <div class="grande">
                    <label>Título:</label>
                    <input type="text" class="form-control" name="titulo" value="<?php echo $titulo; ?>" readonly>
                </div>
            </div>

            <div class="d-flex">
                <div class="center">
                    <label>Lançamento:</label>
                    <input type="date" class="form-control" name="dataPublicacao" value="<?php echo $dataPublicacao; ?>" readonly>
                </div>
                <div class="edtr">
                    <label>Editora:</label>
                    <input type="text" class="form-control" name="editora" value="<?php echo $editora; ?>" readonly>
                </div>

                <div class="qtdd">
                    <label>Quantidade:</label>
                    <input type="number" class="form-control" name="quantidade" value="<?php echo $quantidade; ?>" readonly>
                </div>

            </div>

            <div class="d-flex">
               
               
                <div class="igual">
                    <label>Estante:</label>
                    <input type="text" class="form-control" name="descricao" value="<?php echo $nome_estante; ?>" readonly>
                </div>

                <div class="igual">
                    <label>Prateleira:</label>
                    <input type="text" class="form-control" name="numero" value=" <?php echo $numero_prateleira; ?>" readonly>
                </div>

                <div class="igual">
                    <label>Categoria:</label>
                    <input type="text" class="form-control" name="categoria" value=" <?php echo $categoria_livro ; ?>" readonly>
                </div>


            </div>
        
            <div class="form-group">
                <label>Autor:</label>
                <textarea class="form-control" type="text" rows="2"  name="autor" value="" readonly><?php echo $autores_livro; ?></textarea>
            </div>
        

            <div class="form-group">
                    <label>Observação:</label>
                    <textarea type="text" class="form-control" rows="2" name="obs"  readonly><?php echo $obs; ?></textarea>
                </div>

            
            <div style="text-align: right;">
                <a href="listar_livros.php" role="button" class="btn btn-primary btn-lg" style="margin-top: 20px">Voltar</a>
            </div>
        </form>
    </div>

<script>

document.addEventListener("DOMContentLoaded", function () {
    function formatarISBN(isbn) {
        isbn = isbn.replace(/\D/g, ""); 
        isbn = isbn.replace(/^(\d{3})(\d)/, "$1-$2");
        isbn = isbn.replace(/-(\d{2})(\d)/, "-$1-$2");
        isbn = isbn.replace(/-(\d{3})(\d)/, "-$1-$2");
        isbn = isbn.replace(/-(\d{4})(\d)$/, "-$1-$2");
        return isbn;
    }

    document.getElementById("isbn").addEventListener("input", function (e) {
        e.target.value = formatarISBN(e.target.value);
    });

    // Aplica a máscara nos valores vindos do banco de dados
    document.getElementById("isbn").value = formatarISBN(document.getElementById("isbn").value);
});


</script>

</body>
</html>
