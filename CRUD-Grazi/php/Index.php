<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home2.css">
    <title>CRUD | Banco de Dados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>




<div class="form-style-div">

<form action=""  method="POST" enctype="multipart/form-data">
<div class="div-h1">
<h1> &#5792; Library </h1>

<div class="div-image">
<img src="cat.png" alt="">
</div>
<br>
</div>



<div class="teste">
<div class="style-form">
<i class="bi bi-book-half"></i>
<input type="text" placeholder="Title" require name="title">
</div>

<div class="style-form">
<i class="bi bi-bookmarks"></i>
<input type="text" placeholder="Autor" require name="subtitle">
</div>

<div class="style-form">
<i class="bi bi-collection-fill"></i>
<input type="text" placeholder="Gender" require name="gender">
</div>


<div class="style-form">
<i class="bi bi-upc"></i>
<input type="number" placeholder="Code" require name="code">
</div>
</div>
<div class="style-form">
<h2>Picture</h2><br><br>
<input type="file" name="foto" accept="image/gif, image/png, image/jpg, image/jpeg"><br><br>
</div>


<div class="formatic-div">
<input type="submit" value="register" class="btn-form">
<a href="consulta.php"><input type="button" value="search"  class="btn-form"></a>

</div>

</form>
</div>

    </body>

</html>

<?php
   include("bd.php");

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        //inserindo dados
        $title = $_POST["title"];
        $subtitle = $_POST["subtitle"];
        $gender = $_POST["gender"];
        $code = $_POST["code"];
        $foto = $_FILES["foto"];

        if ((trim($code) == "") || (trim($title) == "")) {
            echo "<div class='aviso'>
            <span id='warning'>🙀​ Warning 🙀 <br>Code and Title are required!</span>
            </div>";
        } else {
            cadastrar($title, $subtitle, $gender, $code, $foto);
        }
    }
?>