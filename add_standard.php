<div class = "adding" id="standards" style="display: none;">
    <hr/>
    <form class="form-horizontal" id = "standards1" method="post" action="adding.php">
         <div class="form-group" >
            <label class="col-sm-2 control-label">Шифр</label>
            <div class="col-sm-10">
                <input type="text" name = "st_cypher" class="form-control input-xs" placeholder="Введите шифр стандарта">
            </div>
            <label class="col-sm-2 control-label">Название</label>
            <div class="col-sm-10">
                <input type="text" name = "st_name" class="form-control input-xs" placeholder="Введите наименование стандарта">
            </div>
            <label class="col-sm-2 control-label">Статус</label>
            <div class="col-sm-10">
                <select class="form-control" id="standard_satatus" name = "st_status">
                    <option value = "Действует">Действует</option>
                    <option value = "Устарел">Устарел</option>
                </select>
            </div>
         </div>
        <input type="submit" class="btn btn-default btn-block" value="Добавить стандарты" name="submit6">
    </form>
</div>