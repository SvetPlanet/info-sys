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

    $query = " SELECT * FROM eventTypes";
    $event_types = mysql_query($query) or die("Ошибка: " . mysql_error());
    $query = " SELECT * FROM tests";
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
    <link rel = "stylesheet" href = "css/jquery-ui.css">
    <link rel= "stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel = "stylesheet" href = "css/fullcalendar.css">
    <link rel = "stylesheet" href = "css/fullcalendar.print.css" media="print">
    <link rel = "stylesheet" href = "css/style.css">
</head>
<body> 
    <div id="modalAddEv" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Добавить событие</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <select class="form-control" id="ev_type" onchange="showTitle(this)">
                                <?php
                                while($row = mysql_fetch_array($event_types))
                                {?>
                                     <option value = "<?php echo $row["id"]; ?>">
                                         <?php echo $row["name"]; ?></option>
                                    <?
                                }?>
                            </select>
                        </div>
                        <div class="col-sm-12" id = "hid_title_test" style = "display: none;">
                            <select class="form-control" id="test_name">
                                <?php 
                                while($row = mysql_fetch_array($tests))
                                {?>
                                     <option value = "<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
                                <?
                                }?>
                            </select>
                        </div>
                        <label class="col-sm-3 control-label" id = "hid_title_l" style = "display: none;">Наименование</label>
                        <div class="col-sm-9" id = "hid_title" style = "display: none;">
                            <input type="text" name="title" id="title_event" class="form-control input-xs" placeholder="Введите наименование события"
                                   />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save_event">Добавить</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="modalEvInfo" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ev_title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            Start: <span id="startTime"></span><br>
                            End: <span id="endTime"></span><br><br>
                            <p class="col-xs-12" id="eventInfo" style="margin-left: -15px;"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <input type="hidden" id="ModalId"/>
                    <button type="button" class="btn btn-default" id="delEvent">Удалить</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            <div id = "lef-navvv" class="col-md-4 col-sm-6 col-xs-12">
                <div class="content colour-1 left-sidebar">
                    <div id = "treeview"></div>
                </div>
            </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="content colour-1" >
                <div id = "calendar">
                </div>
            </div>
          </div>
        </div>    
    </div>
    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-treeview.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ru.js"></script>
    <script>
        
    var nm = {data1: ''} 
    var tp = {data1: ''}
        
    function showTitle(elem){
        var a = elem.value;
        window.tp = a;
        switch (a) {
            case "1":
                document.getElementById('hid_title_test').style.display = "block";
                document.getElementById('hid_title').style.display = "none";
                document.getElementById('hid_title_l').style.display = "none";
                break;
            case "2":{
                document.getElementById('hid_title_test').style.display = "none";
                document.getElementById('hid_title_l').style.display = "block";
                document.getElementById('hid_title').style.display = "block";
                break;
            }
            case "3":{
                document.getElementById('hid_title_test').style.display = "none";
                document.getElementById('hid_title_l').style.display = "block";
                document.getElementById('hid_title').style.display = "block";
                break;
            }
            case "4":{
                document.getElementById('hid_title_test').style.display = "none";
                document.getElementById('hid_title_l').style.display = "block";
                document.getElementById('hid_title').style.display = "block";
                break;
            }
        }
    }
           
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            events: 'load_events.php',
            selectable:true,
            selectHelper:true,
            select: function(start, end, allDay)
            {
                $('#modalAddEv').modal();
                var title = "";
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                var type = tp;
                
                $("#save_event").off('click').on('click', function(e) {
                    if (tp == "1")
                    {
                        title = document.getElementById("test_name").value;
                    }
                    else if ((tp == "2") || (tp == "3") || (tp == 4))
                    {
                        title = document.getElementById("title_event").value;
                    }

                    if ((tp != "") && (title!=""))
                    {
                        $.ajax({
                       url:"insert_event.php",
                       type:"POST",
                       data:{title:title, start:start, end:end, type:tp},
                       success:function()
                       {
                        calendar.fullCalendar('refetchEvents');
                       },
                       error:function(data){
                           alert("На выбранную дату уже заплонированы работы.");
                       }
                      });
                    }
                    else {alert("Не все данные введены! ");}
                    $('#modalAddEv').modal('hide'); 
                });
                
            },
            editable:true,
            eventResize:function(event)
            {
                 var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                 var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                 var title = event.title;
                 var id = event.id;
                 $.ajax({
                    url:"update_event.php",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                    }
                })
            },  
            
            eventDrop:function(event)
            {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"update_event.php",
                    type:"POST",
                    data:{title:title, start:start, end:end, id:id},
                    success:function()
                    {
                        calendar.fullCalendar('refetchEvents');
                    },
                   error:function(data){
                       alert("На выбранную дату уже заплонированы работы.");
                   }
                });
            },

            eventClick: function (event, jsEvent, view) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                
                $('#ev_title').html(title);
                $('#startTime').html(start);
                $('#endTime').html(end);
                $('#eventInfo').html(event.info + event.description);
                $('#modalEvInfo').modal();

                
                $("#delEvent").off('click').on('click', function(e) {
                    if(confirm("Вы уверены, что хотите удалить файл?"))
                    {
                
                         var id = event.id;
                          $.ajax({
                           url:"delete_event.php",
                           type:"POST",
                           data:{id:id},
                           success:function()
                           {
                            calendar.fullCalendar('refetchEvents');
                            //alert("Событие удалено");
                           }  
                        })
                        $('#modalEvInfo').modal('hide'); 
                    }
                });
            } 
        });
    });
    </script>
</body>
</html>
<?php } ?>