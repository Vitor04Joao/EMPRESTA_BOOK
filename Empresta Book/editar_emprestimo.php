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


// Consulta SQL otimizada para buscar todos os dados necessários
$sql = "
SELECT
    e.id, e.dataEmprestimo, e.dataDevolucao, e.data_atual_devolucao, e.status_livro, e.unidade,
    l.nome AS leitor_nome, l.dataNascimento AS leitor_dataNascimento, l.email AS leitor_email, l.matricula AS leitor_matricula, l.tipoLeitor AS leitor_tipoLeitor,
    lv.id AS livro_id, lv.titulo AS livro_titulo, lv.isbn AS livro_isbn, lv.quantidade AS livro_quantidade,
    b.nome AS bibliotecario_nome, b.usuario AS bibliotecario_usuario
FROM Emprestimo e
JOIN Leitor l ON e.leitor_emprestimo = l.id
JOIN Livro lv ON e.livro_emprestimo = lv.id
JOIN Bibliotecario b ON e.bibliotecario_emprestimo = b.id
WHERE e.id = ?
";

$usuario = $_SESSION['usuario'];

$stmt = mysqli_prepare($conec, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $array = mysqli_fetch_assoc($result);

    // Atribuindo os valores retornados à variáveis
    $id_emprestimo = $array['id'];
    $id_livro = $array['livro_id'];  // Aqui você estava com erro, agora está correto
    $data_emprestimo = $array['dataEmprestimo'];
    $data_entrega = $array['dataDevolucao'];
    $data_atual_devolucao = $array['data_atual_devolucao'];
    $status_livro = $array['status_livro'];
    $unidade = $array['unidade'];
    $leitor_nome = $array['leitor_nome'];
    $livro_titulo = $array['livro_titulo'];
    $bibliotecario_nome = $array['bibliotecario_nome'];

    // Dados do leitor
    $dataNascimento_leitor = $array['leitor_dataNascimento'];
    $email_leitor = $array['leitor_email'];
    $matricula_leitor = $array['leitor_matricula'];
    $tipoLeitor = $array['leitor_tipoLeitor'];

    // Dados do livro
    $isbn_livro = $array['livro_isbn'];
    $quantidade_livro = $array['livro_quantidade'];

    // Dados do bibliotecário
    $usuario_bibliotecario = $array['bibliotecario_usuario'];

} else {
    echo "<div class='alert alert-danger' role='alert'>Empréstimo não encontrado!</div>";
    exit();
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


.data{
  display: flex;
  flex-direction: column;
  align-items: right;
 
  width: 210px;
  
}

.nasc{
    display: flex;
  flex-direction: column;
  align-items: right;
  width: 210px;
  line-height: 12px;

}

.igual{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 210px;
  line-height: 20px;
}

.user{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 210px;

}

.grande{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 515px;
  line-height: 12px;
}

.Biblio{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 515px;
  
}


.titulo{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 515px;
 
}


.ISBN{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 210px;
  
}


.Id{
    display: flex;
  flex-direction: column;
  align-items: right;
  width: 165px;

}




.btn-container {
            text-align: right;
            position: fixed;
            bottom: 20px;
            right: 26%;
            width: 100%;
        }

        .Alert {
        
        width: 740px; 
        text-align: justify; 
        font-size: 14px; 
        color: gray; 
        margin-top: 10px;
        font-family:Georgia, serif; }

  </style>
</head>

<body>

<?php 


include "cabecalho.php";
?>

<div class="container" style="margin-top: 20px" id="container">
    <a href="listar_emprestimo.php">
        <h2><i class="fa-solid fa-arrow-left"></i></a>Dados do Empréstimo</h2>
    
    <form action="atualizar_EdcaoEmprest.php" method="POST" id="cadastroForm" style="margin-top: 20px">
        
            
    <input type="hidden" id ="id" name="id" value = "<?php echo $id_emprestimo ?>">

        <div class="d-flex">
      
      <div class="grande">

<label>Leitor:</label>

<input type="Text" class="form-control" name="nome" id="nome_leito" value = "<?php echo $leitor_nome ?>" readonly>

</div>
            

            <div class="nasc">


<label class="cor">Data de Nascimento:</label>
        
        <input type="date" class="form-control" name="dataNascimento" value = "<?php echo $dataNascimento_leitor ?>" readonly >


        </div>


        </div>

        <!-- Dados do Leitor -->

        <div class="d-flex">
        <div class="igual">
                <label >E-mail:</label>

<input type="text" class="form-control" name="email" placeholder="......"  value = "<?php echo $email_leitor ?>" readonly>

                    
                </div>
                <div class="igual">
                <label >Matricula:</label>

<input type="numeber" class="form-control" name="matricula" placeholder="......"  value = "<?php echo $matricula_leitor ?>" readonly>

                    
                </div>
                <div class="igual">
                <label >Descrição:</label>

                                    
<input type="text" class="form-control" name="tipoLeitor" placeholder="......"  value = "<?php echo $tipoLeitor ?>"readonly>
                    
                </div>
        </div>

<br>

        <div class="d-flex">


        <div class="titulo">

<label>Título:</label>
<input type="text" class="form-control" id="nomeLivro" name="titulo" value = "<?php echo $livro_titulo ?>" placeholder="Título do livro" readonly>

</div>


<div class="ISBN">
                <label>ISBN do Livro:</label>
            <div class="input-group">
                <input type="text" class="form-control" id="isbn" name="isbn" pattern=".{13}" maxlength="13" placeholder="xxx-xx-xxx-xxxx-x"
                inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')" value="<?php echo $isbn_livro ?>" readonly>
                         
                </div>
                </div>

   
</div>

<input type="hidden" id="id_livro" name="id_livro" value="<?php echo $id_livro ?>">


       <div class="d-flex">

                 <div class="data">
                    <label>Unidade:</label>
                    <input type="number" class="form-control" id="unidade" name="unidade" min="1" value="<?php echo $unidade ?>" readonly>
                    
                </div>

                <div class="data">
                    <label>Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="N°" value="<?php echo $quantidade_livro ?>" min="0" readonly>
                    
                </div>

                <div class="data">
                    <label>Data do Empréstimo:</label>
                    <input type="date" class="form-control" id="data_emprestimo" name="data_emprestimo" value="<?php echo $data_emprestimo ?>" readonly>
                    
                </div>

            </div>


       <div class="d-flex">
                
                <div class="data">
                    <label>Data da Entrega Prevista:</label>
                    <input type="date" class="form-control" id="data_entrega" name="data_entrega" value="<?php echo $data_entrega ?>" >
                    
                </div>
                <div class="data">
                    <label>Status do Livro:</label>
                    <input type="text" class="form-control" id="status_livro" name="status_livro" value="<?php echo $status_livro ?>" readonly>
                    
                </div>

                <div class="data">
                    <label>Data da Devolução:</label>
                    <input type="date" class="form-control" id="data_atual_devolucao" name="data_atual_devolucao" value="<?php echo $data_atual_devolucao ?>"   readonly>
                    
                </div>


            </div>
            <br>
   
  
        <div class="d-flex">

<div class="grande">
    <label>Responsável pelo Empréstimo:</label>
    <input type="text" class="form-control" id="nome_bibliotecario" name="nome_bibliotecario" value="<?php echo $bibliotecario_nome ?>" placeholder="Nome" readonly>
    
</div>

<div class="nasc">
    <label>Usuario:</label>
    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario_bibliotecario ?>" placeholder="usuario" readonly>
    
</div>

</div>


<div class="Alert">
    <p><strong>Alert:</strong> Somente a data de entrega pode ser alterada. O usuário deve garantir 
    que as informações fornecidas estejam corretas.</p>

</div>
       <div class="btn-container">

                <a href="listar_emprestimo.php" role="button" class="btn btn-primary btn-lg">Voltar </a>
                <button type="submit" id="botao" class="btn btn-warning btn-lg">Atualizar</button>

            </div>

    
 
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
$(document).ready(function() {
    $('#cadastroForm').submit(function(event) {
        let formValido = true;

        function validarCampo(selector, mensagem) {
            let campo = $(selector);
            if (campo.val().trim() === "") {
                campo.addClass('is-invalid');
                if (campo.next('.invalid-feedback').length === 0) {
                    campo.after('<div class="invalid-feedback">' + mensagem + '</div>');
                }
                formValido = false;
            } else {
                campo.removeClass('is-invalid');
                campo.next('.invalid-feedback').remove();
            }
        }

        validarCampo('#unidade', 'A unidade é obrigatória!');
        validarCampo('#data_entrega', 'A data de entrega é obrigatória!');

        let unidade = parseInt($('#unidade').val());
        let quantidade = parseInt($('#quantidade').val());
        let dataEmprestimo = new Date($('#data_emprestimo').val());
        let dataEntrega = new Date($('#data_entrega').val());

       
    });

    // Formatação do ISBN
    function formatarISBN(isbn) {
        isbn = isbn.replace(/\D/g, "");
        isbn = isbn.replace(/^(\d{3})(\d)/, "$1-$2");
        isbn = isbn.replace(/-(\d{2})(\d)/, "-$1-$2");
        isbn = isbn.replace(/-(\d{3})(\d)/, "-$1-$2");
        isbn = isbn.replace(/-(\d{4})(\d)$/, "-$1-$2");
        return isbn;
    }

    $('#isbn').on('input', function() {
        $(this).val(formatarISBN($(this).val()));
    });

    $('#isbn').val(formatarISBN($('#isbn').val()));
});
</script>



    
</body>

</html>  