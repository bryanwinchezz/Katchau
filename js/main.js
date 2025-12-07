// Arquivo: js/main.js (Corrigido e Otimizado)

const DIALOG_ID = 'dialog-excluir';
const CONFIRM_ID = 'btn-confirmar-exclusao';
// ALTERAÇÃO AQUI: Removemos a dependência da classe ".btn"
const DELETE_BUTTON_SELECTOR = 'button[data-veiculo-id]'; 

// Função para anexar os listeners aos botões de exclusão
function attachDeleteListeners() {
    const deleteButtons = document.querySelectorAll(DELETE_BUTTON_SELECTOR);
    const dialogExcluir = document.getElementById(DIALOG_ID);
    const btnConfirmarExclusao = document.getElementById(CONFIRM_ID);

    if (!dialogExcluir || !btnConfirmarExclusao) {
        console.error("ERRO JS: Dialog ou Botão de Confirmação não encontrados no HTML.");
        return;
    }
    
    // Configura o botão de fechar (CANCELAR/SAIR) dentro do Dialog
    const closeBtns = dialogExcluir.querySelectorAll('.sair, .close-modal');
    closeBtns.forEach(btn => {
        btn.onclick = () => {
            dialogExcluir.close();
        };
    });

    // Configura a ação final do botão "EXCLUIR PERMANENTEMENTE" (O botão vermelho do modal)
    btnConfirmarExclusao.onclick = () => {
        const veiculoId = btnConfirmarExclusao.getAttribute('data-veiculo-id');
        
        if (veiculoId) {
            // Redireciona para o script PHP de DELETE
            // Certifique-se que o arquivo excluir-veiculo.php está na mesma pasta (pages/)
            window.location.href = `excluir-veiculo.php?id=${veiculoId}`; 
        } else {
            alert("Erro: ID do veículo não encontrado para exclusão.");
            dialogExcluir.close();
        }
    };

    // Configura o clique nas lixeiras da lista
    deleteButtons.forEach(button => {
        button.onclick = (e) => {
            e.preventDefault(); // Evita comportamentos padrões
            
            const veiculoId = button.getAttribute('data-veiculo-id');
            
            // 1. Passa o ID para o botão de confirmação dentro do modal
            btnConfirmarExclusao.setAttribute('data-veiculo-id', veiculoId);
            
            // 2. Mostra o ID no texto do modal (para o usuário conferir)
            const dialogModeloCor = dialogExcluir.querySelector('#dialog-modelo-cor');
            if (dialogModeloCor) {
                 dialogModeloCor.textContent = `#${veiculoId}`; 
            }

            // 3. Abre a janela modal
            dialogExcluir.showModal();
        };
    });
}

// Inicializa a função quando o site carregar
document.addEventListener('DOMContentLoaded', attachDeleteListeners);