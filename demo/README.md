# QR Eventos - Demo Web

Interface web para demonstrar o funcionamento da API PHP do sistema QR Eventos.

## Funcionalidades

- ✅ Login de usuários
- ✅ Listagem de eventos
- ✅ Criação de novo evento
- ✅ Cadastro de obras artísticas
- ✅ Visualização de minhas obras
- ✅ Upload de imagens em Base64

## Como usar

### 1. Estrutura necessária

```
QReventos2/
├── demo/
│   ├── index.html
│   ├── dashboard.html
│   ├── style.css
│   ├── app.js
│   └── README.md
├── Classes/
├── Dao/
├── GeradorPDF/
├── wsLogin.php
├── wsEvento.php
├── wsObra.php
└── ... (outros arquivos)
```

### 2. Configurar servidor local

#### Opção A: Com XAMPP/WAMP

1. Coloque a pasta `QReventos2` em `C:\xampp\htdocs\` (XAMPP) ou `C:\wamp\www\` (WAMP)
2. Inicie o Apache e MySQL
3. Acesse: `http://localhost/QReventos2/QReventos2/demo/index.html`

#### Opção B: Com PHP Built-in Server

```bash
cd c:\Users\USER\Downloads\QReventos2\QReventos2
php -S localhost:8000
```

Depois acesse: `http://localhost:8000/demo/index.html`

### 3. Configurar Banco de Dados

Edite `Dao/Conexao.php` com suas credenciais:

```php
private $servidor = "localhost";
private $banco = "qreventos";
private $usuario = "root";
private $senha = "";
```

### 4. Criar tabelas do banco (exemplo)

```sql
CREATE TABLE usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    nickname VARCHAR(100),
    sexo VARCHAR(10),
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    descricao TEXT,
    dataNascimento DATE,
    idFoto INT
);

CREATE TABLE evento (
    idEvento INT PRIMARY KEY AUTO_INCREMENT,
    nomeEvento VARCHAR(255) NOT NULL,
    local VARCHAR(255),
    dataHora DATETIME,
    descricao TEXT,
    idOrganizador INT,
    idFoto INT,
    FOREIGN KEY (idOrganizador) REFERENCES usuario(id)
);

CREATE TABLE obra (
    idObra INT PRIMARY KEY AUTO_INCREMENT,
    nomeObra VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2),
    largura DECIMAL(10, 2),
    altura DECIMAL(10, 2),
    descricao TEXT,
    dataObra DATE,
    idArtista INT,
    idFoto INT,
    FOREIGN KEY (idArtista) REFERENCES usuario(id)
);

CREATE TABLE foto (
    idFoto INT PRIMARY KEY AUTO_INCREMENT,
    foto VARCHAR(500)
);
```

### 5. Testar a demo

1. Abra `http://localhost:8000/demo/index.html` (ou conforme sua configuração)
2. Faça login com credenciais do banco
3. Liste eventos
4. Crie um novo evento
5. Cadastre uma obra

## Fluxo da Demo

### Login
- Email e senha
- Verifica com `wsLogin.php`
- Salva dados do usuário no localStorage
- Redireciona para dashboard

### Dashboard
- **Eventos**: Lista todos os eventos do banco
- **Minhas Obras**: Lista obras do usuário logado
- **Novo Evento**: Cria evento com upload de logo
- **Cadastrar Obra**: Cadastra obra com upload de imagem

## Estrutura de Requisições

### Login
```
POST /wsLogin.php
{
    "email": "user@example.com",
    "senha": "senha123"
}
```

### Listar Eventos
```
GET /wsEvento.php
```

### Criar Evento
```
POST /wsEvento.php
{
    "nomeEvento": "Nome",
    "local": "Local",
    "dataHora": "2026-04-23T15:30",
    "descricao": "Descrição",
    "logo": "data:image/png;base64,...",
    "idOrganizador": 1
}
```

### Listar Obras do Usuário
```
GET /wsObra.php?id=1
```

### Cadastrar Obra
```
POST /wsObra.php
{
    "nomeObra": "Nome",
    "altura": 100,
    "largura": 80,
    "preco": 500.00,
    "descricao": "Descrição",
    "dataObra": "2026-04-23",
    "obraFoto": "data:image/png;base64,...",
    "idArtista": 1
}
```

## Notas Importantes

- A imagem é convertida para Base64 no navegador antes de ser enviada
- O servidor PHP deve ter `img/` com permissão de escrita para salvar as imagens
- CORS pode ser necessário dependendo da configuração do servidor
- O localStorage é usado para manter a sessão do usuário

## Melhorias Futuras

- [ ] Autenticação com sessão no servidor
- [ ] Validação mais robusta no backend
- [ ] Sistema de filtros para eventos
- [ ] Edição de evento/obra
- [ ] Deletar evento/obra
- [ ] Geração de QR Code
- [ ] Download de PDF do evento
- [ ] Integração com app mobile Android

## Autor

Parte da demo do TCC - QR Eventos (IFRN Informática)