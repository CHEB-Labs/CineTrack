<?php
require_once __DIR__ . '/conexao.php';

// Retorna filmes e séries (id, titulo, capa) para uma linha de posters.
//   $limite : quantos itens trazer (o design comporta 5 por linha)
//   $inicio : quantos itens pular antes de começar (0 = a partir do primeiro)
function buscarFilmes($pdo, $limite = 5, $inicio = 0) {
    $sql = "SELECT id, titulo, capa FROM filmes ORDER BY id LIMIT " . (int)$limite . " OFFSET " . (int)$inicio;
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

// Retorna itens em ordem aleatória (muda a cada vez que a página é carregada).
//   $tipo      : 'filme' ou 'serie' (null = filmes e séries misturados)
//   $limite    : quantos itens trazer (o design comporta 5 por linha)
//   $excluirId : id de um título que não deve aparecer (ex: o filme que está aberto)
function buscarAleatorios($pdo, $tipo = null, $limite = 5, $excluirId = null) {
    $sql = "SELECT id, titulo, capa FROM filmes WHERE 1 = 1";
    $params = [];

    if ($tipo !== null) {
        $sql .= " AND tipo = ?";
        $params[] = $tipo;
    }

    if ($excluirId !== null) {
        $sql .= " AND id <> ?";
        $params[] = (int)$excluirId;
    }

    $sql .= " ORDER BY RAND() LIMIT " . (int)$limite;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Busca com filtros opcionais, usada nas linhas da página Explorar.
//   $tipo      : 'filme' ou 'serie' (null = os dois)
//   $genero    : palavra que deve aparecer no campo genero, ex: 'Drama' (null = qualquer)
//   $limite    : máximo de resultados (o design comporta 5 por linha)
//   $aleatorio : true = ordem aleatória a cada carregamento, false = ordem do cadastro (id)
function buscarPorFiltro($pdo, $tipo = null, $genero = null, $limite = 5, $aleatorio = false) {
    $sql = "SELECT id, titulo, capa FROM filmes WHERE 1 = 1";
    $params = [];

    if ($tipo !== null) {
        $sql .= " AND tipo = ?";
        $params[] = $tipo;
    }

    if ($genero !== null) {
        $sql .= " AND genero LIKE ?";
        $params[] = '%' . $genero . '%';
    }

    $sql .= $aleatorio ? " ORDER BY RAND()" : " ORDER BY id";
    $sql .= " LIMIT " . (int)$limite;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Desenha os cards de uma linha de filmes (mesmo HTML do design)
// As capas ficam em _img/capas/. Sem capa cadastrada, usa o poster padrão (em _img/).
function linhaFilmes($filmes) {
    foreach ($filmes as $f) {
        $imagem = !empty($f['capa']) ? 'capas/' . rawurlencode($f['capa']) : 'poster-padrao.webp';
        ?>
                    <div class="filme">
                        <a href="filme.php?id=<?= (int)$f['id'] ?>"><img src="_img/<?= $imagem ?>" alt="<?= htmlspecialchars($f['titulo']) ?>"></a>
                    </div>
        <?php
    }
}
