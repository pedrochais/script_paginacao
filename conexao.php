<?php

$dsn = 'mysql:host=localhost;dbname=teste_paginacao';
$user = 'root';
$pass = '';

$conexao = new PDO($dsn, $user, $pass);

/*
for($i = 1; $i <= 40; $i++){
    
    $nome = 'Usuário '.$i;
    $email = 'E-mail '.$i;

    $query = "
        INSERT INTO contas (nome, email) values ('$nome', '$email')
    ";
    
    $conexao->exec($query);

}
*/

?>