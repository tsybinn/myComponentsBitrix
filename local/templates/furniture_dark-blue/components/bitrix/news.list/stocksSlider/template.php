<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
dump($arResult);

?>

<?use Bitrix\Main\Page\Asset;
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/components/bitrix/news.list/stocksSlider/jquery-1.8.2.min.js");
//Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/components/bitrix/news.list/stocksSlider/slides.min.jquery.js");
//Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/components/bitrix/news.list/stocksSlider/style.css");

?>
<script>
	$().ready(function(){
		$(function(){
			$('#slides').slides({
				preload: false,
				generateNextPrev: false,
				autoHeight: true,
				play: 4000,
				effect: 'fade'
			});
		});
	});
</script>
<?
$this->addExternalCss("/local/styles.css");
$this->addExternalJS("/local/liba.js");
?>
<div class="sl_slider" id="slides">
	<div class="slides_container">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<div >
			<div class= "flexx">
				<div><?if(is_array($arItem["DETAIL_PICTURE"])):?>
				<img src="<?=$arItem["DETAIL_PICTURE"]["src"]?>" alt="" />
				<?endif;?></div>
				<?$idE = $arItem["PROPERTIES"]["LINK"]["VALUE"]; ?>
				<?//dump($arResult["CAT_ELEM"][$idE],"i")?>
			<div>	<h3><a href="<?=$arResult["CAT_ELEM"][$idE]["DETAIL_PAGE_URL"]?>" title="<?=$arResult["CAT_ELEM"][$idE]["NAME"]?>"  ><?echo $arItem["NAME"]?></a></h3></div>
				<div><p><?=$arResult["CAT_ELEM"][$idE]["NAME"]?> всего за  <?=$arResult["CAT_ELEM"][$idE]["PROPERTY_PRICE_VALUE"] ?> руб  </p></div>
				<div><a href="<?=$arResult["CAT_ELEM"][$idE]["DETAIL_PAGE_URL"]?>" title="<?=$arResult["CAT_ELEM"][$idE]["NAME"]?>" class="sl_more">Подробнее &rarr;</a></div>
			</div>
		</div>
		<?endforeach;?>
	</div>
</div>

