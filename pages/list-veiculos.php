<?php
// Arquivo: pages/list-veiculos.php
require_once '../php/conexao.php';

// --- LÓGICA DE FILTRO ---
$filtro_status = $_GET['filtro'] ?? 'todos';
$where_clause = "";

if ($filtro_status == 'disponivel') {
    $where_clause = "WHERE estado_id = 1";
} elseif ($filtro_status == 'vendido') {
    $where_clause = "WHERE estado_id = 2";
}

$status_message = '';
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    switch ($status) {
        case 'cadastrado':
            $status_message = '<p style="color: #155724; background: #d4edda; padding: 10px; border-radius: 5px; text-align: center;">✅ Veículo cadastrado com sucesso!</p>';
            break;
        case 'excluido':
            $status_message = '<p style="color: green; font-weight: bold; text-align: center; margin-top: 15px; background: #d4edda; padding: 10px; border-radius: 5px;">✅ Veículo excluído com sucesso!</p>';
            break;
        case 'erro_vendido':
            $status_message = '<p style="color: #721c24; font-weight: bold; text-align: center; margin-top: 15px; background: #f8d7da; padding: 10px; border-radius: 5px;">⛔ PROIBIDO: Não é permitido excluir veículos VENDIDOS.</p>';
            break;
        case 'erro_exclusao':
            $status_message = '<p style="color: red; font-weight: bold; text-align: center; margin-top: 15px;">❌ Erro técnico ao excluir.</p>';
            break;
    }
}

