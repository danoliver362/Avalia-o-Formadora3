<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include('conexao.php'); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $num_serie = $_POST['num_serie'];
    $id_cliente = $_POST['id_cliente']; 

    $sql = "INSERT INTO relogios (marca, modelo, num_serie, id_cliente)
            VALUES ('$marca', '$modelo', '$num_serie', '$id_cliente')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Relogio cadastrado com sucesso!');</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}

$sql_clientes = "SELECT id_cliente, nome, sobrenome FROM clientes";
$result_clientes = $conn->query($sql_clientes);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Relogio</title>
        <link rel="stylesheet" href="style.css">
    </head>
 <body>
    <h1>Cadastrar Relogios</h1>
    <form method="post">
        <label>Marca</label><br>
        <input type="text" name="marca" required><br><br>
        <label>Modelo</label><br>
        <input type="text" name="modelo" required><br><br>
        <label>Numero de Serie</label><br>
        <input type="text" name="num_serie" required><br><br>
        <label>ID do Cliente</label><br>
        <select name="id_cliente" required>
        <option value="">Selecione o Cliente</option>
           <?php
            if ($result_clientes->num_rows > 0) {
                while ($row = $result_clientes->fetch_assoc()) {
                    echo "<option value='{$row['id_cliente']}'>{$row['nome']} {$row['sobrenome']}</option>";
                }
            } else {
                echo "<option disabled>Nenhum cliente cadastrado</option>";
            }
            ?>
</select> <br> <br>

        <button type="submit">Cadastrar Relogio</button>
<br>
<br>

    </form>
    <a href="PaginaInicial.html">Voltar ao Inicio</a>
 </body>
</html>