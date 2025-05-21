<?php
// header.php
// Determinar a página atual
$current_page = basename($_SERVER['PHP_SELF']);

// Verificar o tipo de usuário (se implementado)
$is_admin = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
$is_leiloeiro = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'leiloeiro';
$is_comprador = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'comprador';

// Se não tiver implementado tipos de usuário ainda, considerar todos como admin para manter funcionalidade
if (!isset($_SESSION['user_type']) && isset($_SESSION['user'])) {
    $is_admin = true;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Sistema de Leilão'; ?></title>
    <link rel="stylesheet" href="CSS/main.css?v=<?php echo time(); ?>">
    <?php if (isset($page_css)): ?>
    <link rel="stylesheet" href="CSS/<?php echo $page_css; ?>?v=<?php echo time(); ?>">
    <?php endif; ?>
</head>
<body>
    <nav>
        <div class="container">
            <div class="logo">
                <a href="index.php">Sistema de Leilão</a>
            </div>
            <ul>
                <?php if ($is_admin): ?>
                    <li><a href="admin.php" class="<?php echo $current_page === 'admin.php' ? 'active' : ''; ?>">Painel Admin</a></li>
                    <li><a href="register.php" class="<?php echo $current_page === 'register.php' ? 'active' : ''; ?>">Cadastrar Usuário</a></li>
                    <li><a href="cadastro_produto.php" class="<?php echo $current_page === 'cadastro_produto.php' ? 'active' : ''; ?>">Cadastrar Produto</a></li>
                    <li><a href="leilao.php" class="<?php echo $current_page === 'leilao.php' ? 'active' : ''; ?>">Painel de Leilão</a></li>
                    <li><a href="lance.php" class="<?php echo $current_page === 'lance.php' ? 'active' : ''; ?>">Dar Lance</a></li>
                <?php elseif ($is_leiloeiro): ?>
                    <li><a href="leilao.php" class="<?php echo $current_page === 'leilao.php' ? 'active' : ''; ?>">Painel de Leilão</a></li>
                    <li><a href="cadastro_produto.php" class="<?php echo $current_page === 'cadastro_produto.php' ? 'active' : ''; ?>">Cadastrar Produto</a></li>
                <?php elseif ($is_comprador): ?>
                    <li><a href="lance.php" class="<?php echo $current_page === 'lance.php' ? 'active' : ''; ?>">Dar Lance</a></li>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['user'])): ?>
                    <li class="user-info">Olá, <?php echo htmlspecialchars($_SESSION['user']); ?></li>
                    <li><a href="logout.php">Sair</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="<?php echo $current_page === 'login.php' ? 'active' : ''; ?>">Login</a></li>
                    <li><a href="register.php" class="<?php echo $current_page === 'register.php' ? 'active' : ''; ?>">Cadastro</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    
    <div class="container">
