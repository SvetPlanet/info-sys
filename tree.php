<?php

    $host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'info_sys';

    $connect = mysql_connect($host, $db_user, $db_pass) or die("Ошибка: " . mysql_error());
    mysql_select_db($db_name) or die("Ошибка");
    mysql_set_charset('utf8', $connect);

    $query = " SELECT * FROM archive a";

    $result = mysql_query($query) or die("Ошибка: " . mysql_error());

    $output = array();
    while($row = mysql_fetch_array($result))
    {
         $row_data["id"] = $row["id"];
         $row_data["name"] = $row["name"];
         $row_data["text"] = $row["name"];
         $row_data["idAncestor"] = $row["idAncestor"];
         $data[] = $row_data;
    }

    foreach($data as $key => &$value)
    {
        $res[$value["id"]] = &$value;
    }

    foreach($data as $key => &$value)
    {
         if($value["idAncestor"] && isset($res[$value["idAncestor"]]))
         {
            $res[$value["idAncestor"]]["nodes"][] = &$value;
         }
    }

    foreach($data as $key => &$value)
    {
         if($value["idAncestor"] && isset($res[$value["idAncestor"]]))
         {
            unset($data[$key]);
         }
    }
    
    echo json_encode($data);
?>