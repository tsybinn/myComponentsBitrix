<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach ($arResult['ITEMS'] as $key => $arItem)
{
	$arItem['PRICES']['PRICE']['PRINT_VALUE'] = number_format($arItem['PRICES']['PRICE']['PRINT_VALUE'], 0, '.', ' ');
	$arItem['PRICES']['PRICE']['PRINT_VALUE'] .= ' '.$arItem['PROPERTIES']['PRICECURRENCY']['VALUE_ENUM'];
	
	$arResult['ITEMS'][$key] = $arItem;


	
}

//dump($arResult);

$arTempID = array();

foreach($arResult["ITEMS"] as $elem ){

$arTempID [] = $elem["ID"];

}

//dump($arTempID);

$arSort = false;
$arFilter = array(

    "IBLOCK_ID" => IBLOCK_NEWS_ID,
    "ACTIVE" => "Y",
    "PROPERTY_LINK_CAT" => $arTemp,
);
$arGroupBy = false;
$arNavStartParams = array("nTopCount" => 200);
$arSelect =array("ID","NAME","DETAIL_PAGE_URL","PROPERTY_LINK_CAT");
$DBres =CIBlockElement::GetList
(   $arSort, 
    $arFilter,
    $arGroupBy, 
    $arNavStartParams , 
    $arSelect
);

$arResult["NEWS"] = array();
while($arRes = $DBres->GetNext()){

	if($arRes["PROPERTY_LINK_CAT_VALUE"])
$arResult["NEWS"][$arRes["PROPERTY_LINK_CAT_VALUE"]] = $arRes;
}

dump($arResult["NEWS"])
?>