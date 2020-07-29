<?php

    $db_pass = '';
	$user = 'root';
    $connect = new PDO('mysql:host=localhost;dbname=info_sys', $user, $db_pass);

    if(isset($_POST["title"]))
    {
        $st = $_POST['start'];
        $en = $_POST['end'];
        
        $query0 = 'SELECT COUNT(*) as num FROM events WHERE (type = 1 or type = 2) and 
                                    NOT ( 
                                      (:st < start AND :en <= start)
                                      OR
                                      (:st >= end AND :en > end)
                                    )';
        $statement0 = $connect->prepare($query0);
         $statement0->execute(
          array(
           ':st'  =>  $st,
           ':en' => $en
          )
         );
        
        $num=1000;
        while($row = $statement0->fetch()) {
            $num = $row['num'];
        } 

        if ($num <= 0)
        {
        
         $query = "INSERT INTO events (title, start, end, type) VALUES (:title, :start, :end, :type)";
            $statement = $connect->prepare($query);
             $statement->execute(
              array(
               ':title'  => $_POST['title'],
               ':start' => $_POST['start'],
               ':end' => $_POST['end'],
                ':type' => $_POST['type']
              )
             );
        }
        else 
        {
             die(header("HTTP/1.0 404 Not Found"));
        }
    }
?>