
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="home2.css">
</head>
<style>
   #select{
    color: #fff;
    font-size: 40px;
   
    
}

.style-form1{
   
   justify-content: center;
   margin-top: 0px;

   margin-left: 0px;
  
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
    margin-left:130px;
    position: absolute; 
}
.link a{
    color: #fff;
    text-decoration: none;
    text-align: center;
    display:flex;
    margin-left:50px;
    position: absolute;
}
.link a:hover{
    color: #fff;
    text-decoration: underline;
}
.link1{
    text-align: center;
    display:flex;
    margin-left:20px;
    
}
.link1 a{
    color: #fff;
    text-decoration: none;
    text-align: center;
    display:flex;
  
}
.link1 a:hover{
    color: #fff;
    text-decoration: underline;
}
.div-h1-1 {
    align-items: center;
   margin-left:20px;
    padding: 5px;
    position: relative;margin:10px;
}
.div-h1-1 h1{
    display:flex;
    margin-left:-90px;
    
}
</style>
<body>


</body>
</html>

<?php 
include("bd.php");

if (isset($_POST['code'])) {
    $code = $_POST['code'];
    
    try {
        $pdo = conectarBD();
        $stmt = buscarEdicao($code);
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $title = $row['title'];
            $subtitle = $row['subtitle'];
            $gender = $row['gender'];
            $foto = $row['foto'];
            
          

            echo "<div class='form-style-div'>
            <div class='div-image1'>
            <img src='catandbook.png' alt=''>
            </div>
            <form method='post' action='altera.php' enctype='multipart/form-data'>
            <div class='div-h1-1'>
            <h1> &#5792; Library - Edit</h1></div>";
            echo "<div class='style-form1'>
            <input type='text' name='newtitle' size='30' value='$title'><br><br>
            </div>";
           
            echo "<div class='style-form'> <input type='text' size='30' name='newsubtitle' value='$subtitle'><br><br></div>";
            
            echo "<div class='style-form'><input type='text' size='30' name='newgender' value='$gender'><br><br></div>";
           
            if (!empty($foto)) {
                echo "<br><img src='data:image;base64,".base64_encode($foto)."' width='150px' height='150px'><br><br>";
            }
            
            echo "<div class='style-form'><input type='file' name='newfoto'><br><br>";
            echo "<input type='hidden' name='code' value='$code'></div>";
            echo "<br>";
          
            echo '
            <br><input type="submit" value="Save" class="btn-form">';
            echo"
<div class='link1'>

<a href='index.php'><i class='bi bi-house'></i>Back</a>
</div>
</form>
</div>
</div>" ;
        } else {
            echo "Don't found.";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "<div class='aviso'><span id='select'>😺​Select the file😺​</span>
    <div class='link'>
<a href='consulta.php'><i class='bi bi-house'></i>Back</a>
</div>
</div>";
}
?>


