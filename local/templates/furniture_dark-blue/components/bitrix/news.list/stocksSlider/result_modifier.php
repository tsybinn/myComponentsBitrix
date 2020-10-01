<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? //var_dump($arResult)
?>


<?php

$arTemp = array(); // получаем ве id  связанных елементов
foreach ($arResult["ITEMS"] as $key=>$elem) {

    $arPhotoSmall = CFile::ResizeImageGet(
        $elem["DETAIL_PICTURE"],
        array(
            'width' =>100,
            'height' => 100,
        ),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
    $arResult["ITEMS"][$key]["DETAIL_PICTURE"] = $arPhotoSmall;

    $arTemp[] = $elem["PROPERTIES"]["LINK"]["VALUE"];
}

var_dump($arTemp);

$arSort = false;
$arFilter = array(

    "IBLOCK_ID" => IBLOCK_CAT_ID,
    "ACTIVE" => "Y",
    "ID" => $arTemp,
);
$arGroupBy = false;
$arNavStartParams = array("nTopCount" => 50); // вот здесь  надо или из елемента инфоблока
$arSelect = array("ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_PRICE", "DETAIL_PICTURE");
$DBres = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    $arGroupBy,
    $arNavStartParams,
    $arSelect
);

$arResult["CAT_ELEM"] = array(); // масссив  с значениями полец связанных елементов
while ($arRes = $DBres->GetNext()) {

    $arResult["CAT_ELEM"][$arRes["ID"]] = $arRes;
}




//dump($arResult);

//  $cp = $this->__component;
//     $arPrevie = CFile::GetFileArray(
//         $arResult["ITEMS"][0]["PROPERTY_LINK_PREVIEW_PICTURE"] ,
//         $upload_dir = false
//     );
//     $arResult["ITEMS"][0]["PROPERTY_LINK_PREVIEW_PICTURE"] = $arPrevie["SRC"];
//     $cp->setResultCacheKeys(array("PROPERTY_LINK_PREVIEW_PICTURE"));
//     $arResult["ITEMS"][0]["PROPERTY_LINK_NAME"] = 1;
//     $t = $arResult["ITEMS"][0];
//     $cp->setResultCacheKeys($t);
//     $this->__component->arResultCacheKeys = array_merge($this->__component->arResultCacheKeys, array("ITEMS"));
//     $cp = $this->__component;
//     if (is_object($cp))
//     {
//       $cp->arResult["SOME_KEY"] = $arResult["SOME_KEY"];
//       $cp->SetResultCacheKeys(array("SOME_KEY")); //cache keys in $arResult array
//     }


?><?//dump($arResult)?>