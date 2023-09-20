
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
</head>

<body>

<a href="index.html">Home</a> | <a href="consulta.php">Consulta</a>
<hr>

<h2>Edição de Filmes</h2>

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
            
            echo "<form method='post' action='altera.php' enctype='multipart/form-data'>";
            echo "Title:<br>";
            echo "<input type='text' size='10' name='newtitle' value='$title'><br><br>";
            echo "Subtitle:<br>";
            echo "<input type='text' size='30' name='newsubtitle' value='$subtitle'><br><br>";
            echo "Gender:<br>";
            echo "<input type='text' size='30' name='newgender' value='$gender'><br><br>";
            
            echo "Foto:<br>";
            if (!empty($foto)) {
                echo "<img src='data:image;base64,".base64_encode($foto)."' width='150px' height='150px'><br><br>";
            }
            
            echo "<input type='file' name='newfoto'><br><br>";
            echo "<input type='hidden' name='code' value='$code'>";
            echo "<input type='submit' value='Salvar Alterações'>";
            echo "</form>";
        } else {
            echo "Registro não encontrado.";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo "Selecione o livro que deseja editar.";
}
?>


