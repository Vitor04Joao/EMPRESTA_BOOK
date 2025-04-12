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


    <?php 

session_start();
$usuario = $_SESSION['usuario'];
if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}
include "cabecalho.php";
?>

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

.fa-arrow-left{}


    </style>

</head>

<body>



<div class="container" style="margin-top: 20px" id="container">


   

<a href="menu.php">
    <h2><i class="fa-solid fa-arrow-left"></i></a>Cadastro de Leitor</h2>

   

           <form action="inserir_leitores.php" method="post" id="cadastroForm" style="margin-top: 20px">

                <div class="d-flex" >
    
                   <div class="FgNome">

                        <label>Nome:<span class="required">*</span></label>

                        <input type="Text" class="form-control" id="nome" name="nome" placeholder="Insira o nome.." 
                        oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">

                        <div class="invalid-feedback"></div>
                   </div>


                  <div class="Fg2">
   
                        <label class="cor">Data de Nascimento:<span class="required">*</span></label>
        
                        <input type="date" class="form-control" id="dataNascimento" min="1500-01-01" max="2023-12-31" name="dataNascimento" >
                        <div class="invalid-feedback"></div>
                  </div>

                </div>


                <div class="d-flex" >
       
                         <div class="FgNome">
   
                                <label >E-mail:<span class="required">*</span></label>

                                <input type="text" class="form-control" id="email" name="email" placeholder="Insira um e-mail.." >
                                <div class="invalid-feedback"></div>
                        </div>
   
                        <div class="Fg2">
   
                                <label >Matricula:<span class="required">*</span></label>

                                <input type="text" class="form-control" id="matricula" pattern=".{6}" name="matricula" placeholder="Matricula" maxlength="6" 
                                inputmode="numeric"
        oninput="this.value = this.value.replace(/\D/g, '')">

                                <div class="invalid-feedback"></div>
                        </div> 

                </div>

       
                <div class="d-flex" >
       
                        <div class="FgNome">
   
                                <label >Telefone:<span class="required">*</span></label>

                                <input type="text" class="form-control" id="telefone" name="telefone" pattern=".{15}" maxlength="15" placeholder="(xx) xxxxx-xxxx" 
                                inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')">

                                <div class="invalid-feedback"></div>
                        </div>
   
                        <div class="Fg2">
   
                            <label >Leitor:<span class="required">*</span></label>
                           
                                <select class="form-control" name="tipoLeitor" id="tipoLeitor">
                               
                                    <option value="">Selecione o Leitor</option>
                                   
                                                <option value="Aluno">Aluno</option>
                                                <option value="Professor">Professor</option>

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

          <input type="text" class="form-control"  id="logradouro" name="logradouro" placeholder="Exe: Rua, Avenida, Praça, Loteamento...">
          <div class="invalid-feedback"></div>
         </div>            

 


       <div class="FgID">
       
                   <label>Número:<span class="required">*</span></label>
       
                   <input type="text" class="form-control" id="numero" name="numero" placeholder="Número"  maxlength="4"
                   inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')">

                   <div class="invalid-feedback"></div>
               </div>
       
            
       </div>
       
       
       <div class="d-flex" >
              

       <div class="Fg1">
       
       <label>Bairro:<span class="required">*</span></label>

       <input type="Text" class="form-control" id="bairro" name="bairro" placeholder="Insira o bairro.." 
       oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">


       <div class="invalid-feedback"></div>
   </div>



              <div class="cidade">
          
                       <label >Cidade:<span class="required">*</span></label>
       
                       <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Insira a cidade.." 
                       oninput="this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s]/g, '')">


                       <div class="invalid-feedback"></div>
                      </div>
          
      
       
              
              
              <div class="UF">

<label class="cor">Estado:<span class="required">*</span></label>

<select class="form-control" name="estado" id="estado">
<option value="">UF</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
                <option value="SP">SP</option>
</select>
<div class="invalid-feedback"></div>
</div>
</div>
<br>
              <div style="text-align: right;">

                <a href="menu.php" role="button" class="btn btn-primary btn-lg" style="margin-top: 12px">Voltar ao menu</a>

                <button type="submit" id="botao" class="btn btn-success btn-lg" style="margin-top: 12px">Cadastrar</button>

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

    document.getElementById("telefone").value = formatarTelefone(document.getElementById("telefone").value);
});
    </script>

</body>
</html>