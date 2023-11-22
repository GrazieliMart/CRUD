<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleconsulta1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>CRUD | Banco de dados</title>
    <style>
        
.link3{
    display: flex;
    align-items: center;
    text-align: center;
    
    margin-left:130px;
 }
.link3 a{
    color: #fff;
    text-decoration: none;
}
.link3 a:hover{
    color: #fff;
    text-decoration: underline;
}
    </style>
</head>
<body>
    
<div class="form-style-div">
    
<form action=""  method="POST" enctype="multipart/form-data">
<div class="div-h1">
<h1> &#5792; Library -  Reviews</h1>

<div class="div-image">
<img src="catandumbrella.png" alt="">
</div>
<br>
</div>


<div class="style-form">
<i class="bi bi-upc"></i>
<input type="number" placeholder="Author" require name="autorResenha">
</div>
<br>
<div class="formatic-div">
<input type="submit" value="send" class="btn-form"><br>

</div><br>

<br>
<div class="link3">
<a href="index.php"><i class="bi bi-house"></i>Back</a>
</div></form>


</div>
</div>


</div>


</body>
</html>

<?php
    include("bd.php");

     if ($_SERVER["REQUEST_METHOD"] === 'POST') {

         try {

             $stmt = consultarResenha();

             echo "
            <br>
              <div class='tabela'>
             <form method='post' >
             
             <table border='2px'>
             ";
             echo "<tr><th></th>
             <th>Author</th>
             <th>Title</th>
             <th>Review</th>
             
             
             </tr>
             ";

             while ($row = $stmt->fetch()) {

                 echo "<tr>";
                 echo "<td><input type='radio' name='autorResenha' 
                      value='" . $row['autorResenha'] . "'>";
                      echo "<td>" . $row['autorResenha'] . "</td>";
                 echo "<td>" . $row['tituloResenha'] . "</td>";
                 echo "<td>" . $row['resenha'] . "</td>";
                 
              
                echo "</tr>";
            }
               
             echo "</table>
             <br>
             <div class='btndiv'>
             <button type='submit' formaction='removeResenha.php'>Delete File</button>
             </div>
             </form>
             </div>";

         } catch (PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }

     }
?>