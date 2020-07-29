<form class="form-horizontal" id = "worker1" method="post" action="adding.php">
     <div class="form-group" >
        <label class="col-sm-2 control-label">ФИО</label>
        <div class="col-sm-10">
            <input type="text" name = "w_name" class="form-control input-xs" placeholder="Введите ФИО сотрудника">
        </div>
        <label class="col-sm-2 control-label">Должность</label>
        <div class="col-sm-10">
            <input type="text"  name = "w_position" class="form-control input-xs" placeholder="Введите должность">
        </div>
        <label class="col-sm-2 control-label">Телефон</label>
        <div class="col-sm-10">
            <input type="text" name = "w_phone" class="form-control input-xs" placeholder="Введите телефон">
        </div>
     </div>
     <input type="submit" class="btn btn-default btn-block" value="Добавить работника" name="submit3">
</form>