<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "news");
$sql = "SELECT * FROM `headeradmin`";
$headerResult = mysqli_query($conn, $sql);
$newsSelect = "SELECT * FROM `news`";
$newsResult = mysqli_query($conn, $newsSelect);
?>
<?php
if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = $_POST["login"];
    $auth = "SELECT * FROM `admin` WHERE login='$login'";
    $authResult = mysqli_query($conn, $auth);
    $authAssoc = mysqli_fetch_assoc($authResult);
    if (!empty($authAssoc)) {
        $hash = $authAssoc['password'];
        $adminid = $authAssoc['id'];
        $_SESSION["adminid"] = $adminid;
    } else {
        echo "Админа с таким логином не существует";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">

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
                        <?php
                        if (isset($_SESSION["adminid"])) {
                            $currentID = $_SESSION["adminid"];
                            $loginSelect = "SELECT login FROM `admin` WHERE id = '$currentID'";
                            $loginResult = mysqli_query($conn, $loginSelect);
                            $loginFetch = mysqli_fetch_array($loginResult);
                            echo "<a href='exit.php'>" . " Выйти?" . "</a>";
                        }
                        ?>
                    </div>


                </div>

            </header>
        </div>
        <div class="menu">

            <?php
            foreach ($headerResult as $headerrow) {
                echo "<ul class='menu'";
                echo "<li><a href='admenu.php?title=" . $headerrow["id"] . "'>" . " " . $headerrow["title"] . " " . "</a></li>";
            }
            echo "</ul>";
            ?>
        </div>
        <div class="content">

            <div class="cont">

                <?php

                if (isset($_GET['title']) && $_GET['title'] == 1) {
                ?>
                    <form method="POST" enctype="multipart/form-data">
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
                        $newsAdd = "INSERT INTO `news` (`title`, `image`, `longdesc`, `date`, `autor`, `type`)
                        VALUES ('$title', '$name', '$longdesc', NOW(),'$autor', '$type')";
                        if ($conn->query($newsAdd)) {
                            echo "<script>alert(\"Новость добавлена\");</script>";
                        } else {
                            echo "Ошибка: " . $conn->error;
                        }
                    } else {
                        echo "<script>alert(\"Введите все данные\");</script>";
                    }
                    ?>
                <?php

                } else if (isset($_GET['title']) && $_GET['title'] == 3) {
                    foreach ($newsResult as $newsRow) {
                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='../img/" . $newsRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsRow['id'] . "'>" . $newsRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsRow['date'] .  "</p>";
                        echo "<p>"  . $newsRow['autor'] .  "</p>";

                        echo "<form method='GET' action='redact.php'>
                            <input type='hidden' name='newred' value='" . $newsRow["id"] . "'/>
                            <input type='submit' class='text-field__input' value='Редактировать'>
                        </form>";

                        echo "</div>";
                    }
                ?>
                <?php
                } else if (isset($_GET['title']) && $_GET['title'] == 2) {
                    foreach ($newsResult as $newsRow) {

                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='../img/" . $newsRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsRow['id'] . "'>" . $newsRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsRow['date'] .  "</p>";
                        echo "<p>"  . $newsRow['autor   '] .  "</p>";

                        echo "<form method='GET'>
                            <input type='hidden' name='new' value='" . $newsRow["id"] . "'/>
                            <input type='submit' class='text-field__input' value='Удалить'>
                        </form>";

                        echo "</div>";
                    }
                }
                ?>
                <?php
                if (isset($_GET['new'])) {
                    $newid = mysqli_real_escape_string($conn, $_GET['new']);
                    $deleteNews = "DELETE FROM `news` WHERE id = '$newid'";
                    if (mysqli_query($conn, $deleteNews)) {
                        echo "<script>alert(\"Новость удалена\");</script>";
                    } else {
                        echo "Ошибка: " . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                }
                ?>
                <?php
                if (isset($_GET['title']) && $_GET['title'] == 4) {
                ?>
                    <form method="POST">
                        <h1>Заполните все поля</h1>
                        <p>Логин</label>
                        <p><input type="text" name="login"></p>
                        <p>Пароль</p>
                        <p><input type="text" name="password"></p>
                        <br>
                        <p><input type="submit" value="Отправить"></p>
                    </form>
                <?php
                }
                if (isset($_POST["login"]) && isset($_POST["password"])) {
                    $login = $_POST["login"];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $adminReg = "INSERT INTO `admin` (`login`, `password`) VALUES ('$login', '$password')";
                    if ($conn->query($adminReg)) {
                        echo "<p>" . "Регистрация прошла успешно" . "</p>";
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                }

                ?>
            </div>


        </div>

    </body>

</html>