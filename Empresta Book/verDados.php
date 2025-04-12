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

$id_leitor = intval($_GET['id']); 
$usuario = $_SESSION['usuario']; 

// Consulta SQL para buscar o Leitor

    $sql = "SELECT * FROM Leitor WHERE id = $id_leitor";
    $buscar = mysqli_query($conec, $sql);

    if (mysqli_num_rows($buscar) > 0) {
        $array = mysqli_fetch_array($buscar);

        $id_leitor = $array['id'];
        $nome_leitor = $array['nome'];
        $dataNascimento_leitor = $array['dataNascimento'];
        $email_leitor = $array['email'];
        $matricula_leitor = $array['matricula'];
        $telefone_leitor = $array['telefone'];
        $tipoLeitor = $array['tipoLeitor'];
        $numero_leitor = $array['numero'];
        $bairro_leitor = $array['bairro'];
        $cidade_leitor= $array['cidade'];
        $estado_leitor = $array['estado'];
        $logradouro_leitor = $array['logradouro'];

    } else {
        echo "<div class='alert alert-danger' role='alert'>Leitor não encontrado!</div>";
        exit();
    }


    ?>

<!DOCTYPE html>
<html lang="pt-bt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"> 




    <style>



#container {
        width: 680px;
    }


.d-flex{
    justify-content: space-between;
    
}

.FgID{
 
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 176px;
  
}

.ID{
 
 display: flex;
 flex-direction: column;
 align-items: left;
 width: 56px;
 
}



.FgNome{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 435px;
}

.logra{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 455px;
}


.Fg1{
  display: flex;
  flex-direction: column;
  align-items: left;
  width: 322px;
}

.Fg2{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 188px;
}

.UF{ 
   display: flex;
  flex-direction: column;
  align-items: right;
  width: 97px;
}


.cidade{
  display: flex;
  flex-direction: column;
  align-items: right;
  width: 199px;
}



.btn-primary, .btn-success{

font-size: 20px;

 }



    </style>



</head>

<body>
<?php 


include "cabecalho.php";
?>


<div class="container" style="margin-top: 20px" id="container">


   

<a href="listar_leitores.php">
            <h2><i class="fa-solid fa-arrow-left"></i></a>Dados dos Leitores:</h2>

   

           <form action="inserir_leitores.php" method="post" style="margin-top: 20px">

           <div class="ID">

<input type="hidden" class="form-control" name="id" value = "<?php echo $id_leitor ?>" readonly >

 </div>

                <div class="d-flex" >
    
        

                   <div class="FgNome">

                        <label>Nome:</label>

                        <input type="Text" class="form-control" name="nome" placeholder="......" value = "<?php echo $nome_leitor ?>" readonly>

                   </div>


                  <div class="Fg2">
   
                        <label class="cor">Data de Nascimento:</label>
        
                        <input type="date" class="form-control" name="dataNascimento" value = "<?php echo $dataNascimento_leitor ?>" readonly >
   
                  </div>

                </div>


                <div class="d-flex" >
       
                         <div class="FgNome">
   
                                <label >E-mail:</label>

                                <input type="text" class="form-control" name="email" placeholder="......"  value = "<?php echo $email_leitor ?>" readonly>

                        </div>
   
                        <div class="Fg2">
   
                                <label >Matricula:</label>

                                <input type="numeber" class="form-control" name="matricula" placeholder="......"  value = "<?php echo $matricula_leitor ?>" readonly>

                        </div> 

                </div>

       
                <div class="d-flex" >
       
                        <div class="FgNome">
   
                                <label >Telefone:</label>

                                <input type="numeber" class="form-control" id= "telefone" name="telefone" pattern=".{15}"  maxlength="15" placeholder="......"  value = "<?php echo $telefone_leitor ?>" 
                                inputmode="numeric"   oninput="this.value = this.value.replace(/\D/g, '')" readonly>

                        </div>
   
                        <div class="Fg2">
   
                            <label >Leitor:</label>

                                    
                                <input type="text" class="form-control" name="tipoLeitor" placeholder="......"  value = "<?php echo $tipoLeitor ?>"readonly>
                              
                        </div> 
                     </div>
                 <div>
             <div>
             <div>
                 </div>
                    </div>
    </div>

<br>

       <h4> Endereço: </h4>

       <div class="d-flex" >
       

       <div class="logra">
          
          <label >Logradouro:</label>

          <input type="text" class="form-control" name="logradouro" placeholder="......"  value = "<?php echo $logradouro_leitor ?>"readonly>

         </div>            

 


       <div class="FgID">
       
                   <label>Número:</label>
       
                   <input type="numeber" class="form-control" name="numero" placeholder="......"  value = "<?php echo $numero_leitor?>" readonly>
       
               </div>
       
            
       </div>
       
       
       <div class="d-flex" >
              

       <div class="Fg1">
       
       <label>Bairro:</label>

       <input type="Text" class="form-control" name="bairro" placeholder="......"  value = "<?php echo $bairro_leitor ?>" readonly>

   </div>



              <div class="cidade">
          
                       <label >Cidade:</label>
       
                       <input type="text" class="form-control" name="cidade" placeholder="......"  value = "<?php echo $cidade_leitor ?>" readonly>
       
                      </div>
          
      
       
              
              
              <div class="UF">

<label class="cor">Estado:</label>
<input type="text" class="form-control" name="estado" placeholder="......"  value = "<?php echo $estado_leitor ?>" readonly>
</div>
</div>
<br>
              <div style="text-align: right;">

                <a href="listar_leitores.php" role="button" class="btn btn-primary btn-lg" style="margin-top: 12px">Voltar</a>

            </div>
      </div>
        </form>
    </div>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    

    function formatarTelefone(telefone) {
        telefone = telefone.replace(/\D/g, ""); 
        telefone = telefone.replace(/^(\d{2})(\d)/, "($1) $2");
        telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");
        return telefone;
    }


    document.getElementById("telefone").addEventListener("input", function (e) {
        e.target.value = formatarTelefone(e.target.value);
    });

    // Aplica a máscara nos valores vindos do banco de dados
   
    document.getElementById("telefone").value = formatarTelefone(document.getElementById("telefone").value);
});

</script>

</body>
</html>