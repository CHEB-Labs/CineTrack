<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="_css/sobre.css">
    <link rel="stylesheet" href="_css/style.css">
    <link rel="shortcut icon" href="_img/popcorn-box.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=BBH+Bogle&family=Google+Sans+Flex:opsz,wght@1..144,1..1000&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <title>Sobre - CineTrack</title>
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

            <div class="sobre">
                <h2>Sobre</h2>

                <div class="sobre-card">
                    <h3>Quem somos</h3>
                    <p>A CHEB-Labs é o nosso grupo de projetos escolares. Somos estudantes que usam a tecnologia para aprender na prática: dividimos tarefas, trabalhamos em equipe e transformamos ideias em sistemas que funcionam.</p>
                </div>

                <div class="sobre-card">
                    <h3>Nossos projetos</h3>
                    <p>O CineTrack é um deles. Além dele, o grupo também desenvolveu uma mão robótica com ESP32 e servomotores e um RPG de fantasia sombria por turnos.</p>
                </div>

                <div class="sobre-card">
                    <h3>O CineTrack</h3>
                    <p>Uma plataforma para explorar filmes e séries, conhecer os detalhes de cada título, assistir aos trailers e montar a sua biblioteca pessoal. Para guardar títulos na biblioteca, basta criar uma conta e fazer login.</p>
                    <div class="sobre-tecs">
                        <span>PHP</span>
                        <span>MySQL</span>
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>Bootstrap</span>
                        <span>XAMPP</span>
                    </div>
                </div>

                <div class="sobre-card">
                    <h3>Código no GitHub</h3>
                    <p>O código do CineTrack e dos outros projetos do grupo está disponível no nosso GitHub.</p>
                    <a class="sobre-github" href="https://github.com/CHEB-Labs" target="_blank" rel="noopener noreferrer">Ver o GitHub da CHEB-Labs</a>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>