<?php
session_start();
require_once 'vendor/autoload.php';

$phpWord = new  \PhpOffice\PhpWord\PhpWord();
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("Template.docx");

$test_id = $_POST['test'];

$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'info_sys';

$connect = mysql_connect($host, $db_user, $db_pass) or die("Ошибка: " . mysql_error());
mysql_select_db($db_name) or die("Ошибка");
mysql_set_charset('utf8', $connect);

$query = " SELECT * FROM tests WHERE id = '$test_id'";
$tests = mysql_query($query) or die("Ошибка: " . mysql_error());
$row = mysql_fetch_row($tests);


$method = "Метод";
$hour = intval(intval($row[3]) / 60);
$min = intval($row[3]) - 60*$hour;

$query1 = " SELECT * FROM objects WHERE id = '$row[6]'";
$objs= mysql_query($query1) or die("Ошибка: " . mysql_error());
$row1 = mysql_fetch_row($objs);

$object = $row1[2];

$query2 = " SELECT * FROM Organizations WHERE id = '$row[5]'";
$orgs = mysql_query($query2) or die("Ошибка: " . mysql_error());
$row2 = mysql_fetch_row($orgs);
$org = $row2[1];

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
$tmo = ($km + 1) * $m * $tm;
$tir = $tio * (1 + $kio);

$name = "testId_".$test_id."_Method.docx";

$nm = iconv("UTF-8", "CP1251", $org);
$base_path = "archive/test/";
if(!is_dir($base_path.$nm)) 
{
   mkdir($base_path.$nm, 0777, true);
}

$templateProcessor->setValue('method', $method);
$templateProcessor->setValue('hour', $hour);
$templateProcessor->setValue('min', $min);
$templateProcessor->setValue('object', $object);
$templateProcessor->setValue('organization', $org);
$templateProcessor->setValue('tp', $tp);
$templateProcessor->setValue('tpp', $tpp);
$templateProcessor->setValue('tpz', $tpz);
$templateProcessor->setValue('tio', $tio);
$templateProcessor->setValue('tir', $tir);
$templateProcessor->setValue('tmo', $tmo);
$templateProcessor->setValue('kio', $kio);
$templateProcessor->setValue('tm', $tm );
$templateProcessor->setValue('m', $m);
$templateProcessor->setValue('km', $km);
$templateProcessor->setValue('tap', $tap);
$templateProcessor->setValue('L', $L);
$templateProcessor->setValue('Knz', $Knz);
$templateProcessor->setValue('Knr', $Knr);
$templateProcessor->setValue('P', $P);
$templateProcessor->setValue('C', $C);

$full_name = 'archive/test/'.$nm.'/'.$name;
$templateProcessor->saveAs($full_name); 

$_SESSION['filename'] = $full_name;

header("Location: price.php");

?>