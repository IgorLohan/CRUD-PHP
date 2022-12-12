<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRUD | PHP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="style.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>

        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=crudphp", "root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_GET['excluir'])){
            $cod_pessoa = (int) $_GET['excluir'];
            $pdo->exec("DELETE FROM tab_dados_pessoa WHERE cod_pessoa = $cod_pessoa");
            echo "<h2>Aluno $cod_pessoa foi excluído com sucesso.</h2>";
            header("Location: index.php");
        }

            if (isset($_POST['nome'])){
                $sql = $pdo->prepare("INSERT INTO `tab_dados_pessoa` VALUES (null, ?, ?, ?)");
                $nome = $_POST['nome'];
                $sql->execute(array($nome, $_POST['cpf'], $_POST['email']));
                echo "$nome cadastrado com sucesso!";
            }
        ?>

        <section class="get-in-touch">
            <h2 class="title">CRUD | PHP</h2>
            <form method="POST" class="contact-form row">
            <fieldset>
                <div class="form-field col-lg-6">
                    <input type="text" name="nome" placeholder="" class="input-text js-input" required>
                    <label class="label" for="name">Nome</label>    
                </div>
                <div class="form-field col-lg-6">
                    <input type="text" name="cpf" placeholder="" class="input-text js-input" required>
                    <label class="label" for="cpf">CPF</label>
                </div>
                <div class="form-field col-lg-6">
                    <input type="text" name="email" placeholder="" class="input-text js-input" required>
                    <label class="label" for="email">E-mail</label>
                </div>
                <div class="form-field col-lg-12">
                    <input type="submit" class="submit-btn" value="Enviar">
                    <input type="reset" class="submit-btn" value="Limpar Dados">
                </div>
            </fieldset>
            </form>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <?php
            $sql = $pdo->prepare("SELECT * FROM `tab_dados_pessoa`");
            $sql->execute();
            $dados_pessoa = $sql->fetchAll();

            echo "<table class = 'table table-stripped table-hover'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th scope='col'>Nome</th>";
            echo "<th scope='col'>CPF</th>";
            echo "<th scope='col'>E-mail</th>";
            echo "<th scope='col' colspan='2' class='text-center'> Ações <th>";
            echo "</tr></thead>";

            foreach($dados_pessoa as $dado_pessoa){
                echo "<tr>";
                echo "<td>" . $dado_pessoa['nome'] . "</td>";
                echo "<td>" . $dado_pessoa['cpf'] . "</td>";
                echo "<td>" . $dado_pessoa['email'] . "</td>";
                echo '<td align=center>
                        <a href="?excluir='.$dado_pessoa['cod_pessoa'] .'"> ( X ) </a>
                    </td>';
                echo '<td align=center>
                        <a href="alterar.php?cod_pessoa='.$dado_pessoa['cod_pessoa'] .'"> Alterar </a>
                    </td>';
                echo "</tr>";
            }
        ?>
    </body>
</html>