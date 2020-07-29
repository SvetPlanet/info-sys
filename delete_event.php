<?php
    
    $db_pass = '';
	$user = 'root';

    if(isset($_POST["id"]))
    {
        $connect = new PDO('mysql:host=localhost;dbname=info_sys', $user, $db_pass);
        $query = "DELETE from events WHERE id=:id";
        $statement = $connect->prepare($query);
            $statement->execute(
            array(
            ':id' => $_POST['id']
            )
        );
    }

?>