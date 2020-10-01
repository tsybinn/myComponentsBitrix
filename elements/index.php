<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Элементы");
?><?
    // файл /bitrix/php_interface/init.php
    // регистрируем обработчик
    AddEventHandler("iblock", "OnBeforeIBlockElementDelete", Array("MyClass", "OnBeforeIBlockElementDeleteHandler"));
    function OnBeforeIBlockElementDeleteHandler($ID)
        { // приходит только id елемента невозможно вывести var dump лучше делать на отдельнос странице

//            CModule::IncludeModule("iblock");
//            $res = CIBlockElement::GetProperty(
//            7,
//                $ID,
//                Array("CODE"=>"COUNTVOTING")
//                      );
//            $ar_res = $res->GetNext();
//            var_dump($ar_res);
//            if ($ar_res["SHOW_COUNTER"] > 1) {
//                $el = new CIBlockElement; //class
//                $arLoadProductArray = array(
//                    "ACTIVE" => "N",  // неактивен
//                );
//                $PRODUCT_ID = $ID;
//                $res = $el->Update($PRODUCT_ID, $arLoadProductArray); // update   field elements
//                $GLOBALS['DB']->Commit(); //Закрываем транзакцию, что заставляет БД сохранить изменения перманентно, не реагируя на последующие ошибки
//                global $APPLICATION;
//                $APPLICATION->throwException("Количество просмотров товара " . $ar_res["NAME"] . " = " . $ar_res["SHOW_COUNTER"]);
//                return false;
//            }
        }
        OnBeforeIBlockElementDeleteHandler(59);

    ?>
<?$APPLICATION->IncludeComponent(
	"myComponents:taskAlt.list", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "sneakers",
		"IBLOCK_ID" => "2",
		"ELEMENT_COUNT" => "3",
		"SORT_BY1" => "PROPERTY_RAITING",
		"SORT_ORDER1" => "DESC",
		"PROPERTY_CODE" => array(
		),
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "180",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => "templatesMy",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>