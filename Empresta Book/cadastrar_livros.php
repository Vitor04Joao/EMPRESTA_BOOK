<?php
include 'conexao.php';

// Buscar Categorias
$sqlCategoria = "SELECT * FROM Categoria ORDER BY descricao ASC";
$buscarCategoria = mysqli_query($conec, $sqlCategoria);
$categorias = mysqli_fetch_all($buscarCategoria, MYSQLI_ASSOC);

// Buscar Estantes
$sqlEstante = "SELECT * FROM Estante ORDER BY nome ASC";
$buscarEstante = mysqli_query($conec, $sqlEstante);
$estantes = mysqli_fetch_all($buscarEstante, MYSQLI_ASSOC);

// Buscar Prateleiras
$sqlPrateleira = "SELECT * FROM Prateleira ORDER BY numero ASC";
$buscarPrateleira = mysqli_query($conec, $sqlPrateleira);
$prateleiras = mysqli_fetch_all($buscarPrateleira, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Empresta Book</title>
</head>

<?php 
session_start();
$usuario = $_SESSION['usuario'];
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}
include 'cabecalho.php';
?>

<style>
    #container {
        width: 770px;
    }

    .d-flex {
        justify-content: space-between;
    }

    .FgID {
        display: flex;
        flex-direction: column;
        align-items: left;
        width: 95px;
    }

    .B {
        display: flex;
        width: 35px;
        flex-direction: column;
        align-items: left;
        margin-top: 34px;
        margin-left: 2px;
        margin-right: 2px;

    }

    .igual {
        display: flex;
        flex-direction: column;
        align-items: right;
        width: 205px;
    }

    .edtr {
        display: flex;
        flex-direction: column;
        align-items: right;
        width: 358px;
    }

    .qtdd {
        display: flex;
        flex-direction: column;
        align-items: right;
        width: 105px;
    }

    .medio {
        display: flex;
        flex-direction: column;
        align-items: right;
        width: 152px;
    }

    .grande {
        display: flex;
        flex-direction: column;
        align-items: left;
        width: 522px;
    }

    .center {
        display: flex;
        flex-direction: column;
        align-items: left;
        width: 238px;
    }

    .telaCheia {
        display: flex;
        flex-direction: column;
        align-items: left;
        width: 742px;
    }

    .input-with-button {
        position: relative;
        display: flex;
        align-items: left;
        width: 697px;
    }

    #toggle-list {
        position: absolute;
        right: 1px;
        top: 28%;
        transform: translateY(-50%);
        border: none;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    #toggle-list:hover {
        background-color: #0056b3;
    }

    .autor-item.active {
        background-color: #007bff;
        color: white;
    }

    #autor-list {
        display: none;
        max-height: 180px;
        overflow-y: auto;
        width: 697px;
        position: absolute;
        top: 100%;
        left: 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: white;
        list-style: none;
        padding: 0;
    }

    .list-group-item {
        padding: 8px;
        cursor: pointer;
    }

    .list-group-item:hover {
        background-color: #007bff;
    }

    .btn-container {
        text-align: right;
        position: fixed;
        bottom: 20px;
        right: 26%;
        width: 100%;
    }
</style>

<body>
    <div class="container" style="margin-top: 20px" id="container">
        <a href="menu.php">
            <h2><i class="fa-solid fa-arrow-left"></i> </a> Cadastro de Livro</h2>
       

        <form action="inserir_livros.php" method="post" style="margin-top: 20px">
            <div class="d-flex">
                <div class="igual">
                    <label>ISBN:<span class="required">*</span></label>
                    <input type="text" class="form-control" id="isbn" name="isbn" pattern=".{17}" maxlength="17" placeholder="xxx-xx-xxx-xxxx-x" inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="grande">
                    <label class="cor">Título:<span class="required">*</span></label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título do livro">
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="d-flex">
                <div class="center">
                    <label>Lançamento:<span class="required">*</span></label>
                    <input type="date" class="form-control" min="1500-01-01" max="2030-12-31" id="dataPublicacao" name="dataPublicacao">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="edtr">
                    <label>Editora:<span class="required">*</span></label>
                    <input type="text" class="form-control" placeholder="Digite a editora do livro" id="editora" name="editora">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="qtdd">
                    <label>Quantidade:<span class="required">*</span></label>
                    <input type="number" class="form-control" placeholder="N°" id="quantidade" name="quantidade" min=0>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="d-flex" >

<div class="igual">
    <label>Estante:<span class="required">*</span></label>
    <select class="form-control" id="estante" name="estante">
        <option value="">Selecione uma opção</option>
        <?php foreach ($estantes as $estante) { ?>
            <option value="<?php echo $estante['nome']; ?>" data-id="<?php echo $estante['id']; ?>">
                <?php echo $estante['nome']; ?>
            </option>
        <?php } ?>
    </select>
    <div class="invalid-feedback"></div>
</div>

<div class="B">
                                
                                <a href="adicionar_estante.php" role="button" class="btn btn-success btn-sm">+</a>  
    
                                 </div>

<input type="hidden" class="form-control" name="id_estante" id="id_estante" readonly>

<div class="igual">
    <label>Prateleira:<span class="required">*</span></label>
    <select class="form-control" id="prateleira" name="prateleira">
        <option value="">Selecione uma opção</option>
        <?php foreach ($prateleiras as $prateleira) { ?>
            <option value="<?php echo $prateleira['numero']; ?>" data-id="<?php echo $prateleira['id']; ?>">
                <?php echo $prateleira['numero']; ?>
            </option>
        <?php } ?>
    </select>
    <div class="invalid-feedback"></div>
</div>

