<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleconsulta1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>

          #select{
    color: #fff;
    font-size: 40px;
   
    
}


.aviso{
    align-items: center;
    position: absolute; 
    margin-top: 250px;
    text-align: center;
}
.link{
    text-align: center;
    display:flex;
    padding-top:20px;
    margin-left:90px; 
}
.link a{
    color: #fff;
    text-decoration: none;
    text-align: center;
    display:flex;
    position: absolute;
}
.link a:hover{
    color: #fff;
    text-decoration: underline;
}
    </style>
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
        echo "<div class='aviso'><span id='select'>😸​Sucess😸​</span>
        <div class='link'>
    <a href='index.php'><i class='bi bi-house'></i>Back</a>
    </div>
    </div>";
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Requisição inválida.";
}
?>