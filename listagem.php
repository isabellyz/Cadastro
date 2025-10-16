<?php
include 'conexao.php'; // Inclui a conexão

// 1. Lógica de Filtragem
$filtro_nome = '';
$condicao_sql = '';
if (isset($_GET['nome']) && !empty($_GET['nome'])) {
    $filtro_nome = $conexao->real_escape_string($_GET['nome']);
    // Adiciona a condição WHERE para buscar nomes que contenham o texto
    $condicao_sql = " WHERE Nome_Funcionario LIKE '%$filtro_nome%'";
}

// 2. Query para buscar os registros
$sql = "SELECT N_Registro, Nome_Funcionario, Data_Admissao, Cargo, Salario_Bruto, INSS, Salario_Liquido 
        FROM tb_funcionarios" . $condicao_sql . " ORDER BY Nome_Funcionario ASC";
$resultado = $conexao->query($sql);

$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>DEMONSTRATIVO DE RENDIMENTOS MENSAIS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 1200px; margin: 0 auto; background-color: white; padding: 30px; border: 1px solid #ccc; }
        h1 { text-align: center; color: #333; margin-bottom: 20px; }
        
        /* Estilos do filtro */
        .filter-form { display: flex; align-items: center; margin-bottom: 20px; }
        .filter-form label { margin-right: 10px; font-weight: bold; }
        .filter-form input[type="text"] { padding: 8px; border: 1px solid #ccc; border-radius: 4px; flex-grow: 1; max-width: 400px; margin-right: 10px; }
        .filter-form button, .filter-form a.btn-voltar { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; margin-left: 5px; text-decoration: none; text-align: center; }
        .btn-filtrar { background-color: #007bff; color: white; }
        .btn-voltar { background-color: #6c757d; color: white; }

        /* Estilos da tabela */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }
        th, td { border: 1px solid #ddd; padding: 10px 8px; text-align: left; }
        th { background-color: #e9e9e9; color: #333; font-weight: bold; }
        td { white-space: nowrap; }
        .text-center { text-align: center; }
        .delete-btn { color: #dc3545; font-size: 18px; text-decoration: none; display: block; text-align: center; }
    </style>
</head>
<body>

<div class="container">
    <h1>DEMONSTRATIVO DE RENDIMENTOS MENSAIS</h1>

    <form method="GET" action="listagem.php" class="filter-form">
        <label for="nome">DIGITE O NOME DO FUNCIONÁRIO :</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($filtro_nome); ?>" placeholder="Pesquisar por nome...">
        <button type="submit" class="btn-filtrar">FILTRAR</button>
        <a href="home_funcionarios.php" class="btn-voltar">VOLTAR</a>
    </form>

    <?php if ($resultado->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Nº REGISTRO</th>
                    <th>NOME FUNCIONÁRIO</th>
                    <th>DATA ADMISSÃO</th>
                    <th>CARGO</th>
                    <th>SALÁRIO BRUTO</th>
                    <th>INSS</th>
                    <th>SALÁRIO LÍQUIDO</th>
                    <th class="text-center">APAGAR</th>
                </tr>
            </thead>
            <tbody>
                <?php while($linha = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $linha["N_Registro"]; ?></td>
                        <td><?php echo $linha["Nome_Funcionario"]; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($linha["Data_Admissao"])); ?></td>
                        <td><?php echo $linha["Cargo"]; ?></td>
                        <td>R$ <?php echo number_format($linha["Salario_Bruto"], 2, ',', '.'); ?></td>
                        <td>
                            <?php 
                                $inss_val = $linha["INSS"];
                                if ($inss_val == 0.00) {
                                    echo "Isento";
                                } else {
                                    echo "R$ " . number_format($inss_val, 2, ',', '.');
                                }
                            ?>
                        </td>
                        <td>R$ <?php echo number_format($linha["Salario_Liquido"], 2, ',', '.'); ?></td>
                        <td class="text-center">
                            <a href='excluir.php?id=<?php echo $linha["N_Registro"]; ?>' class="delete-btn" title="Excluir Registro"
                               onclick="return confirm('ATENÇÃO: Deseja realmente excluir o funcionário <?php echo htmlspecialchars($linha["Nome_Funcionario"]); ?> (Reg: <?php echo $linha["N_Registro"]; ?>)?')">
                                X
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; margin-top: 40px; color: #555;">Nenhum funcionário encontrado com o filtro aplicado.
        <?php if (!empty($filtro_nome)): ?>
            <a href="listagem.php">Clique aqui para ver a lista completa.</a>
        <?php endif; ?>
        </p>
    <?php endif; ?>
</div>

</body>
</html>