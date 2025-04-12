<?php
session_start();
include 'conexao.php';

if (isset($_POST['senhaAtual'])) {
    $usuario = $_SESSION['usuario'];
    $senhaAtual = md5($_POST['senhaAtual']); // Criptografando a senha para comparar com o banco
    
    // Verificar a senha no banco de dados
    $sql = "SELECT * FROM Bibliotecario WHERE usuario = '$usuario' AND senha = '$senhaAtual'";
    $result = mysqli_query($conec, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Senha correta, habilita os campos para alterar a senha
        echo json_encode(['status' => 'success']);
    } else {
        // Senha incorreta
        echo json_encode(['status' => 'error', 'message' => 'Senha atual incorreta.']);
    }
}
?>
