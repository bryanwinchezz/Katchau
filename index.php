<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle | Katchau</title>
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="cabecalho">
        <nav>
            <a href="index.php" class="logo"><img src="img/favicon.png" alt="logo"></a>
        </nav>
    </header>

    <div class="inicio">
        <div class="nome">
            <h1>KATCHAU <span style="font-size: 0.5em; color: var(--text-muted);">CADASTROS</span></h1>
            <p style="color: #FFF; font-weight: bold;">Bem-vindo ao sistema de gestão de veículos.</p>
        </div>

        <div class="dashboard-grid">
            <a href="pages/cad-veiculo.php">
                <div class="card-menu">
                    <h1 style="font-size: 3rem;">🚗</h1>
                    <h2>Novo Veículo</h2>
                    <p style="color: #666; margin-top: 10px;">Cadastre um novo carro no estoque.</p>
                </div>
            </a>

            <a href="pages/list-veiculos.php">
                <div class="card-menu">
                    <h1 style="font-size: 3rem;">📋</h1>
                    <h2>Estoque</h2>
                    <p style="color: #666; margin-top: 10px;">Visualize, filtre e edite os veículos.</p>
                </div>
            </a>

            <a href="pages/cad-parametros.php">
                <div class="card-menu">
                    <h1 style="font-size: 3rem;">⚙️</h1>
                    <h2>Parâmetros</h2>
                    <p style="color: #666; margin-top: 10px;">Gerencie modelos, cores e marcas.</p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>