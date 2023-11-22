<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleconsulta.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>CRUD | Banco de dados</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost&family=Ubuntu:wght@300;400;500&display=swap');

*{
    font-family: 'Jost', sans-serif;
font-family: 'Ubuntu', sans-serif;
}
* {
    padding: 0;
    margin: 0;
   
}

body{  animation: color 20s infinite linear; 
    justify-content: center;
    display: flex;
}
@keyframes color {
    0%   { background: #4a0086b4; }
    20%  { background: #3a0086d7; }
    40%  { background: #641797d8; }
    60%  { background: #5419b4d0; }
    80%  { background: #6830c2d2; }
    100% { background: #5b0086c7; }
  }
  
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
    margin-left:250px; 
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
</head>
<body>
        

</body>
</html>


<?php

include("bd.php");

if (!isset($_POST["autorResenha"])) {
    echo "<div class='aviso'><span id='select'>😼​​Select the file to delete😼​​</span>
    <div class='link'>
<a href='consultaResenha.php'><i class='bi bi-house'></i>Back</a>
</div>
</div>";
} else {
    $autorResenha = $_POST["autorResenha"];
    excluirResenha($autorResenha);
}

?>