<?php
/*
    ***********************************************
    CONNECTION.PHP - PARAMETRIZAÇÃO DA CONEXÃO COM BANCO DE DADOS DE NOSSA APLICAÇÃO.
    ***********************************************
    Copyright (c) 2020, Jeferson Souza INTERLIG SOLUÇÕES INTELIGENTES
*/

$pdo = new PDO ("mysql: host= localhost; dbname=login", "root" , "");
$pdo -> exec("SET NAMES utf8");

?>