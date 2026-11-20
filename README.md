# Classics

Plataforma web para divulgação e agendamento de atividades de lazer e turismo em Foz do Iguaçu, desenvolvida como Projeto de Conclusão de Curso (TDS).

Visitantes pesquisam atividades por nome, cidade, categoria e data. Clientes reservam sessões, favoritam e avaliam atividades. Empresas prestadoras cadastram atividades, sessões e categorias e respondem às reservas. O administrador aprova as empresas e mantém usuários, empresas e atividades.

## Tecnologias

- PHP 8 com arquitetura MVC própria, sem frameworks (Controller → Service → Repository → Model/View)
- MySQL com PDO e consultas preparadas
- HTML, CSS, JavaScript e Bootstrap 5

## Requisitos

- PHP 8.1 ou superior com as extensões `pdo_mysql`, `fileinfo`, `mbstring` e `gd` (já vêm no XAMPP)
- MySQL 8 ou MariaDB 10.4 ou superior (o do XAMPP serve)

## Instalação

### 1. Banco de dados

**Automático:** com o MySQL ligado e a senha certa no `Config.php` (passo 2), o primeiro acesso ao site cria o banco `Classics` com todas as tabelas e o administrador inicial.

**Manual** (phpMyAdmin ou terminal):

1. Crie o banco `Classics` com o agrupamento `utf8mb4_general_ci`.
2. Com o banco `Classics` selecionado, importe nesta ordem:
   1. `Classics/app/database/scripts/script.sql`: cria as tabelas;
   2. `Classics/app/database/scripts/admin.sql`: cria o administrador.

```bash
mysql -u root -p -e "CREATE DATABASE Classics CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci"
mysql -u root -p Classics < Classics/app/database/scripts/script.sql
mysql -u root -p Classics < Classics/app/database/scripts/admin.sql
```

**Dados de demonstração (opcional):** para já ter empresas e atividades no catálogo, importe também `Classics/app/database/scripts/dados_demonstracao.sql` no banco `Classics`. Ele cria 7 empresas (5 aprovadas e 2 pendentes) e 11 atividades com sessões nos próximos dias. A senha de todas as empresas é `Empresa@123`.

```bash
mysql -u root -p Classics < Classics/app/database/scripts/dados_demonstracao.sql
```

### 2. Conexão com o banco

Em `Classics/app/config/Config.php`, ajuste o usuário e a senha do seu MySQL:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'Classics');
define('DB_USER', 'root');
define('DB_PASS', 'bancodedados'); // no XAMPP, normalmente a senha é vazia: ''
```

### 3. Executar

O site precisa ser servido a partir da pasta `public`. A forma mais simples é o servidor embutido do PHP:

```bash
cd Classics/public
php -S localhost:8080
```

Acesse **http://localhost:8080**.

Se aparecer a mensagem "Não foi possível conectar ao banco de dados", confira se o MySQL está ligado e se `DB_USER` e `DB_PASS` estão corretos no `Config.php`.

Para abrir em outro computador ou no celular da mesma rede, rode `php -S 0.0.0.0:8080` e acesse `http://IP-DO-COMPUTADOR:8080`.

> No Windows com XAMPP, o comando fica `C:\xampp\php\php.exe -S localhost:8080`, rodado dentro da pasta `public`. Abrir o projeto por `http://localhost/Classics/public` não funciona, porque as rotas partem da raiz do endereço.

## Acesso inicial

| Perfil | E-mail | Senha |
|---|---|---|
| Administrador | admin@gmail.com | Admin@123 |
| Empresas de demonstração (se importadas) | ex.: contato@aventurasradicais.com.br | Empresa@123 |

Clientes e empresas são criados pela tela **Criar conta**. Toda empresa nova começa como **pendente** e só pode cadastrar atividades depois que o administrador a aprova no painel.

## Fluxo sugerido para testar

1. **Empresa:** em Criar conta → Empresa, cadastre uma empresa.
2. **Administrador:** entre como admin e aprove a empresa no Painel.
3. **Empresa:** entre como empresa, cadastre uma categoria e uma atividade (dados, localização e ao menos uma sessão futura).
4. **Cliente:** em Criar conta → Cliente, cadastre um cliente (maior de 18 anos), abra a atividade e faça uma reserva.
5. **Empresa:** em Reservas, aceite ou recuse a solicitação. O cliente recebe a notificação no sino.

## Regras principais

- E-mail único entre clientes, empresas e administradores.
- Senha com pelo menos 8 caracteres, uma letra maiúscula e um número, armazenada com bcrypt.
- Cliente com idade entre 18 e 120 anos; CPF, CNPJ e telefone são validados.
- Somente empresas aprovadas publicam atividades e recebem reservas.
- Só aparecem no catálogo as atividades com sessão futura e vagas disponíveis.
- Toda reserva nasce pendente e é confirmada pela empresa; as vagas são reservadas na hora e devolvidas na recusa ou no cancelamento.
- Só pode avaliar quem participou da atividade (reserva confirmada com a sessão já realizada).

## Estrutura

```
Classics/
├── app/
│   ├── config/        Configuração (banco, URL, fuso horário)
│   ├── controllers/   Recebem as requisições
│   ├── core/          Router (Front Controller), Controller base e Autoload
│   ├── database/      Scripts SQL
│   ├── helpers/       Validação, formatação e upload de imagens
│   ├── models/        Entidades
│   ├── repositories/  Acesso ao banco (PDO)
│   ├── services/      Regras de negócio
│   └── views/         Telas
└── public/            Ponto de entrada (index.php), CSS, JS, imagens e uploads
```
