<?php


$pdo = new PDO("mysql:host=143.106.241.3;dbname=cl201287;charset=utf8", "cl201287", "cl*17082005");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $stmt = $pdo->prepare("SELECT * FROM biblioteca ORDER BY title");
    $stmt->execute();

    $fp = fopen('arquivoBooks.csv', 'w');
    
    $colunasTitulo = array("title", "subtitle", "gender", "code");

    fputcsv($fp, $colunasTitulo);

    while ($row = $stmt->fetch()) {
        $title = $row["title"];  
        $subtitle = $row["subtitle"];
        $gender = $row["gender"];
        $code = $row["code"];
      

        $linha = array($title, $subtitle, $gender, $code);

        fputcsv($fp, $linha);
    }

    $msg = "Arquivo gerado: arquivoBooks.csv";    
    fclose($fp);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listagem Books</title>
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

    <h1>&#5792;  -  Books Archives</h1>
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

