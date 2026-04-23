// Configuração da API
const API_URL = 'http://localhost/QReventos2/QReventos2';

// ===== LOGIN =====
function login() {
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const errorDiv = document.getElementById('loginError');
    const loadingDiv = document.getElementById('loginLoading');

    errorDiv.style.display = 'none';
    loadingDiv.style.display = 'block';

    const loginData = {
        email: email,
        senha: senha
    };

    fetch(`${API_URL}/wsLogin.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(loginData)
    })
    .then(response => response.json())
    .then(data => {
        loadingDiv.style.display = 'none';

        if (data.itens && data.itens.length > 0) {
            const usuario = data.itens[0];
            // Salvar dados do usuário no localStorage
            localStorage.setItem('usuario', JSON.stringify(usuario));
            // Redirecionar para dashboard
            window.location.href = 'dashboard.html';
        } else {
            errorDiv.textContent = 'Email ou senha inválidos!';
            errorDiv.style.display = 'block';
        }
    })
    .catch(error => {
        loadingDiv.style.display = 'none';
        errorDiv.textContent = 'Erro ao conectar com o servidor: ' + error.message;
        errorDiv.style.display = 'block';
    });
}

// ===== LOGOUT =====
function logout() {
    localStorage.removeItem('usuario');
    window.location.href = 'index.html';
}

// ===== VERIFICAR AUTENTICAÇÃO =====
function verificarAutenticacao() {
    const usuario = localStorage.getItem('usuario');
    if (!usuario && window.location.pathname.includes('dashboard.html')) {
        window.location.href = 'index.html';
    }
}

// ===== EXIBIR DADOS DO USUÁRIO =====
function exibirDadosUsuario() {
    const usuario = JSON.parse(localStorage.getItem('usuario'));
    if (usuario) {
        document.getElementById('userName').textContent = usuario.nome || 'Usuário';
    }
}

// ===== CARREGAR EVENTOS =====
function carregarEventos() {
    const eventosList = document.getElementById('eventosList');
    eventosList.innerHTML = '<p class="loading">Carregando eventos...</p>';

    fetch(`${API_URL}/wsEvento.php`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        eventosList.innerHTML = '';
        
        if (data.itens && data.itens.length > 0) {
            data.itens.forEach(evento => {
                const card = criarCardEvento(evento);
                eventosList.appendChild(card);
            });
        } else {
            eventosList.innerHTML = '<p>Nenhum evento disponível no momento.</p>';
        }
    })
    .catch(error => {
        eventosList.innerHTML = '<p class="error-message">Erro ao carregar eventos: ' + error.message + '</p>';
    });
}

// ===== CRIAR CARD DE EVENTO =====
function criarCardEvento(evento) {
    const card = document.createElement('div');
    card.className = 'card';
    
    const logoPath = evento.logo ? `${API_URL}/${evento.logo}` : 'https://via.placeholder.com/280x200?text=Sem+Imagem';
    
    card.innerHTML = `
        <img src="${logoPath}" alt="${evento.nomeEvento}" class="card-image" onerror="this.src='https://via.placeholder.com/280x200?text=Sem+Imagem'">
        <div class="card-title">${evento.nomeEvento}</div>
        <div class="card-subtitle">${evento.local}</div>
        <div class="card-info"><strong>Data:</strong> ${evento.dataHora}</div>
        <div class="card-text">${evento.descricao || 'Sem descrição'}</div>
    `;
    
    return card;
}

// ===== CRIAR EVENTO =====
function criarEvento(e) {
    e.preventDefault();

    const nomeEvento = document.getElementById('nomeEvento').value;
    const localEvento = document.getElementById('localEvento').value;
    const dataHoraEvento = document.getElementById('dataHoraEvento').value;
    const descricaoEvento = document.getElementById('descricaoEvento').value;
    const logoEvento = document.getElementById('logoEvento').files[0];
    const usuario = JSON.parse(localStorage.getItem('usuario'));

    if (!logoEvento) {
        mostrarMensagem('criarEventoMsg', 'Selecione uma imagem!', true);
        return;
    }

    // Converter imagem para Base64
    const reader = new FileReader();
    reader.onload = function(e) {
        const logoBase64 = e.target.result;

        const eventoData = {
            nomeEvento: nomeEvento,
            local: localEvento,
            dataHora: dataHoraEvento,
            descricao: descricaoEvento,
            logo: logoBase64,
            idOrganizador: usuario.id
        };

        fetch(`${API_URL}/wsEvento.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(eventoData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.id) {
                mostrarMensagem('criarEventoMsg', 'Evento criado com sucesso!', false);
                document.getElementById('criarEventoForm').reset();
                setTimeout(() => {
                    carregarEventos();
                    showSection('eventos');
                }, 2000);
            } else {
                mostrarMensagem('criarEventoMsg', 'Erro ao criar evento!', true);
            }
        })
        .catch(error => {
            mostrarMensagem('criarEventoMsg', 'Erro: ' + error.message, true);
        });
    };
    reader.readAsDataURL(logoEvento);
}

