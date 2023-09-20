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

if (!isset($_POST["code"])) {
    echo "Selecione o aluno a ser excluído!";
} else {
    $code = $_POST["code"];
    excluir($code);
}

?>