// --- CARREGAMENTO DE DADOS COM VIEW ---
try {
    $sql = "SELECT * FROM vw_veiculos_detalhes $where_clause ORDER BY veiculo_id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log("Erro: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estoque | Katchau</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
</head>
<body>
    <header class="cabecalho">
        <nav>
            <a href="../index.php" class="logo"><img src="../img/favicon.png" alt="Katchau"></a>
            <div style="color: white; font-weight: bold;">SISTEMA DE GESTÃO</div>
        </nav>
    </header>

    <div class="inicio">
        <div class="nome">
            <h1>Gerenciamento de Veículos</h1>
        </div>

        <?php if ($status_message) echo $status_message; ?>

        <div class="filter-bar">
            <form action="" method="get" style="display: flex; gap: 15px; width: 100%; align-items: flex-end;">
                <div class="input-group" style="flex-grow: 1;">
                    <label class="label-ui">Filtrar por Status:</label>
                    <select name="filtro" class="input-ui" onchange="this.form.submit()">
                        <option value="todos" <?php echo $filtro_status == 'todos' ? 'selected' : ''; ?>>Todos os Veículos</option>
                        <option value="disponivel" <?php echo $filtro_status == 'disponivel' ? 'selected' : ''; ?>>Somente Disponíveis</option>
                        <option value="vendido" <?php echo $filtro_status == 'vendido' ? 'selected' : ''; ?>>Somente Vendidos</option>
                    </select>
                </div>
            </form>
            <a href="cad-veiculo.php"><button class="btn-primary" style="width: 210px; height: 49px; font-size: 1rem;">+ Novo Veículo</button></a>
        </div>

        <div class="container-list">
            <div class="list-header">
                <div>Veículo (Informações)</div>
                <div>Fabricante</div>
                <div>Status</div>
                <div>Proprietário</div>
                <div>Valor (R$)</div>
                <div style="text-align: right;">Ações</div>
            </div>

            <?php if (empty($veiculos)): ?>
                <div style="padding: 40px; text-align: center; color: #666; background: #fff;">Nenhum veículo encontrado com este filtro.</div>
            <?php else: ?>
                <?php foreach ($veiculos as $v):
                    $statusClass = (stripos($v['estado_nome'] ?? '', 'vendido') !== false) ? 'status-vend' : 'status-disp';
                    
                    // BUSCAR ACESSÓRIOS DESTE VEÍCULO
                    $stmtAcc = $pdo->prepare("SELECT a.nome FROM acessorio a JOIN veiculo_acessorio va ON a.id = va.acessorio_id WHERE va.veiculo_id = ?");
                    $stmtAcc->execute([$v['veiculo_id']]);
                    $lista_acessorios = $stmtAcc->fetchAll(PDO::FETCH_COLUMN);
                    $texto_acessorios = implode(' • ', $lista_acessorios);
                ?>
                    <div class="list-item">
                        <div style="font-weight: bold; color: var(--secondary);">
                            <?php echo htmlspecialchars($v['nome_modelo']); ?>
                            <span style="font-weight: normal; color: #666; font-size: 0.9em;"> • <?php echo htmlspecialchars($v['nome_cor']); ?></span>
                            <div style="font-size: 0.8rem; color: #999;"><?php echo $v['ano'] . ' • ' . $v['placa']; ?></div>
                            
                            <?php if (!empty($texto_acessorios)): ?>
                                <div style="font-size: 0.75rem; color: #d63384; margin-top: 6px; font-style: italic; line-height: 1.4; padding-right: 30px; width: 95%;">
                                    + <?php echo htmlspecialchars($texto_acessorios); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div><?php echo htmlspecialchars($v['nome_fabricante'] ?? '-'); ?></div>

                        <div><span class="status-badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($v['estado_nome']); ?></span></div>

                        <div style="font-size: 0.9rem;"><?php echo htmlspecialchars($v['nome_proprietario'] ?? '-'); ?></div>

                        <div style="font-weight: bold; color: var(--accent);">R$ <?php echo number_format($v['valor'], 2, ',', '.'); ?></div>

                        <div class="actions">
                            <a href="edit-veiculo.php?id=<?php echo $v['veiculo_id']; ?>" title="Editar">
                                <button class="btn-icon" type="button"><img src="../img/editar.png" style="width: 20px;"></button>
                            </a>

                            <?php if ($v['estado_id'] == 1): ?>
                                <button class="btn-icon" type="button" onclick="abrirModal(<?php echo $v['veiculo_id']; ?>)" title="Excluir">
                                    <img src="../img/lixeira.png" style="width: 20px; pointer-events: none;">
                                </button>
                            <?php else: ?>
                                <button class="btn-icon" type="button" style="cursor: not-allowed; opacity: 0.3;" title="Bloqueado: Veículo Vendido">
                                    <img src="../img/lixeira.png" style="width: 20px; filter: grayscale(100%);">
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <dialog id="dialog-excluir">
        <div style="text-align: center;">
            <h2 style="font-family: var(--font-brand); color: var(--accent); margin-bottom: 10px;">Confirmar Exclusão</h2>
            <p>Tem certeza que deseja apagar o veículo ID: <span id="dialog-modelo-cor" style="font-weight: bold;"></span>?</p>
            <br>
            <div style="display: flex; gap: 10px; justify-content: center;">
                <button class="sair btn-primary" onclick="fecharModal()" style="background: #ccc; color: #333; border: 1px solid #999;">CANCELAR</button>
                <button id="btn-confirmar-exclusao" class="btn-primary" style="background: var(--accent); color: #FFF; border: 1px solid var(--accent);">EXCLUIR</button>
            </div>
        </div>
    </dialog>

    <script>
        const dialog = document.getElementById('dialog-excluir');
        const textoId = document.getElementById('dialog-modelo-cor');
        const btnConfirmar = document.getElementById('btn-confirmar-exclusao');

        function abrirModal(idVeiculo) {
            if (!dialog) return;
            textoId.textContent = '#' + idVeiculo;
            btnConfirmar.onclick = function() {
                window.location.href = `excluir-veiculo.php?id=${idVeiculo}`;
            };
            dialog.showModal();
        }

        function fecharModal() {
            dialog.close();
        }
    </script>
</body>
</html>