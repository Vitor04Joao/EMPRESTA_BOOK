<?php
include 'conexao.php';


if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];

    $sql_leitor = "SELECT id, dataNascimento, tipoLeitor FROM Leitor WHERE nome = '$nome'";
    $busca_leitor = mysqli_query($conec, $sql_leitor);

    if (mysqli_num_rows($busca_leitor) > 0) {
        $row = mysqli_fetch_assoc($busca_leitor);
        $data = array(
            'id' => $row['id'],
            'data_nascimento' => $row['dataNascimento'],
            'tipo_leitor' => $row['tipoLeitor']
        );
        echo json_encode($data); // Retorna os dados em formato JSON
    } else {
        echo json_encode(array()); // Retorna um array vazio se não encontrar o leitor
    }
}
?>

<?php
    session_start();
    $usuario = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
    }

    ?>