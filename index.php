<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "news");
if (!$conn) {
    die("Ошибка:" . mysqli_connect_error());
}
if (isset($_GET["newsid"])) {
    $newsid = $_GET["newsid"]; //Записываем get запрос в переменную
}
if (isset($_GET["title"])) {
    $title = $_GET["title"]; //Записываем get запрос в переменную
}
$sql = "SELECT * FROM `header`";
$headerResult = mysqli_query($conn, $sql);
$newsSelect = "SELECT * FROM `news`";
$newsResult = mysqli_query($conn, $newsSelect);
$newsIdSelect = "SELECT * FROM `news` WHERE id = '$newsid'";
$newsIdResult = mysqli_query($conn, $newsIdSelect);
$newsTitleSelect = "SELECT * FROM `news` WHERE type = '$title'";
$newsTitleSelect = mysqli_query($conn, $newsTitleSelect);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>News Today</title>
</head>

<body>
    <div class="header">
        <header>

            <div class="left">

                <div>
                    <img src="img/log.png" class="respons" alt="">
                    <span class="header_info">Новости</span>
                    <?php
                    if (isset($_SESSION["adminid"])) {
                        $currentID = $_SESSION["adminid"];
                        $loginSelect = "SELECT login FROM `admin` WHERE id = '$currentID'";
                        $loginResult = mysqli_query($conn, $loginSelect);
                        $loginFetch = mysqli_fetch_array($loginResult);
                        echo "<a href='admin/exit.php'>" . "Выйти?" . "</a>";
                    } else {
                        echo "<a href='admin/auth.php'>" . "Войти?" . "</a>";
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
            echo "<li><a href='index.php?title=" . $headerrow["title"] . "'>" . " " . $headerrow["title"] . " " . "</a></li>";           
        }
        echo "</ul>";
        ?>
    </div>
    <div class="content">

        <div class="cont">

            <?php
            if (isset($_GET['title']) && $_GET['title'] == "Политика") { 
                if (isset($_GET["newsid"])) { 
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                } else { 
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";                     
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                }
            } else if (isset($_GET['title']) && $_GET['title'] == "Экономика") { 
                if (isset($_GET["newsid"])) { 
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newslongblock'>";
                        echo "<img class='newsbigimage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                } else { 
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";                      
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                }
            } else if (isset($_GET['title']) && $_GET['title'] == "Наука") { 
                if (isset($_GET["newsid"])) { 
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newslongblock'>";
                        echo "<img class='newsbigimage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                } else { 
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";                      
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                }  
            } else if (isset($_GET['title']) && $_GET['title'] == "Общество") { 
                if (isset($_GET["newsid"])) { 
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newslongblock'>";
                        echo "<img class='newsbigimage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                } else { //Вывод всех новостей
                    foreach ($newsTitleSelect as $newsTitleRow) {
                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='img/" . $newsTitleRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsTitleRow['id'] . "'>" . $newsTitleRow['title'] . "</a>" .  "</h2>";                      
                        echo "<p>"  . $newsTitleRow['date'] .  "</p>";
                        echo "<p>"  . $newsTitleRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                }                   
            } else { //Главная(Выводим из всех разделов)
                if (isset($_GET["newsid"])) {
                    foreach ($newsIdResult as $newsIdRow) {
                        echo "<div class='newslongblock'>";
                        echo "<img class='newsbigimage' src='img/" . $newsIdRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsIdRow['id'] . "'>" . $newsIdRow['title'] . "</a>" .  "</h2>";
                        echo "<p>"  . $newsIdRow['longdesc'] .  "</p>";
                        echo "<p>"  . $newsIdRow['date'] .  "</p>";
                        echo "<p>"  . $newsIdRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                } else {
                    foreach ($newsResult as $newsRow) {
                        echo "<div class='news_block'>";
                        echo "<img class='newsimage' src='img/" . $newsRow['image'] . "' alt=''>";
                        echo "<h2>" . "<a href='index.php?newsid=" . $newsRow['id'] . "'>" . $newsRow['title'] . "</a>" .  "</h2>";                      
                        echo "<p>"  . $newsRow['date'] .  "</p>";
                        echo "<p>"  . $newsRow['autor'] .  "</p>";
                        echo "</div>";
                    }
                }
            }



            ?>

        </div>

</body>

</html>