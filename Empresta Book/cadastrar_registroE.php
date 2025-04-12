<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'conexao.php';

$usuario = $_SESSION['usuario'];

// Data atual para o empréstimo
date_default_timezone_set('America/Sao_Paulo');
$data_emprestimo = date("Y-m-d", strtotime("midnight"));

// Consulta para buscar o bibliotecário logado
$sql_bibliotecario = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario'";
$busca_bibliotecario = mysqli_query($conec, $sql_bibliotecario);

if (mysqli_num_rows($busca_bibliotecario) > 0) {
    $array_bibliotecario = mysqli_fetch_array($busca_bibliotecario);
    $id_bibliotecario = $array_bibliotecario['id'];
    $nome_bibliotecario = $array_bibliotecario['nome'];
} else {
    $nome_bibliotecario = "";
}
?>


<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Empresta Book</title>


    <style>

#container {
        width: 770px;
       
        }
    


.d-flex{
    justify-content: space-between;
    
}


.igual{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 229px;
}

.nome{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 365px;
}

.qtdd{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 95px;
}



.Id{
    display: flex;
  flex-direction: column;
  align-items: right;
  width: 165px;

}
.dataN{
    display: flex;
  flex-direction: column;
  align-items: right;
  width: 185px;

}


.buton{
  display: flex;
  margin-top:35px;
  margin-right:168px;
  flex-direction: column;
  align-items: left;
 width: 40px;
 height: 32px;
 
}

.busca{
  display: flex;
  margin-top:32px;
  margin-right:29px;
  flex-direction: column;
  align-items: left;
 width: 150px;
 height: 32px;
 
}



.grande{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 522px;
}

.center{
  display: flex;
  flex-direction: column;
  margin-right: 150px;
  width: 238px;
}

.telaCheia{
    display: flex;
  flex-direction: column;
  align-items: left;
  width: 742px;

}

.btn-container {
            text-align: right;
            position: fixed;
            bottom: 20px;
            right: 26%;
            width: 100%;
        }

        .dadosLeitor{
  display: flex;
  flex-direction: column;
  margin-right: 250px;
  width: 229px;
}
  </style>
</head>

<body>

<?php 


include "cabecalho.php";
?>

