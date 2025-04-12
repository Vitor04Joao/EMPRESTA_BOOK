<?php
include 'conexao.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger' role='alert'>ID inválido!</div>";
    exit();
}

$id_categoria = $_GET['id'];

$sql = "SELECT * FROM Categoria WHERE id = $id_categoria";
$buscar = mysqli_query($conec, $sql);
$array = mysqli_fetch_array($buscar);

if (!$array) {
    echo "<div class='alert alert-danger' role='alert'>Categoria não encontrada!</div>";
    exit();
}

$descricao = $array['descricao'];
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Empresta Book</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    
    <style>
       #container {
            width: 470px;
            margin-top: 38px;
           
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

        .btn-container {
            text-align: right;
            position: fixed;
            bottom: 20px;
            right: 37%;
            width: 100%;
}


        .category-dic {
        
        width: 400px; 
        text-align: justify; 
        font-size: 15px; 
        color: gray; 
        margin-top: 10px; 
        font-family:Georgia, serif; }

    .category-list {
        
        width: 400px; 
        text-align: left; 
        font-size: 14px; 
        color: gray; 
        font-family:Georgia, serif;
        
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
        <a href="listar_categoria.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a>Dados da Categoria:</h2>

            <form name="formulario" action="atualizar_categoria.php" method="post" style="margin-top: 20px" onsubmit="return validarFormulario()">


<div class="FgID">
        <input type="hidden" class="form-control" name="id_categoria" value="<?php echo $id_categoria ?>" readonly>
    </div>

    <div class="FgNome">
        <label>Descrição:<span class="required">*</span></label>
        <input type="Text" class="form-control" name="descricao" value="<?php echo $descricao ?>" placeholder="Digite a descrição..." oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
        <div class="invalid-feedback">Este campo é obrigatório!!</div>
    </div>
    <br><br>



    <div class="category-dic">
    <p><strong>Dica:</strong> Uma categoria de livros é um agrupamento de obras com temas ou gêneros semelhantes, 
    facilitando a organização e a busca por conteúdos.</p>

</div>
<div class="category-list">
    
    <p><strong>Exemplos de categorias:</strong></p>
    <ul>
        <li><strong>Ficção:</strong> Romance, fantasia, ficção científica, terror...</li>
        <li><strong>Não ficção:</strong> Biografias, autoajuda, história, ciência...</li>
        <li><strong>Infantil e Juvenil:</strong> Livros ilustrados, contos, literatura...</li>
        <li><strong>Acadêmicos e Didáticos:</strong> Livros escolares...</li>
        
    </ul>
</div>





    <div class="btn-container">
        <a href="listar_categoria.php" role="button" class="btn btn-primary btn-lg">Voltar</a>
        <button type="submit" id="botao" class="btn btn-warning btn-lg">Atualizar</button>
    </div>

</form>

    </div>

    <script>
    function validarFormulario() {
        const descricao = document.querySelector('input[name="descricao"]'); 
        const feedback = descricao.nextElementSibling; 
        let isValid = true;

        if (!descricao.value.trim()) {
            descricao.classList.add('is-invalid');
            feedback.style.display = 'block';
            isValid = false;
        } else {
            descricao.classList.remove('is-invalid');
            feedback.style.display = 'none';
        }
        return isValid;
    }
</script>


</body>
</html>
