<?php
// Arquivo: pages/cad-fabricante.php
require_once '../php/conexao.php';
$erro_msg = '';
$sucesso_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_fabricante = trim($_POST['nome-fab'] ?? '');
    if (empty($nome_fabricante)) {
        $erro_msg = "O nome não pode ser vazio.";
    } else {
        try {
            $sql = "INSERT INTO fabricante (nome) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome_fabricante]);
            $sucesso_msg = "Fabricante cadastrado com sucesso!";
        } catch (PDOException $e) {
            $erro_msg = "Erro: Este fabricante já deve existir.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabricantes | Katchau Pro</title>
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
            <a href="cad-fabricante.php" class="nav-tab active">Fabricantes</a>
            <a href="cad-modelos.php" class="nav-tab">Modelos</a>
            <a href="cad-cores.php" class="nav-tab">Cores</a>
            <a href="cad-acessorios.php" class="nav-tab">Acessórios</a>
        </div>

        <div class="container-form" style="max-width: 600px; margin: 0 auto;">
            
            <?php if ($erro_msg): ?><p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo $erro_msg; ?></p><?php endif; ?>
            <?php if ($sucesso_msg): ?><p style="color: green; text-align: center; margin-bottom: 15px; font-weight: bold;"><?php echo $sucesso_msg; ?></p><?php endif; ?>

            <form action="" method="post">
                <div class="input-group">
                    <label class="label-ui">Nome do Fabricante</label>
                    <input type="text" name="nome-fab" class="input-ui" placeholder="Ex: Volkswagen" required>
                </div>
                <br>
                <input type="submit" class="btn-primary" value="SALVAR FABRICANTE">
            </form>
        </div>
    </div>
</body>
</html>