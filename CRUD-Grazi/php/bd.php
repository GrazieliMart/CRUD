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
        $stmt = $pdo->prepare("select * from biblioteca where title = :title");
        $stmt->bindParam(':title', $title);
        $stmt->execute();

        $rows = $stmt->rowCount();
        return $rows;
    }

    function consultar() {
        $pdo = conectarBD();
        if (isset($_POST["ra"]) && ($_POST["ra"] != "")) {
            $ra = $_POST["ra"];
            $stmt = $pdo->prepare("select * from alunos where ra= :ra order by curso, nome");
            $stmt->bindParam(':ra', $ra);
        } else {
            $stmt = $pdo->prepare("select * from alunos order by curso, nome");
        }

        $stmt->execute();

        return $stmt;
    }

    function buscarEdicao($ra) {
        $pdo = conectarBD();
        $stmt = $pdo->prepare('select * from alunos where ra = :ra');
        $stmt->bindParam(':ra', $ra);
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

    function excluir($ra) {
        try {
            $pdo = conectarBD();
            $stmt = $pdo->prepare('DELETE FROM alunos WHERE ra = :ra');
            $stmt->bindParam(':ra', $ra);
            $stmt->execute();

            echo $stmt->rowCount() . " aluno de RA $ra removido!";

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    ?>