<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php
$arTemp = array();

foreach ($arResult["ITEMS"] as $ID => $arItems) {

    preg_match_all('#"(.+)">(.+)<#', $arItems["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"], $matches);
    $detailink = $matches[1][0];
    $name = $matches[2][0]; // скорее всего это решение не верно,  но как вариант
    $arResult["ITEMS"][$ID]["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_DETAIL_PAGE"] = $detailink;
    $arResult["ITEMS"][$ID]["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_DETAIL_NAME"] = $name;

    $arPhotoSmall = CFile::ResizeImageGet(//resizeImage
        $arItems["DETAIL_PICTURE"],
        array(
            'width' => $arParams["LIST_PREV_PICT_W"],
            'height' => $arParams["LIST_PREV_PICT_H"],
        ), BX_RESIZE_IMAGE_PROPORTIONAL, true
    );
    $arResult["ITEMS"][$ID]["DETAIL_PICTURE"] = $arPhotoSmall;

    $arTemp [] = $arItems["PROPERTIES"]["LINK"]["VALUE"]; //get ID of all attached prоperties
}

$arSort = false;
$arFilter = array(

    "IBLOCK_ID" => IBLOCK_CAT_ID,
    "ACTIVE" => "Y",
    "ID" => $arTemp,
);
$nTopCount = count($arTemp); // count of all
$arGroupBy = false;
$arNavStartParams = array("nTopCount" => $nTopCount); //вот здесь  надо или из елемента инфоблока
$arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_PRICE", "PROPERTY_SIZE", "PROPERTY_ARTNUMBER");
$DBres = CIBlockElement::GetList
($arSort,
    $arFilter,
    $arGroupBy,
    $arNavStartParams,
    $arSelect
);

$arResult["CAT_ELEM"] = array();// масссив  с значениями полец связанных елементов
while ($arRes = $DBres->GetNext()) {

    $arResult["CAT_ELEM"][$arRes["ID"]] = $arRes;

}
//dump ($arResult);
//dump($arTemp);
?>