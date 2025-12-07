<?php
// Arquivo: pages/cad-cores.php
require_once '../php/conexao.php';
$erro_msg = '';
$sucesso_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_cor = trim($_POST['nome-cor'] ?? '');
    if (empty($nome_cor)) {
        $erro_msg = "O nome da cor é obrigatório.";
    } else {
        try {
            $sql = "INSERT INTO cor (nome) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome_cor]);
            $sucesso_msg = "Cor cadastrada com sucesso!";
        } catch (PDOException $e) {
            $erro_msg = "Erro: Cor duplicada ou inválida.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cores | Katchau Pro</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
</head>
<body>
    <header class="cabecalho">
        <nav><a href="../index.php" class="logo"><img src="../img/favicon.png" alt="logo"></a></nav>
    </header>

    <div class="inicio">
        <div class="nome"><h1>Gerenciar Parâmetros</h1></div>

        <div class="nav-tabs">
            <a href="cad-fabricante.php" class="nav-tab">Fabricantes</a>
            <a href="cad-modelos.php" class="nav-tab">Modelos</a>
            <a href="cad-cores.php" class="nav-tab active">Cores</a>
            <a href="cad-acessorios.php" class="nav-tab">Acessórios</a>
        </div>

        <div class="container-form" style="max-width: 600px; margin: 0 auto;">
            <?php if ($erro_msg): ?><p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo $erro_msg; ?></p><?php endif; ?>
            <?php if ($sucesso_msg): ?><p style="color: green; text-align: center; margin-bottom: 15px; font-weight: bold;"><?php echo $sucesso_msg; ?></p><?php endif; ?>

            <form action="" method="post">
                <div class="input-group">
                    <label class="label-ui">Nome da Cor</label>
                    <input type="text" name="nome-cor" class="input-ui" placeholder="Ex: Preto Ninja" required>
                </div>
                <br>
                <input type="submit" class="btn-primary" value="SALVAR COR">
            </form>
        </div>
    </div>
</body>
</html>