<div class="B">
                                
                                <a href="adicionar_prateleira.php" role="button" class="btn btn-success btn-sm">+</a>  
    
                                </div>


<input type="hidden" class="form-control" name="id_prateleira" id="id_prateleira" readonly>

<div class="igual">
    <label>Categoria:<span class="required">*</span></label>
    <select class="form-control" id="categoria" name="categoria">
        <option value="">Selecione uma opção</option>
        <?php foreach ($categorias as $categoria) { ?>
            <option value="<?php echo $categoria['descricao']; ?>" data-id="<?php echo $categoria['id']; ?>">
                <?php echo $categoria['descricao']; ?>
            </option>
        <?php } ?>
    </select>
    <div class="invalid-feedback"></div>
</div>

<div class="B">
       
<a href="adicionar_categoria.php" role="button" class="btn btn-success btn-sm">+</a>  

                            
</div>

<input type="hidden" class="form-control" name="id_categoria" id="id_categoria" readonly>
</div>
            <div class="d-flex">
                <div class="telaCheia" style="position: relative;">
                    <label>Autor:<span class="required">*</span></label>
                    <div class="input-with-button">
                        <textarea id="autor-input" class="form-control" class="invalid-feedback" rows="2" id="autor" name="autor" readonly placeholder="Selecione um ou mais Autores..."></textarea>
                        <button id="toggle-list" type="button" class="btn btn-secondary">
                            <span>▾</span>
                        </button>
                    </div>

                    <ul id="autor-list" class="list-group mt-2" style="display: none; overflow-y: auto;">
                        <?php
                        include 'conexao.php';
                        $sql = "SELECT * FROM Autor ORDER BY nome ASC";
                        $buscar = mysqli_query($conec, $sql);
                        while ($array = mysqli_fetch_array($buscar)) {
                            $id = $array['id'];
                            $nome = $array['nome'];
                        ?>
                            <li class="list-group-item autor-item" data-id="<?php echo $id; ?>" data-nome="<?php echo $nome; ?>" style="cursor: pointer;">
                                <?php echo $nome; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <input type="hidden" name="autores_ids" id="autores_ids" readonly>

                <div class="B">
                    <a href="adicionar_autor.php" role="button" class="btn btn-success btn-sm">+</a>
                </div>
            </div>

            <div class="telaCheia">
                <label>Observação:</label>
                <textarea type="text" class="form-control" placeholder="Escreva algo significativo..." maxlength="120" rows="2" name="obs"></textarea>
            </div>

            <div class="btn-container">
                <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao menu</a>
                &nbsp;
                <button type="submit" id="botao" class="btn btn-success btn-lg">Cadastrar</button>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Impede o envio até que seja validado corretamente
            let isValid = true;

            function validarCampo(input) {
                const feedback = input.nextElementSibling;
                if (input.value.trim() === "") {
                    input.classList.add('is-invalid');
                    feedback.textContent = "Este campo é obrigatório!!";
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                    feedback.textContent = "";
                }
            }

            function validarSelect(select) {
                const feedback = select.nextElementSibling;
                if (!select.value || select.value === "") {
                    select.classList.add('is-invalid');
                    feedback.textContent = "Selecione uma opção!!";
                    isValid = false;
                } else {
                    select.classList.remove('is-invalid');
                    feedback.textContent = "";
                }
            }

            function validarNumero(input) {
                const feedback = input.nextElementSibling;
                if (input.value.trim() === "" || isNaN(input.value) || parseInt(input.value) < 0) {
                    input.classList.add('is-invalid');
                    feedback.textContent = "Número inválido!!";
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                    feedback.textContent = "";
                }
            }

            // Validação de todos os campos obrigatórios
            validarCampo(document.querySelector('input[name="isbn"]'));
            validarCampo(document.querySelector('input[name="titulo"]'));
            validarCampo(document.querySelector('input[name="dataPublicacao"]'));
            validarCampo(document.querySelector('input[name="editora"]'));
            validarNumero(document.querySelector('input[name="quantidade"]'));
            validarSelect(document.querySelector('select[name="estante"]'));  // Corrigido aqui
            validarSelect(document.querySelector('select[name="prateleira"]')); // Corrigido aqui
            validarSelect(document.querySelector('select[name="categoria"]'));
            validarCampo(document.querySelector('textarea[name="autor"]'));

            if (isValid) {
                form.submit();
            }
        });
    });

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

        document.getElementById("isbn").value = formatarISBN(document.getElementById("isbn").value);
    });

    document.addEventListener('DOMContentLoaded', function () {
        function atualizarId(selectId, inputId) {
            const select = document.getElementById(selectId);
            const input = document.getElementById(inputId);

            select.addEventListener('change', function () {
                const selectedOption = select.selectedOptions[0];
                input.value = selectedOption.dataset.id || "";
            });
        }

        atualizarId('categoria', 'id_categoria');
        atualizarId('estante', 'id_estante');
        atualizarId('prateleira', 'id_prateleira');
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Adicionando um evento de clique para os itens de autores
        const autorListItems = document.querySelectorAll('.autor-item');
        const autorInput = document.getElementById('autor-input');
        const autoresIdsInput = document.getElementById('autores_ids');
        let autoresIds = [];

        autorListItems.forEach(item => {
            item.addEventListener('click', function () {
                const autorId = item.getAttribute('data-id');
                const autorNome = item.getAttribute('data-nome');

                // Verifica se o autor já foi adicionado
                if (!autoresIds.includes(autorId)) {
                    autoresIds.push(autorId);
                    autorInput.value += autorNome + ", ";
                    autoresIdsInput.value = autoresIds.join(',');
                }
            });
        });
    });
</script>


    <script src="scriptLivros.js"></script>
</body>

</html>
