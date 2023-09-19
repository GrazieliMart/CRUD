<?php
echo'<div class="form-style-div">
<form action="">
<div class="div-h1">
<h1> 🌻 &#5792; Library 🌻</h1>
<br>
</div>
<div class="style-form">
<i class="bi bi-book-half"></i>
<input type="text" placeholder="Title" require name="title">
</div>

<div class="style-form">
<i class="bi bi-bookmarks"></i>
<input type="text" placeholder="Subtitle" require name="subtitle">
</div>

<div class="style-form">
<i class="bi bi-collection-fill"></i>
<input type="text" placeholder="Gender" require name="gender">
</div>


<div class="style-form">
<i class="bi bi-upc"></i>
<input type="number" placeholder="Code" require name="code">
</div>

<div class="style-form">
<h2>Picture</h2><br><br>
<input type="file" name="foto" accept="image/gif, image/png, image/jpg, image/jpeg"><br><br>
</div>


<div class="formatic-div">
<input type="submit" value="register" class="btn-form">
</div>

</form>
</div>';

define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

if ($_SERVER["REQUEST_METHOD"] === 'POST') {

    try {
        //inserindo dados
        $title = $_POST["title"];
        $subtitle = $_POST["subtitle"];
        $gender = $_POST["gender"];
        $code = $_POST["code"];

        //foto
        $foto = $_FILES["foto"];
        $nomeFoto = $foto["name"];
        $tipoFoto = $foto["type"];
        $tamanhoFoto = $foto["size"];

        if ((trim($title) == "") || (trim($code) == "")) {
            echo "<span id='warning'>Title and Code are required!</span>";

        //validação tipo arquivo
        } else if ( ($nomeFoto != "") && 
        (!preg_match('/^image\/(jpg|jpeg|png|gif)$/', $tipoFoto)) ) {
        echo "<span id='error'>Não é uma imagem válida!</span>";
        
        //validação tamanho arquivo
        } else if ($tamanhoFoto > TAMANHO_MAXIMO) { 
            echo "<span id='error'>A imagem deve possuir no máximo 2 MB</span>";

        } else {

            include("conexaoBD.php");                
            
            //verificando se o RA informado já existe no BD para não dar exception
            $stmt = $pdo->prepare("select * from biblioteca where title = :title");
            $stmt->bindParam(':title', $title);
            $stmt->execute();

            $rows = $stmt->rowCount();

            if ($rows <= 0) {

                if ($nomeFoto == "") {
                    $fotoBinario = null;
                } else {
                    // Lendo o conteudo do arq para uma var
                    $fotoBinario = file_get_contents($foto['tmp_name']);
                }

                $stmt = $pdo->prepare("insert into biblioteca (title, subtitle, gender, code, foto) values(:title, :subtitle, :gender, :code, :foto)");
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':subtitle', $subtitle);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':code',$code);
                $stmt->bindParam(':foto', $fotoBinario);
                $stmt->execute();

                echo "<span id='sucess'>Sucess!</span>";
            } else {
                echo "<span id='error'>This title already exist!</span>";
            }
        }

    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>