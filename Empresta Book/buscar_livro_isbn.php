<?php
    session_start();
    $usuario = $_SESSION['usuario'];

    if(!isset($_SESSION['usuario'])){
        header('Location: login.php');
    }

    ?>

<?php
include 'conexao.php';

if (isset($_POST['isbn'])) {
    $isbn = mysqli_real_escape_string($conec, $_POST['isbn']);

    $sql = "SELECT id, titulo, quantidade FROM Livro WHERE isbn = '$isbn'";
    $busca = mysqli_query($conec, $sql);

    if (mysqli_num_rows($busca) > 0) {
        $row = mysqli_fetch_assoc($busca);
        echo json_encode([
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'quantidade' => $row['quantidade']
        ]);
    } else {
        echo json_encode([]);
    }
}
?>
