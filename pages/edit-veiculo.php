<?php
// Arquivo: pages/edit-veiculo.php
require_once '../php/conexao.php';

$erro_msg = '';
$sucesso_msg = '';
$veiculo = null;
$ids_acessorios_veiculo = [];

// Carregamento de Listas
try {
    $modelos = $pdo->query("SELECT id, nome FROM modelo ORDER BY nome")->fetchAll();
    $fabricantes = $pdo->query("SELECT id, nome FROM fabricante ORDER BY nome")->fetchAll();
    $cores = $pdo->query("SELECT id, nome FROM cor ORDER BY nome")->fetchAll();
    $cidades = $pdo->query("SELECT id, nome FROM cidade ORDER BY nome")->fetchAll();
    $estados = $pdo->query("SELECT id, nome FROM estado ORDER BY nome")->fetchAll();
    $carrocerias = $pdo->query("SELECT id, nome FROM carroceria ORDER BY nome")->fetchAll();
    $proprietarios = $pdo->query("SELECT id, nome FROM proprietario ORDER BY nome")->fetchAll();
    $combustiveis = $pdo->query("SELECT id, nome FROM combustivel ORDER BY nome")->fetchAll();
    $acessorios_disponiveis = $pdo->query("SELECT id, nome FROM acessorio ORDER BY nome")->fetchAll();
    $portas = [2, 3, 4, 5];
} catch (PDOException $e) {
    error_log("Erro ao carregar listas: " . $e->getMessage());
    $erro_msg = "Erro ao carregar opções do sistema.";
}

// Busca Dados do Veículo
$veiculo_id = $_GET['id'] ?? null;
if (!$veiculo_id || !is_numeric($veiculo_id)) {
    $erro_msg = "ID do veículo inválido.";
} else {
    try {
        $sql_select = "SELECT * FROM veiculo WHERE id = ?";
        $stmt = $pdo->prepare($sql_select);
        $stmt->execute([(int)$veiculo_id]);
        $veiculo = $stmt->fetch();

        if (!$veiculo) {
            $erro_msg = "Veículo não encontrado.";
        } else {
            // Carregar acessórios que este veículo JÁ POSSUI
            $stmtAcc = $pdo->prepare("SELECT acessorio_id FROM veiculo_acessorio WHERE veiculo_id = ?");
            $stmtAcc->execute([(int)$veiculo_id]);
            $ids_acessorios_veiculo = $stmtAcc->fetchAll(PDO::FETCH_COLUMN);
        }
    } catch (PDOException $e) {
        $erro_msg = "Erro ao carregar dados do veículo.";
    }
}

