<?php


$pdo = new PDO("mysql:host=143.106.241.3;dbname=cl201287;charset=utf8", "cl201287", "cl*17082005");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $stmt = $pdo->prepare("SELECT * FROM resenha ORDER BY autorResenha");
    $stmt->execute();

    $fp = fopen('arquivoReviews.csv', 'w');
    
    $colunasTitulo = array("autorResenha", "tituloResenha", "resenha");

    fputcsv($fp, $colunasTitulo);

    while ($row = $stmt->fetch()) {
        $autorResenha = $row["autorResenha"];  
        $tituloResenha = $row["tituloResenha"];
        $resenha = $row["resenha"];
    
      

        $linha = array($autorResenha, $tituloResenha, $resenha);

        fputcsv($fp, $linha);
    }

    $msg = "Arquivo gerado: arquivoReview.csv";    
    fclose($fp);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listagem Review</title>
    <link rel="stylesheet" href="home2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .div-h1 h1 {
     margin-left: 0px; 
}
    </style>
</head>

<body>
  
<div class="form-style-div">
    

    <div class="div-h1">

    <h1>&#5792;  -  Reviews Archives</h1>
    <br>
    <?= $msg ?>
    <br>
    <br>
    Open your archive in PowerBi
    <br>
   
    <br>
    <div class="link3">
    <a href="Index.php" style="color: white;text-decoration:none;"><i class="bi bi-house" style="color:white;"></i>Back</a>
    </div>
    
    </div>
    
    
    
    </div>
    </div>
    
    
    </div>
</body>
</html>

