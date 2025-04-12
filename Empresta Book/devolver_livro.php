<?php
session_start();

// Define o fuso horário (opcional)
date_default_timezone_set('America/Sao_Paulo'); 

// Data atual para o campo de empréstimo

$data_atual_devolucao =  date("Y-m-d", strtotime("midnight"));


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

$id_emprestimo = intval($_GET['id']);
$usuario = $_SESSION['usuario'];

// Consulta SQL otimizada para buscar todos os dados necessários
$sql = "
SELECT
    e.id, e.dataEmprestimo, e.dataDevolucao, e.status_livro, e.unidade,
    l.nome AS leitor_nome, l.dataNascimento AS leitor_dataNascimento, l.email AS leitor_email, l.matricula AS leitor_matricula, l.tipoLeitor AS leitor_tipoLeitor,
    lv.titulo AS livro_titulo, lv.isbn AS livro_isbn, lv.quantidade AS livro_quantidade,
    b.nome AS bibliotecario_nome, b.usuario AS bibliotecario_usuario
FROM Emprestimo e
JOIN Leitor l ON e.leitor_emprestimo = l.id
JOIN Livro lv ON e.livro_emprestimo = lv.id
JOIN Bibliotecario b ON e.bibliotecario_emprestimo = b.id
WHERE e.id = ?
";

$stmt = mysqli_prepare($conec, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_emprestimo);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $array = mysqli_fetch_assoc($result);

    // Atribuindo os valores retornados à variáveis
    $id_emprestimo = $array['id'];
    $data_emprestimo = $array['dataEmprestimo'];
    $data_entrega = $array['dataDevolucao'];
    $status_livro = $array['status_livro'];
    $unidade = $array['unidade'];
    $leitor_nome = $array['leitor_nome'];
    $livro_titulo = $array['livro_titulo'];
    $bibliotecario_nome = $array['bibliotecario_nome'];

    // Dados adicionais do leitor
    $dataNascimento_leitor = $array['leitor_dataNascimento'];
    $email_leitor = $array['leitor_email'];
    $matricula_leitor = $array['leitor_matricula'];
    $tipoLeitor = $array['leitor_tipoLeitor']; // Corrigido aqui

    // Dados adicionais do livro
    $isbn_livro = $array['livro_isbn'];
    $quantidade_livro = $array['livro_quantidade'];

    //Dados adicionais do bibliotecario
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


  </style>
</head>

<body>

<?php 


include "cabecalho.php";

if (isset($_SESSION['usuario'])) { 
    $usuario = $_SESSION['usuario'];

    $sql = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario'";
    $busca = mysqli_query($conec, $sql);

    while ($array = mysqli_fetch_array($busca)) {
        $id = $array['id'];
        $nome = $array['nome'];

?>


    <div class="container" style="margin-top: 40px" id="container">
    <a href="listar_emprestimo.php">
    <h2><i class="fa-solid fa-arrow-left"></i></a> Dados do Empréstimo</h2>

    <form name="formulario" action="atualizar_emprestimo.php"  method="post" style="margin-top: 20px">


    <input type="hidden" name="id" value="<?php echo $id_emprestimo; ?>">

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


<div class="igual">

<input type="hidden" class="form-control" name="id_livro" readonly >

 </div>

                 <div class="d-flex">

                 <div class="data">
                    <label>Unidade:</label>
                    <input type="number" class="form-control" id="unidade" name="Unidade" value="<?php echo $unidade ?>" readonly>
                    
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
                    <input type="date" class="form-control" id="data_entrega" name="data_entrega" value="<?php echo $data_entrega ?>" readonly>
                    
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

                <div class="Biblio">
                    <label>Responsável Pelo Empréstimo:</label>
                    <input type="text" class="form-control" id="nome_bibliotecario" name="nome_bibliotecario" value="<?php echo $bibliotecario_nome ?>" placeholder="Responsável Pelo Empréstimo" readonly>
                    
                </div>
                
                <div class="user">
                    <label>Usuario:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario_bibliotecario ?>" placeholder="usuario" readonly>
                    
                </div>


            </div>
         

            <div style="text-align: right;">

<a href="listar_emprestimo.php" role="button" class="btn btn-primary btn-lg" style= "margin-top: 20px">Voltar</a>

<button type="submit" id="botao" class="btn btn-success btn-lg" style="margin-top: 20px" onclick="return confirmarDevolucao();">Confirma Devolução</button>

</div>

        </form>

        <?php  }}?>
    </div>
    
    <script>
        function confirmarDevolucao() {
            return confirm("Tem certeza que deseja registrar a devolução deste livro?");
        }
    </script>

</body>

</html>  