// PROCESSAR UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST" && $veiculo_id && !$erro_msg) {
    $modelo_id = $_POST['modelo_id'] ?? null;
    $ano = $_POST['ano-carro'] ?? null;
    $placa = $_POST['placa-carro'] ?? null;
    $valor = $_POST['valor-carro'] ?? null;
    $quilometragem = $_POST['km-carro'] ?? null;
    $combustivel_id = $_POST['combustivel_id'] ?? null;
    $portas_val = $_POST['portas'] ?? null;
    $cidade_id = $_POST['cidade_id'] ?? null;
    $estado_id = $_POST['estado_id'] ?? null;
    $carroceria_id = $_POST['carroceria_id'] ?? null;
    $proprietario_id = $_POST['proprietario_id'] ?? null;
    $cor_id = $_POST['cor_id'] ?? null;
    $acessorios_selecionados = $_POST['acessorios'] ?? [];

    try {
        $pdo->beginTransaction();

        $sql_update = "UPDATE veiculo SET 
            modelo_id = ?, cor_id = ?, combustivel_id = ?, ano = ?, placa = ?, valor = ?, quilometragem = ?, portas = ?, cidade_id = ?, estado_id = ?, carroceria_id = ?, proprietario_id = ?
            WHERE id = ?";
        $stmt = $pdo->prepare($sql_update);
        $stmt->execute([
            (int)$modelo_id,
            (int)$cor_id,
            (int)$combustivel_id,
            $ano,
            $placa,
            (float)$valor,
            (int)$quilometragem,
            (int)$portas_val,
            $cidade_id ? (int)$cidade_id : null,
            $estado_id ? (int)$estado_id : null,
            $carroceria_id ? (int)$carroceria_id : null,
            $proprietario_id ? (int)$proprietario_id : null,
            (int)$veiculo_id
        ]);

        // ATUALIZAÇÃO DOS ACESSÓRIOS
        // 1. Remove todos os antigos
        $stmtDel = $pdo->prepare("DELETE FROM veiculo_acessorio WHERE veiculo_id = ?");
        $stmtDel->execute([(int)$veiculo_id]);

        // 2. Insere os novos selecionados
        if (!empty($acessorios_selecionados)) {
            $stmtIns = $pdo->prepare("INSERT INTO veiculo_acessorio (veiculo_id, acessorio_id) VALUES (?, ?)");
            foreach ($acessorios_selecionados as $acc_id) {
                $stmtIns->execute([(int)$veiculo_id, (int)$acc_id]);
            }
        }

        $pdo->commit();
        $sucesso_msg = "Veículo atualizado com sucesso!";

        // Recarrega os dados para mostrar atualizado
        $stmt = $pdo->prepare($sql_select);
        $stmt->execute([(int)$veiculo_id]);
        $veiculo = $stmt->fetch();
        
        // Recarrega lista de acessórios marcados
        $stmtAcc->execute([(int)$veiculo_id]);
        $ids_acessorios_veiculo = $stmtAcc->fetchAll(PDO::FETCH_COLUMN);

    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log("Erro Update: " . $e->getMessage());
        $erro_msg = "Falha ao atualizar. Verifique os dados.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Veículo | Katchau Pro</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
</head>
<body>
    <header class="cabecalho">
        <nav><a href="../index.php" class="logo"><img src="../img/favicon.png" alt="logo"></a></nav>
    </header>

    <div class="inicio">
        <div class="nome">
            <h1>Editar Veículo <span style="font-size: 0.5em; color: #999;">#<?php echo $veiculo_id; ?></span></h1>
        </div>

        <?php if ($erro_msg): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; width: 100%; max-width: 900px; text-align: center; margin: 0 auto 20px auto;">
                <?php echo $erro_msg; ?>
            </div>
        <?php endif; ?>

        <?php if ($sucesso_msg): ?>
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; width: 100%; max-width: 900px; text-align: center; margin: 0 auto 20px auto;">
                <?php echo $sucesso_msg; ?>
                <br><a href="list-veiculos.php" style="font-weight: bold; text-decoration: underline;">Voltar para a Lista</a>
            </div>
        <?php endif; ?>

        <?php if ($veiculo): ?>
            <div class="container-form" style="max-width: 900px; width: 100%;">
                <form action="edit-veiculo.php?id=<?php echo (int)$veiculo_id; ?>" method="post">
                    <div class="form-grid">

                        <div class="full-width">
                            <h3 style="color: #721c24; border-bottom: 2px solid #eee; padding-bottom: 10px;">Dados Principais</h3>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Modelo *</label>
                            <select name="modelo_id" class="input-ui" required>
                                <option value="" disabled>Selecione...</option>
                                <?php foreach ($modelos as $mod): ?>
                                    <option value="<?php echo $mod['id']; ?>" <?php echo ($veiculo['modelo_id'] == $mod['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($mod['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Fabricante (Ref.)</label>
                            <select name="fabricante_id" class="input-ui">
                                <option value="" disabled>...</option>
                                <?php foreach ($fabricantes as $fab): ?>
                                    <option value="<?php echo $fab['id']; ?>" <?php echo (isset($veiculo['fabricante_id']) && $veiculo['fabricante_id'] == $fab['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($fab['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Placa *</label>
                            <input type="text" name="placa-carro" class="input-ui" value="<?php echo htmlspecialchars($veiculo['placa']); ?>" required>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Ano *</label>
                            <input type="number" name="ano-carro" class="input-ui" value="<?php echo htmlspecialchars($veiculo['ano']); ?>" required min="1900" max="2026">
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Cor *</label>
                            <select name="cor_id" class="input-ui" required>
                                <option value="" disabled>...</option>
                                <?php foreach ($cores as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" <?php echo ($veiculo['cor_id'] == $c['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($c['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Combustível *</label>
                            <select name="combustivel_id" class="input-ui" required>
                                <option value="" disabled>...</option>
                                <?php foreach ($combustiveis as $comb): ?>
                                    <option value="<?php echo $comb['id']; ?>" <?php echo ($veiculo['combustivel_id'] == $comb['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($comb['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="full-width" style="margin-top: 20px;">
                            <h3 style="color: #721c24; border-bottom: 2px solid #eee; padding-bottom: 10px;">Detalhes & Situação</h3>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Valor (R$) *</label>
                            <input type="number" name="valor-carro" class="input-ui" step="0.01" value="<?php echo htmlspecialchars($veiculo['valor']); ?>" required>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Quilometragem</label>
                            <input type="number" name="km-carro" class="input-ui" value="<?php echo htmlspecialchars($veiculo['quilometragem']); ?>">
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Status (Venda) *</label>
                            <select name="estado_id" class="input-ui" style="font-weight: bold; color: var(--accent);" required>
                                <option value="" disabled>...</option>
                                <?php foreach ($estados as $e): ?>
                                    <option value="<?php echo $e['id']; ?>" <?php echo ($veiculo['estado_id'] == $e['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($e['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Cidade</label>
                            <select name="cidade_id" class="input-ui">
                                <option value="" disabled>...</option>
                                <?php foreach ($cidades as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" <?php echo ($veiculo['cidade_id'] == $c['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($c['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Proprietário</label>
                            <select name="proprietario_id" class="input-ui">
                                <option value="" disabled>...</option>
                                <?php foreach ($proprietarios as $prop): ?>
                                    <option value="<?php echo $prop['id']; ?>" <?php echo ($veiculo['proprietario_id'] == $prop['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($prop['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Carroceria</label>
                            <select name="carroceria_id" class="input-ui">
                                <option value="" disabled>...</option>
                                <?php foreach ($carrocerias as $car): ?>
                                    <option value="<?php echo $car['id']; ?>" <?php echo ($veiculo['carroceria_id'] == $car['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($car['nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <label class="label-ui">Portas</label>
                            <select name="portas" class="input-ui">
                                <?php foreach ($portas as $p): ?>
                                    <option value="<?php echo $p; ?>" <?php echo ($veiculo['portas'] == $p) ? 'selected' : ''; ?>><?php echo $p; ?> Portas</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="full-width">
                            <label class="label-ui">Acessórios</label>
                            <div class="checkbox-group" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px;">
                                <?php foreach ($acessorios_disponiveis as $acess): 
                                    $checked = in_array($acess['id'], $ids_acessorios_veiculo) ? 'checked' : '';
                                ?>
                                    <label class="checkbox-item" style="cursor: pointer;">
                                        <input type="checkbox" name="acessorios[]" value="<?php echo $acess['id']; ?>" <?php echo $checked; ?>>
                                        <?php echo htmlspecialchars($acess['nome']); ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="full-width" style="margin-top: 20px;">
                            <input type="submit" class="btn-primary" value="ATUALIZAR DADOS">
                        </div>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>