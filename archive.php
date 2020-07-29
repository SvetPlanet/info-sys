<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] != "yes")
{
    header("Location: login.php");
}
else
{?>

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
                    <li class = "highlight"><a class = "cl" href="#">Архив</a></li>
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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="content colour-1" >
              <h2 align="center">Архив</h2>
                   <br />
                   <div align="right">
                    <button type="button" name="create_folder" id="create_folder" class="btn btn-success">Создать</button>
                   </div>
                   <br />
                   <div class="table-responsive" id="folder_table">
                   </div>  
            </div>
          </div>
        </div>    
    </div>
</body>
</html>

<div id="folderModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"><span id="change_title">Создать папку</span></h4>
   </div>
   <div class="modal-body">
    <p>Введите наименование папки
    <input type="text" name="folder_name" id="folder_name" class="form-control" /></p>
    <br />
    <input type="hidden" name="action" id="action" />
    <input type="hidden" name="old_name" id="old_name" />
    <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create" />
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
<div id="uploadModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Загрузить файл</h4>
   </div>
   <div class="modal-body">
    <form method="post" id="upload_form" enctype='multipart/form-data'>
     <p>Выберите файл
     <input type="file" name="upload_file" /></p>
     <br />
     <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" />
     <input type="submit" name="upload_button" class="btn btn-info" value="Загрузить" />
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<div id="filelistModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Список файлов</h4>
   </div>
   <div class="modal-body" id="file_list">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script>
$(document).ready(function(){
 
 load_folder_list();
 
 function load_folder_list()
 {
  var action = "fetch";
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
    $('#folder_table').html(data);
   }
  });
 }
 
 $(document).on('click', '#create_folder', function(){
  $('#action').val("create");
  $('#folder_name').val('');
  $('#folder_button').val('Создать');
  $('#folderModal').modal('show');
  $('#old_name').val('');
  $('#change_title').text("Создать папку");
 });
 
 $(document).on('click', '#folder_button', function(){
  var folder_name = $('#folder_name').val();
  var old_name = $('#old_name').val();
  var action = $('#action').val();
  if(folder_name != '')
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{folder_name:folder_name, old_name:old_name, action:action},
    success:function(data)
    {
     $('#folderModal').modal('hide');
     load_folder_list();
    //alert(data);
    }
   });
  }
  else
  {
   alert("Введите имя папки");
  }
 });
 
 $(document).on("click", ".update", function(){
  var folder_name = $(this).data("name");
     //alert(folder_name);
  $('#old_name').val(folder_name);
  $('#folder_name').val(folder_name);
  $('#action').val("change");
  $('#folderModal').modal("show");
  $('#folder_button').val('Переименовать');
 });
 
 $(document).on("click", ".delete", function(){
  var folder_name = $(this).data("name");
  var action = "delete";
  if(confirm("Вы уверены что хотите удалить этот объект?"))
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{folder_name:folder_name, action:action},
    success:function(data)
    {
     load_folder_list();
     //alert(data);
    }
   });
  }
 });
 
 $(document).on('click', '.upload', function(){
  var folder_name = $(this).data("name");
  $('#hidden_folder_name').val(folder_name);
  $('#uploadModal').modal('show');
 });
 
 $('#upload_form').on('submit', function(){
  $.ajax({
   url:"upload.php",
   method:"POST",
   data: new FormData(this),
   contentType: false,
   cache: false,
   processData:false,
   success: function(data)
   { 
    load_folder_list();
    alert(data);
   }
  });
 });
 
 $(document).on('click', '.view_files', function(){
  var folder_name = $(this).data("name");
  var action = "fetch_files";
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{action:action, folder_name:folder_name},
   success:function(data)
   {
    $('#file_list').html(data);
    $('#filelistModal').modal('show');
   }
  });
 });
 
 $(document).on('click', '.remove_file', function(){
  var path = $(this).attr("id");
  var action = "remove_file";
  if(confirm("Вы уверены, что хотите удалить файл?"))
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{path:path, action:action},
    success:function(data)
    {
     //alert(data);
     $('#filelistModal').modal('hide');
     load_folder_list();
    }
   });
  }
 });
    
/*$(document).on('click', '.download_file', function(){
  //var path = $(this).attr("id");
    var path = 'archive/test/Jungkookie/Template.docx';
    alert(path);
  var action = "download_file";
    $.ajax({
    url:"download.php",
    method:"POST",
    data:{path:path, action:action},
    success:function(data)
    {
        alert(data);
         $('#filelistModal').modal('hide');
         load_folder_list();
    }
    });
 });*/

$(document).on('blur', '.change_file_name', function(){
  var folder_name = $(this).data("folder_name");
  var old_file_name = $(this).data("file_name");
  var new_file_name = $(this).text();
  var action = "change_file_name";
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{folder_name:folder_name, old_file_name:old_file_name, new_file_name:new_file_name, action:action},
   /*success:function(data)
   {
    alert(data);
   }*/
  });
 });
 
});
</script>
<?php } ?>