<div class="container" style="margin-top: 20px" id="container">
    <a href="menu.php">
        <h2><i class="fa-solid fa-arrow-left"></i></a>Registro de Empréstimo</h2>
    

    <form action="inserir_emprestimo.php" method="POST" id="cadastroForm" style="margin-top: 20px">

    
        <div class="d-flex">
            <div class="grande">
                <label>Leitor:<span class="required">*</span></label>
                <select class="form-control" id="nome" name="nome">
                    <option value="" disabled selected>Selecione uma opção</option>
                    <?php
                    include 'conexao.php';
                    $sql = "SELECT * FROM Leitor order by nome ASC";
                    $buscar = mysqli_query($conec, $sql);
                    while ($array = mysqli_fetch_array($buscar)) {
                        $id_leitor = $array['id'];
                        $nome = $array['nome'];
                    ?>
                        <option><?php echo $nome; ?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback"></div>
            </div>

            <div class="buton">
                <a href="cadastrar_leitores.php" role="button" class="btn btn-success btn-sm">+</a>  
            </div>
        </div>
<br>
        <div class="d-flex">
           
                <input type="hidden" class="form-control" id="id" name="id" placeholder="Identificador" readonly>
           
            
            <div class="igual">
                <label>Data de Nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" readonly>
                <div class="invalid-feedback"></div>
            </div>
            <div class="dadosLeitor">
                <label>Tipo de Leitor:</label>
                <input type="text" class="form-control" id="tipo_leitor" name="tipo_leitor" placeholder="Tipo de Leitor" readonly>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="d-flex">
    <div class="grande">
        <label>ISBN do Livro:<span class="required">*</span></label>
        <div class="input-group">
            <input type="text" class="form-control" id="isbn" name="isbn" pattern=".{17}" maxlength="17" placeholder="XXX-XX-XXXX-XXXX-X" 
            inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')">
        </div>
        <div id="mensagemErroISBN" class="text-danger mt-2"></div> 
    </div>

    <div class="busca">
        <button type="button" id="buscarLivro" class="btn btn-primary btn-ms">Buscar</button>
    </div>
</div>

        <div class="igual">
            <input type="hidden" class="form-control" name="id_livro" readonly>
        </div>

        <div class="d-flex">
            <div class="qtdd">
                <label>Unidade:</label>
                <input type="number" class="form-control" id="unidade" name="unidade" value="1" min="1" max="2"
                inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')">
                <div class="invalid-feedback"></div>
            </div>

            <div class="grande">
                <label>Título:</label>
                <input type="text" class="form-control" id="nomeLivro" name="titulo" placeholder="Título do livro" readonly>
                <div class="invalid-feedback"></div>
            </div>

            <div class="qtdd">
                <label>Quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="N°" value="<?php echo $quantidade ?>" min="0" readonly>
                <div class="invalid-feedback"></div>
            </div>
        </div>


        <div class="d-flex">
            <div class="igual">
                <label>Data do Empréstimo:</label>
                <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" value="<?php echo $data_emprestimo ?>" readonly>
                <div class="invalid-feedback"></div>
            </div>
            <div class="igual">
                <label>Data da Entrega Prevista:</label>
                <input type="date" class="form-control" id="data_entrega" min="2024-01-01" max="2030-01-01" name="data_entrega" >
                <div class="invalid-feedback"></div>
            </div>
            <div class="igual">
                <label>Status do Livro:</label>
                <input type="text" class="form-control" id="status_livro" name="status_livro" value="Emprestado" readonly>
                <div class="invalid-feedback"></div>
            </div>
        </div>


        <div class="d-flex">
            <div class="ID">
                <input type="hidden" class="form-control" name="id_bibliotecario" value="<?php echo $id_bibliotecario ?>" readonly>
            </div>

            <div class="nome">
                <label>Responsável pelo:</label>
                <input type="text" class="form-control" id="nome_bibliotecario" name="nome_bibliotecario" value="<?php echo $nome_bibliotecario ?>" placeholder="Nome" readonly>
                <div class="invalid-feedback"></div>
            </div>

            <div class="nome">
                <label>Usuário:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario ?>" placeholder="Usuário" readonly>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="btn-container">
            <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar</a>
            <button type="submit" id="botao" class="btn btn-success btn-lg">Cadastrar</button>
        </div>
    </form>
</div>


            
    
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

    <script>
    $(document).ready(function() {
        // Validação do leitor
        $('select[name="nome"]').change(function() {
            var nomeLeitor = $(this).val();
            var mensagemErroLeitor = $('#mensagemErroLeitor'); 

            if (nomeLeitor) {
                $.ajax({
                    url: 'buscar_dados_leitor.php',
                    type: 'POST',
                    data: { nome: nomeLeitor },
                    dataType: 'json',
                    success: function(data) {
                        if (data.id) {
                            $('input[name="id"]').val(data.id);
                            $('input[name="data_nascimento"]').val(data.data_nascimento);
                            $('input[name="tipo_leitor"]').val(data.tipo_leitor);
                            mensagemErroLeitor.text(''); 
                        } else {
                            mensagemErroLeitor.text('Dados do leitor não encontrados.');
                            $('input[name="id"], input[name="data_nascimento"], input[name="tipo_leitor"]').val('');
                        }
                    },
                    error: function() {
                        mensagemErroLeitor.text('Erro ao buscar os dados do leitor.');
                    }
                });
            } else {
                $('input[name="id"], input[name="data_nascimento"], input[name="tipo_leitor"]').val('');
                mensagemErroLeitor.text(''); 
            }
        });

        // Busca de livro pelo ISBN
        $('#buscarLivro').click(function() {
            var isbn = $('input[name="isbn"]').val().trim();
            var mensagemErroISBN = $('#mensagemErroISBN');

            if (isbn) {
                $.ajax({
                    url: 'buscar_livro_isbn.php',
                    type: 'POST',
                    data: { isbn: isbn },
                    dataType: 'json',
                    success: function(data) {
                        if (data.id) {
                            $('input[name="titulo"]').val(data.titulo);
                            $('input[name="quantidade"]').val(data.quantidade);
                            $('input[name="id_livro"]').val(data.id);
                            mensagemErroISBN.text('');
                        } else {
                            mensagemErroISBN.text('Livro não encontrado.');
                            $('input[name="titulo"], input[name="quantidade"], input[name="id_livro"]').val('');
                        }
                    },
                    error: function() {
                        mensagemErroISBN.text('Erro ao buscar o livro.');
                    }
                });
            } else {
                mensagemErroISBN.text('Digite um ISBN válido.');
            }
        });

        // Validação de quantidade disponível
        $('#unidade').change(function() {
            var unidade = parseInt($(this).val());
            var quantidade = parseInt($('#quantidade').val());
            var mensagemErroUnidade = $('#unidade').next('.invalid-feedback');

            if (isNaN(unidade) || unidade <= 0) {
                mensagemErroUnidade.text('Informe uma quantidade válida.');
                $(this).val('1');
            } else if (quantidade - unidade < 0) {
                mensagemErroUnidade.text('A quantidade informada é maior que a disponível!');
                $(this).val('1');
            } else {
                mensagemErroUnidade.text(''); 
            }
        });

        // Validação do formulário ao enviar
        $('#cadastroForm').submit(function(event) {
            let formValido = true;

            function validarCampo(input) {
                if (input.value.trim() === "") {
                    $(input).addClass('is-invalid').next('.invalid-feedback').text("Este campo é obrigatório!");
                    formValido = false;
                } else {
                    $(input).removeClass('is-invalid').next('.invalid-feedback').text("");
                }
            }

            validarCampo(document.getElementById('nome'));
            validarCampo(document.getElementById('isbn'));
            validarCampo(document.getElementById('nomeLivro'));
            validarCampo(document.getElementById('quantidade'));

            const unidadeInput = document.getElementById('unidade');
            const quantidadeInput = document.getElementById('quantidade');
            const unidade = parseInt(unidadeInput.value);
            const quantidade = parseInt(quantidadeInput.value);

            if (quantidade - unidade < 0) {
                $(unidadeInput).addClass('is-invalid').next('.invalid-feedback').text("A quantidade informada é maior que a disponível!");
                formValido = false;
            } else {
                $(unidadeInput).removeClass('is-invalid').next('.invalid-feedback').text("");
            }

            // Validação de datas
            const data_entregaInput = document.getElementById('data_entrega');

            if (data_entregaInput.value.trim() === "") {
                $(data_entregaInput).addClass('is-invalid').next('.invalid-feedback').text("A data não pode estar vazia!");
                formValido = false;
            } else {
                $(data_entregaInput).removeClass('is-invalid').next('.invalid-feedback').text("");

                const data_emprestimo = new Date(document.getElementById('data_emprestimo').value);
                const data_entrega = new Date(data_entregaInput.value);

                if (data_entrega < data_emprestimo) {
                    $(data_entregaInput).addClass('is-invalid').next('.invalid-feedback').text("Data menor que a de empréstimo.");
                    formValido = false;
                } else {
                    $(data_entregaInput).removeClass('is-invalid').next('.invalid-feedback').text("");
                }
            }

            if (!formValido) {
                event.preventDefault();
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

        // Aplica a máscara nos valores vindos do banco de dados
        document.getElementById("isbn").value = formatarISBN(document.getElementById("isbn").value);
    });
</script>

    
</body>

</html>  