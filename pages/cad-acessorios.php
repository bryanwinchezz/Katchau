<?php
// Arquivo: pages/cad-acessorios.php
require_once '../php/conexao.php';
$erro_msg = '';
$sucesso_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_acessorio = trim($_POST['nome-acessorio'] ?? '');
    if (empty($nome_acessorio)) {
        $erro_msg = "O nome é obrigatório.";
    } else {
        try {
            $sql = "INSERT INTO acessorio (nome) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome_acessorio]);
            $sucesso_msg = "Acessório cadastrado com sucesso!";
        } catch (PDOException $e) {
            $erro_msg = "Erro ao cadastrar acessório.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acessórios | Katchau Pro</title>
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
            <a href="cad-cores.php" class="nav-tab">Cores</a>
            <a href="cad-acessorios.php" class="nav-tab active">Acessórios</a>
        </div>

        <div class="container-form" style="max-width: 600px; margin: 0 auto;">
            <?php if ($erro_msg): ?><p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo $erro_msg; ?></p><?php endif; ?>
            <?php if ($sucesso_msg): ?><p style="color: green; text-align: center; margin-bottom: 15px; font-weight: bold;"><?php echo $sucesso_msg; ?></p><?php endif; ?>

            <form action="" method="post">
                <div class="input-group">
                    <label class="label-ui">Descrição do Acessório</label>
                    <input type="text" name="nome-acessorio" class="input-ui" placeholder="Ex: Sensor de Ré" required>
                </div>
                <br>
                <input type="submit" class="btn-primary" value="SALVAR ACESSÓRIO">
            </form>
        </div>
    </div>
</body>
</html>