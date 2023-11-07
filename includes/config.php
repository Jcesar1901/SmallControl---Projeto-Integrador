<?php
/*
    ***********************************************
    CONFIG.PHP - PARAMETRIZAÇÃO DE NOSSA APLICAÇÃO.
    ***********************************************
    Copyright (c) 2020, Jeferson Souza MESTRES DO PHP
*/

//Iniciando a Sessão em Toda Nossa Aplicação
//session_start();
//Chamar a conexão
include_once 'connection.php';

$_SESSION['user'] = 'Jeferson Souza';

//Configurando o Timezone e a Data Hora do Nosso Servidor
date_default_timezone_set("America/Sao_paulo");

/*Configuações da Aplicação */
$configBase = "http://localhost/smallcontrol/"; //Url da Aplicação;
$titleSite = "Controle de Estoque"; //Título de sua Aplicação
$description = "Plataforma dedicada ao controle de estoque"; //Descrição da Aplicação
$mailSite = "contato@mestresdophp.com.br"; //E-mail do Cliente ou Dono da Aplicação
$phoneSite = "(XX) xxxxx-xxxx"; //Telefone do Cliente ou Empresa Cliente
$statusSite = 1; //0=>offline, 1=>online, 2=>maintenance  [Status da aplicação]
$helloBar = 1;  //0=>offline, 1=>online [Status do HelloBar]

/* Configurações do Autor */
$nameAuthorSite = "Mestres do PHP Treinamentos"; //Nome do Autor
$mainAuthorSite = "contato@interligsolucoes.com.br"; //E-mail do Autor
$phoneAuthorSite = "(XX) xxxxx-xxxx"; //Telefone do Autor

/* Configurações de Servidor de E-mail */
$mailHost = ""; //Definição Configuração de Host do Servidor
$mailSMTP =  ""; //Definição Configuração de SMTP do Servidor
$mailUser = ""; //Definição Configuração de Login de Usuário
$mailPass = ""; //Definição Configuração de Senha de Acesso
$mailResponse = ""; //Definição Configuração de E-mail Para Resposta
$mailPort = 465; //Definição Configuração de Porta do Servidor [587 ou 465]
$mailSecure = "SSL"; //Definição Configuração de Segurança [TLS/SSL]

/* Configurações de Temas */
$themeSite = "sistema"; //Definição Configuração Tema do Site

/* Configurações de Diretórios de Temas */
$themePathSite =  "Themes/".$themeSite; //Definição Configuração do Diretório do Tema do Site

/* Configurações de Níveis de Acesso */
define("LEVEL_USER", 1); //Nível de Acesso Para Usuários [Operacionais]
define("LEVEL_CLIENT", 2); //Nível de Acesso Para Clientes [Coordenadores de Equipes]
define("LEVEL_ADMIN", 9); //Nível de Acesso Para Administradores [Administrador Responsável pela Aplicação]
define("LEVEL_SUPER", 10); //Nível de Acesso Para Profissional Web [Você]

/* Configurações de Tabelas do Database */
define("DB_USER", "si_usuarios"); //Definição da Constante Para Tabela USERS
define("DB_CLIENTS", "si_clientes"); //Definição da Constante Para Tabela CLIENTS
define("DB_ORDERS", "si_pedidos"); //Definição da Constante Para Tabela ORDERS
define("DB_PRODUCT", "si_produtos"); //Definição da Constante Para Tabela PRODUCT
define("DB_PROVIDERS", "si_fornecedores"); //Definição da Constante Para Tabela PROVIDERS

define('BLOCKED', 1); //Bloqueio o Usuário Após 6 Tentativas de Senha Errado
define('TIMESBLOCKED', 6); //Quantas Tentativas Usuário Pode Fazer Antes de Bloquear
define('REMEMBER', 1); //Lembrar Senha


/*Criação do Guid*/
if (!function_exists('com_create_guid')) {
    function com_create_guid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
