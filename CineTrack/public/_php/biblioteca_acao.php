<?php
session_start();
require_once 'conexao.php';

// Só aceita envio de formulário (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../biblioteca.php');
    exit;
}

$filmeId = (int)($_POST['filme_id'] ?? 0);

// Para onde o usuário volta depois da ação (a página do filme, se o id for válido)
$destino = $filmeId > 0 ? '../filme.php?id=' . $filmeId : '../index.php';

// Mostra um aviso e vai para o destino. Interrompe o resto do script.
function avisar($mensagem, $destino) {
    echo "<script>alert(" . json_encode($mensagem) . "); window.location.href = " . json_encode($destino) . ";</script>";
    exit;
}

// 1. Visitante: avisa e interrompe, nada é gravado
if (!isset($_SESSION['usuario_id'])) {
    avisar('Faça login para adicionar algo para sua biblioteca.', $destino);
}

$usuarioId = (int)$_SESSION['usuario_id'];

// 2. A sessão pode ser antiga (usuário apagado do banco): confere se ele existe
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE id = ?");
$stmt->execute([$usuarioId]);
if (!$stmt->fetch()) {
    $_SESSION = [];
    session_destroy();
    avisar('Sua sessão expirou. Faça login novamente.', '../login.html');
}

// 3. Confere se o filme existe
$stmt = $pdo->prepare("SELECT id FROM filmes WHERE id = ?");
$stmt->execute([$filmeId]);
if (!$stmt->fetch()) {
    header('Location: ../index.php');
    exit;
}

// 4. Não permite adicionar o mesmo título duas vezes
$stmt = $pdo->prepare("SELECT id FROM biblioteca WHERE usuario_id = ? AND filme_id = ?");
$stmt->execute([$usuarioId, $filmeId]);
if ($stmt->fetch()) {
    avisar('Este título já está na sua biblioteca.', $destino);
}

// 5. Grava na biblioteca (o status usa o padrão 'quero_ver' do banco)
try {
    $stmt = $pdo->prepare("INSERT INTO biblioteca (usuario_id, filme_id) VALUES (?, ?)");
    $stmt->execute([$usuarioId, $filmeId]);
} catch (PDOException $e) {
    // 1062 = chave duplicada (a trava UNIQUE do banco barrou, ex: duplo clique)
    if (isset($e->errorInfo[1]) && $e->errorInfo[1] == 1062) {
        avisar('Este título já está na sua biblioteca.', $destino);
    }
    avisar('Não foi possível adicionar à biblioteca. Tente novamente.', $destino);
}

// Volta para a página do filme (o botão já aparece como "Na sua biblioteca")
header('Location: ' . $destino);
exit;