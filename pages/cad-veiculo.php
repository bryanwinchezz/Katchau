<?php
// Arquivo: pages/cad-veiculo.php
require_once '../php/conexao.php';

$erro_msg = '';
$sucesso_msg = '';

$modelos = $fabricantes = $cores = $cidades = $estados = $carrocerias = $proprietarios = $acessorios_disponiveis = $combustiveis = [];
$portas = [2, 3, 4, 5]; // Ajustado para padrão comum

try {
    $modelos = $pdo->query("SELECT id, nome FROM modelo ORDER BY nome")->fetchAll();
    $fabricantes = $pdo->query("SELECT id, nome FROM fabricante ORDER BY nome")->fetchAll();
    $cores = $pdo->query("SELECT id, nome FROM cor ORDER BY nome")->fetchAll();
    $cidades = $pdo->query("SELECT id, nome FROM cidade ORDER BY nome")->fetchAll();
    $estados = $pdo->query("SELECT id, nome FROM estado ORDER BY nome")->fetchAll();
    $carrocerias = $pdo->query("SELECT id, nome FROM carroceria ORDER BY nome")->fetchAll();
    $proprietarios = $pdo->query("SELECT id, nome FROM proprietario ORDER BY nome")->fetchAll();
    $acessorios_disponiveis = $pdo->query("SELECT id, nome FROM acessorio ORDER BY nome")->fetchAll();
    $combustiveis = $pdo->query("SELECT id, nome FROM combustivel ORDER BY nome")->fetchAll();
} catch (PDOException $e) {
    error_log("Erro ao carregar listas: " . $e->getMessage());
    $erro_msg = "❌ Erro ao carregar opções. Verifique o banco de dados.";
}

