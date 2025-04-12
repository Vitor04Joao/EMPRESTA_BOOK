<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include 'conexao.php';

$usuario = $_SESSION['usuario'];

// Consulta SQL para buscar o livro

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = mysqli_real_escape_string($conec, $_GET['id']);

    $sql = "SELECT * FROM Livro WHERE id = $id";
    $buscar = mysqli_query($conec, $sql);

    if (mysqli_num_rows($buscar) > 0) {
        $array = mysqli_fetch_array($buscar);

        $id_livro = $array['id'];
    
        $titulo = $array['titulo'];
        $quantidade = $array['quantidade'];

    } else {
        echo "<div class='alert alert-danger' role='alert'>Livro não encontrado!</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger' role='alert'>ID do livro não especificado!</div>";
    exit();
}

date_default_timezone_set('America/Sao_Paulo');
$data_emprestimo = date("Y-m-d", strtotime("midnight"));

// Consulta  dados do bibliotecário

$sql_bibliotecario = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario'";
$busca_bibliotecario = mysqli_query($conec, $sql_bibliotecario);

if (mysqli_num_rows($busca_bibliotecario) > 0) {
    $array_bibliotecario = mysqli_fetch_array($busca_bibliotecario);
    $nome_bibliotecario = $array_bibliotecario['nome'];
    $id_bibliotecario = $array_bibliotecario['id'];

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

.dadosLeitor{
  display: flex;
  flex-direction: column;
  margin-right: 250px;
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
  margin-top:45px;
  margin-right:168px;
  flex-direction: column;
  align-items: left;
 width: 40px;
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
  </style>
</head>

<body>

<?php 


include "cabecalho.php";
?>


    <div class="container" style="margin-top: 20px" id="container">
    <a href="listar_livros.php">
    <h2><i class="fa-solid fa-arrow-left"></i></a>Registro de Empréstimo</h2>

        <form action="inserir_emprestimo.php"method="post" id="cadastroForm" style="margin-top: 20px">



        <div class="d-flex">
        <div class="grande">

<label>Leitor:<span class="required">*</span></label>

<select class="form-control" id="nome" name="nome" >

<option value="" disabled selected>Selecione  opção</option>


<?php

include 'conexao.php';

$sql = "SELECT * FROM Leitor order by nome ASC";
$buscar = mysqli_query($conec,$sql);

while ($array = mysqli_fetch_array($buscar)) {

$id = $array ['id'];
$nome = $array['nome'];

?>        

<option><?php echo $nome ?> </option>

<?php   } ?>


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

<br>

            <div class="d-flex">
             
               
                 <input type="hidden" class="form-control" id="id_livro" name="id_livro" value="<?php echo $id_livro?>" readonly>
           

                 </div>

                 <div class="d-flex">

                 <div class="qtdd">
                    <label>Unidade:</label>
                    <input type="number" class="form-control" id="unidade"  name="unidade" value="1" min="1" max="2" >
                    <div class="invalid-feedback"></div>
                </div>

                <div class="grande">
                    <label>Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo ?>" placeholder="Título do livro" readonly>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="qtdd">
                    <label>Quantidade:</label>
                    <input type="number" class="form-control"id="quantidade"  name="quantidade" value="<?php echo $quantidade ?>" min="0" readonly>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <br>

            <div class="d-flex">
                <div class="igual">
                    <label>Data do Empréstimo:</label>
                    <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" value="<?php echo $data_emprestimo ?>" readonly>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="igual">
                    <label>Data da Entrega Prevista:</label>
                    <input type="date" class="form-control" id="data_entrega"  min="2024-01-01" max="2030-01-01"  name="data_entrega" min="">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="igual">
                    <label>Status do Livro:</label>
                    <input type="text" class="form-control" id="status_livro" name="status_livro" value="Emprestado" readonly>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <br>

            <div class="d-flex">

            <div class="ID">

<input type="hidden" class="form-control" name="id_bibliotecario" value = "<?php echo $id_bibliotecario ?>" readonly >

 </div>


                <div class="nome">
                    <label>Responsável pelo:</label>
                    <input type="text" class="form-control"  id="nome_bibliotecario" name="nome_bibliotecario" value="<?php echo $nome_bibliotecario ?>" placeholder="Nome" readonly>
                    <div class="invalid-feedback"></div>
                </div>
                
                <div class="nome">
                    <label>Usuario:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario ?>" placeholder="usuario" readonly>
                    <div class="invalid-feedback"></div>
                </div>


            </div>
         

            <div style="text-align: right;">

<a href="listar_livros.php" role="button" class="btn btn-primary btn-lg" style= "margin-top: 20px">Voltar</a>

<button type="submit" id="botao" class="btn btn-success btn-lg" style= "margin-top: 20px">Cadastrar</button>

</div>

        </form>
    </div>

    
 
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

    <script>
       $(document).ready(function() {
    $('select[name="nome"]').change(function() {
        var nomeLeitor = $(this).val();

        if (nomeLeitor) {
            $.ajax({
                url: 'buscar_dados_leitor.php',
                type: 'POST',
                data: { nome: nomeLeitor },
                dataType: 'json',
                success: function(data) {
                    if (data.data_nascimento) { // Correção aqui
                        $('input[name="id"]').val(data.id);
                        $('input[name="data_nascimento"]').val(data.data_nascimento);
                        $('input[name="tipo_leitor"]').val(data.tipo_leitor);
                    } else {
                        alert('Dados do leitor não encontrados.');
                        $('input[name="id"]').val('');
                        $('input[name="data_nascimento"]').val('');
                        $('input[name="tipo_leitor"]').val('');
                    }
                },
                error: function() {
                    alert('Erro na requisição.');
                }
            });
        } else {
            $('input[name="id"]').val('');
            $('input[name="data_nascimento"]').val('');
            $('input[name="tipo_leitor"]').val('');
        }
    });
});
        
// Validação dos inputs
const form = document.getElementById('cadastroForm');

form.addEventListener('submit', function (event) {

    // Função para validar campos
    function validarCampo(input) {
        if (input.value.trim() === "") {
            input.classList.add('is-invalid');
            input.nextElementSibling.textContent = "Este campo é obrigatório!";
            return false;
        } else {
            input.classList.remove('is-invalid');
            input.nextElementSibling.textContent = "";
            return true;
        }
    }

    // Validação dos campos obrigatórios
    let valido = true;

    const nomeInput = document.getElementById('nome');
    if (!validarCampo(nomeInput)) valido = false;

    const data_nascimentoInput = document.getElementById('data_nascimento');
    if (!validarCampo(data_nascimentoInput)) valido = false;

    const tipo_leitorInput = document.getElementById('tipo_leitor');
    if (!validarCampo(tipo_leitorInput)) valido = false;

    const nomeLivroInput = document.getElementById('titulo');
    if (!validarCampo(nomeLivroInput)) valido = false;

    const quantidadeInput = document.getElementById('quantidade');
    if (!validarCampo(quantidadeInput)) valido = false;

    const data_emprestimoInput = document.getElementById('data_emprestimo');
    if (!validarCampo(data_emprestimoInput)) valido = false;

    // Verificação para a data de entrega
    const data_entregaInput = document.getElementById('data_entrega');
    if (data_entregaInput.value.trim() === "") {
        data_entregaInput.classList.add('is-invalid');
        data_entregaInput.nextElementSibling.textContent = "A data não pode estar vazia!";
        valido = false;
    } else {
        data_entregaInput.classList.remove('is-invalid');
        data_entregaInput.nextElementSibling.textContent = "";

        // Validação da data de emprestimo e data de entrega
        const data_emprestimo = new Date(data_emprestimoInput.value);
        const data_entrega = new Date(data_entregaInput.value);

        if (data_entrega < data_emprestimo) {
            data_entregaInput.classList.add('is-invalid');
            data_entregaInput.nextElementSibling.textContent = "Não pode ser antes da data atual!!";
            valido = false;
        } else {
            data_entregaInput.classList.remove('is-invalid');
            data_entregaInput.nextElementSibling.textContent = "";
        }
    }

    // Validação dos campos do usuário
    const status_livroInput = document.getElementById('status_livro');
    if (!validarCampo(status_livroInput)) valido = false;

    const nome_bibliotecarioInput = document.getElementById('nome_bibliotecario');
    if (!validarCampo(nome_bibliotecarioInput)) valido = false;

    const usuarioInput = document.getElementById('usuario');
    if (!validarCampo(usuarioInput)) valido = false;

    if (!valido) {
        event.preventDefault();
    }
});
    </script>

    
</body>

</html>  