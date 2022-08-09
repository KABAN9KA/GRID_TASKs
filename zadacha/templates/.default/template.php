<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
use \Bitrix\Iblock\PropertyEnumerationTable;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;

CModule::IncludeModule("iblock");
$ilist_id = 'Tablelist';
$obGridOptions = new GridOptions($ilist_id);
$sort = $obGridOptions->GetSorting(['sort' => ['DATE_CREATE' => 'DESC'], 'vars' => ['by' => 'by', 'order' => 'order']]);
$arNavParams = $obGridOptions->GetNavParams();

$obNav = new PageNavigation($ilist_id);
$obNav->allowAllRecords(true)
    ->setPageSize($arNavParams['nPageSize'])
    ->initFromUri();

if ($obNav->allRecordsShown()) {
    $arNavParams = false;
} else {
    $arNavParams['iNumPage'] = $obNav->getCurrentPage();
}

$arFilter['IBLOCK_ID'] = 2;
$arFilter = [
    ['id' => 'ID', 'name' => 'Номер задачи',  'default' => true],
    ['id' => 'NAME', 'name' => 'Название', 'type'=>'text', 'default' => true],
    ['id' => 'PROPERTY_SROK', 'name' => 'Крайний срок', 'type'=>'text', 'default' => true],
    ['id' => 'PROPERTY_STATUS_VALUE', 'name' => 'Статус', 'type'=>'list', 'items'=>['Новая'=>'Новая',
        'Выполнена'=>'Выполнена', 'Завершена'=>'Завершена', 'Отменена'=>'Отменена', 'Отклонена'=>'Отклонена' ,
        'Выполняется'=>'Выполняется',],'default' => true],
];
?>

<div>
    <?$APPLICATION->IncludeComponent('bitrix:main.ui.filter', '', [
        'FILTER_ID' => $ilist_id,
        'GRID_ID' => $ilist_id,
        'FILTER' => $arFilter,
        'ENABLE_LIVE_SEARCH' => true,
        'ENABLE_LABEL' => true
    ]);?>
</div>
<div style="clear: both;"></div>

<?php
$obFilterOption = new Bitrix\Main\UI\Filter\Options($ilist_id);
$arFilterData = $obFilterOption->getFilter([]);

foreach ($arFilterData as $k => $v) {
    $filterData['NAME'] = "%".$arFilterData['FIND']."%";
}

$arFilterData['IBLOCK_ID'] = 2;
$arFilterData['ACTIVE'] = "Y";

$arColumns = [];
$arColumns[] = ['id' => 'ID', 'name' => 'Номер задачи', 'sort' => 'ID', 'default' => true];
$arColumns[] = ['id' => 'NAME', 'name' => 'Название', 'sort' => 'NAME', 'default' => true];
$arColumns[] = ['id' => 'DESCRIPTION', 'name' => 'Описание', 'sort' => 'DESCRIPTION', 'default' => true];
$arColumns[] = ['id' => 'SROK', 'name' => 'Крайний срок', 'sort' => 'SROK', 'default' => true];
$arColumns[] = ['id' => 'STATUS', 'name' => 'Статус', 'sort' => 'STATUS', 'default' => true];

$obResult = \CIBlockElement::GetList($sort['sort'], $arFilterData, false, $arNavParams,
    ["ID", "IBLOCK_ID", "NAME",  "PROPERTY_DESCRIPTION", "PROPERTY_SROK", "PROPERTY_STATUS"]
);

$obNav->setRecordCount($obResult->selectedRowsCount());
while($arRow = $obResult->GetNext()) {
    $list[] = [
        'data' => [
            "ID" => $arRow['ID'],
            "NAME" => $arRow['NAME'],
            "DESCRIPTION" => $arRow['PROPERTY_DESCRIPTION_VALUE'],
            "SROK" => $arRow['PROPERTY_SROK_VALUE'],
            "STATUS" => $arRow['PROPERTY_STATUS_VALUE'],
        ],
        'actions' => [
            [
                'text'    => 'Добавить',
                'default' => true,
                'onclick' => 'document.location.href="?iblock_Add=Y&action=add"'
            ], [
                'text'    => 'Редактировать статус',
                'default' => true,
                'onclick' => 'document.location.href="?iblock_status=Y&action=edit"'
            ],
            [
                'text'    => 'Удалить',
                'default' => true,
                'onclick' => 'document.location.href="?ID='.$arRow['ID'].'&action=delete"'
            ]
        ]
    ];
}

$APPLICATION->IncludeComponent('bitrix:main.ui.grid', '', [
    'GRID_ID' => $ilist_id,
    'COLUMNS' => $arColumns,
    'ROWS' => $list,
    'SHOW_ROW_CHECKBOXES' => true,
    'NAV_OBJECT' => $obNav,
    'AJAX_MODE' => 'Y',
    'AJAX_ID' => \CAjax::getComponentID('bitrix:main.ui.grid', '.default', ''),
    'PAGE_SIZES' =>  [
        ['NAME' => '5', 'VALUE' => '5'],
        ['NAME' => '10', 'VALUE' => '10'],
        ['NAME' => '25', 'VALUE' => '25']
    ],
    'AJAX_OPTION_JUMP'          => 'N',
    'SHOW_CHECK_ALL_CHECKBOXES' => true,
    'SHOW_ROW_ACTIONS_MENU'     => true,
    'SHOW_GRID_SETTINGS_MENU'   => true,
    'SHOW_NAVIGATION_PANEL'     => true,
    'SHOW_PAGINATION'           => true,
    'SHOW_SELECTED_COUNTER'     => true,
    'SHOW_TOTAL_COUNTER'        => true,
    'SHOW_PAGESIZE'             => true,
    'SHOW_ACTION_PANEL'         => true,
    "ACTION_PANEL" => array(
			"GROUPS" => array(
				"TYPE" => array(
					"ITEMS" => array(
                        ["ID" => 'document.location.href="?iblock_Add=Y&action=add"', "TYPE"=>"BUTTON","TEXT"=>"Добавить",]
					),
				),
			),
		),
    'ALLOW_COLUMNS_SORT'        => true,
    'ALLOW_COLUMNS_RESIZE'      => true,
    'ALLOW_HORIZONTAL_SCROLL'   => true,
    'ALLOW_SORT'                => true,
    'ALLOW_PIN_HEADER'          => true,
    'AJAX_OPTION_HISTORY'       => 'N'
]);
?>

