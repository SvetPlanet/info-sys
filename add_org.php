<?php session_start();?>

<form class="form-horizontal" id = "organization1" method="post" action="adding.php">
     <div class="form-group" >
        <label class="col-sm-2 control-label">Название</label>
        <div class="col-sm-10">
            <input type="text" name = "org_name" class="form-control input-xs" placeholder="Введите наименованиие организации">
        </div>
        <label class="col-sm-2 control-label">Телефон</label>
        <div class="col-sm-10">
            <input type="text" name = "org_phone" class="form-control input-xs" placeholder="Введите телефон">
        </div>
        <label class="col-sm-2 control-label">E-mail</label>
        <div class="col-sm-10">
            <input type="text" name = "org_mail" class="form-control input-xs" placeholder="Введите e-mail">
        </div>
     </div>
    <input type="submit" class="btn btn-default btn-block" value="Добавить орагнизацию" name="submit2">
</form>   