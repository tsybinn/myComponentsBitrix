<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Случайный элемент");
?><?$APPLICATION->IncludeComponent(
	"myComponents:photo.random", 
	".default", 
	array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "N",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "sneakers",
		"IMG_HEIGHT1" => "100",
		"IMG_WIDTH1" => "100",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>