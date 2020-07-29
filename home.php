<?php session_start();
    
if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] != "yes")
{
    header("Location: login.php");
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Climatic laboratory ecm</title>  
    <link rel = "stylesheet" href = "css/bootstrap.css">
    <link rel = "stylesheet" href = "css/bootstrap-treeview.min.css">
    <link rel= "stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel = "stylesheet" href = "css/style.css">
</head>
<body> 
    <div class = "navbar navbar-inverse navbar-static-top">
        <a id = "logo" class="navbar-brand" href="index.php"><h1 id = "logo-h"><i class="fas fa-industry"></i>CPi<sup>2</sup>nfo</h1></a>
        <div class = "container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class = "highlight"><a class = "cl" href="archive.php">Архив</a></li>
                    <li class = "highlight"><a href="add.php">Добавление</a></li>
                    <li class = "highlight"><a href="#">Поиск</a></li>
                    <li class = "highlight"><a href="calendar.php">Календарь</a></li>
                    <li class = "highlight"><a href="price.php">Калькулятор</a></li>
                    <li class = "highlight"><a href="#">История</a></li>
                    <li class = "highlight"><a href="logout.php" >Выход</a></li>
                </ul>
            </div>   
        </div> 
    </div>
    <div class="container">
        <div class="row row-flex">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="content colour-1 left-sidebar">
                    <div id = "treeview"></div>
                </div>
            </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="content colour-1">
                <div class="row row-flex">  
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="content colour-5">
                            <a class = "main-menu" href="add.php"><i class="fas fa-plus-square fa-3x"></i><span class = "menu-it">Добавить</span></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="content colour-4">
                            <a class = "main-menu" href="#"><i class="fa fa-search fa-3x"></i><span class = "menu-it">Найти</span></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="content colour-5">
                            <a class = "main-menu" href="calendar.php"><i class="far fa-calendar-alt fa-3x"></i><span class = "menu-it">Календарь</span></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="content colour-4">
                            <a class = "main-menu" href="#"><i class="fas fa-wrench fa-3x"></i><span class = "menu-it">Методики</span></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="content colour-5">
                            <a class = "main-menu" href="price.php"><i class="fas fa-calculator fa-3x"></i><span class = "menu-it">Стоимость</span></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="content colour-4">
                            <a class = "main-menu" href="archive.php"><i class="fas fa-book fa-3x"></i><span class = "menu-it">Архив</span></a>
                        </div>
                    </div>
                </div>

                <div class="row row-flex"> 
                    <h2 class="history"> История </h2>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-6">
                            <p>Расчет стоимости испытаний<br/>Калориферная сборка<br/>ООО "Остров"<br/>Русейкин Н.<br/>25.05.18 13.00</p><hr/>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>    
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-treeview.min.js"></script>
    <script src="js/main.js"></script>  
</body>
</html>
<?php } ?>