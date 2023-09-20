<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleconsulta.css">
    <title>CRUD | Banco de dados</title>
</head>
<body>

    
</body>
</html>

<?php 
include("bd.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['code'])) {
    $code = $_POST['code'];
    $newtitle = $_POST['newtitle'];
    $newsubtitle = $_POST['newsubtitle'];
    $newgender = $_POST['newgender'];
    $newfoto = $_FILES["newfoto"];
    
    try {
        $pdo = conectarBD();
        if ($newfoto["size"] > 0) {
            $fotoBinario = file_get_contents($newfoto['tmp_name']);
            $stmt = $pdo->prepare('UPDATE biblioteca SET title = :newtitle, subtitle = :newsubtitle, gender = :newgender, foto = :newfoto WHERE code = :code');
            $stmt->bindParam(':newtitle', $newtitle);
            $stmt->bindParam(':newsubtitle', $newsubtitle);
            $stmt->bindParam(':newgender', $newgender);
            $stmt->bindParam(':newfoto', $fotoBinario, PDO::PARAM_LOB);
            $stmt->bindParam(':code', $code);
        } else {
            $stmt = $pdo->prepare('UPDATE biblioteca SET title = :newtitle, subtitle = :newsubtitle, gender = :newgender WHERE code = :code');
            $stmt->bindParam(':newtitle', $newtitle);
            $stmt->bindParam(':newsubtitle', $newsubtitle);
            $stmt->bindParam(':newgender', $newgender);
            $stmt->bindParam(':code', $code);
        }
        $stmt->execute();
        echo "Os dados do filme foram alterados!";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Requisição inválida.";
}
?>