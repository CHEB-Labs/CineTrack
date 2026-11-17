<?php
session_start();
require_once '_php/filmes.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM filmes WHERE id = ?");
$stmt->execute([$id]);
$filme = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o filme não existir, volta para o início
if (!$filme) {
    header('Location: index.php');
    exit;
}

// Verifica se o título já está na biblioteca do usuário logado
$naBiblioteca = false;
if (isset($_SESSION['usuario_id'])) {
    $stmt = $pdo->prepare("SELECT 1 FROM biblioteca WHERE usuario_id = ? AND filme_id = ?");
    $stmt->execute([(int)$_SESSION['usuario_id'], $filme['id']]);
    $naBiblioteca = (bool)$stmt->fetchColumn();
}

// Link do trailer: só aceita endereços que começam com http:// ou https://
$trailer = $filme['trailer'] ?? '';
$temTrailer = (bool)preg_match('#^https?://#i', $trailer);

$similares = buscarAleatorios($pdo, null, 5, $filme['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="_css/style.css">
    <link rel="stylesheet" href="_css/filme.css">
    <link rel="shortcut icon" href="_img/popcorn-box.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=BBH+Bogle&family=Google+Sans+Flex:opsz,wght@1..144,1..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <title><?= htmlspecialchars($filme['titulo']) ?> - CineTrack</title>
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

            <div class="capa">
                <img src="_img/<?= !empty($filme['destaque']) ? 'destaque/' . rawurlencode($filme['destaque']) : 'capa-padrao.png' ?>" alt="<?= htmlspecialchars($filme['titulo']) ?>">
                <img src="_img/shadow2.png" class="img-cima" alt="">

                <div class="capa-info">
                    <h1 class="titulo"><?= htmlspecialchars(mb_strtoupper($filme['titulo'])) ?></h1>
                    <p><?= (int)$filme['ano'] ?> - <?= htmlspecialchars($filme['genero']) ?></p>
                </div>
            </div>

            <div class="div1">
                <div class="div2">
                    <form id="form-biblioteca" action="_php/biblioteca_acao.php" method="POST" style="display: none;">
                        <input type="hidden" name="filme_id" value="<?= (int)$filme['id'] ?>">
                    </form>
                    <div class="botoes">
                        <?php if ($temTrailer): ?>
                            <button type="button" onclick="window.open(<?= htmlspecialchars(json_encode($trailer), ENT_QUOTES) ?>, '_blank', 'noopener')">Assistir ao trailer</button>
                        <?php else: ?>
                            <button type="button" disabled style="opacity: 0.5; cursor: not-allowed;" title="Trailer indisponível">Assistir ao trailer</button>
                        <?php endif; ?>
                        <?php if ($naBiblioteca): ?>
                            <button type="button" disabled style="background-color: transparent; border: solid 1px #ffffff; color: white; opacity: 0.5; cursor: not-allowed;">Na sua biblioteca</button>
                        <?php else: ?>
                            <button type="submit" form="form-biblioteca" style="background-color: transparent; border: solid 1px #ffffff; color: white;">Adicionar a biblioteca</button>
                        <?php endif; ?>
                    </div>
                    <div class="sinopse">
                        <h1>Sinopse</h1>
                        <p><?= nl2br(htmlspecialchars($filme['descricao'])) ?></p>
                    </div>
                    <div class="avaliar">
                        <form action="">
                            <textarea name="" id="" placeholder="Escreva sua opinião. (Opcional)"></textarea>
                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                </div>

                <div class="div3">
                    <div class="nota">
                        <h1>8.7/10</h1>
                        <p>(953 mil)</p>
                    </div>

                    <p>DIRETOR</p>
                    <div class="elenco">
                        <img src="_img/user.png" alt="">
                        <p><?= htmlspecialchars($filme['diretor']) ?></p>
                    </div>

                    <p style="margin-top: 15px;">ELENCO</p>
                    <div class="elenco">
                        <img src="_img/user.png" alt="">
                        <p>Matt Reeves</p>
                    </div>

                    <div class="elenco">
                        <img src="_img/user.png" alt="">
                        <p>Matt Reeves</p>
                    </div>

                    <div class="elenco">
                        <img src="_img/user.png" alt="">
                        <p>Matt Reeves</p>
                    </div>

                    <div class="elenco">
                        <img src="_img/user.png" alt="">
                        <p>Matt Reeves</p>
                    </div>
                </div>
            </div>

            <h1 style="margin-top: 40px;">Bilheteria</h1>
            <div class="bilheteria">
                <div class="orc">
                    <h2>Orçamento</h2>
                    <p>US$ 200.000.000 (estimativa)</p>
                </div>
                <div class="fat">
                    <h2>Faturamento Bruto Mundial</h2>
                    <p>US$ 772.775.278</p>
                </div>
            </div>

            <h1>Avaliações</h1>
            <div class="avaliacoes">

                <div class="avaliacao">

                    <img src="_img/user.png" alt="">
                    <div class="txt">
                        <h2>Nome Usuário</h2>
                        <p>Batman acompanha Bruce Wayne enfrentando ameaças complexas e vilões icônicos em Gotham, enquanto equilibra sua vida como bilionário e vigilante mascarado.</p>
                    </div>
                </div>
                <div class="avaliacao">

                    <img src="_img/user.png" alt="">
                    <div class="txt">
                        <h2>Nome Usuário</h2>
                        <p>Batman acompanha Bruce Wayne enfrentando ameaças complexas e vilões icônicos em Gotham, enquanto equilibra sua vida como bilionário e vigilante mascarado.</p>
                    </div>
                </div>
                <div class="avaliacao">

                    <img src="_img/user.png" alt="">
                    <div class="txt">
                        <h2>Nome Usuário</h2>
                        <p>Batman acompanha Bruce Wayne enfrentando ameaças complexas e vilões icônicos em Gotham, enquanto equilibra sua vida como bilionário e vigilante mascarado.</p>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <h1>Filmes e Séries similares</h1>
                <div class="filmes-linha">
                    <?php linhaFilmes($similares); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>