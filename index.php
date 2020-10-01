<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?><? //header('location:elements/index.php');?><?$APPLICATION->IncludeComponent(
	"myComponents:complexComp",
	"listElem.php",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "180",
		"CACHE_TYPE" => "A",
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "sneakers",
		"PARENT_SECTION" => "",
		"SEF_FOLDER" => "",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("element"=>"item/id/#ELEMENT_ID#/","popular"=>"","section"=>"category/id/#SECTION_ID#/")
	)
);?><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>