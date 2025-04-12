<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-ChzD5StK818ZgZivd+c9Bov0I8LlyrOoymakY0+jNH7/qd0wdfyE6121xw693%" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css"> </head>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   

</head>

<style>


.direita{

  margin-right: 30px;
}


.menu-item {
    list-style: none;
    position: relative;
    margin-top: 12px;
    margin-right: 30px;
   
}

.menu-item > a {
    
    text-decoration: none;
    font-size: 15px;
    padding: 5px;
    display: inline-block;
}

.menu-item-has-children > .sub-menu {
    display: none;
    position: absolute;
    background-color:  #1C1C1C;
    padding: 10px;
    list-style: none;
    margin: 3;
    top: 100%;
    left: 0;
    border-radius: 5px;
    z-index: 1000;
    
}

.menu-item-has-children:hover > .sub-menu {
    display: block;
    
}

.sub-menu .menu-item > a {
    color: white;
    padding: 8px 12px;
    display: block;
    font-size: 14px;
}

.sub-menu .menu-item > a:hover {
    background-color: rgb(0, 128, 255);
    color: white;
    text-decoration: none;
}

header{
background-color: #1C1C1C;

}

</style>
<?php
include 'conexao.php';

// Verifique se a sessão foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



if (isset($_SESSION['usuario'])) { // Verifique se o usuário está logado
    $usuario = $_SESSION['usuario'];

    $sql = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario'";
    $busca = mysqli_query($conec, $sql);

    while ($array = mysqli_fetch_array($busca)) {
        $id = $array['id'];
        $nome = $array['nome'];
        ?>
<body>

<header class="p-3 text-white d-flex justify-content-between align-items-center"> 

  <div>
 <a href="menu.php" >

    <img src="IMG/logo1.png" alt="logo" width="400px"> <a>

  </div>

  <div class= "direita">

     <ul class="nav col-12 col-lg-auto">

 
    

      <li class="menu-item menu-item-has-children">

      <p style="font-size: 20px;"><?php echo "Olá, " . ucwords(htmlspecialchars($nome)) . "!"; ?></p></a>

      <ul class="sub-menu">

        <li class="menu-item">
          <a href="usuario.php" ><i class="fas fa fa-user"></i>&nbsp; Perfil</a>

        </li>     

        <li class="menu-item">
        <a href="sair.php" > <i class=" fas fa-sign-out-alt"></i>&nbsp; Sair</a>

        
        </li>


      </ul>
    </li>

      
     
      
     <?php
    } 
    
} else {
    
    header('Location: login.php');
    
}
?>
  </div>
</header>
</body>
</html>