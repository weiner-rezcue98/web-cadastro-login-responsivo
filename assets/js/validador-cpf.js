const cpfCheck = require('cpf-check');

// Exemplo de validação de CPF
const cpf = '123.456.789-09'; // Substitua pelo valor do campo de CPF do seu formulário
if (cpfCheck.validate(cpf)) {
    console.log('CPF válido');
} else {
    console.log('CPF inválido');
}
