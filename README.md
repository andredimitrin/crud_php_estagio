# Projeto CRUD Simples em PHP

Este é um projeto CRUD simples em PHP, destinado a operações básicas de gerenciamento de usuários. O sistema utiliza um banco de dados MySQL para armazenar informações como nome, CPF, data de nascimento, e outros detalhes.

## Estrutura do Projeto

- **index.php**: Lista os usuários e fornece opções de edição/exclusão.
- **editar.php**: Permite a edição das informações de um usuário existente.
- **editar_processa.php**: Processa a atualização do usuário.
- **cadastro.php**: Página para cadastrar novos usuários.
- **conexao.php**: Arquivo de configuração para a conexão com o banco de dados.

## Uso

1. Abra a página `index.php` para visualizar a lista de usuários.
2. Clique em "Editar" para modificar as informações de um usuário.
3. Clique em "Excluir" para remover um usuário.
4. Clique em "Adicionar Novo Usuário" para inserir um novo usuário.

## Configuração

### Requisitos
- PHP instalado (versão 5.6 ou superior)
- Servidor web (por exemplo, Apache) com suporte a PHP
- MySQL

### Instalação
1. Clone ou faça o download do projeto para o seu servidor web.
2. Configure as informações de conexão com o banco de dados no arquivo `conexao.php`.

    ```php
    $host = "seu_host";
    $usuario = "seu_usuario";
    $senha = "sua_senha";
    $banco = "sua_base_de_dados";

    $conn = new mysqli($host, $usuario, $senha, $banco);

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }
    ```

## Observações
Certifique-se de que o PHP está configurado corretamente em seu servidor. Este projeto é um exemplo básico e pode ser expandido conforme necessário para atender a requisitos específicos.
