<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresta Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>



        .IMG {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #container {
            width: 770px;
            border-radius: 15px;
            margin-top: 20px;
            padding: 20px; 
          
        }

    


.d-flex{
    justify-content: space-between;
    
}
       

        .btn-container {
            display: flex;
            justify-content: flex-end;
           
        }

        .btn {
        
            margin-top: 28px;
        }

        .meus-dados-titulo {
            display: flex;
            align-items: center;
        }

        .meus-dados-titulo h2 {
            margin-left: 10px;
        }

        .editar-link {
            margin-left: auto;
        }

        


            .FgNome{
            display: flex;
            flex-direction: column;
            width: 485px;
          
            }

            .data{
            display: flex;
            flex-direction: column;
            margin-left: 15px;
            width: 234px;
          
            }

            .igual{
            display: flex;
            flex-direction: column;
            width: 234px;
          
            }

            .Fg2{
            display: flex;
            flex-direction: column;
            width: 365px;
          
          
            }

            .Fg3{
            display: flex;
            flex-direction: column;
            width: 365px;
          
            margin-left: 10px;
          
            }
            .senha{
            display: flex;
            flex-direction: column;
            width: 365px;
            line-height: 30px;
                      
            }

            .NVsenha{
            display: flex;
            flex-direction: column;
            width: 365px;
            line-height: 30px;
            margin-left: 10px;
            }

    </style>
</head>

<body>
    <?php
    session_start();
    $usuario = $_SESSION['usuario'];

    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
    }

    include 'cabecalho.php';
    ?>

    <div class="container" id="container">
        <?php
        include 'conexao.php';
        $sql = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario'";
        $busca = mysqli_query($conec, $sql);

        while ($array = mysqli_fetch_array($busca)) {
            $id = $array['id'];
            $nome = $array['nome'];
            $email = $array['email'];
            $telefone = $array['telefone'];
            $dataNascimento = $array['dataNascimento'];
            $cpf = $array['cpf'];
            $nivel = $array['nivel'];
            ?>

            <div class="IMG meus-dados-titulo">
                <a href="menu.php"><i class="fa-solid fa-arrow-left"></i></a>
                <h2>Meu Perfil</h2>
                <a class="editar-link" href="editar_usuario.php?id=<?php echo $id ?>"><img src="IMG/editar.png" alt="Edit" width="35px"></a>
            </div>

            <form method="post" method="post" style="margin-top: 18px">

            
            <div class="form-row">
                    <div class="FgNome">

                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome ?>" readonly>

                    </div>

                    <div class="data">
                        <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value="<?php echo $dataNascimento ?>" readonly>
                    </div>

                </div>


                <div class="d-flex" >
              

              <div class="igual">
              
              <label for="cpf" class="form-label">CPF:</label>
              <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cpf ?>" readonly>
       
          </div>
       
       
       
                     <div class="igual">
                 
                     <label for="telefone" class="form-label">Telefone:</label>
                     <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $telefone ?>" readonly>
              
                             </div>
                 
             
              
                     
                     
                     <div class="igual">
       
                     <label for="email" class="form-label">E-mail:</label>
                     <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>" readonly>
       </div>
       </div>

            

                <div class="form-row">
                   

                    <div class="Fg2">
                        <label for="usuario" class="form-label">Usuário:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario ?>" readonly>
                    </div>

                    <div class="Fg3">
                        <label for="nivel" class="form-label">Função:</label>
                        <input type="text" class="form-control" id="nivel" name="nivel" value="<?php
                                if ($nivel == 1) {
                                    echo "Bibliotecário";
                                } elseif ($nivel == 2) {
                                    echo "Recepcionista";
                                }
                                ?>" readonly>
                    </div>

                </div>
<br>
                <h4> Minha Senha </h4>

                <div class="form-row">
                    <div class="senha">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="********" readonly>
                        <div class="invalid-feedback"></div>
                    </div>
                   
                </div>
                <div class="form-row">
                    <div class="senha">
                        <label for="CSenha" class="form-label">Confirmar senha:</label>
                        <input type="password" class="form-control" id="CSenha" name="CSenha" placeholder="********" readonly>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="NVsenha">
                        <label for="Nvsenha" class="form-label">Nova Senha:</label>
                        <input type="password" class="form-control" id="Nvsenha" name="Nvsenha" placeholder="********" readonly>
                        <div class="invalid-feedback"></div>
                    </div>

                </div>

           

            <?php } ?>

                <div class="btn-container">
                    <a href="menu.php" role="button" class="btn btn-primary btn-lg">Voltar ao menu</a>
                </div>
            </form>
    </div>


<script>


document.addEventListener("DOMContentLoaded", function () {
    
    function formatarCPF(cpf) {
        cpf = cpf.replace(/\D/g, ""); // Remove tudo que não for número
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        return cpf;
    }

    function formatarTelefone(telefone) {
        telefone = telefone.replace(/\D/g, ""); 
        telefone = telefone.replace(/^(\d{2})(\d)/, "($1) $2");
        telefone = telefone.replace(/(\d{5})(\d)/, "$1-$2");
        return telefone;
    }

    document.getElementById("cpf").addEventListener("input", function (e) {
        e.target.value = formatarCPF(e.target.value);
    });

    document.getElementById("telefone").addEventListener("input", function (e) {
        e.target.value = formatarTelefone(e.target.value);
    });

    // Aplica a máscara nos valores vindos do banco de dados
    document.getElementById("cpf").value = formatarCPF(document.getElementById("cpf").value);
    document.getElementById("telefone").value = formatarTelefone(document.getElementById("telefone").value);
});


</script>
    
</body>

</html>