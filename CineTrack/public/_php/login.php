<?php
session_start();
require_once 'conexao.php';

// Só aceita envio de formulário (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.html');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

// Mostra um aviso e volta para a tela de login
function voltarComErro($mensagem) {
    echo "<script>alert(" . json_encode($mensagem) . "); history.back();</script>";
    exit;
}

if ($email === '' || $senha === '') {
    voltarComErro('Preencha e-mail e senha.');
}

// Busca o usuário pelo e-mail
$stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Confere a senha criptografada
if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    voltarComErro('E-mail ou senha inválidos.');
}

// Login ok: guarda na sessão
session_regenerate_id(true);
$_SESSION['usuario_id']   = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];

// Vai para a página inicial
header('Location: ../index.php');
exit;