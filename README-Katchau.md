# 🚗 Katchau

**Katchau** é um sistema de gerenciamento de veículos desenvolvido em **PHP** com banco de dados **MySQL** — projeto interdisciplinar do curso técnico de Desenvolvimento de Sistemas na **Etec Dra. Ruth Cardoso**, com proposta de comercialização real.

## 📋 Sobre o Projeto

O **Katchau** é um sistema web completo para gerenciamento de veículos, desenvolvido como trabalho interdisciplinar do ensino técnico. O sistema permite cadastrar, consultar, editar e remover veículos de uma frota ou estoque, com interface web e backend em PHP conectado a banco de dados MySQL. O projeto foi desenvolvido com proposta de ser vendido como solução real.

## 🖥️ Tecnologias Utilizadas

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

- **PHP** — backend e lógica de servidor
- **MySQL** — banco de dados relacional
- **HTML5 + CSS3** — interface do sistema
- **JavaScript** — interatividade no frontend

## 📁 Estrutura do Projeto

```
Katchau/
├── index.php               # Página principal / entrada do sistema
├── pages/                  # Páginas do sistema (CRUD, listagem, etc.)
├── php/                    # Scripts PHP (conexão, lógica de negócio)
├── css/                    # Folhas de estilo
├── js/                     # Scripts JavaScript
├── img/                    # Imagens e assets
└── dump_db_katchau.sql     # Script SQL com estrutura do banco de dados
```

## ✨ Funcionalidades

- Cadastro de veículos com dados completos (modelo, marca, ano, placa, cor, etc.)
- Listagem e busca de veículos
- Edição e exclusão de registros
- Gerenciamento de estoque/frota
- Interface administrativa completa
- Banco de dados relacional com exportação SQL

## 🗄️ Banco de Dados

O projeto inclui o arquivo `dump_db_katchau.sql` com a estrutura completa do banco de dados. Importe-o no MySQL antes de rodar o sistema:

```sql
mysql -u root -p katchau < dump_db_katchau.sql
```

## 🚀 Como Executar

### Pré-requisitos

- PHP 7.4+ instalado
- MySQL instalado
- Servidor web local (XAMPP, WAMP, Laragon, ou similar)

### Instalação

```bash
# Clone o repositório
git clone https://github.com/bryanwinchezz/Katchau.git

# Mova para a pasta do servidor web
# (Ex: C:/xampp/htdocs/Katchau ou /var/www/html/Katchau)

# Importe o banco de dados
mysql -u root -p < dump_db_katchau.sql
```

### Configuração do Banco de Dados

Edite o arquivo de conexão em `php/` com suas credenciais MySQL:

```php
$host = 'localhost';
$db   = 'katchau';
$user = 'root';
$pass = 'sua_senha';
```

### Acesso

Inicie o XAMPP (ou seu servidor) e acesse:

```
http://localhost/Katchau
```

## 🏫 Contexto Acadêmico

Projeto interdisciplinar desenvolvido na **Etec Doutora Ruth Cardoso** — São Vicente/SP, como trabalho do curso técnico de **Desenvolvimento de Sistemas**, integrando disciplinas de programação web, banco de dados e desenvolvimento de sistemas. O projeto foi concebido com proposta de comercialização real como solução de gestão de veículos.

## 👨‍💻 Autor

**bryanwinchezz (Kauan Bryan)**

[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/bryanwinchezz)
[![LinkedIn](https://img.shields.io/static/v1?message=LinkedIn&logo=linkedin&label=&color=0077B5&logoColor=white&labelColor=&style=for-the-badge)](https://www.linkedin.com/in/kauan-bryan-silveira-silva-416102350)

---

> Katchau — gerenciamento de veículos simples, rápido e eficiente. 🚘
