<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
?>
<?php
$this->addExternalCss("/local/css/bootstrap.min.css");
$this->addExternalJS("/local/js/bootstrap.bundle.min.js");
?>
<div>
    <?$APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', [
        'FILTER_ID' => $arResult['ilist_id'],
        'GRID_ID' => $arResult['ilist_id'],
        'FILTER' => $arResult['$arFilter'],
        'ENABLE_LIVE_SEARCH' => true,
        'ENABLE_LABEL' => true
    ]);?>
</div>
<div style="clear: both;"></div>

<?php

$APPLICATION->IncludeComponent('bitrix:main.ui.grid', '', [
    'GRID_ID' => $arResult['ilist_id'],
    'COLUMNS' => $arResult['$arColumns'],
    'ROWS' => $arResult['list'],
    'SHOW_ROW_CHECKBOXES' => false,
    'NAV_OBJECT' => $arResult['obNav'],
    'AJAX_MODE' => 'Y',
    'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
    'PAGE_SIZES' =>  [
        ['NAME' => '1', 'VALUE' => '1'],
        ['NAME' => '2', 'VALUE' => '2'],
        ['NAME' => '3', 'VALUE' => '3'],
        ['NAME' => '4', 'VALUE' => '4'],
        ['NAME' => '5', 'VALUE' => '5']
    ],
    'AJAX_OPTION_JUMP'          => 'N',
    'SHOW_CHECK_ALL_CHECKBOXES' => false,
    'SHOW_ROW_ACTIONS_MENU'     => true,
    'SHOW_GRID_SETTINGS_MENU'   => true,
    'SHOW_NAVIGATION_PANEL'     => true,
    'SHOW_PAGINATION'           => true,
    'SHOW_SELECTED_COUNTER'     => true,
    'SHOW_TOTAL_COUNTER'        => true,
    'SHOW_PAGESIZE'             => true,
    'SHOW_ACTION_PANEL'         => false,
    'ALLOW_COLUMNS_SORT'        => true,
    'ALLOW_COLUMNS_RESIZE'      => true,
    'ALLOW_HORIZONTAL_SCROLL'   => true,
    'ALLOW_SORT'                => true,
    'ALLOW_PIN_HEADER'          => true,
    'AJAX_OPTION_HISTORY'       => 'N'
]);
?>
<a href="?iblock_Add=Y&action=add"  class="btn btn-primary">добавить</a>
