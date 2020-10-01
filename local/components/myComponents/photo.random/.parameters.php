<?
	if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

	if(!CModule::IncludeModule("iblock"))
		return;

	$arIBlockType = CIBlockParameters::GetIBlockTypes();

	$arIBlock=array(
		"-" => GetMessage("IBLOCK_ANY"),
	);
	$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
	while($arr=$rsIBlock->Fetch())
	{
		$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
	}



	$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("IBLOCK_IBLOCK"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),


//		"CACHE_TIME"  =>  Array("DEFAULT"=>180),
//		"CACHE_GROUPS" => array(
//			"PARENT" => "CACHE_SETTINGS",
//			"NAME" => GetMessage("CP_BPR_CACHE_GROUPS"),
//			"TYPE" => "CHECKBOX",
//			"DEFAULT" => "Y",
//		),

		"IMG_WIDTH1" => array(
			"PARENT" => "BASE",
			"NAME" => "Ширина картинки",
			"TYPE" => "STRING",
			"DEFAULT" => "99",

		),
		"IMG_HEIGHT1" => array(
			"PARENT" => "BASE",
			"NAME" => "Высота картинки",
			"TYPE" => "STRING",
			"DEFAULT" => "99",

		),
	),
);
?>
