<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "news");
$sql = "SELECT * FROM `headeradmin`";
$headerResult = mysqli_query($conn, $sql);
$newsSelect = "SELECT * FROM `news`";
$newsResult = mysqli_query($conn, $newsSelect);
if (isset($_GET["newred"])) {
    $newred = $_GET["newred"];
}
$newsSelect = "SELECT * FROM `news` WHERE id='$newred'";
$newsResult = mysqli_query($conn, $newsSelect);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>News Tosay</title>
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
            echo "<li><a href='admenu.php?title=" . $headerrow["title"] . "'>" . " " . $headerrow["title"] . " " . "</a></li>";
        }
        echo "</ul>";
        ?>
    </div>
    <div class="conten">
        <div class="cont">
            <form method="POST" enctype="multipart/form-data">
                <?php
                foreach ($newsResult as $newrow) {

                ?>
                    <h2>Заполните все поля</h2>
                    <p>Заголовок</pl>
                    <p><input type="text" name="title"></p>
                    <p>Выберите изображение для статьи</p>
                    <p><input type="file" name="filename" size="10"></p>
                    <p>Введите описание статьи</p>
                    <textarea name="longdesc" cols="55" rows="25"></textarea>
                    <p>Введите имя автора</p>
                    <p><input type="text" name="autor"></p>
                    <p>Введите тип статьи</p>
                    <p><input type="text" name="type"></p>
                    <br>
                    <p><input type="submit" value="Отправить"></p>
                <?php
                }
                ?>

            </form>
            <?php
            if (
                isset($_POST["title"]) && isset($_POST["longdesc"])  && isset($_POST["autor"])
                && isset($_POST["type"]) && $_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK
            ) {
                $name = $_FILES["filename"]["name"];
                $type = $_FILES["filename"]["type"];
                $path = __DIR__ . "/../" . '/img/';
                move_uploaded_file($_FILES["filename"]["tmp_name"], $path . $name);
                $title = $_POST["title"];
                $longdesc = $_POST["longdesc"];
                $autor = $_POST["autor"];
                $type = $_POST["type"];
                $newsAdd = "UPDATE `news` SET `title`='$title', `image`='$name', `longdesc`='$longdesc', `date`=NOW(), `autor`='$autor', `type`='$type' WHERE id ='$newred'";
                if ($conn->query($newsAdd)) {
                    echo "<script>alert(\"Новость изменена\");</script>";
                } else {
                    echo "Ошибка: " . $conn->error;
                }
            } else {
                echo "<script>alert(\"Введите все данные\");</script>";
            }
            ?>
        </div>
    </div>
</body>

</html>