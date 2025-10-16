<?php
// Inclui a conexão para que a variável $conexao esteja disponível.
include 'conexao.php';

// Define os 6 cargos solicitados para o <select>
$cargos = [
    "Auxiliar Administrativo", 
    "Analista de Projetos", 
    "Gerente de Projetos", 
    "Analista de Suporte", 
    "Programador Jr.", 
    "Analista de Sistemas"
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CADASTRO DE FUNCIONÁRIOS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { max-width: 900px; margin: 0 auto; background-color: white; padding: 30px; border: 1px solid #ccc; }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .form-box { border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; }
        .form-group { display: flex; flex-wrap: wrap; margin-bottom: 15px; gap: 20px; }
        .field { flex: 1; min-width: 250px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 12px; }
        input[type="text"], input[type="date"], input[type="number"], select { 
            width: 100%; padding: 8px; border: 1px solid #999; border-radius: 2px; box-sizing: border-box; 
            font-size: 14px;
        }
        input[disabled] { background-color: #eee; }
        .actions { text-align: center; margin-top: 30px; }
        button { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-cadastrar { background-color: #007bff; color: white; margin-right: 10px; }
        .btn-visualizar { background-color: transparent; color: blue; border: 1px solid blue; text-decoration: none; padding: 9px 20px; }
        
        /* Ajustes de layout da imagem */
        .field-full { flex: 1 1 100%; }
        .field-small { flex: 0 0 calc(33.33% - 14px); } /* 3 colunas */
        .field-medium { flex: 0 0 calc(50% - 10px); } /* 2 colunas */
    </style>
</head>
<body>

<div class="container">
    <h1>CADASTRO DE FUNCIONÁRIOS</h1>
    
    <form action="gravar.php" method="POST">
        <div class="form-box">
            <h3 style="margin-top: 0;">DADOS DO FUNCIONÁRIO</h3>
            
            <div class="form-group">
                <div class="field field-small">
                    <label for="n_registro">Nº REGISTRO</label>
                    <input type="text" id="n_registro" value="Automático" disabled>
                </div>

                <div class="field field-medium">
                    <label for="nome">NOME DO FUNCIONÁRIO</label>
                    <input type="text" id="nome" name="nome_funcionario" required>
                </div>
                
                <div class="field field-small">
                    <label for="data_admissao">DATA DE ADMISSÃO</label>
                    <input type="date" id="data_admissao" name="data_admissao" required>
                </div>
            </div>

            <div class="form-group">
                <div class="field field-medium">
                    <label for="cargo">CARGO (Adicionar 06 (seis) Cargos)</label>
                    <select id="cargo" name="cargo" required>
                        <option value="">Selecione um Cargo</option>
                        <?php foreach ($cargos as $c): ?>
                            <option value="<?php echo htmlspecialchars($c); ?>"><?php echo htmlspecialchars($c); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field field-medium">
                    <label for="qtde_salarios">QTDE DE SALÁRIOS MÍNIMOS</label>
                    <input type="number" id="qtde_salarios" name="qtde_salarios" step="0.01" min="0.01" required>
                </div>
            </div>
            
            </div>

        <div class="actions">
            <button type="submit" class="btn-cadastrar">CADASTRAR</button>
            <a href="listagem.php" class="btn-visualizar">VISUALIZAR DEMONSTRATIVOS DE PAGAMENTOS</a>
        </div>
    </form>
</div>

</body>
</html>