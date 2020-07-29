<?php session_start();

if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] != "yes")
{
    header("Location: login.php");
}
else
{

    $host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'info_sys';

    $connect = mysql_connect($host, $db_user, $db_pass) or die("Ошибка: " . mysql_error());
    mysql_select_db($db_name) or die("Ошибка");
    mysql_set_charset('utf8', $connect);

    $query = "SELECT * FROM price_variables";
    $vars = mysql_query($query) or die("Ошибка: " . mysql_error());

    $query = "SELECT * FROM tests";
    $tests = mysql_query($query) or die("Ошибка: " . mysql_error());
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Climatic laboratory ecm</title>  
    <link rel = "stylesheet" href = "css/bootstrap.css">
    <link rel = "stylesheet" href = "css/bootstrap-treeview.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="content colour-1">
                            <form class="form-horizontal" id = "price_form" method="post" action="template.php">
                             <div class="form-group">
                                <!--Объект-->
                                <label class="col-sm-12 control-label" style="margin-bottom: 20px; text-align: left;">Выполнить расчет стоимости для испытания:</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="test" name ="test" >
                                        <?php while($row = mysql_fetch_array($tests))
                                        {?>
                                             <option value = "<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <input type="hidden" value="111" id="from_separate"/>
                            </div> 
                                   
                            <?php 
                                while($row = mysql_fetch_array($vars))
                                {?>
                                        <label class="col-sm-1 control-label" style = "font-weight: 800; margin-bottom: 10px;" 
                                               data-placement="right" data-toggle="tooltip" 
                                               title="<?php echo $row["description"];?>">
                                                    <?php if (isset($row["subname"])) 
                                                                { echo $row["name"] . '<sub>'.$row["subname"].'</sub>'; }
                                                            else echo $row["name"];?>
                                        </label>
                                        <div class="col-sm-5" style = "margin-bottom: 10px;">
                                            <input type="number" step="any" class="form-control pr_variables" value = "<?php echo $row["value"];?>" 
                                                   <?php if ($row["const"] == true) echo "style = \"background-color: #a0c99f; font-weight: 600;\""; ?>
                                                name = "<?php if (isset($row["subname"])) 
                                                                { echo $row["name"] .$row["subname"]; }
                                                            else echo $row["name"];?>">
                                        </div>
                                <?}?>

                                <label class="col-sm-1 control-label" id = "price_label"
                                               data-placement="left" data-toggle="tooltip" 
                                               title="Стоимость проведения испытаний">
                                    С<sub>ип</sub>
                                </label>
                                <div class="col-sm-5" style = "margin-bottom: 10px;">
                                    <input type="number" step = "any" class="form-control" id = "price_input" name="price" readonly style = "margin-bottom: 20px;">
                                </div>
                                <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="curr_time"/>
                                <input type="hidden" value="<?php echo $_SESSION['login'];?>" name="auth"/>
                                <div class="col-sm-5">
                                </div>
                                <div class="col-sm-12" style = "margin-bottom: 10px;">
                                </div>
                                <div class="col-sm-6" style = "margin-bottom: 10px;">
                                    <button type="button" class="btn btn-default btn-block" onClick = "calc()">Расcчитать</button>
                                </div>
                                 <div class="col-sm-6" style = "margin-bottom: 10px;">
                                     <button type="button" class="btn btn-default btn-block" onClick = "clean()">Очистить неконстантные поля</button>
                                </div>
                                <div class="col-sm-6" style = "margin-bottom: 10px;">
                                    <button type="submit" class="btn btn-default btn-block" onClick = "return isemp()">Сгенерировать отчет</button>
                               </div>
                                <div class="col-sm-6" style = "margin-bottom: 10px;">
                                    <button type="button" class="btn btn-default btn-block" onclick="location.href='download.php'">Скачать отчет</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row row-flex"> 
                    
                </div>
            </div>
          </div>
        </div>    
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-treeview.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
<?php } ?>