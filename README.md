## WEB-CADASTRO-LOGIN-RESPONSIVO

# Projeto de Autenticação de Usuário

Bem-vindo ao projeto de autenticação de usuário! Este projeto fornece um sistema de autenticação básico para aplicativos da web. Os usuários podem se registrar, fazer login e acessar áreas restritas.



---

## Conteúdo

1. [**Visão Geral**](#visão-geral)
2. [**Recursos**](#recursos)
3. [**Pré-requisitos**](#pré-requisitos)
4. [**Instalação**](#instalação)
5. [**Uso**](#uso)
6. [**Alterações Realizadas**](#alterações-realizadas) 🆕⚠️
7. [**Prós e Contras**](#prós-e-contras)
8. [**Contribuindo**](#contribuindo)
9. [**Licença**](#licença)

---

## Visão Geral

Este projeto tem como objetivo oferecer uma solução de autenticação de usuário pronta para uso em aplicativos da web. Ele inclui páginas de registro e login, proteção de rotas autenticadas e integração com um banco de dados.

- Demonstração Página de Registro - Layout Desktop 
![Demonstração Página de Registro](https://media.discordapp.net/attachments/1162859199127109635/1162859374981677118/register_responsive.png?ex=653d782f&is=652b032f&hm=d7ea43f23f0e385c5005779114b58218fe13c0eb05235b1819ccf41a750e23ce&=&width=1223&height=628)

- Demonstração Página de Login - Layout Desktop 
![Demonstração Página de Login](https://media.discordapp.net/attachments/1162859199127109635/1162859374553862164/login_responsive.png?ex=653d782f&is=652b032f&hm=b1a2f4685e6cf7a47dae81024a1099e375fd3e745723027c63c776905eb8d6ba&=&width=908&height=628)

- Demonstração Página de Registro, Página de Login - Layout Responsivo Mobile
![Demonstração Página de Registro](https://media.discordapp.net/attachments/1162859199127109635/1162861934144671877/register_responsive_mobile.png?ex=653d7a92&is=652b0592&hm=8ecd6d1f99cbad1fb3afd8acd6fb3d0442cf82ce0895a7d48fc1b1aa2b1386ce&=&width=293&height=628) ![Demonstração Página de Login](https://media.discordapp.net/attachments/1162859199127109635/1162861933825896459/login_mobile_responsive.png?ex=653d7a91&is=652b0591&hm=bc7e4f5f21378c4aae171eeaa53f3b3f7e64843430c487715a7189721f3b6d92&=&width=290&height=627)

---

## Recursos

- **Registro de Conta**: Os usuários podem criar uma conta fornecendo um e-mail, senha e outras informações relevantes.

- **Login**: Usuários registrados podem fazer login na aplicação com seu e-mail e senha.

- **Proteção de Rotas Autenticadas**: As rotas restritas são protegidas. Os usuários não autenticados são redirecionados para a página de login.

- **Segurança**: Utiliza declarações preparadas para evitar injeção de SQL e inclui validação de formulário.

- **Base de Dados**: Integração com um banco de dados para armazenar informações de usuário.

---

## Pré-requisitos

Antes de começar, certifique-se de atender aos seguintes requisitos:

- PHP 7.0 ou superior
- MySQL ou outro banco de dados de sua escolha
- Servidor da web (por exemplo, Apache)

---

## Instalação

Siga estas etapas para instalar o projeto em seu ambiente local:

1. Clone este repositório:

```bash
git clone https://github.com/weiner-rezcue98/web-cadastro-login-responsivo.git
```
2. Configure o banco de dados editando o arquivo `includes/db_config.php`. Substitua as informações de host, usuário, senha e nome do banco de dados.

3. Importe o esquema do banco de dados a partir do arquivo `database.sql` em seu sistema de gerenciamento de banco de dados.

4. Execute a aplicação em seu servidor da web.

5. Acesse a aplicação em seu navegador.

---

## Uso

1. Acesse a página de registro para criar uma nova conta.

2. Após o registro, faça login na aplicação.

3. Você terá acesso às áreas restritas da aplicação.

---

## Alterações Realizadas

Neste projeto, foram feitas as seguintes alterações:

🆕 #Atualização do Projeto de Autenticação de Usuário 📅 17/10/2023

**Adição do Campo de Foto de Perfil**: Foi adicionado um campo de foto de perfil ao formulário de registro. Os usuários podem fazer o upload de uma imagem PNG ou JPG com tamanho máximo de 100MB.

**Alterações nos Códigos PHP**:

   - O arquivo `register.php` foi atualizado para processar o upload da foto de perfil e inserir os dados no banco de dados.

   ```php
   $userimage = file_get_contents($_FILES["userimage"]["tmp_name"]);
   $stmt = $conn->prepare("INSERT INTO usuarios (email, senha, imagem_perfil) VALUES (?, ?, ?)");
   $stmt->bind_param("sss", $useremail, $userpassword, $userimage);
   ```
📅 17/10/2023 - Páginas HTML:

Foram adicionadas páginas HTML para exibir mensagens de sucesso e erro após o registro. Personalize essas páginas de acordo com suas necessidades.
Instruções de Uso:
As instruções de uso foram atualizadas para refletir as novas funcionalidades. Os usuários podem se registrar com uma foto de perfil e acessar áreas restritas.
Para instalar e usar esta atualização, siga as etapas originais do projeto e as alterações mencionadas nesta atualização. Lembre-se de configurar a conexão com o banco de dados em db_config.php.


Outras:
📅 15/10/2023 - Adição de funcionalidade de autenticação de usuário.
📅 15/10/2023 - Criação de páginas de registro e login.
📅 15/10/2023 - Proteção de rotas autenticadas.

---

## Prós e Contras

#### Prós

- Fornece uma base sólida para adicionar autenticação a projetos web.
- Interface de usuário simples e amigável para registro e login.
- Uso de declarações preparadas para evitar injeção de SQL.
- Integração com banco de dados para armazenamento seguro de informações de usuário.

#### Contras

- Pode precisar de melhorias adicionais em termos de segurança, como hashing de senhas.
- O projeto é voltado para fins de aprendizado e pode precisar de personalização adicional para uso em produção.

---

## Contribuindo

Se você deseja contribuir para o projeto ou relatar problemas, sinta-se à vontade para abrir uma [issue](https://github.com/weiner-rezcue98/web-cadastro-login-responsivo/issues) ou enviar um [pull request](https://github.com/weiner-rezcue98/web-cadastro-login-responsivo/pulls).

---

## Licença

Este projeto está licenciado sob a Licença MIT - consulte o arquivo [LICENSE](LICENSE.txt) para obter detalhes.
