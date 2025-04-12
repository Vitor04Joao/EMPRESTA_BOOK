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
        width: 690px;
        
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
  width: 194px;
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


<div class="container" style="margin-top: 20px" id="container"   >


   

<a href="listar_leitores.php">
<h2><i class="fa-solid fa-arrow-left"></i></a>Dados dos Leitores: </h2>


<form action = "atualizar_leitor.php"  method="post" id="cadastroForm" style="margin-top: 20px">

           <div class="ID">

<input type="hidden" class="form-control" name="id" value = "<?php echo $id_leitor ?>" readonly >

 </div>

                <div class="d-flex" >
    
        

                   <div class="FgNome">

                   <label>Nome:<span class="required">*</span></label>

<input type="Text" class="form-control"  id="nome" name="nome" value = "<?php echo $nome_leitor ?>"
oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">

<div class="invalid-feedback"></div>
                   </div>


                  <div class="Fg2">
   
                  <label class="cor">Data de Nascimento:<span class="required">*</span></label>
        
        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value = "<?php echo $dataNascimento_leitor ?>" >
        <div class="invalid-feedback"></div>
   
                  </div>

                </div>


                <div class="d-flex" >
       
                         <div class="FgNome">
   
                         <label >E-mail:<span class="required">*</span></label>

<input type="text" class="form-control" id="email" name="email" value = "<?php echo $email_leitor ?>" >
<div class="invalid-feedback"></div>

                        </div>
   
                        <div class="Fg2">
   
                        <label >Matricula:<span class="required">*</span></label>

<input type="numeber" class="form-control" id="matricula" pattern=".{6}"  name="matricula"  maxlength="6"  value = "<?php echo $matricula_leitor ?>" 
inputmode="numeric"   oninput="this.value = this.value.replace(/\D/g, '')">


<div class="invalid-feedback"></div>

                        </div> 

                </div>

       
                <div class="d-flex" >
       
                        <div class="FgNome">
   
                        <label >Telefone:<span class="required">*</span></label>

<input type="numeber" class="form-control" id="telefone" pattern=".{15}"  maxlength="15"  name="telefone"  value = "<?php echo $telefone_leitor ?>"
inputmode="numeric"   oninput="this.value = this.value.replace(/\D/g, '')">


