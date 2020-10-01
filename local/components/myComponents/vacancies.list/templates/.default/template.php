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
<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">

<p> Компонент выводит елементы инфоблока вместе с каталогом</p>
<? //dump($arResult) ?>
<?php

    $i=1;
    foreach ($arResult["ITEMS"] as  $key=>$Items):?>
        <ul >
            <li  class="parent"><h3 id="toggle" data-title="click" ><?=$key?></h3></li>
            <ul   class="active" >
                <? foreach ($Items as $elem) :?>
                    <?
                    $this->AddEditAction($elem['ID'], $elem['EDIT_LINK'], CIBlock::GetArrayByID($elem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($elem['ID'], $elem['DELETE_LINK'], CIBlock::GetArrayByID($elem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <li id="<?=$this->GetEditAreaId($elem['ID']);?>" class="panel"><p href="<?=$elem["DETAIL_PAGE_URL"]?>"><?=$elem["NAME"]?></p></li>
                    <?endforeach;?>
            </ul>
        </ul>
    <?endforeach ?>


