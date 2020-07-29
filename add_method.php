<form class="form-horizontal" id = "methods_cats1" method="post" action="adding.php">
     <div class="form-group" >
        <label class="col-sm-2 control-label">Шифр</label>
        <div class="col-sm-10">
            <input type="text" name = "m_cypher" class="form-control input-xs" placeholder="Введите шифр метода">
        </div>
        <label class="col-sm-2 control-label">Название</label>
        <div class="col-sm-10">
            <input type="text" name = "m_name" class="form-control input-xs" placeholder="Введите наименование метода">
        </div>
        <label class="col-sm-2 control-label">Стандарт</label>
        <div class="col-sm-10">
            <select name = "stand" class="form-control" id="standard_satatus">
                <?php while($row = mysql_fetch_array($standards))
                {?>
                     <option value = "<?php echo $row["id"]; ?>"><?php echo $row["cypher"]; ?></option>
                <?}?>
            </select>
        </div>
        <label class="col-sm-2 control-label">Описание</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" id="comment" name = "m_description"></textarea>
        </div>
     </div>
    <input type="submit" class="btn btn-default btn-block" value="Добавить методы" name="submit7">
</form>