<?
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	date_default_timezone_set('Russia/Moscow');	
		
	$host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'info_sys';
    $connect = mysql_connect($host, $db_user, $db_pass) or die("Ошибка: " . mysql_error());
    mysql_select_db($db_name) or die("Ошибка");
    mysql_set_charset('utf8');

    if (isset($_SESSION['authorized']) && $_SESSION['authorized'] == "yes")
    {	
        header("Location: home.php");	
    }
    else 
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (($login == NULL) && ($password == NULL))
        {
            header("Location: login.php");
        }
        else 
        {
            $query = 'SELECT COUNT(*) AS num_users FROM users WHERE login = "' . $login . '" and password = sha1("' . $password . '") ';
            $result = mysql_query($query) or die("Ошибка: " . mysql_error());			
            $num_users = mysql_fetch_array($result);
            mysql_free_result($result);				

            if ($num_users['num_users'] == 1)
            {
                $_SESSION['authorized'] = "yes";
                $_SESSION['login'] =  $login;
                header("Location: home.php");	
            }
            else
            {
                $_SESSION['log_error'] = "Логин или пароль введен неверно. Попробуйте еще раз.";
                header("Location: login.php");	
            }
        }
    }
    mysql_close($connect);
?>