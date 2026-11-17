<?php
session_start();
require_once '_php/filmes.php';

$logado = isset($_SESSION['usuario_id']);
$meusFilmes = [];

// Só busca no banco se houver um usuário logado
if ($logado) {
    $stmt = $pdo->prepare(
        "SELECT f.id, f.titulo, f.capa
         FROM biblioteca b
         JOIN filmes f ON f.id = b.filme_id
         WHERE b.usuario_id = ?
         ORDER BY b.id DESC"
    );
    $stmt->execute([(int)$_SESSION['usuario_id']]);
    $meusFilmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="_css/biblioteca.css">
    <link rel="stylesheet" href="_css/style.css">
    <link rel="shortcut icon" href="_img/popcorn-box.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=BBH+Bogle&family=Google+Sans+Flex:opsz,wght@1..144,1..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <title>Home - CineTrack</title>
</head>

<body>
    <header>
        <a href="index.php"><img src="_img/Logo.png" class="logo"></a>
        <div class="barra-pesquisa">
            <img src="_img/search.png" alt="">
            <p>Pesquisar filmes ou séries...</p>
        </div>
    </header>

    <div class="layout">
        <div class="menu">
            <div class="nav-botoes">
                <button>
                    <img src="_img/home.png" alt=""><a href="index.php">Início</a>
                </button>

                <button>
                    <img src="_img/compass-icon.png" alt=""><a href="explorar.php">Explorar</a>
                </button>

                <button>
                    <img src="_img/library.png" alt=""><a href="biblioteca.php">Biblioteca</a>
                </button>

                <button>
                    <img src="_img/info.png" alt=""><a href="index.php">Sobre</a>
                </button>
            </div>

            <hr style="margin-top: 45%;">
            <div class="usuario">
                <div class="usr-foto">
                    <a href="login.html"><img src="_img/user.png" alt=""></a>
                </div>
                <div class="usr-nome">
                    <p><?= isset($_SESSION['usuario_nome']) ? htmlspecialchars($_SESSION['usuario_nome']) : 'Visitante' ?></p>
                    <p class="texto" style="font-size: 0.7em; color: #A2A2A2;"><?= isset($_SESSION['usuario_nome']) ? 'Online' : 'Offline' ?></p>
                </div>
            </div>
        </div>

        <div class="main">

            <div>
                <h2>Minha Biblioteca</h2>

                <?php if (!$logado): ?>
                    <p style="margin-top: 25px; color: #A2A2A2;">Faça <a href="login.html" style="text-decoration: underline;">login</a> para adicionar algo para sua biblioteca.</p>

                <?php elseif (count($meusFilmes) === 0): ?>
                    <p style="margin-top: 25px; color: #A2A2A2;">Sua biblioteca ainda está vazia. Abra um filme ou série e clique em "Adicionar a biblioteca".</p>

                <?php else: ?>
                    <?php foreach (array_chunk($meusFilmes, 5) as $linha): ?>
                        <div class="filmes-linha">
                            <?php linhaFilmes($linha); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>