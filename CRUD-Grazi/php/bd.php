<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #sucess{
    color: #fff;
    font-size: 20px;
}
#error{
    color: #fff;
    font-size: 20px;
}
  
#select{
    color: #fff;
    font-size: 40px;
   
    
}



.link{
    text-align: center;
    display:flex;
    padding-top:20px;
    margin-left:90px; 
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
    <title></title>
</head>
<body>
    
</body>
</html>

<?php

    function conectarBD() 
    //FEITO
    {
        try {
        
            $db = 'mysql:host=143.106.241.3;dbname=cl201287;charset=utf8';
            $user = 'cl201287';
            $passwd = 'cl*17082005';
            $pdo = new PDO($db, $user, $passwd);
    
           
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        } catch (PDOException $e) {
            $output = 'Impossível conectar BD : ' . $e . '<br>';
            echo $output;
        }
        return $pdo;
    
       /* $pdo = new PDO("mysql:host=143.106.241.3;dbname=cl201287;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;*/
    }

    function cadastrar($title, $subtitle, $gender,$code,$foto) 
    //FEITO
    {
        try {
            $pdo = conectarBD();
            $rows = verificarCadastro($code, $pdo);

            if ($rows <= 0) {

                if ($foto == "") {
                    $fotoBinario = null;
                } else {
                   
                    $fotoBinario = file_get_contents($foto['tmp_name']);
                }

                $stmt = $pdo->prepare("insert into biblioteca (title, subtitle, gender, code, foto) values(:title, :subtitle, :gender, :code, :foto)");
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':subtitle', $subtitle);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':code',$code);
                $stmt->bindParam(':foto', $fotoBinario);
                $stmt->execute();

                echo "<div class='aviso'><span id='sucess'>​😸​Sucess!​😸​</span></div>";
            } else {
                echo "<div class='aviso'><span id='error'>😽​This title already exist!😽​</span></div>";
            }

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function verificarCadastro($code, $pdo) 
    //FEITO
    {
        //verificando se o RA informado já existe no BD para não dar exception
        $stmt = $pdo->prepare("select * from biblioteca where code = :code");
        $stmt->bindParam(':code', $code);
        $stmt->execute();

        $rows = $stmt->rowCount();
        return $rows;
    }

    function consultar() 
    //FEITO
    {
        $pdo = conectarBD();
        if (isset($_POST["code"]) && ($_POST["code"] != "")) {
            $code = $_POST["code"];
            $stmt = $pdo->prepare("select * from biblioteca where code= :code order by title, subtitle");
            $stmt->bindParam(':code', $code);
        } else {
            $stmt = $pdo->prepare("select * from biblioteca order by title, subtitle");
        }

        $stmt->execute();

        return $stmt;
    }

    function buscarEdicao($code)
     {
        $pdo = conectarBD();
        $stmt = $pdo->prepare('select * from biblioteca where code = :code');
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt;
    }

    function alterar($newtitle, $newsubtitle, $newgender, $code, $newfoto) {
        try {
            $pdo = conectarBD();
            $stmt = $pdo->prepare('UPDATE
             biblioteca SET title = :newtitle, subtitle = :newsubtitle, gender = :newgender, foto = :newfoto WHERE code = :code');
            $stmt->bindParam(':title', $newtitle);
            $stmt->bindParam(':subtitle', $newsubtitle);
            $stmt->bindParam(':gender', $newgender);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':foto', $newfoto);
            $stmt->execute();

            echo "<div class='aviso'>The book code $code have been changed!</div>";

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function excluir($code)
    //FEITO 
    {
        try {
            $pdo = conectarBD();
            $stmt = $pdo->prepare('DELETE FROM biblioteca WHERE code = :code');
            $stmt->bindParam(':code', $code);
            $stmt->execute();

            echo $stmt->rowCount() . " <div class='aviso'><span id='select'>😼​Sucess😼​​</span>
            <div class='link'>
        <a href='index.php'><i class='bi bi-house'></i>Back</a>
        </div>
        </div>";

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    ?>