<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? //dump($arResult["ITEMS"],"u")?>


<?
// foreach ($arResult["ITEMS"] as $key => $Items){

//    // $arResult["ITEMS"][$key]["PROPERTY_LINK_CAT_PREVIEW_TEXT"] = strip_tags(html_entity_decode($Items["PROPERTY_LINK_CAT_PREVIEW_TEXT"]));

// }



$arTemp = array();
 foreach($arResult["ITEMS"] as $elem){

    //dump($elem["PROPERTIES"]["LINK_CAT"]["VALUE"]);
    $arTemp []= $elem["PROPERTIES"]["LINK_CAT"]["VALUE"];
 }


$arSort = false;
$arFilter = array(

    "IBLOCK_ID" => IBLOCK_CAT_ID,
    "ACTIVE" => "Y",
    "ID" => $arTemp,
);
$arGroupBy = false;
$arNavStartParams = array("nTopCount" => 50);
$arSelect =array("ID","NAME","DETAIL_PAGE_URL", "PROPERTY_PRICE","PROPERTY_SIZE", "PROPERTY_ARTNUMBER");
$DBres =CIBlockElement::GetList
(   $arSort, 
    $arFilter,
    $arGroupBy, 
    $arNavStartParams , 
    $arSelect
);

$arResult["CAT_ELEM"] = array();
while($arRes = $DBres->GetNext()){

$arResult["CAT_ELEM"][$arRes["ID"]] = $arRes;

}

//dump($arResult);

?>

<?//dump($DBres,"l")?>