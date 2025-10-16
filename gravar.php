<?php
include 'conexao.php'; // Inclui a conexão e as constantes de cálculo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Receber e Sanear os dados do formulário
    $nome_funcionario = $conexao->real_escape_string($_POST['nome_funcionario']);
    $data_admissao    = $conexao->real_escape_string($_POST['data_admissao']);
    $cargo            = $conexao->real_escape_string($_POST['cargo']);
    $qtde_salarios    = (float)$_POST['qtde_salarios'];
    
    // 2. Cálculo do Salário Bruto
    $salario_bruto = $qtde_salarios * SALARIO_MINIMO;
    
    // 3. Lógica de Cálculo do INSS conforme o ENUNCIADO:
    // Salário bruto superior a R$ 1.550,00, aplicar alíquota de 11%. Caso contrário, isenção.
    $inss = 0.00;
    if ($salario_bruto > LIMITE_INSS) {
        $inss = $salario_bruto * ALIQUOTA_INSS; // 11% sobre o salário bruto
    }

    // 4. Cálculo do Salário Líquido
    $salario_liquido = $salario_bruto - $inss;
    
    // 5. Preparar e Executar a Query de Inserção (CREATE)
    $sql = "INSERT INTO tb_funcionarios (Nome_Funcionario, Data_Admissao, Cargo, Qtde_Salarios, Salario_Bruto, INSS, Salario_Liquido) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração (previne SQL Injection)
    $stmt = $conexao->prepare($sql);
    // Tipos de dados: s=string, i=integer, d=double/float
    $stmt->bind_param("sssiddd", $nome_funcionario, $data_admissao, $cargo, $qtde_salarios, $salario_bruto, $inss, $salario_liquido);

    if ($stmt->execute()) {
        $mensagem = "Funcionário cadastrado com sucesso! Salário Bruto: R$ " . number_format($salario_bruto, 2, ',', '.') . " | INSS: R$ " . number_format($inss, 2, ',', '.');
    } else {
        $mensagem = "Erro ao cadastrar funcionário: " . $stmt->error;
    }
    
    // 6. Fechar a declaração e a conexão
    $stmt->close();
    $conexao->close();

    // 7. Redirecionar de volta para a home (ou ir para a listagem)
    echo "<script>alert('$mensagem'); window.location.href='home_funcionarios.php';</script>";
    exit();
} else {
    // Acesso direto, redireciona para a home
    header("Location: home_funcionarios.php");
    exit();
}
?>