<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
$APPLICATION->SetTitle("Задача");
$APPLICATION->AddChainItem($APPLICATION->GetTitle(),'/about/');
?>

<?php
$this->addExternalCss("/local/css/bootstrap.min.css");
$this->addExternalJS("/local/js/bootstrap.bundle.min.js");
?>


<div class="container">
    <form name="add_my_ankete" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="form_id" value="Add_Item" />
        <div class="form-group">
            <label>Название</label>
            <input type="text" class="form-control" name="NAME" maxlength="255" value="">

            <label>Описание</label>
            <textarea name="OPISANIE" class="form-control" placeholder="Заполните поле"></textarea>

            <label>Крайний срок</label>
            <input type="text" name="SROK" class="form-control" maxlength="255" value="">

            <label>Статус(при добавлении задачи по умолчанию новая)</label>
            <select name='STATUS' class="form-control">
                <option value="1">Новая</option>
            </select>
            <br>
            <input type="submit" class="btn btn-success" value="Добавить">
        </div>
    </form>
</div>
