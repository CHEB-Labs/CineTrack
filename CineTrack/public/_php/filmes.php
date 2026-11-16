<?php
require_once __DIR__ . '/conexao.php';

// Retorna todos os filmes (id, titulo, capa)
function buscarFilmes($pdo) {
    return $pdo->query("SELECT id, titulo, capa FROM filmes ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
}

// Desenha os cards de uma linha de filmes (mesmo HTML do design)
function linhaFilmes($filmes) {
    foreach ($filmes as $f) {
        ?>
                    <div class="filme">
                        <a href="filme.php?id=<?= (int)$f['id'] ?>"><img src="_img/<?= rawurlencode($f['capa']) ?>" alt="<?= htmlspecialchars($f['titulo']) ?>"></a>
                    </div>
        <?php
    }
}