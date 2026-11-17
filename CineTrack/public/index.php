<?php
session_start();
require_once '_php/filmes.php';

$emAlta = buscarAleatorios($pdo);            // filmes e séries misturados
$filmes = buscarAleatorios($pdo, 'filme');   // só filmes
$series = buscarAleatorios($pdo, 'serie');   // só séries

// Filmes que têm imagem de destaque (usados no carrossel)
$destaques = $pdo->query("SELECT id, titulo, ano, genero, destaque FROM filmes WHERE destaque IS NOT NULL AND destaque <> '' ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="_css/index.css">
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
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Pesquisar filmes ou séries...">
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
                    <img src="_img/info.png" alt=""><a href="sobre.php">Sobre</a>
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
            <div id="destaque" class="destaque carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

                <div class="carousel-indicators">
                    <?php foreach ($destaques as $i => $d): ?>
                        <button type="button" data-bs-target="#destaque" data-bs-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?>></button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner">
                    <?php foreach ($destaques as $i => $d): ?>
                        <div class="carousel-item<?= $i === 0 ? ' active' : '' ?>">
                            <img src="_img/destaque/<?= rawurlencode($d['destaque']) ?>" alt="<?= htmlspecialchars($d['titulo']) ?>">
                            <a href="filme.php?id=<?= (int)$d['id'] ?>"><img src="_img/shadow.png" class="img-cima" alt=""></a>

                            <div class="destaque-info">
                                <h2 class="titulo"><?= htmlspecialchars(mb_strtoupper($d['titulo'])) ?></h2>
                                <p><?= (int)$d['ano'] ?> - <?= htmlspecialchars($d['genero']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#destaque" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#destaque" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>

            <h2>Em alta agora</h2>
            <div class="filmes-linha">
                <?php linhaFilmes($emAlta); ?>
            </div>

            <h2>Filmes</h2>
            <div class="filmes-linha">
                <?php linhaFilmes($filmes); ?>
            </div>

            <h2>Séries</h2>
            <div class="filmes-linha">
                <?php linhaFilmes($series); ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>