// ===== CARREGAR OBRAS =====
function carregarObras() {
    const usuario = JSON.parse(localStorage.getItem('usuario'));
    const obrasList = document.getElementById('obrasList');
    obrasList.innerHTML = '<p class="loading">Carregando obras...</p>';

    fetch(`${API_URL}/wsObra.php?id=${usuario.id}`, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        obrasList.innerHTML = '';
        
        if (data.itens && data.itens.length > 0) {
            data.itens.forEach(obra => {
                const card = criarCardObra(obra);
                obrasList.appendChild(card);
            });
        } else {
            obrasList.innerHTML = '<p>Você não tem obras cadastradas ainda.</p>';
        }
    })
    .catch(error => {
        obrasList.innerHTML = '<p class="error-message">Erro ao carregar obras: ' + error.message + '</p>';
    });
}

// ===== CRIAR CARD DE OBRA =====
function criarCardObra(obra) {
    const card = document.createElement('div');
    card.className = 'card';
    
    const imagemPath = obra.obraFoto ? `${API_URL}/${obra.obraFoto}` : 'https://via.placeholder.com/280x200?text=Sem+Imagem';
    
    card.innerHTML = `
        <img src="${imagemPath}" alt="${obra.nomeObra}" class="card-image" onerror="this.src='https://via.placeholder.com/280x200?text=Sem+Imagem'">
        <div class="card-title">${obra.nomeObra}</div>
        <div class="card-info"><strong>Preço:</strong> R$ ${parseFloat(obra.preco).toFixed(2)}</div>
        <div class="card-info"><strong>Dimensões:</strong> ${obra.altura}cm x ${obra.largura}cm</div>
        <div class="card-info"><strong>Data:</strong> ${obra.dataObra}</div>
        <div class="card-text">${obra.descricao || 'Sem descrição'}</div>
    `;
    
    return card;
}

// ===== CRIAR OBRA =====
function criarObra(e) {
    e.preventDefault();

    const nomeObra = document.getElementById('nomeObra').value;
    const alturaObra = document.getElementById('alturaObra').value;
    const larguraObra = document.getElementById('larguraObra').value;
    const precoObra = document.getElementById('precoObra').value;
    const descricaoObra = document.getElementById('descricaoObra').value;
    const dataObra = document.getElementById('dataObra').value;
    const imagemObra = document.getElementById('imagemObra').files[0];
    const usuario = JSON.parse(localStorage.getItem('usuario'));

    if (!imagemObra) {
        mostrarMensagem('criarObraMsg', 'Selecione uma imagem!', true);
        return;
    }

    // Converter imagem para Base64
    const reader = new FileReader();
    reader.onload = function(e) {
        const imagemBase64 = e.target.result;

        const obraData = {
            nomeObra: nomeObra,
            altura: alturaObra,
            largura: larguraObra,
            preco: precoObra,
            descricao: descricaoObra,
            dataObra: dataObra,
            obraFoto: imagemBase64,
            idArtista: usuario.id
        };

        fetch(`${API_URL}/wsObra.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(obraData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.itens) {
                mostrarMensagem('criarObraMsg', 'Obra cadastrada com sucesso!', false);
                document.getElementById('criarObraForm').reset();
                setTimeout(() => {
                    carregarObras();
                    showSection('obras');
                }, 2000);
            } else {
                mostrarMensagem('criarObraMsg', 'Erro ao cadastrar obra!', true);
            }
        })
        .catch(error => {
            mostrarMensagem('criarObraMsg', 'Erro: ' + error.message, true);
        });
    };
    reader.readAsDataURL(imagemObra);
}

// ===== EXIBIR SEÇÃO =====
function showSection(sectionId) {
    // Esconder todas as seções
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });

    // Remover active de todos os links
    document.querySelectorAll('.menu-link').forEach(link => {
        link.classList.remove('active');
    });

    // Mostrar seção selecionada
    document.getElementById(sectionId).classList.add('active');

    // Marcar link como ativo
    event.target.classList.add('active');

    // Carregar dados se necessário
    if (sectionId === 'obras') {
        carregarObras();
    }
}

// ===== MOSTRAR MENSAGEM =====
function mostrarMensagem(elementId, mensagem, isError = false) {
    const msgDiv = document.getElementById(elementId);
    msgDiv.textContent = mensagem;
    msgDiv.className = isError ? 'message error' : 'message';
    msgDiv.style.display = 'block';

    setTimeout(() => {
        msgDiv.style.display = 'none';
    }, 5000);
}

// Verificar autenticação ao carregar
window.addEventListener('load', verificarAutenticacao);