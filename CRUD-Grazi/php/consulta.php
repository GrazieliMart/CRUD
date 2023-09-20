<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleconsulta1.css">
    <title>CRUD | Banco de dados</title>
</head>
<body>
    
<div class="form-style-div">
    
<form action=""  method="POST" enctype="multipart/form-data">
<div class="div-h1">
<h1> &#5792; Library -  Find</h1>

<div class="div-image">
<img src="catandfish.png" alt="">
</div>
<br>
</div>


<div class="style-form">
<i class="bi bi-upc"></i>
<input type="number" placeholder="Code" require name="code">
</div>

<div class="formatic-div">
<input type="submit" value="send" class="btn-form">
</div>


</div>
</form>
</div>


</body>
</html>

<?php
    include("bd.php");

     if ($_SERVER["REQUEST_METHOD"] === 'POST') {

         try {

             $stmt = consultar();

             echo "
            
              <div class='tabela'>
             <form method='post' >
             
             <table border='2px'>
             ";
             echo "<tr><th></th>
             <th>Code</th>
             <th>Title</th>
             <th>Subtitle</th>
             <th>Gender</th>
             <th>Foto</th>
             
             </tr>
             ";

             while ($row = $stmt->fetch()) {

                 echo "<tr>";
                 echo "<td><input type='radio' name='code' 
                      value='" . $row['code'] . "'>";
                 echo "<td>" . $row['code'] . "</td>";
                 echo "<td>" . $row['title'] . "</td>";
                 echo "<td>" . $row['subtitle'] . "</td>";
                 echo "<td>" . $row['gender'] . "</td>";
                 if ($row["foto"] == null) {
                    echo "<td align='center'><img src='img/semFoto.png' width='50px' height='50px'></td>";
                } else {
                   echo "<td align='center'><img src='data:image;base64,".base64_encode($row["foto"])."' width='50px' height='50px'></td>";
                   //base64 - Maneira de codificar dados binários em texto ASCII, informando ao navegador que os dados estão embutidos em uma imagem.
                }
                echo "</tr>";
            }
               
             echo "</table>
             <br>
             <div class='btndiv'>
             <button type='submit' formaction='remove.php'>Delete File</button>
             <button type='submit' formaction='editar.php'>Edit File</button>
             </div>
             </form>
             </div>";

         } catch (PDOException $e) {
             echo 'Error: ' . $e->getMessage();
         }

     }
?>