<?php
// Arquivo: pages/excluir-veiculo.php
require_once '../php/conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $veiculo_id = (int)$_GET['id'];

    try {
        // --- 1. VERIFICAÇÃO DE SEGURANÇA ---
        // Antes de apagar, verificamos o status do veículo
        $stmtCheck = $pdo->prepare("SELECT estado_id FROM veiculo WHERE id = ?");
        $stmtCheck->execute([$veiculo_id]);
        $veiculo = $stmtCheck->fetch();

        // Se o veículo não existir, volta com erro
        if (!$veiculo) {
            header("Location: list-veiculos.php?status=erro_id");
            exit;
        }

        // REGRA DE NEGÓCIO: Só pode excluir se estado_id == 1 (Disponível)
        // Se for diferente de 1 (Vendido, Reservado, etc), bloqueia.
        // *Ajuste o ID '1' se no seu banco 'Disponível' for outro número.
        if ($veiculo['estado_id'] != 1) {
            header("Location: list-veiculos.php?status=erro_vendido");
            exit;
        }

        // --- 2. EXCLUSÃO (Se passou na verificação acima) ---
        $pdo->beginTransaction();

        $stmtAcessorios = $pdo->prepare("DELETE FROM veiculo_acessorio WHERE veiculo_id = ?");
        $stmtAcessorios->execute([$veiculo_id]);

        $sqlVeiculo = "DELETE FROM veiculo WHERE id = ?";
        $stmtVeiculo = $pdo->prepare($sqlVeiculo);
        $stmtVeiculo->execute([$veiculo_id]);

        $pdo->commit();

        header("Location: list-veiculos.php?status=excluido");
        exit;

    } catch (PDOException $e) {
        $pdo->rollBack();
        error_log("Erro ao excluir: " . $e->getMessage());
        header("Location: list-veiculos.php?status=erro_exclusao");
        exit;
    }
} else {
    header("Location: list-veiculos.php?status=erro_id");
    exit;
}
?>