// PROCESSAR CADASTRO DO VEÍCULO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegar valores do formulário
    $modelo_id = $_POST['modelo_id'] ?? '';
    $fabricante_id = $_POST['fabricante_id'] ?? ''; 
    $ano = trim($_POST['ano-carro'] ?? '');
    $placa = trim($_POST['placa-carro'] ?? '');
    $valor = $_POST['valor-carro'] ?? '';
    $quilometragem = $_POST['km-carro'] ?? '';
    $combustivel_id = $_POST['combustivel_id'] ?? '';
    $portas_sel = $_POST['portas'] ?? '';
    $cidade_id = $_POST['cidade_id'] ?? '';
    $estado_id = $_POST['estado_id'] ?? '';
    $carroceria_id = $_POST['carroceria_id'] ?? '';
    $proprietario_id = $_POST['proprietario_id'] ?? '';
    $cor_id = $_POST['cor_id'] ?? '';
    $acessorios_selecionados = $_POST['acessorios'] ?? [];

    // Validações básicas
    if (empty($modelo_id) || empty($cor_id) || empty($combustivel_id) || empty($ano) || empty($placa) || empty($valor)) {
        $erro_msg = "Preencha os campos obrigatórios (modelo, cor, combustível, ano, placa, valor).";
    } else {
        try {
            $pdo->beginTransaction(); // Inicia transação para segurança

            $sql = "INSERT INTO veiculo 
                (modelo_id, cor_id, combustivel_id, ano, placa, valor, quilometragem, portas, cidade_id, estado_id, carroceria_id, proprietario_id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                (int)$modelo_id,
                (int)$cor_id,
                (int)$combustivel_id,
                $ano,
                $placa,
                (float)$valor,
                (int)$quilometragem,
                (int)$portas_sel,
                $cidade_id ? (int)$cidade_id : null,
                $estado_id ? (int)$estado_id : null,
                $carroceria_id ? (int)$carroceria_id : null,
                $proprietario_id ? (int)$proprietario_id : null
            ]);

            $novoVeiculoId = $pdo->lastInsertId();

            // Insere acessórios na tabela de relação (se houver)
            if (!empty($acessorios_selecionados) && is_array($acessorios_selecionados)) {
                $sql_acc = "INSERT INTO veiculo_acessorio (veiculo_id, acessorio_id) VALUES (?, ?)";
                $stmtAcc = $pdo->prepare($sql_acc);
                foreach ($acessorios_selecionados as $acc) {
                    $stmtAcc->execute([(int)$novoVeiculoId, (int)$acc]);
                }
            }

            $pdo->commit(); // Confirma tudo
            header("Location: list-veiculos.php?status=cadastrado");
            exit;
        } catch (PDOException $e) {
            $pdo->rollBack(); // Desfaz se der erro
            error_log("Erro ao cadastrar veículo: " . $e->getMessage());
            $erro_msg = "❌ Erro ao cadastrar veículo. Verifique os dados e tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Novo Veículo | Katchau</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
</head>
<body>
    <header class="cabecalho">
        <nav><a href="../index.php" class="logo"><img src="../img/favicon.png" alt="logo"></a>
        <div style="color: white; font-weight: bold;">CADASTRAR</div>
        </nav>
    </header>

    <div class="inicio">
        <div class="nome"><h1>Cadastro de Veículo</h1></div>

        <?php if (!empty($erro_msg)): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; width: 100%; max-width: 900px;"><?php echo $erro_msg; ?></div>
        <?php endif; ?>

        <div class="container-form" style="max-width: 900px; width: 100%;">
            <form action="" method="post">
                <div class="form-grid">
                    
                    <div class="full-width"><h3 style="color: #721c24; border-bottom: 2px solid #eee; padding-bottom: 10px;">Dados do Carro</h3></div>

                    <div class="input-group">
                        <label class="label-ui">Modelo *</label>
                        <select name="modelo_id" class="input-ui" required>
                            <option value="" selected disabled>Selecione...</option>
                            <?php foreach ($modelos as $m): ?><option value="<?php echo $m['id']; ?>"><?php echo htmlspecialchars($m['nome']); ?></option><?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Fabricante</label>
                        <select name="fabricante_id" class="input-ui">
                            <option value="" selected disabled>Selecione...</option>
                            <?php foreach ($fabricantes as $f): ?><option value="<?php echo $f['id']; ?>"><?php echo htmlspecialchars($f['nome']); ?></option><?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Placa *</label>
                        <input type="text" name="placa-carro" class="input-ui" placeholder="ABC-1234" required>
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Ano *</label>
                        <input type="number" name="ano-carro" class="input-ui" placeholder="2024" required min="1900" max="2026">
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Cor *</label>
                        <select name="cor_id" class="input-ui" required>
                            <option value="" selected disabled>...</option>
                            <?php foreach ($cores as $c): ?><option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['nome']); ?></option><?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Combustível *</label>
                        <select name="combustivel_id" class="input-ui" required>
                            <option value="" selected disabled>...</option>
                            <?php foreach ($combustiveis as $co): ?><option value="<?php echo $co['id']; ?>"><?php echo htmlspecialchars($co['nome']); ?></option><?php endforeach; ?>
                        </select>
                    </div>

                    <div class="full-width"><h3 style="color: #721c24; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 20px;">Detalhes & Venda</h3></div>

                    <div class="input-group">
                        <label class="label-ui">Valor (R$) *</label>
                        <input type="number" name="valor-carro" class="input-ui" step="0.01" placeholder="0,00" required>
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Quilometragem (KM)</label>
                        <input type="number" name="km-carro" class="input-ui" placeholder="0">
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Status *</label>
                        <select name="estado_id" class="input-ui" required>
                            <?php foreach ($estados as $e): ?><option value="<?php echo $e['id']; ?>"><?php echo htmlspecialchars($e['nome']); ?></option><?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="label-ui">Cidade</label>
                        <select name="cidade_id" class="input-ui" required>
                            <option value="" selected disabled>...</option>
                            <?php foreach ($cidades as $cid): ?><option value="<?php echo $cid['id']; ?>"><?php echo htmlspecialchars($cid['nome']); ?></option><?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="input-group">
                         <label class="label-ui">Proprietário</label>
                         <select name="proprietario_id" class="input-ui">
                            <option value="" selected disabled>...</option>
                            <?php foreach ($proprietarios as $prop): ?><option value="<?php echo $prop['id']; ?>"><?php echo htmlspecialchars($prop['nome']); ?></option><?php endforeach; ?>
                         </select>
                    </div>

                    <div class="input-group">
                         <label class="label-ui">Portas</label>
                         <select name="portas" class="input-ui">
                            <?php foreach ($portas as $p): ?><option value="<?php echo $p; ?>"><?php echo $p; ?> Portas</option><?php endforeach; ?>
                         </select>
                    </div>

                    <div class="full-width">
                        <label class="label-ui">Acessórios</label>
                        <div class="checkbox-group" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px;">
                            <?php foreach ($acessorios_disponiveis as $acess): ?>
                                <label class="checkbox-item" style="cursor: pointer;">
                                    <input type="checkbox" name="acessorios[]" value="<?php echo $acess['id']; ?>">
                                    <?php echo htmlspecialchars($acess['nome']); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="full-width" style="margin-top: 20px;">
                        <input type="submit" class="btn-primary" value="CADASTRAR VEÍCULO">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>