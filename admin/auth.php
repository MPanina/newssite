<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "news");
$sql = "SELECT * FROM `header`";
$headerResult = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Today</title>
</head>
<body>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/style.css">
        <title>News Today</title>
    </head>

    <body>
        <div class="header">
            <header>

                <div class="left">

                    <div>
                    <img src="../img/log.png" class="respons" alt="">
                    <span class="header_info">Новости</span>               
                    </div>


                </div>

            </header>
        </div>
        <div class="menu">

            <?php
            foreach ($headerResult as $headerrow) {
                echo "<ul class='menu'";
                echo "<li><a href='index.php?title=" . $headerrow["title"] . "'>" . " " . $headerrow["title"] . " " . "</a></li>";
            }
            echo "</ul>";
            ?>
        </div>
        <div class="content">

            <form method="POST" action="admenu.php">           
                <h2>Введите данные для авторизации</h2>
                <p>Логин: <input type="text" name="login"></p>
                <p>Пароль: <input type="password" name="password"></p>
                <p><input type="submit" value="Отправить"></p>
            </form>
            
        </div>

    </body>

</html>