<div class="invalid-feedback"></div>

                        </div>
   
                        <div class="Fg2">
   
                        <label>Leitor:<span class="required">*</span></label>
                    <select class="form-control" name="tipoLeitor" id="tipoLeitor">
                    
                        <option value="">Selecione o Leitor</option>
                        
                        <option value="Aluno" <?php if($tipoLeitor=='Aluno') echo 'selected';?>>Aluno</option>
                        <option value="Professor" <?php if($tipoLeitor=='Professor') echo 'selected';?>>Professor</option>
                    </select>
                    <div class="invalid-feedback"></div>
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
          
       <label >Logradouro:<span class="required">*</span></label>
       
       <input type="text" class="form-control" id="logradouro" name="logradouro" value = "<?php echo $logradouro_leitor ?>">
       <div class="invalid-feedback"></div>

         </div>            

 


       <div class="FgID">
       
       <label>Número:<span class="required">*</span></label>
       
       <input type="text" class="form-control" id="numero" name="numero" value = "<?php echo $numero_leitor ?>" 
       inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')" maxlength="4">

       <div class="invalid-feedback"></div>

               </div>
       
            
       </div>
       
       
       <div class="d-flex" >
              

       <div class="Fg1">
       
       <label>Bairro:<span class="required">*</span></label>
      
       
                   <input type="Text" class="form-control"  id="bairro" name="bairro"  value = "<?php echo $bairro_leitor ?>" 
                   oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">

                   <div class="invalid-feedback"></div>
   </div>



              <div class="cidade">
          
              <label >Cidade:<span class="required">*</span></label>
       
       <input type="text" class="form-control" id="cidade" name="cidade" value = "<?php echo $cidade_leitor ?>" 
       oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">
       
       <div class="invalid-feedback"></div>
       
                      </div>
          
      
       
              
              
                      <div class="UF">
    <label class="cor">Estado:<span class="required">*</span></label>
    <select class="form-control" name="estado" id="estado">
    
        <option value="AC" <?php if($estado_leitor=='AC'){echo 'selected';} ?>>AC</option>
        <option value="AL" <?php if($estado_leitor=='AL'){echo 'selected';} ?>>AL</option>
        <option value="AP" <?php if($estado_leitor=='AP'){echo 'selected';} ?>>AP</option>
        <option value="AM" <?php if($estado_leitor=='AM'){echo 'selected';} ?>>AM</option>
        <option value="BA" <?php if($estado_leitor=='BA'){echo 'selected';} ?>>BA</option>
        <option value="CE" <?php if($estado_leitor=='CE'){echo 'selected';} ?>>CE</option>
        <option value="DF" <?php if($estado_leitor=='DF'){echo 'selected';} ?>>DF</option>
        <option value="ES" <?php if($estado_leitor=='ES'){echo 'selected';} ?>>ES</option>
        <option value="GO" <?php if($estado_leitor=='GO'){echo 'selected';} ?>>GO</option>
        <option value="MA" <?php if($estado_leitor=='MA'){echo 'selected';} ?>>MA</option>
        <option value="MT" <?php if($estado_leitor=='MT'){echo 'selected';} ?>>MT</option>
        <option value="MS" <?php if($estado_leitor=='MS'){echo 'selected';} ?>>MS</option>
        <option value="MG" <?php if($estado_leitor=='MG'){echo 'selected';} ?>>MG</option>
        <option value="PA" <?php if($estado_leitor=='PA'){echo 'selected';} ?>>PA</option>
        <option value="PB" <?php if($estado_leitor=='PB'){echo 'selected';} ?>>PB</option>
        <option value="PR" <?php if($estado_leitor=='PR'){echo 'selected';} ?>>PR</option>
        <option value="PE" <?php if($estado_leitor=='PE'){echo 'selected';} ?>>PE</option>
        <option value="PI" <?php if($estado_leitor=='PI'){echo 'selected';} ?>>PI</option>
        <option value="RJ" <?php if($estado_leitor=='RJ'){echo 'selected';} ?>>RJ</option>
        <option value="RN" <?php if($estado_leitor=='RN'){echo 'selected';} ?>>RN</option>
        <option value="RS" <?php if($estado_leitor=='RS'){echo 'selected';} ?>>RS</option>
        <option value="RO" <?php if($estado_leitor=='RO'){echo 'selected';} ?>>RO</option>
        <option value="RR" <?php if($estado_leitor=='RR'){echo 'selected';} ?>>RR</option>
        <option value="SP" <?php if($estado_leitor=='SP'){echo 'selected';} ?>>SP</option>
        <option value="SC" <?php if($estado_leitor=='SC'){echo 'selected';} ?>>SC</option>
        <option value="SE" <?php if($estado_leitor=='SE'){echo 'selected';} ?>>SE</option>
        <option value="TO" <?php if($estado_leitor=='TO'){echo 'selected';} ?>>TO</option>
    </select>
    <div class="invalid-feedback"></div>
</div>
</div>
<br>
              <div style="text-align: right;">

              <a href="listar_leitores.php" role="button" class="btn btn-primary btn-lg">Voltar </a>
        
                <button type="submit" id="botao" class="btn btn-warning btn-lg">Atualizar</button>

            </div>
      </div>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
        const form = document.getElementById('cadastroForm');

        form.addEventListener('submit', function (event) {

// Validação de dos imputs

            function validarCampo(input) {
                if (input.value.trim() === "") {
                    input.classList.add('is-invalid');
                    input.nextElementSibling.textContent = "Este campo é obrigatório!!";
                    event.preventDefault();
                    return false;
                } else {
                    input.classList.remove('is-invalid');
                    input.nextElementSibling.textContent = "";
                    return true;
                }
            }


            const nomeInput = document.getElementById('nome');
            validarCampo(nomeInput);

            const dataNascimentoInput = document.getElementById('dataNascimento');
            validarCampo(dataNascimentoInput);

            const telefoneInput = document.getElementById('telefone');
            validarCampo(telefoneInput);

            const matriculaInput = document.getElementById('matricula');
            validarCampo(matriculaInput);

            const tipoLeitorInput = document.getElementById('tipoLeitor');
            validarCampo(tipoLeitorInput);

            const logradouroInput = document.getElementById('logradouro');
            validarCampo(logradouroInput);

            const numeroInput = document.getElementById('numero');
            validarCampo(numeroInput);

            const bairroInput = document.getElementById('bairro');
            validarCampo(bairroInput);

            const cidadeInput = document.getElementById('cidade');
            validarCampo(cidadeInput);

            const estadoInput = document.getElementById('estado');
            validarCampo(estadoInput);
      

            // Validação de email
            const emailInput = document.getElementById('email');
            const email = emailInput.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                event.preventDefault();
                emailInput.classList.add('is-invalid');
                emailInput.nextElementSibling.textContent = "Por favor, insira um endereço de email válido.";
            } else {
                emailInput.classList.remove('is-invalid');
                emailInput.nextElementSibling.textContent = "";
            }

        
        });

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