<form class="form-horizontal" id = "equipment1" method="post" action="adding.php">
     <div class="form-group" >
        <label class="col-sm-2 control-label">Название</label>
        <div class="col-sm-10">
            <input type="text" name = "e_name" class="form-control input-xs" placeholder="Введите наименованиие оборудования">
        </div>
        <label class="col-sm-2 control-label">Зав. №</label>
        <div class="col-sm-10">
            <input type="text" name = "z_num" class="form-control input-xs" placeholder="Введите зав. №">
        </div>
        <label class="col-sm-2 control-label">Сертификат</label>
        <div class="col-sm-10">
            <input type="text" name = "cert" class="form-control input-xs" placeholder="Введите № аттестата или свидетельства о поверке">
        </div>
     </div>
    <input type="submit" class="btn btn-default btn-block" value="Добавить оборудованию" name="submit5">
</form>