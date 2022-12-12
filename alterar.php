<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=crudphp', 'root', '');

if (isset($_GET['cod_pessoa'])) {
    $cod_pessoa = (int)$_GET['cod_pessoa'];
    $sql = $pdo->prepare("SELECT * FROM tab_dados_pessoa WHERE cod_pessoa = $cod_pessoa");
    $sql->execute();
    $pessoas = $sql->fetchAll();

    foreach ($pessoas as $pessoa) {
        echo "<section class='get-in-touch'>";
        echo "<h2 class='title'>Insira os dados abaixo</h2>";
        echo "<form method='POST' class='contact-form row'>";
        echo "<fieldset>";
        echo "<div class='form-field col-lg-6'>";
        echo "<input type='text' class='input-text js-input' required name='nome' value='" . $pessoa['nome'] . "'>";
        echo "<label class='label' for='name'>Nome</label>";
        echo "</div>";
        echo "<div class='form-field col-lg-6'>";
        echo "<input type='text' class='input-text js-input' required name='cpf' value='" . $pessoa['cpf'] . "'>";
        echo "<label class='label' for='cpf'>CPF</label>";
        echo "</div>";
        echo "<div class='form-field col-lg-6'>";
        echo "<input type='text' class='input-text js-input' required name='email' value='" . $pessoa['email'] . "'>";
        echo "<label class='label' for='email'>E-mail</label>";
        echo "</div>";
        echo "<div class='form-field col-lg-12'>";
        echo "<input type='submit' class='submit-btn' value='Enviar'>";
        echo "<input type='reset' class='submit-btn' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }
}

if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("UPDATE tab_dados_pessoa SET nome = ?, cpf = ?, email = ? WHERE cod_pessoa = $cod_pessoa");
    $sql->execute(array($_POST['nome'],$_POST['cpf'],$_POST['email']));
    echo "<h1>Usuário com id = $cod_pessoa alterado com sucesso!</h1>";
    echo "<a href='index.php'>Voltar</a>";
}
