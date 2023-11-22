<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home2.css">
    <title>CRUD | Banco de Dados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .resenha {
    border: #fff solid 2px;
    border-radius: 10px;
    padding-left: 10px;
    margin: 5px;
    height: 100px;
    color: rgb(46, 38, 38);
    background: transparent;
    font-size: 20px;
    transition: 0.3s;
}
    </style>
</head>
<body>




<div class="form-style-div">

<form action=""  method="POST" enctype="multipart/form-data">
<div class="div-h1">
<h1> &#5792; Library - Reviews </h1>

<div class="div-image">
<img src="catandbook.png" alt="">
</div>
<br>
</div>



<div class="teste">
<div class="style-form">
<i class="bi bi-book-half"></i>
<input type="text" placeholder="Your name" require name="autorResenha">
</div>

<div class="style-form">
<i class="bi bi-bookmarks"></i>
<input type="text" placeholder="Book" require name="tituloResenha">
</div>

<div class="style-form">
<i class="bi bi-collection-fill"></i>
<input type="text" placeholder="Review" require name="resenha" class="resenha">
</div>




<div class="formatic-div">
<input type="submit" value="Send" class="btn-form">


</div>


</form><div class="link3">
<a href="Index.php" style="color: white;text-decoration:none;"><i class="bi bi-house" style="color:white;"></i>Back</a>
<br>

</div>
<a href="consultaResenha.php" style="color: white;text-decoration:none;">Take a look</a>
</div>

    </body>

</html>

<?php
   include("bd.php");

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        //inserindo dados
        $autorResenha = $_POST["autorResenha"];
        $tituloResenha = $_POST["tituloResenha"];
        $resenha = $_POST["resenha"];
   

        if ((trim($tituloResenha) == "") || (trim($autorResenha) == "")) {
            echo "<div class='aviso'>
            <span id='warning'>🙀​ Warning 🙀 <br>Title and Review are require!</span>
            </div>";
        } else {
            cadResenha($autorResenha, $tituloResenha, $resenha);
        }
    }
?>