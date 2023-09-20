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

                echo "<span id='sucess'>Sucess!</span>";
            } else {
                echo "<span id='error'>This title already exist!</span>";
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

            echo "The book code $code have been changed!";

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

            echo $stmt->rowCount() . "  Book of $code code removed!";

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    ?>