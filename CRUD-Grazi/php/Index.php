<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD | Banco de Dados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

<?php
include 'form.php';
?>
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

        if ((trim($code) == "") || (trim($title) == "")) {
            echo "<span id='warning'>Code and Title are required!</span>";
        } else {
            cadastrar($title, $subtitle, $gender, $code, $foto);
        }
    }
?>