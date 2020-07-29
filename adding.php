<?php session_start();
    header('Content-Type: text/html; charset=utf-8');
    $host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'info_sys';

    $connect = mysql_connect($host, $db_user, $db_pass) or die("Ошибка: " . mysql_error());
    mysql_select_db($db_name) or die("Ошибка");

    if (!empty($_POST)) 
    {
        if (isset($_POST['submit1'])) 
        {
            $obj = $_POST['obj'];
            $org = $_POST['org'];
            $time = $_POST['time'];
            $method = $_POST['method'];
            $price_tst = $_POST['price_tst'];
            $wrk = $_POST['wrk'];
            $equip = $_POST['equip'];
            $start_tst = $_POST['start_tst'];
            $end_tst = $_POST['end_tst'];
            $test_satatus = $_POST['test_satatus'];
            $author = $_POST['author'];         
            
            if (($obj != null) && ($org != null) && ($method != null) && ($price_tst != null) && ($wrk != null) && ($equip != null)
               && ($test_satatus != null))
            {
                $ins_id = null;
                
                $query = "SELECT name FROM organizations WHERE id = ' $org '";
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                $res1 = mysql_fetch_row($result);
                $organization = $res1[0];

                $query = " SELECT name FROM objects where id = ' $obj '";
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                $res2 = mysql_fetch_row($result);
                $object = $res2[0];

                $query = " SELECT name FROM methods_cats where id = ' $method '";
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                $res3 = mysql_fetch_row($result);
                $method_cat = $res3[0];   

                
                $tit = 'Испытание '.$object.' ('.$organization.')';
                $descript = 'Метод: '. $method_cat;
                
                if (($start_tst != null) && ($end_tst != null))
                {
                    if ($start_tst < $end_tst)
                    {
                        $st=date("Y-m-d H:i:s",strtotime($start_tst));
                        $en=date("Y-m-d H:i:s",strtotime($end_tst));
                        
                        $query = 'SELECT COUNT(*) FROM events WHERE (type = 1 or type = 2) and 
                                    NOT ( 
                                      ("'. $st .'" < start AND "'. $en .'" < start)
                                      OR
                                      ("'. $st .'"  > end AND "'. $en .'" > end)
                                    )';
                        $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                        $res = mysql_fetch_row($result);
                        $nn = $res[0]; 
                        
                        if ($nn <= 0)
                        {
                            $query = 'INSERT INTO events (title, start, end, type, description) VALUES ("'. $tit .'", "'. $st .'", "'. $en .'", 1, "'.$descript.'")';
                            $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                            $ins_id = mysql_insert_id();
                            foreach ($wrk as $s)
                            {
                                $query0 = 'INSERT INTO busyness (eventId, worktimeId, workerId) VALUES ('. $ins_id .', 1, '. $s .')';
                                $result0 = mysql_query($query0) or die("Ошибка: " . mysql_error());
                            }
                        }
                        else
                        {
                            $_SESSION['add_result'] = "Запись не добавлена. На выбранные даты уже запланировано событие.";
                            header("Location: add.php");
                        }
                    }
                    else
                    {
                        $_SESSION['add_result'] = "Запись не добавлена. Даты введены неверно.";
                        header("Location: add.php");
                    }
                }
                $query = 'SELECT workerId FROM users where login = "'. $author .'"';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                $res = mysql_fetch_row($result);
                $author_id = $res[0];   
                
                
                $query = 'INSERT INTO tests (name, eventId, duration, status, idOrganization, idObject, price, authorId, description) 
                                VALUES ("'. $tit .'", '. $ins_id .', '. $time .', "'.$test_satatus.'", '.$org.', '.$obj.', '.$price_tst.',
                                '.$author_id.', "'.$descript.'")';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                $tst_id = mysql_insert_id();
                
                $query = 'INSERT INTO tests_methods (testId, methodId) VALUES ('. $tst_id .', '. $method .')';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                
                foreach ($equip as $s)
                {
                    $query = 'INSERT INTO tests_equipments (idTest, idEquipment) VALUES ('. $tst_id .', '. $s .')';
                    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                }
                
                $_SESSION['add_result'] = "Запись добавлена";
                header("Location: add.php");
            }
            else
            {
                $_SESSION['add_result'] = "Запись не добавлена. Введите данные.";
                header("Location: add.php");
            }
        } 
        else if (isset($_POST['submit2'])) 
        {
            $org_name = $_POST['org_name'];
            $org_phone = $_POST['org_phone'];
            $org_mail = $_POST['org_mail'];
            
            if ($org_name != NULL)
            {
                $query = 'SELECT COUNT(*) AS num FROM organizations WHERE name = "' . $org_name . '"';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());			
                $num_orgs = mysql_fetch_array($result);
                mysql_free_result($result);				

                if ($num_orgs['num'] == 0)
                {
                    $query = 'INSERT INTO organizations (name, phone, email) VALUES ("'. $org_name .'", "'. $org_phone .'", "'. $org_mail .'")';
                    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                    $_SESSION['add_result'] = "Запись добавлена";
                    header("Location: add.php");
                }
                else
                {
                    $_SESSION['add_result'] = "Запись уже существует. Попробуйте еще раз.";
                    header("Location: add.php");
                }
            }
            else
            {
                $_SESSION['add_result'] = "Запись не добавлена. Введите данные.";
                header("Location: add.php");
            }
        } 
        else if (isset($_POST['submit3']))
        {
            $w_name = $_POST['w_name'];
            $w_position = $_POST['w_position'];
            $w_phone = $_POST['w_phone'];
            
            if ($w_name  != NULL)
            {
                $query = 'SELECT COUNT(*) AS num FROM workers WHERE name = "' . $w_name . '"';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());			
                $num_w = mysql_fetch_array($result);
                mysql_free_result($result);				

                if ($num_w['num'] == 0)
                {
                    $query = 'INSERT INTO workers (name, position, phone) VALUES ("'. $w_name .'", "'. $w_position .'", "'. $w_phone .'")';
                    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                    $_SESSION['add_result'] = "Запись добавлена";
                    header("Location: add.php");
                }
                else
                {
                    $_SESSION['add_result'] = "Запись уже существует. Попробуйте еще раз.";
                    header("Location: add.php");
                }
            }
            else
            {
                $_SESSION['add_result'] = "Запись не добавлена. Введите данные.";
                header("Location: add.php");
            }
        }
        else if (isset($_POST['submit4']))
        {
            $okpd2 = $_POST['okpd2'];
            $obj_name = $_POST['obj_name'];
            $weight = floatval($_POST['weight']);
            $width = intval($_POST['width']);
            $width1 = intval($_POST['width1']);
            $height = intval($_POST['height']);
                        
            if ($obj_name != NULL)
            {
                $query = 'SELECT COUNT(*) AS num FROM objects WHERE name = "' . $w_name . '"';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());			
                $num_w = mysql_fetch_array($result);
                mysql_free_result($result);				

                if ($num_w['num'] == 0)
                {
                    $query = 'INSERT INTO objects (okpd2_cypher, name, weight, width, width1, height) 
                                VALUES ("'. $okpd2 .'", "'. $obj_name .'", '. $weight .', '. $width.', '. $width1.', '. $height.')';
                    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                    $_SESSION['add_result'] = "Запись добавлена";
                    header("Location: add.php");
                }
                else
                {
                    $_SESSION['add_result'] = "Запись уже существует. Попробуйте еще раз.";
                    header("Location: add.php");
                }
            }
            else
            {
                $_SESSION['add_result'] = "Запись не добавлена. Введите данные.";
                header("Location: add.php");
            }
        }
        else if (isset($_POST['submit5']))
        {
            $e_name = $_POST['e_name'];
            $z_num = $_POST['z_num'];
            $cert = $_POST['cert'];
                        
            if ($e_name != NULL)
            {
                $query = 'SELECT COUNT(*) AS num FROM equipments WHERE name = "' . $e_name . '" and certificate = "'.$cert.'"';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());			
                $num_e = mysql_fetch_array($result);
                mysql_free_result($result);				

                if ($num_e['num'] == 0)
                {
                    $query = 'INSERT INTO equipments (name, num, certificate) 
                                VALUES ("'. $e_name .'", "'. $z_num .'", "'. $cert.'")';
                    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                    $_SESSION['add_result'] = "Запись добавлена";
                    header("Location: add.php");
                }
                else
                {
                    $_SESSION['add_result'] = "Запись уже существует. Попробуйте еще раз.";
                    header("Location: add.php");
                }
            }
            else
            {
                $_SESSION['add_result'] = "Запись не добавлена. Введите данные.";
                header("Location: add.php");
            }
        }
        else if (isset($_POST['submit6']))
        {
            $st_cypher = $_POST['st_cypher'];
            $st_name = $_POST['st_name'];
            $st_status = $_POST['st_status'];
                        
            if (($e_name != NULL) || ($st_cypher != NULL))
            {
                $query = 'SELECT COUNT(*) AS num FROM standards WHERE name = "' . $st_name . '" and cypher = "'.$st_status.'"';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());			
                $num_st = mysql_fetch_array($result);
                mysql_free_result($result);				

                if ($num_st['num'] == 0)
                {
                    $query = 'INSERT INTO standards (cypher, name, status) 
                                VALUES ("'. $st_cypher .'", "'. $st_name .'", "'. $st_status.'")';
                    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                    $_SESSION['add_result'] = "Запись добавлена";
                    header("Location: add.php");
                }
                else
                {
                    $_SESSION['add_result'] = "Запись уже существует. Попробуйте еще раз.";
                    header("Location: add.php");
                }
            }
            else
            {
                $_SESSION['add_result'] = "Запись не добавлена. Введите данные.";
                header("Location: add.php");
            }
        }
        else if (isset($_POST['submit7']))
        {
            $m_cypher = $_POST['m_cypher'];
            $m_name = $_POST['m_name'];
            $stand = $_POST['stand'];
            $m_description = $_POST['m_description'];
                        
            if (($m_cypher != NULL) || ($m_name != NULL))
            {
                $query = 'SELECT COUNT(*) AS num FROM methods_cats WHERE name = "' . $m_name . '" and cypher = "'.$m_cypher.'"';
                $result = mysql_query($query) or die("Ошибка: " . mysql_error());			
                $num_m = mysql_fetch_array($result);
                mysql_free_result($result);				

                if ($num_m['num'] == 0)
                {
                    $query = 'INSERT INTO methods_cats (cypher, name, standardId, description) 
                                VALUES ("'. $m_cypher .'", "'. $m_name .'", '. $stand.', "'.$m_description.'")';
                    $result = mysql_query($query) or die("Ошибка: " . mysql_error());
                    $_SESSION['add_result'] = "Запись добавлена";
                    header("Location: add.php");
                }
                else
                {
                    $_SESSION['add_result'] = "Запись уже существует. Попробуйте еще раз.";
                    header("Location: add.php");
                }
            }
            else
            {
                $_SESSION['add_result'] = "Запись не добавлена. Введите данные.";
                header("Location: add.php");
            }
        }
    }

    mysql_close($connect);
?>