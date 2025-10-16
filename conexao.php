<?php
// Linha de correção: Define o fuso horário padrão para evitar o Warning
date_default_timezone_set('America/Sao_Paulo');

// Configurações do banco de dados
$servidor = "localhost";
$usuario = "root"; // Mude para o seu usuário
$senha = "usbw";       // Mude para sua senha
$banco = "folha_pagt";

// Valor de referência do Salário Mínimo e INSS, conforme o ENUNCIADO
const SALARIO_MINIMO = 1412.00;
const LIMITE_INSS = 1550.00;
const ALIQUOTA_INSS = 0.11; // 11%

// 1. Criar a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// 2. Checar a conexão
if ($conexao->connect_error) {
    die("Falha na conexão com o Banco de Dados: " . $conexao->connect_error);
}

// 3. Definir o charset para UTF-8
$conexao->set_charset("utf8");

// A variável $conexao será utilizada nos outros arquivos.
?>