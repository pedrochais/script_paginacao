<?php

//Realiza conexão com o BD
require_once('conexao.php');

//Verifica existência da variável 'pagina_atual'
if (isset($_GET['pagina_atual'])) {
    $current_page = $_GET['pagina_atual'];
} else {
    $current_page = 1;
}

//Preparação da instrução
$instruction = "
SELECT * FROM contas;
";

//Execução da instrução
$statement = $conexao->query($instruction);

//Número de itens que há na tabela
$number_of_rows = $statement->rowCount();

//Número de itens por página
$items_per_page = 6;

//Quantidade de páginas necessárias para mostrar os itens
$pages = ceil($number_of_rows / $items_per_page);

//ID do item inicial de cada página
$start_item = $items_per_page * ($current_page - 1);

//Prepara instrução para selecionar os itens
$instruction = "
SELECT * FROM contas LIMIT $start_item, $items_per_page;
";

//Execução da instrução
$statement = $conexao->query($instruction);

//Itens retornados
$items = $statement->fetchAll(PDO::FETCH_ASSOC);

//Caso 'current_page' contiver um valor inválido o usuário será redirecionado para a última página válida
if ($current_page > $pages) header("Location: index.php?pagina_atual=$pages");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: block;
        }

        .itens {
            display: flex;
        }

        .navegacao {
            display: block;
        }

        .navegacao ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navegacao li {
            border: 1px solid black;
            padding: 5px;
        }

        .card {
            border: 1px solid black;
            margin: 20px;
            padding: 10px;
        }
    </style>
</head>

<body>

    <section class="itens">
        <?php
        foreach ($items as $key => $value) {
        ?>

            <div class="card">
                <p>
                    <?= $value['nome'] ?>
                </p>
                <p>
                    <?= $value['email'] ?>
                </p>
            </div>

        <?php
        } //rof
        ?>
    </section>

    <section class="navegacao">
        <nav class="paginacao">
            <ul>

                <?php
                for ($i = 1; $i <= $pages; $i++) {
                ?>

                    <li>
                        <a href="index.php?pagina_atual=<?= $i ?>">
                            <span>
                                <?= $i ?>
                            </span>
                        </a>
                    </li>

                <?php
                }
                ?>

            </ul>
        </nav>
    </section>
</body>

</html>