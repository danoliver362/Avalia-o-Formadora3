<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('conexao.php');
if ($_SERVER['REQUEST_METHOD']== "POST"){
    $descricao = $_POST['descricao'];
    $data_entrada = $_POST['data_entrada'];
    $valor = $_POST['valor'];
    $forma_pgt = $_POST['forma_pgt'];
    $garantia = $_POST['garantia'];
    $id_relogio = $_POST['id_relogio'];
    $status = $_POST['status'];

    $sql = "INSERT INTO ordens_servico(descricao, data_entrada, valor, forma_pgt, garantia, id_relogio, status)
            VALUES ('$descricao', '$data_entrada', '$valor', '$forma_pgt', '$garantia', '$id_relogio', '$status')";
            
            if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Ordem de Serviço cadastrada com sucesso!');</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
$sql_relogios = "SELECT id_relogio, marca, modelo FROM relogios";
$result_relogios = $conn->query($sql_relogios);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Ordem de Serviço</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Cadastrar Ordem de Serviço</h1>
        <form method="post">
       <label>Descrição</label><br>
        <textarea name="descricao" rows="4" cols="50" required placeholder="Descreva aqui qual o serviço sera feito no relogio"></textarea><br><br>
        <label>Data de Entrada</label><br>
        <input type="date" name="data_entrada" required><br><br>
        <label>Valor</label><br>
        <input type="text" name="valor" required><br><br>
        <select name="forma_pgt" required>
        <option value="">Selecione a forma de pagamento</option>
        <option value="Dinheiro">Dinheiro</option>
        <option value="Cartão de Crédito">Cartão de Crédito</option>
        <option value="Cartão de Débito">Cartão de Débito</option>
        <option value="PIX">PIX</option>
        </select> <br><br>

        <label>Garantia</label><br>
        <input type="text" name="garantia" required><br><br>
        <label>Status</label>
        <select name="status" required><br>
        <option value="">Selecione um tipo</option>
        <option value="Em Análise">Em Análise</option>
        <option value="Em conserto">Em conserto</option>
        <option value="Concluído">Concluído</option>
        <option value="Aguardando retirada">Aguardando retirada</option>
</select>
        <label>ID do Relógio</label>
        <select name="id_relogio" required><br><br>
        <option value="">Selecione o Relógio</option>
           <?php
            if ($result_relogios->num_rows > 0) {
                while ($row = $result_relogios->fetch_assoc()) {
                    echo "<option value='{$row['id_relogio']}'>{$row['marca']} {$row['modelo']}</option>";
                }
            } else {
                echo "<option disabled>Nenhum relogio encontrado</option>";
            }
            ?>
            </select>
<br><br>
            <button type="submit">Cadastrar Ordem de Servico</button>


        </form>
        <br>
    <a href="PaginaInicial.html">Voltar ao Inicio</a>
    </body>
</html>