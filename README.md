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
6. [**Alterações Realizadas**](#alterações-realizadas)
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
git clone 
