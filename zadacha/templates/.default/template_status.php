<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
$APPLICATION->SetTitle("Статус");
$APPLICATION->AddChainItem($APPLICATION->GetTitle(),'/about/');
?>

<?php
$this->addExternalCss("/local/css/bootstrap.min.css");
$this->addExternalJS("/local/js/bootstrap.bundle.min.js");
print_r($arResult['LIST_VALUES']);
print_r($arResult['ROLE']['AVAILABLE_STATUS']);
?>
<form action="" method="POST">
    <input type="hidden" name="form_id" value="Add_status" />
    <table class="table table-bordered">
        <thead class="active">
        <tr >
            <th>Название</th>
            <th>Статус</th>
        </tr>
        </thead>
        <div class="form-group">
            <tr>
                <td>
                    <select class="form-control" name = 'TASK'>
                        <? foreach ($arResult['TASKS'] as  $key=>$arTask): ?>
                            <option value="<?=$key?>"><?= $arTask['NAME']?></option>
                        <?endforeach; ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" name='STATUS'>
                        <??>
                        <?foreach($arResult['LIST_VALUES'] as $key => $arEl):?>
                            <? if (in_array($arEl['CODE'], $arResult['ROLE']['AVAILABLE_STATUS'])): ?>
                                <option value="<?=$key?>"><?= $arEl['VALUE']?></option>
                            <?endif;?>
                        <?endforeach; ?>
                    </select>
                </td>
            </tr>
        </div>
    </table>
    <input type="submit" class="btn btn-success" value="Сохранить">
</form>