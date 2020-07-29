<?php

    $host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'info_sys';

    $connect = mysql_connect($host, $db_user, $db_pass) or die("Ошибка: " . mysql_error());
    mysql_select_db($db_name) or die("Ошибка");
    mysql_set_charset('utf8', $connect);
    $query = "SELECT * FROM events ORDER BY id";
    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
    $data = array();
    
    while($row = mysql_fetch_array($result))
    {
        $info = "";
        if ($row["type"] == 1)
        {
            $col = 'blue';
        }
        else if ($row["type"] == 2)
        {
            $col = 'green';
            $ev_id = $row["id"];
            $query1 = "SELECT worktimeId, workerId FROM busyness WHERE eventId = ' $ev_id '";
            $result1 = mysql_query($query1) or die("Ошибка: " . mysql_error());
            while($row1 = mysql_fetch_array($result1))
            {
                $w_id = $row1["workerId"];
                $query2 = "SELECT name FROM workers WHERE id = ' $w_id '";
                $result2 = mysql_query($query2) or die("Ошибка: " . mysql_error());
                $wt_id = $row1["worktimeId"];
                $query3 = "SELECT start, end FROM worktime WHERE id = ' $wt_id '";
                $result3 = mysql_query($query3) or die("Ошибка: " . mysql_error());

                $res1 = mysql_fetch_row($result2);
                $nm = $res1[0];
                $res2 = mysql_fetch_row($result3);
                $st = $res2[0]; $en = $res2[1];
                $info .= "Исполнитель: $nm <br/> Время работы:  $st - $en <br/>";
            }
            
        }
        else if ($row["type"] == 3)
        {
            $col = 'grey';
        }
        else if ($row["type"] == 4)
        {
            $col = 'red';
        }
        
        $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'start'   => $row["start"],
        'end'   => $row["end"],
        'type'   => $row["type"],
        'color'  => $col,
        'description'  => $row["description"],
        'info' => $info
        );
    }
    echo json_encode($data);

?>
