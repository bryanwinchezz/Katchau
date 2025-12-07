<?php
// Arquivo: pages/cad-modelos.php
require_once '../php/conexao.php';
$erro_msg = '';
$sucesso_msg = '';

// Carrega fabricantes
try {
    $fabricantes = $pdo->query("SELECT id, nome FROM fabricante ORDER BY nome")->fetchAll();
} catch (PDOException $e) { $erro_msg = "Erro ao carregar lista."; }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_modelo = trim($_POST['nome-modelo'] ?? '');
    $fabricante_id = $_POST['fabricante_id'] ?? '';

    if (empty($nome_modelo) || empty($fabricante_id)) {
        $erro_msg = "Preencha todos os campos.";
    } else {
        try {
            $sql = "INSERT INTO modelo (nome, fabricante_id) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome_modelo, (int)$fabricante_id]);
            $sucesso_msg = "Modelo cadastrado com sucesso!";
        } catch (PDOException $e) {
            $erro_msg = "Erro ao cadastrar modelo.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelos | Katchau Pro</title>
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
            <a href="cad-modelos.php" class="nav-tab active">Modelos</a>
            <a href="cad-cores.php" class="nav-tab">Cores</a>
            <a href="cad-acessorios.php" class="nav-tab">Acessórios</a>
        </div>

        <div class="container-form" style="max-width: 600px; margin: 0 auto;">
            <?php if ($erro_msg): ?><p style="color: red; text-align: center; margin-bottom: 15px;"><?php echo $erro_msg; ?></p><?php endif; ?>
            <?php if ($sucesso_msg): ?><p style="color: green; text-align: center; margin-bottom: 15px; font-weight: bold;"><?php echo $sucesso_msg; ?></p><?php endif; ?>

            <form action="" method="post">
                <div class="input-group">
                    <label class="label-ui">Fabricante</label>
                    <select name="fabricante_id" class="input-ui" required>
                        <option value="" selected disabled>Selecione...</option>
                        <?php foreach ($fabricantes as $fab): ?>
                            <option value="<?php echo $fab['id']; ?>"><?php echo htmlspecialchars($fab['nome']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <label class="label-ui">Nome do Modelo</label>
                    <input type="text" name="nome-modelo" class="input-ui" placeholder="Ex: Golf" required>
                </div>
                <br>
                <input type="submit" class="btn-primary" value="SALVAR MODELO">
            </form>
        </div>
    </div>
</body>
</html>