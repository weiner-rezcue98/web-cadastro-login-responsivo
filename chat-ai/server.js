const http = require('http');
const express = require('express');
const { Server } = require('socket.io');
const mysql = require('mysql'); // Importe o módulo do MySQL

const app = express();
const server = http.createServer(app);
const io = new Server(server);

// Configurações de conexão ao banco de dados
const db = mysql.createConnection({
   host: 'localhost',
   user: 'root',
   password: '',
   database: 'sua_basedados'
});

db.connect((err) => {
   if (err) {
       console.error('Erro na conexão ao banco de dados:', err);
       return;
   }
   console.log('Conectado ao banco de dados');
});

app.get('/', (req, res) => {
   res.sendFile(__dirname + '/index.html');
});

io.on('connection', (socket) => {
   console.log('Um usuário se conectou');

   socket.on('chat message', (message) => {
       io.emit('chat message', message);
   });

   socket.on('disconnect', () => {
       console.log('Um usuário se desconectou');
   });
});

server.listen(3000, () => {
   console.log('Servidor está rodando em http://localhost:3000');
});
