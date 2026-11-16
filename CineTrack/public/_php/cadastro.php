<?php
session_start();
require_once 'conexao.php';

// Só aceita envio de formulário (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.html');
    exit;
}

$nome  = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

// Mostra um aviso e volta para a tela de cadastro
function voltarComErro($mensagem) {
    echo "<script>alert(" . json_encode($mensagem) . "); history.back();</script>";
    exit;
}

// Validações básicas
if ($nome === '' || $email === '' || $senha === '') {
    voltarComErro('Preencha todos os campos.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    voltarComErro('Digite um e-mail válido.');
}

if (strlen($senha) < 6) {
    voltarComErro('A senha precisa ter pelo menos 6 caracteres.');
}

// Verifica se o e-mail já está cadastrado
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    voltarComErro('Este e-mail já está cadastrado.');
}

// Salva o usuário com a senha criptografada
$hash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->execute([$nome, $email, $hash]);

// Volta para a página inicial
header('Location: ../index.php');
exit;