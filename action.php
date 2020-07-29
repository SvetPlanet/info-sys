<?php
header('Content-Type: text/html; charset= utf-8'); 
session_start();
$base_path = "archive/test";

function format_folder_size($size)
{
 if ($size >= 1073741824)
 {
  $size = number_format($size / 1073741824, 2) . ' GB';
 }
    elseif ($size >= 1048576)
    {
        $size = number_format($size / 1048576, 2) . ' MB';
    }
    elseif ($size >= 1024)
    {
        $size = number_format($size / 1024, 2) . ' KB';
    }
    elseif ($size > 1)
    {
        $size = $size . ' bytes';
    }
    elseif ($size == 1)
    {
        $size = $size . ' byte';
    }
    else
    {
        $size = '0 bytes';
    }
 return $size;
}

function get_folder_size($folder_name)
{
 $total_size = 0;
 $file_data = scandir($folder_name);
 foreach($file_data as $file)
 {
  if($file === '.' or $file === '..')
  {
   continue;
  }
  else
  {
   $path = $folder_name . '/' . $file;
   $total_size = $total_size + filesize($path);
  }
 }
 return format_folder_size($total_size);
}

if(isset($_POST["action"]))
{
 if($_POST["action"] == "fetch")
 {
     chdir($base_path);
     $folder = array_filter(glob('*'), 'is_dir');
     
     //$dir  = '/archive';
     //$folder = array_filter(scandir($dir), 'is_dir');
  
  $output = '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Имя папки</th>
    <th>Количество файлов</th>
    <th>Размер</th>
    <th>Переименовать</th>
    <th>Удалить</th>
    <th>Загрузить файлы</th>
    <th>Список файлов</th>
   </tr>
   ';
  if(count($folder) > 0)
  {
   foreach($folder as $name)
   {
       $name1 = iconv("CP1251", "UTF-8", $name);
     $output .= '
     <tr>
      <td>'.$name1.'</td>
      <td>'.(count(scandir($name)) - 2).'</td>
      <td>'.get_folder_size($name).'</td>
      <td><button type="button" name="update" data-name="'.$name1.'" class="update btn btn-warning btn-xs">Переименовать</button></td>
      <td><button type="button" name="delete" data-name="'.$name1.'" class="delete btn btn-danger btn-xs">Удалить</button></td>
      <td><button type="button" name="upload" data-name="'.$name1.'" class="upload btn btn-info btn-xs">Загрузить файлы</button></td>
      <td><button type="button" name="view_files" data-name="'.$name1.'" class="view_files btn btn-default btn-xs">Список файлов</button></td>
     </tr>';
   }
  }
  else
  {
   $output .= '
    <tr>
     <td colspan="6">Каталог не обнаружен</td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }
 
 if($_POST["action"] == "create")
 {
     chdir($base_path);
    $nm = iconv("UTF-8", "CP1251", $_POST["folder_name"]);
  if(!file_exists($nm)) 
  {
       mkdir($nm, 0777, true);
      
       /*echo 'Folder Created';*/
  }
  else
  {
   echo 'Папка с таким названием уже существует';
  }
 }
 if($_POST["action"] == "change")
 {
     chdir($base_path); 
  if(!file_exists($_POST["folder_name"]))
  {
    $nm1 = iconv("UTF-8", "CP1251", $_POST["old_name"]);
    $nm2 = iconv("UTF-8", "CP1251", $_POST["folder_name"]);
    rename($nm1, $nm2);
   /*echo 'Folder Name Change';*/
  }
  else if ($nm1 != $nm2)
  {
   echo 'Папка с таким названием уже существует';
  }
 }
 
 if($_POST["action"] == "delete")
 {
   $nm3 = iconv("UTF-8", "CP1251", $_POST["folder_name"]); 
   $nm3 = $base_path.'/'.$nm3;  
   $files = scandir($nm3);
  foreach($files as $file)
  {
   if($file === '.' or $file === '..')
   {
    continue;
   }
   else
   {
    unlink($nm3 . '/' . $file);
   }
  }
  if(rmdir($nm3))
  {
   /*echo 'Folder Deleted';*/
  }
 }
 
 if($_POST["action"] == "fetch_files")
 {
  $nm4 = iconv("UTF-8", "CP1251", $_POST["folder_name"]);  
  $file_data = scandir($base_path.'/'.$nm4);
  $output = '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Имя файла</th>
    <th>Удалить</th>
    <!--<th>Скачать</th>-->
   </tr>
  ';
  
  foreach($file_data as $file)
  {
   if($file === '.' or $file === '..')
   {
    continue;
   }
   else
   {
    $name2 = iconv("CP1251", "UTF-8", $file);  
    $path = $_POST["folder_name"] . '/' . $name2;
    $output .= '
    <tr>
     <td contenteditable="true" data-folder_name="'.$_POST["folder_name"].'"  data-file_name = "'.$name2.'" class="change_file_name">'.$name2.'</td>
     <td><button name="remove_file" class="remove_file btn btn-danger btn-xs" id="'.$path.'">Удалить</button></td>
     <!--<td><button name="download_file" class="download_file btn btn-info btn-xs" id="'.$path.'">Скачать</button></td>-->
    </tr>
    ';
   }
  }
  $output .='</table>';
  echo $output;
 }
 
 if($_POST["action"] == "remove_file")
 {
  $file_n = iconv("UTF-8", "CP1251", $_POST["path"]); 
  $file_n = $base_path.'/'.$file_n;
     
  if(file_exists($file_n))
  {
   unlink($file_n);
  }
 }

/*if($_POST["action"] == "download_file")
 {
  //$file_n = iconv("UTF-8", "CP1251", $_POST["path"]); 
  //$file_n = $base_path.'/'.$file_n;

  $file_n = iconv("UTF-8", "CP1251", $_POST["path"]); 
  $file_n = $base_path.'/'.$file_n;  
     
      //echo '1) Путь файла    '.$file_n;
  if(file_exists($file_n))
  {
      //$_SESSION['filename'] = 'archive/test/Jungkookie/Template.docx';
      header("Location: download.php");

    /*header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Type: application/pdf; charset=utf-8');

    header('Content-Disposition: attachment; filename="'. basename($file_n) . '";');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file_n));

    readfile($file_n);
    exit;
  }
 }   */ 
    
 if($_POST["action"] == "change_file_name")
 {
  $f_n = iconv( "UTF-8", "CP1251", $_POST["folder_name"]);
  chdir($base_path.'/'.$f_n);
  $old_name = iconv( "UTF-8", "CP1251", $_POST["old_file_name"]); 
  $new_name = iconv( "UTF-8", "CP1251", $_POST["new_file_name"]);
     if ($old_name != $new_name)
     {
     if(rename($old_name, $new_name))
      {
       /*echo 'Файл переименован';*/
      }
      else
      {
       echo 'Ошибка переименования файла';
      }
     }
 }
}
?>