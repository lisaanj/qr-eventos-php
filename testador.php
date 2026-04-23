<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gerenciar Obras</title>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/requestJson.js"></script>
    </head>
    <body>
        <h1>Obra</h1>
        <div>
            <!-- Realiza a consulta dos objetos no WS -->
            <input type="number" id="where" step="1" min="0">
            <button onclick="doGet($('#where').val())">GETObra</button>
        </div>
        <div>
            <!-- Campos para a criação de um novo objeto -->
            <label for="wNomeObra">Nome</label>
            <input type="text" id="wNomeObra">
            <br>
            <label for="wPreco">Preço</label>
            <input type="number" id="wPreco" step="0.01" min="0">
            <br>
            <label for="wLargura">Largura</label>
            <input type="text" id="wLargura">
            <br>
            <label for="wAltura">Altura</label>
            <input type="text" id="wAltura">
            <br>
            <label for="wDescricao">Descrição</label>
            <input type="text" id="wDescricao">
            <br>
            <label for="wDataCriacao">Data de criação</label>
            <input type="text" id="wDataCriacao">
            <br>
            <label for="wIdArtista">Artista</label>
            <input type="number" id="wIdArtista" step="1" min="0">
            <br>
            <!-- O método doPost() deve receber todos os valores que devem ser enviados ao WS -->
            <input type="button" onclick="doPost('Obra')" value="POSTObra">
        </div>
        <!-- Este elemento serve para mostrar na tela o retorno do WS -->
        <p id="obra"></p>
        <h1>Usuario</h1>

        <div>

            <label for="wNomeObra">Nome</label>
            <input type="text" id="wNome">
            <br>
            <label for="wPreco">Nickname</label>
            <input type="text" id="wNick" step="0.01" min="0">
            <br>
            <label for="wLargura">Sexo</label>
            <input type="text" id="wSexo">
            <br>
            <label for="wAltura">Email</label>
            <input type="text" id="wEmail">
            <br>
            <label for="wDescricao">Senha</label>
            <input type="text" id="wSenha">
            <br>
            <label for="wDataCriacao">Descrição</label>
            <input type="text" id="wDesc">
            <br>
            <label for="wIdArtista">Data nascimento</label>
            <input type="text" id="wData">
            <br>
            <!-- O método doPost() deve receber todos os valores que devem ser enviados ao WS -->
            <input type="button" onclick="doPost('User')" value="POSTUser">
        </div>


        <h1>Evento</h1>

        <div>
            
            <label for="wNomeEvento">Nome</label>
            <input type="text" id="wNomeEvento">
            <br>
            <label for="wLocal">Local</label>
            <input type="text" id="wLocal" step="0.01" min="0">
            <br>
            <label for="wDescricao">Descrição</label>
            <input type="text" id="wDescricao">
            <br>
            <label for="wLogo">DataEvento</label>
            <input type="text" id="wDataEvento">
            <br>
            <label for="wIdOrganizador">idOrganizador</label>
            <input type="number" id="wIdOrganizador" step="1" min="0">
            <br>
            <!-- O método doPost() deve receber todos os valores que devem ser enviados ao WS -->
            <input type="button" onclick="doPost('Evento')" value="POSTEvento">
            <!-- Este elemento serve para mostrar na tela o retorno do WS -->
            <p id="user"></p>
    </body>
</html>
