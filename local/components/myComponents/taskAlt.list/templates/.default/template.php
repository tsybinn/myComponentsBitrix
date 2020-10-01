<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $frame = $this->createFrame()->begin('');
?>
<?//var_dump($arParams) ?>
<? //var_dump($arResult); ?>

<p>Элементы выводятся в количестве заданном в настройках инфоблока. До тех пор, пока не будут выведены все элементы,
    внизу висит кнопка “Показать ещё” при нажатии на которую через ajax подгружаются следующие элементы.</p>
    <p>У каждого элемента есть кнопки + и -(рейтинг), при нажатии на которые увеличивается рейтинг
        (Защита от повторных нажатий нет). Если рейтинг элемента был изменен делается соответствующая запись в базе данных, после закрытия страницы.</p>

   Код, который при удалении элемента инфоблока в админ-панели проверяет, что элемент имеет
    наибольшее количество голосов. И если это так, посылает уведомление на почту Администратора сайта.</p>
<div class="news-list_elem">

    <?if($arParams["DISPLAY_TOP_PAGER"] == "Y"):?>
        <?=$arResult["NAV_STRING"]?><br />
    <?endif;?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["DETAIL_PICTURE"])):?>
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                    <p href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                                class="preview_picture"
                                border="0"
                                src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"
                                width="100"
                                height="100"
                                alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"
                                title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>"
                                style="float:left"
                        /></p>
                <?else:?>
                    <img
                            class="preview_picture"
                            border="0"
                            src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"
                            width="100"
                            height="100"
                            alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>"
                            title="<?=$arItem["DETAIL_PICTURE"]["TITLE"]?>"
                            style="float:left"
                    />
                <?endif;?>
            <?endif?>
            <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                <span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
            <?endif?>
            <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                    <p href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></p><br />
                <?else:?>
                    <b><?echo $arItem["NAME"]?></b><br />
                <?endif;?>
            <?endif;?>
            <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                <?echo $arItem["PREVIEW_TEXT"];?>
            <?endif;?>
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["DETAIL_PICTURE"])):?>
                <div style="clear:both"></div>
            <?endif?>
            <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                <small>
                    <?=$arProperty["NAME"]?>:&nbsp;

                       <button class="voitingMin">-</button>
                    <span class="voitingRes"><?=$arProperty["DISPLAY_VALUE"];?></span>
                    <button class="voitingPlus">+</button>

                </small><br />
            <?endforeach;?>
        </div>
    <?endforeach;?>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"] == "Y"):?>
        <br /><?=$arResult["NAV_STRING"]?>
    <?endif;?>
</div>


