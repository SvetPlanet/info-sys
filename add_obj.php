<form class="form-horizontal" id = "object1" method="post" action="adding.php">
     <div class="form-group" >
        <label class="col-sm-3 control-label">ОКПД2</label>
        <div class="col-sm-9">
            <input type="text" name = "okpd2" class="form-control input-xs" placeholder="Введите код ОКПД2 изделия">
        </div>
        <label class="col-sm-3 control-label">Название</label>
        <div class="col-sm-9">
            <input type="text" name = "obj_name" class="form-control input-xs" placeholder="Введите наименованиие изделия">
        </div>
        <label class="col-sm-3 control-label">Масса, кг</label>
        <div class="col-sm-9">
            <input type="number" step="any" name = "weight" class="form-control input-xs" placeholder="Введите массу">
        </div>
        <label class="col-sm-3 control-label">Ширина, мм</label>
        <div class="col-sm-9">
            <input type="number" name = "width" class="form-control input-xs" placeholder="Введите ширину">
        </div>
        <label class="col-sm-3 control-label">Длина, мм</label>
        <div class="col-sm-9">
            <input type="number" name = "width1" class="form-control input-xs" placeholder="Введите длину">
        </div>
        <label class="col-sm-3 control-label">Высота, мм</label>
        <div class="col-sm-9">
            <input type="number" name = "height" class="form-control input-xs" placeholder="Введите высоту">
        </div>
     </div>
    <input type="submit" class="btn btn-default btn-block" value="Добавить объект испытаний" name="submit4">
</form>