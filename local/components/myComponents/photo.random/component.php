<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

	/*************************************************************************
	Processing of received parameters
	 *************************************************************************/
	if(!isset($arParams["CACHE_TIME"]))
		$arParams["CACHE_TIME"] = 180;

	$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
	//var_dump($arParams);

	if($arParams['IBLOCK_ID'] == 2  )
	{
		if(!CModule::IncludeModule("iblock"))
		{

			ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
			return;
		}
		//SELECT
		$arSelect = array(
			"ID",
			"IBLOCK_ID",
			"CODE",
			"IBLOCK_SECTION_ID",
			"NAME",
			"PREVIEW_TEXT",
			"DETAIL_PICTURE",
			"DETAIL_PAGE_URL",
		);
		//WHERE
		$arFilter = array(
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ACTIVE_DATE" => "Y",
			"ACTIVE"=>"Y",
			"CHECK_PERMISSIONS"=>"Y",
			"!PROPERTY_".$arParams['IBLOCKS_PROP'] => false,
		);


		if($arParams["PARENT_SECTION"]>0)
		{
			$arFilter["SECTION_ID"] = $arParams["PARENT_SECTION"];
			$arFilter["INCLUDE_SUBSECTIONS"] = "Y";
		}
		//ORDER BY
		$arSort = array(
			"RAND"=>"ASC", //рандомный выбор
		);
		//EXECUTE
		$rsIBlockElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
		$rsIBlockElement->SetUrlTemplates($arParams["DETAIL_URL"]);
		if($arResult = $rsIBlockElement->GetNext())
		{    //var_dump($arResult);
			$arResult["PICTURE"] = CFile::ResizeImageGet($arResult['DETAIL_PICTURE'],
				array('width'=>$arParams['IMG_WIDTH1'], 'height'=>$arParams['IMG_HEIGHT1']), BX_RESIZE_IMAGE_PROPORTIONAL, true);

//			$this->SetResultCacheKeys(array(
//			));
			$this->IncludeComponentTemplate();

		}

	} else{
		ShowError("Установите инфоблок кроссовки");
	}




?>
