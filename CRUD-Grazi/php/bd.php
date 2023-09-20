<?php

    function conectarBD() 
    //FEITO
    {
        $pdo = new PDO("mysql:host=143.106.241.3;dbname=cl201287;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    function cadastrar($title, $subtitle, $gender,$code,$foto) 
    //FEITO
    {
        try {
            $pdo = conectarBD();
            $rows = verificarCadastro($ra, $pdo);

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

        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    function verificarCadastro($ra, $pdo) 
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
            $ra = $_POST["code"];
            $stmt = $pdo->prepare("select * from biblioteca where code= :code order by title, subtitle");
            $stmt->bindParam(':code', $code);
        } else {
            $stmt = $pdo->prepare("select * from biblioteca order by title, subtitle");
        }

        $stmt->execute();

        return $stmt;
    }

    function buscarEdicao($ra)
    //FEITO
     {
        $pdo = conectarBD();
        $stmt = $pdo->prepare('select * from biblioteca where code = :code');
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt;
    }

    function alterar($ra, $novoNome, $novoCurso) {
        try {
            $pdo = conectarBD();
            $stmt = $pdo->prepare('UPDATE alunos SET nome = :novoNome, curso = :novoCurso WHERE ra = :ra');
            $stmt->bindParam(':novoNome', $novoNome);
            $stmt->bindParam(':novoCurso', $novoCurso);
            $stmt->bindParam(':ra', $ra);
            $stmt->execute();

            echo "Os dados do aluno de RA $ra foram alterados!";

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function excluir($ra)
    //FEITO 
    {
        try {
            $pdo = conectarBD();
            $stmt = $pdo->prepare('DELETE FROM biblioteca WHERE code = :code');
            $stmt->bindParam(':code', $code);
            $stmt->execute();

            echo $stmt->rowCount() . "  Book of $ra code removed!";

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    ?>