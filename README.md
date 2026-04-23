# QR Eventos PHP Backend

Backend em PHP para o sistema QR Eventos - TCC de gerenciamento de eventos e obras artísticas.

## Funcionalidades

- **Autenticação de usuários** (`wsLogin.php`)
- **Gerenciamento de eventos** (`wsEvento.php`)
- **Cadastro de obras artísticas** (`wsObra.php`)
- **Upload de imagens** (`foto.php`)
- **Geração de PDF e QR Code** (pasta GeradorPDF)

## Estrutura do Projeto

- `Classes/` - Modelos PHP (Evento, Obra, Usuario, Foto)
- `Dao/` - Acesso a dados (EventoDao, ObraDao, UsuarioDao, FotoDao)
- `ws*.php` - Endpoints da API REST
- `GeradorPDF/` - Biblioteca para geração de PDF e QR Code
- `img/` - Diretório para armazenamento de imagens

## Tecnologias

- PHP 7+
- MySQL/MariaDB
- API REST (JSON)
- Upload de imagens em Base64
- Biblioteca mPDF para PDF
- Biblioteca QR Code

## Como usar

1. Configure o banco de dados MySQL com as tabelas necessárias
2. Ajuste as credenciais em `Dao/Conexao.php`
3. Execute os arquivos PHP em um servidor web (Apache/Nginx)
4. Use endpoints como:
   - `POST /wsLogin.php` - Login
   - `GET /wsEvento.php` - Listar eventos
   - `POST /wsEvento.php` - Criar evento
   - `POST /wsObra.php` - Cadastrar obra

## Banco de Dados

Tabelas principais:
- `usuario` - Usuários do sistema
- `evento` - Eventos cadastrados
- `obra` - Obras artísticas
- `foto` - Imagens armazenadas

## Demo

Em breve: interface web para demonstrar o uso da API.

## Autor

Desenvolvido como TCC - Sistema de gerenciamento de eventos com QR Code.