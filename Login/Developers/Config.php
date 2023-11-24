<?php
/*
    ***********************************************
    CONFIG.PHP - PARAMETRIZAÇÃO DE NOSSA APLICAÇÃO.
    ***********************************************
    Copyright (c) 2020, Jeferson Souza MESTRES DO PHP
*/


//Iniciando a Sessão em Toda Nossa Aplicação
session_start();

//Configurando o Timezone e a Data Hora do Nosso Servidor
date_default_timezone_set("America/Sao_paulo");


//Chamada da Conexão
require 'Connection.php';


/* Configurações de Níveis de Acesso */
define("LEVEL_USER", 1); //Nível de Acesso Para Usuários [Operacionais]
define("LEVEL_CLIENT", 2); //Nível de Acesso Para Clientes [Coordenadores de Equipes]
define("LEVEL_ADMIN", 9); //Nível de Acesso Para Administradores [Administrador Responsável pela Aplicação]
define("LEVEL_SUPER", 10); //Nível de Acesso Para Profissional Web [Você]

/* Configurações de Servidor de E-mail */
define("MAIL_HOST", "mail.servidor.com.br"); //Definição Configuração de Host do Servidor
define("MAIL_SMTP", "smtp.servidor.com.br"); //Definição Configuração de SMTP do Servidor
define("MAIL_USER", "contato@interligsolucoes.com.br"); //Definição Configuração de Login de Usuário
define("MAIL_PASS", "12344"); //Definição Configuração de Senha de Acesso
define("MAIL_RESPONSE", "contato@interligsolucoes.com.br"); //Definição Configuração de E-mail Para Resposta
define("MAIL_PORT", 465); //Definição Configuração de Porta do Servidor [587 ou 465]
define("MAIL_SECURE", "SSL"); //Definição Configuração de Segurança [TLS/SSL]

/*Configurações de Módulos*/
define('BLOCKED', 1); //Bloqueio o Usuário Após 6 Tentativas de Senha Errado
define('TIMESBLOCKED', 6); //Quantas Tentativas Usuário Pode Fazer Antes de Bloquear
define('REMEMBER', 1); //Lembrar Senha
define('TITLE_LOGIN', 'Smallcontrol'); //Nome da Aplicação
define('LOGINACTIVE', 1); //Login Ativo - Módulo Possibilita Acesso Direto, Se Houver Cookies. Para Funcionar Precisa do Remember Ativo.
define('LOGCREATE', 1); //Cria Log com .txt de Login (NOT APPLICATED)
define('LOGINHISTORY', 1); //Cria Histórico de Login - Salve no Banco de Dados. (NOT APPLICATED)