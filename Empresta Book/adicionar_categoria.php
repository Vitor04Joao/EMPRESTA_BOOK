<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empresta Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    
    <style>
        #container {
            width: 470px;
            margin-top: 38px;
           
        }
        .FgNome {
            display: flex;
            flex-direction: column;
            width: 400px;
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
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit();
    }
    include 'cabecalho.php';
    ?>

    <div class="container" id="container">
        <a href="cadastrar_livros.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a> Cadastrar Categoria:</h2>
        
        <form name="formulario" action="inserir_categoria.php" method="post" onsubmit="return validarFormulario()">

            <br>

            <div class="FgNome">
                <label class="cor">Descrição: <span class="required">*</span></label>
                <input type="text" class="form-control" name="descricao" id="descricao"  placeholder="Digite a descrição da categoria..."
                oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
                
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
                <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao Menu</a>
                <button type="submit" id="botao" class="btn btn-success btn-lg">Cadastrar</button>
                <a href="listar_categoria.php" role="button" class="btn btn-info btn-lg" >Listar</a>
            </div>
        </form>
    </div>


    <script>
        function validarFormulario() {
            const descricao = document.getElementById('descricao');
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