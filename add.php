<?php session_start();
    
    if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] != "yes")
    {
        header("Location: login.php");
    }
    else
    {

    header('Content-Type: text/html; charset=utf-8');
    $host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'info_sys';

    $connect = mysql_connect($host, $db_user, $db_pass) or die("Ошибка: " . mysql_error());
    mysql_select_db($db_name) or die("Ошибка");
    mysql_set_charset('utf8', $connect);

    $query = " SELECT id, cypher FROM standards";
    $standards = mysql_query($query) or die("Ошибка: " . mysql_error());
    $query = " SELECT id, name FROM organizations";
    $organizations = mysql_query($query) or die("Ошибка: " . mysql_error());
    $query = " SELECT id, name FROM workers";
    $workers = mysql_query($query) or die("Ошибка: " . mysql_error());
    $query = " SELECT id, name FROM equipments";
    $equipments = mysql_query($query) or die("Ошибка: " . mysql_error());
    $query = " SELECT id, name FROM objects";
    $objects = mysql_query($query) or die("Ошибка: " . mysql_error());
    $query = " SELECT id, name FROM methods_cats";
    $methods_cats = mysql_query($query) or die("Ошибка: " . mysql_error());
    $query = "SELECT * FROM price_variables";
    $vars = mysql_query($query) or die("Ошибка: " . mysql_error());
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Climatic laboratory ecm</title>  
    <link rel = "stylesheet" href = "css/bootstrap.css">
    <link rel = "stylesheet" href = "css/bootstrap-treeview.min.css">
    <link rel = "stylesheet" href = "css/jquery-ui.css">
    <link rel= "stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel = "stylesheet" href = "css/fullcalendar.css">
    <link rel = "stylesheet" href = "css/fullcalendar.print.css" media="print">
    <link rel = "stylesheet" href = "css/style.css">  
    <style>
        .col-sm-10 {
            margin-bottom: 10px;
        }
        .btn-info {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Modals -->
    <?php if (isset($_SESSION['add_result'])) { ?>
    <div id="modalRes" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Message</h4>
                </div>
              <div class="modal-body">
                    <p><?php echo $_SESSION['add_result'];?></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        </div>
    </div>
    <?php $_SESSION['add_result'] = NULL; } ?>
    
    <div id="modalOrg" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Добавить орагнизацию</h4>
            </div>
            <div class="modal-body">
               <?php include 'add_org.php'; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <div id="modalWrk" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Добавить объект испытаний</h4>
            </div>
            <div class="modal-body">
                <?php include 'add_worker.php'; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <div id="modalObj" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Добавить объект испытаний</h4>
            </div>
            <div class="modal-body">
                <?php include 'add_obj.php'; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <div id="modalEquip" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Добавить оборудование</h4>
            </div>
            <div class="modal-body">
                <?php include 'add_equipment.php'; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <div id="modalMeth" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Добавить метод</h4>
            </div>
            <div class="modal-body">
                <?php include 'add_method.php'; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    
    <?php 
        if (isset($_POST['submit0']) && (isset($_POST['price'])) && ($_POST['price']!=""))
        {
            $L = $_POST['L'];
            $Knz = $_POST['Кнз'];
            $Knr = $_POST['Кнр'];
            $P = $_POST['Р'];
            $tp = $_POST['tр'];
            $tpp = $_POST['tп'];
            $tap = $_POST['tап'];
            $tpz = $_POST['tпз'];
            $tio = $_POST['tио'];
            $Kio = $_POST['Кио'];
            $tm = $_POST['tm'];
            $m = $_POST['m'];
            $Km = $_POST['Kм'];
            $Klo = $_POST['Kл'];
            $C = $_POST['price'];
            $date = $_POST['curr_time'];
            $auth = $_POST['auth'];
        }
    ?>
    
    
    <div id="modalPrice" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Расчет стоимости проведения испытаний</h4>
            </div>
            <div class="modal-body" style = "border-bottom: 0px; min-height: 330px;">
                <form class="form-horizontal" id = "price_form" method="post" action="add.php">
                <?php 
                    while($row = mysql_fetch_array($vars))
                    {?>
                            <label class="col-sm-1 control-label" style = "font-weight: 800; margin-bottom: 10px;" 
                                   data-placement="left" data-toggle="tooltip" 
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
                        <input type="number" step = "any" class="form-control" id = "price_input" name="price" readonly>
                    </div>
                    <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="curr_time"/>
                    <input type="hidden" value="<?php echo $_SESSION['login'];?>" name="auth"/>
                    <button type="button" class="btn btn-default btn-block" onClick = "calc()">Расcчитать</button>
                    <button type="button" class="btn btn-default btn-block" onClick = "clean()">Очистить неконстантные поля</button>
                    <input type="submit" class="btn btn-default btn-block" value="Сохранить расчет" name="submit0" onClick = "return isemp()"/>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onClick = "clean()">Close</button>
            </div>
          </div>
        </div>
    </div>
    
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
                        <div class="content">
                            <div class="form-group">
                                <label for="adding">Добавить:</label>
                                <select class="form-control" id="add" onchange="show(this)">
                                    <option selected value = "1">Испытание</option>
                                    <option value = "2">Организацию</option>
                                    <option value = "3">Исполнителя</option>
                                    <option value = "4">Объект испытаний</option>
                                    <option value = "5">Оборудование</option>
                                    <option value = "6">Стандарты</option>
                                    <option value = "7">Методы испытаний</option>   
                                </select>
                            </div>                            
                            
                            <div class = "adding" id="test" style="display: block;">
                                <hr/>
                                <form class="form-horizontal" id = "test1" method="post" action = "adding.php">
                                     <div class="form-group">
                                        <!--Объект-->
                                        <label class="col-sm-2 control-label">Объект</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="obj" name = "obj">
                                                <?php while($row = mysql_fetch_array($objects))
                                                {?>
                                                     <option value = "<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10 butt">
                                             <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modalObj">Добавить объект испытаний</button>
                                        </div>
                                        
                                        <!--Организация-->
                                        <label class="col-sm-2 control-label">Организация</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="org" name = "org">
                                                <?php while($row = mysql_fetch_array($organizations))
                                                {?>
                                                     <option value = "<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10">
                                             <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modalOrg">Добавить организацию</button>   
                                        </div>
                                         
                                        <!--Время-->
                                        <label class="col-sm-2 control-label">Время, мин</label>
                                        <div class="col-sm-10">
                                            <input type="number" id = "tm" name = "time" class="form-control input-xs" placeholder="Введите продолжительность испытания">
                                        </div> 
                                         
                                        <!--Методы-->
                                        <label class="col-sm-2 control-label">Методы</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="method" name = "method">
                                                <?php while($row = mysql_fetch_array($methods_cats))
                                                {?>
                                                     <option value = "<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10 butt">
                                             <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalMeth">Добавить метод</button>
                                        </div>
                                         
                                        <!--Стоимость-->
                                        <label class="col-sm-2 control-label">Стоимость</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control input-xs" name = "price_tst" placeholder="Введите или расчитайте стоимость"
                                                   <?php if (isset($C)) echo "value=\"".$C."\""; ?>>
                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10 butt">
                                             <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modalPrice">Рассчитать стоимость</button>
                                        </div>
                                         
                                        <!--Исполнитель-->
                                        <label class="col-sm-2 control-label">Исполнителя</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="wrk" name = "wrk[]" multiple="multiple">
                                                <?php while($row = mysql_fetch_array($workers))
                                                {?>
                                                     <option value = "<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10 butt">
                                             <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modalWrk">Добавить исполнителя</button>
                                        </div>
                                         
                                        <!--Оборудование-->
                                        <label class="col-sm-2 control-label">Оборудование</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="equip" name = "equip[]" multiple="multiple">
                                                <?php while($row = mysql_fetch_array($equipments))
                                                {?>
                                                     <option value = "<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
                                                <?}?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                        </div>
                                        <div class="col-sm-10 butt">
                                             <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modalEquip">Добавить оборудование</button>
                                        </div>
                                         
                                        <!--Даты-->
                                        <label class="col-sm-2 control-label">Начало</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control input-xs" name ="start_tst" placeholder="Введите даты">
                                        </div>
                                        <label class="col-sm-2 control-label">Завершение</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control input-xs" name ="end_tst" placeholder="Введите даты">
                                        </div>
                                         
                                        <!--Статус-->
                                        <label class="col-sm-2 control-label">Статус</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="test_satatus" name = "test_satatus">
                                                <option value = "В процессе">В процессе</option>
                                                <option value = "Завершено">Завершено</option>
                                            </select>
                                        </div>
                                         
                                     </div>
                                    <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="curr_time1"/>
                                    <input type="hidden" value="<?php echo $_SESSION['login'];?>" name="author"/>
                                    <input type="submit" class="btn btn-default btn-block" value="Добавить испытание" name="submit1">
                                </form> 
                            </div> 
                            
                            <div class = "adding" id="organization" style="display: none">
                                <hr/>
                                <?php include 'add_org.php'; ?>
                            </div>
                            
                            <div class = "adding" id="worker" style="display: none;">
                                <hr/>
                                <?php include 'add_worker.php'; ?>
                            </div>
                            
                            <div class = "adding" id="object" style="display: none;">
                                <hr/>
                                <?php include 'add_obj.php'; ?>
                            </div>
                            
                            <div class = "adding" id="equipment" style="display: none;">
                                <hr/>
                                <?php include 'add_equipment.php'; ?>
                            </div>
                            
                            <?php include 'add_standard.php'; ?>
                            
                            <div class = "adding" id="methods_cats" style="display: none;">
                                <hr/>
                                <?php include 'add_method.php'; ?>
                            </div>
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
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ru.js"></script>
    <script src="js/jquery-ui.js"></script>
</body>
</html>
<?php } ?>