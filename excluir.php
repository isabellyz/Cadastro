<?php
include 'conexao.php'; // Inclui a conexão

// Verifica se o ID do registro foi passado via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $n_registro = (int)$_GET['id'];
    
    // 1. Preparar a Query de Exclusão (DELETE)
    $sql = "DELETE FROM tb_funcionarios WHERE N_Registro = ?";

    // Prepara a declaração
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $n_registro); // 'i' para integer

    // 2. Executar a Query
    if ($stmt->execute()) {
        $mensagem = "Funcionário de Registro $n_registro excluído com sucesso!";
    } else {
        $mensagem = "Erro ao excluir funcionário: " . $stmt->error;
    }

    // 3. Fechar a declaração e a conexão
    $stmt->close();
    $conexao->close();

    // 4. Redirecionar de volta para a listagem
    echo "<script>alert('$mensagem'); window.location.href='listagem.php';</script>";

} else {
    // ID não fornecido ou inválido
    echo "<script>alert('Registro de funcionário não especificado ou inválido.'); window.location.href='listagem.php';</script>";
    exit();
}
?>