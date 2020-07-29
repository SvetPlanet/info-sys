<?php
$base_path = "archive/test";

if($_FILES["upload_file"]["name"] != '')
{
 $data = explode(".", $_FILES["upload_file"]["name"]);
 $extension = $data[1];
 $allowed_extension = array("jpg", "png", "gif", "doc", "docx", "pdf");
 if(in_array($extension, $allowed_extension))
 {
  //$new_file_name = iconv("UTF-8", "CP1251", (rand() . '.' . $extension));
     $new_file_name = iconv("UTF-8", "CP1251", $_FILES["upload_file"]["name"]);
  $nm1 = iconv("UTF-8", "CP1251", $_POST["hidden_folder_name"]);
  $path = $base_path. '/' . $nm1 . '/' . $new_file_name;
  if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $path))
  {
   echo 'Файл загружен.';
  }
  else
  {
   echo 'Возникла ошибка.';
  }
 }
 else
 {
  echo 'Запрещенный формат файла.';
 }
}
else
{
 echo 'Файл не выбран.';
}
?>
