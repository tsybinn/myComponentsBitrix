<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule("iblock"))
    return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$rsIBlock = CIBlock::GetList(array("sort" => "asc"), array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE" => "Y"));
while ($arr = $rsIBlock->Fetch()) {
    $arIBlock[$arr["ID"]] = "[" . $arr["ID"] . "] " . $arr["NAME"];
}

$arSorts = array("ASC" => GetMessage("T_IBLOCK_DESC_ASC"), "DESC" => GetMessage("T_IBLOCK_DESC_DESC"));
$arSortFields = array(
    "ID" => GetMessage("T_IBLOCK_DESC_FID"),
    "NAME" => GetMessage("T_IBLOCK_DESC_FNAME"),
    "ACTIVE_FROM" => GetMessage("T_IBLOCK_DESC_FACT"),
    "SORT" => GetMessage("T_IBLOCK_DESC_FSORT"),
    "TIMESTAMP_X" => GetMessage("T_IBLOCK_DESC_FTSAMP")
);

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(array("sort" => "asc", "name" => "asc"), array("ACTIVE" => "Y", "IBLOCK_ID" => $arCurrentValues["IBLOCK_ID"]));
while ($arr = $rsProp->Fetch()) {
    $arProperty[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
    if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S", "E"))) {
        $arProperty_LNS[$arr["CODE"]] = "[" . $arr["CODE"] . "] " . $arr["NAME"];
    }
}

$arUGroupsEx = array();
$dbUGroups = CGroup::GetList($by = "c_sort", $order = "asc");
while ($arUGroups = $dbUGroups->Fetch()) {
    $arUGroupsEx[$arUGroups["ID"]] = $arUGroups["NAME"];
}

$arComponentParameters = array(
    "GROUPS" => array(
        "REVIEW_SETTINGS" => array(
            "SORT" => 140,
            "NAME" => GetMessage("T_IBLOCK_DESC_REVIEW_SETTINGS"),
        ),


    ),
    "PARAMETERS" => array(
        "VARIABLE_ALIASES" => array(
            "ELEMENT_ID" => array("NAME" => GetMessage("NEWS_ELEMENT_ID_DESC")),
        ),
        "SEF_MODE" => array(
            "afisha" => array(
                "NAME" => GetMessage("T_IBLOCK_SEF_PAGE_NEWS"),
                "DEFAULT" => "",
                "VARIABLES" => array(),
            ),
            "film" => array(
                "NAME" => GetMessage("T_IBLOCK_SEF_PAGE_NEWS_DETAIL"),
                "DEFAULT" => "#ELEMENT_ID#/",
                "VARIABLES" => array("ELEMENT_ID"),
            ),
            "add_film" => array(
                "NAME" => GetMessage("T_IBLOCK_SEF_PAGE_RSS"),
                "DEFAULT" => "add_film/",
                "VARIABLES" => array(),
            ),
        ),
        "AJAX_MODE" => array(),
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("BN_P_IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("BN_P_IBLOCK"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlock,
            "REFRESH" => "Y",
            "ADDITIONAL_VALUES" => "Y",
        ),
        "USE_REVIEW" => array(
            "PARENT" => "REVIEW_SETTINGS",
            "NAME" => GetMessage("T_IBLOCK_DESC_USE_REVIEW"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
            "REFRESH" => "Y",
        ),


        "DATE_FORMAT" => CIBlockParameters::GetDateFormat(GetMessage("T_IBLOCK_DESC_ACTIVE_DATE_FORMAT"), "ADDITIONAL_SETTINGS"),


        "SET_TITLE" => array(),


        "ADD_GROUP_PERMISSIONS" => array(
            "PARENT" => "ADDITIONAL_SETTINGS",
            "NAME" => GetMessage("T_IBLOCK_DESC_GROUP_PERMISSIONS"),
            "TYPE" => "LIST",
            "VALUES" => $arUGroupsEx,
            "DEFAULT" => array(1),
            "MULTIPLE" => "Y",
        ),
        "CACHE_TIME" => array("DEFAULT" => 36000000),
    ),
);


if (!IsModuleInstalled("forum")) {
    unset($arComponentParameters["GROUPS"]["REVIEW_SETTINGS"]);
    unset($arComponentParameters["PARAMETERS"]["USE_REVIEW"]);
} elseif ($arCurrentValues["USE_REVIEW"] == "Y") {
    $arForumList = array();
    if (CModule::IncludeModule("forum")) {
        $rsForum = CForumNew::GetList();
        while ($arForum = $rsForum->Fetch())
            $arForumList[$arForum["ID"]] = $arForum["NAME"];
    }
    $arComponentParameters["PARAMETERS"]["MESSAGES_PER_PAGE"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_MESSAGES_PER_PAGE"),
        "TYPE" => "STRING",
        "DEFAULT" => intVal(COption::GetOptionString("forum", "MESSAGES_PER_PAGE", "10"))
    );
    $arComponentParameters["PARAMETERS"]["USE_CAPTCHA"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_USE_CAPTCHA"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y"
    );
    $arComponentParameters["PARAMETERS"]["REVIEW_AJAX_POST"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_REVIEW_AJAX_POST"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y"
    );
    $arComponentParameters["PARAMETERS"]["PATH_TO_SMILE"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_PATH_TO_SMILE"),
        "TYPE" => "STRING",
        "DEFAULT" => "/bitrix/images/forum/smile/",
    );
    $arComponentParameters["PARAMETERS"]["FORUM_ID"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_FORUM_ID"),
        "TYPE" => "LIST",
        "VALUES" => $arForumList,
        "DEFAULT" => "",
    );
    $arComponentParameters["PARAMETERS"]["URL_TEMPLATES_READ"] = array(
        "PARENT" => "REVIEW_SETTINGS",
        "NAME" => GetMessage("F_READ_TEMPLATE"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
    );
}

///*
// * Файл local/components/tokmakov/iblock/.parameters.php
// */
//if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
//
//// проверяем, установлен ли модуль «Информационные блоки»; если да — то подключаем его
//if (!CModule::IncludeModule('iblock')) {
//    return;
//}
//
///*
// * Получаем массив всех типов инфоблоков — для возможности выбора
// */
//$arInfoBlockTypes = CIBlockParameters::GetIBlockTypes();
//
///*
// * Получаем массив инфоблоков — для возможности выбора; фильтруем их по
// * выбранному типу и по активности
// */
//$arInfoBlocks = array();
//$arFilter = array('ACTIVE' => 'Y');
//// если уже выбран тип инфоблока, выбираем инфоблоки только этого типа
//if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
//    $arFilter['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
//}
//$rsIBlock = CIBlock::GetList(
//    array('SORT' => 'ASC'),
//    $arFilter
//);
//while($iblock = $rsIBlock->Fetch()) {
//    $arInfoBlocks[$iblock['ID']] = '['.$iblock['ID'].'] '.$iblock['NAME'];
//}
//
///*
// * Получаем массив разделов инфоблока, из которых надо получать
// * популярные элементы — для возможности выбора
// */
//$arInfoBlockSections = array(
//    '-' => '[=Выберите=]',
//);
//$arFilter = array(
//    'SECTION_ID' => false, // только корневые разделы
//    'ACTIVE' => 'Y' // только активные разделы
//);
//// если уже выбран тип инфоблока, выбираем разделы, принадлежащие инфоблокам выбранного типа
//if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
//    $arFilter['IBLOCK_TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
//}
//// если уже выбран инфоблок, выбираем разделы только этого инфоблока
//if (!empty($arCurrentValues['IBLOCK_ID'])) {
//    $arFilter['IBLOCK_ID'] = $arCurrentValues['IBLOCK_ID'];
//}
//$result = CIBlockSection::GetList(
//    array('SORT' => 'ASC'),
//    $arFilter
//);
//while ($section = $result->Fetch()) {
//    $arInfoBlockSections[$section['ID']] = '['.$section['ID'].'] '.$section['NAME'];
//}
//
///*
// * Настройки комлексного компонента
// */
//$arComponentParameters = array( // кроме групп по умолчанию, добавляем свои группы настроек
//    'GROUPS' => array(
//        'POPULAR_SETTINGS' => array(
//            'NAME' => 'Настройки главной страницы',
//            'SORT' => 800
//        ),
//        'SECTION_SETTINGS' => array(
//            'NAME' => 'Настройки страницы раздела',
//            'SORT' => 900
//        ),
//        'ELEMENT_SETTINGS' => array(
//            'NAME' => 'Настройки страницы элемента',
//            'SORT' => 1000
//        ),
//    ),
//    /*
//     * Группы параметров компонента:
//     * 1. Основные параметры компонента (BASE)
//     * 2. Параметры главной страницы (POPULAR_SETTINGS)
//     * 3. Параметры страницы раздела (SECTION_SETTINGS)
//     * 4. Параметры страницы элемента (DETAIL_SETTINGS)
//     */
//    'PARAMETERS' => array(
//
//        /*
//         * 1. Основные параметры компонента
//         */
//        'IBLOCK_TYPE' => array(
//            'PARENT' => 'BASE',
//            'NAME' => 'Тип инфоблока',
//            'TYPE' => 'LIST',
//            'VALUES' => $arInfoBlockTypes,
//            'REFRESH' => 'Y',
//        ),
//        'IBLOCK_ID' => array(
//            'PARENT' => 'BASE',
//            'NAME' => 'Инфоблок',
//            'TYPE' => 'LIST',
//            'VALUES' => $arInfoBlocks,
//            'REFRESH' => 'Y',
//        ),
//        // использовать символьный код вместо ID; если отмечен этот checkbox, в
//        // визуальном редакторе надо будет обязательно изменить шаблоны ссылок
//        // при включенном режиме поддержки ЧПУ, чтобы вместо #SECTION_ID# и
//        // #ELEMENT_ID# использовались #SECTION_CODE# и #ELEMENT_CODE#
//        'USE_CODE_INSTEAD_ID' => array(
//            'PARENT' => 'BASE',
//            'NAME' => 'Использовать символьный код вместо ID',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'N',
//        ),
//        // включать раздел в цепочку навигации?
//        'ADD_SECTIONS_CHAIN' => Array(
//            'PARENT' => 'BASE',
//            'NAME' => 'Включать родителей в цепочку навигации',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//
//        /*
//         * 2. Параметры главной страницы
//         */
//        // показывать корневые разделы инфоблока?
//        'POPULAR_ROOT_SECTIONS' => array(
//            'PARENT' => 'POPULAR_SETTINGS',
//            'NAME' => 'Показывать корневые разделы',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        // выбор разделов инфоблока, откуда будем получать популярные элементы
//        'POPULAR_SECTIONS' => array(
//            'PARENT' => 'POPULAR_SETTINGS',
//            'NAME' => 'Выберите разделы инфоблока',
//            'TYPE' => 'LIST',
//            'VALUES' => $arInfoBlockSections,
//            'MULTIPLE'=>'Y',
//            'REFRESH' => 'Y',
//        ),
//        // максимальное количество популярных элементов в разделе
//        'POPULAR_ELEMENT_COUNT' => array(
//            'PARENT' => 'POPULAR_SETTINGS',
//            'NAME' => 'Максимальное количество элементов в разделе',
//            'TYPE' => 'STRING',
//            'DEFAULT' => '3',
//        ),
//        'POPULAR_SET_PAGE_TITLE' => array(
//            'PARENT' => 'POPULAR_SETTINGS',
//            'NAME' => 'Устанавливать заголовок страницы из названия инфоблока',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        'POPULAR_SET_BROWSER_TITLE' => array(
//            'PARENT' => 'POPULAR_SETTINGS',
//            'NAME' => 'Устанавливать заголовок окна браузера из названия инфоблока',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//
//        /*
//         * 3. Параметры страницы раздела
//         */
//        'SECTION_ELEMENT_COUNT' => array(
//            'PARENT' => 'SECTION_SETTINGS',
//            'NAME' => 'Количество элементов на странице',
//            'TYPE' => 'STRING',
//            'DEFAULT' => '3',
//        ),
//        'SECTION_SET_PAGE_TITLE' => array(
//            'PARENT' => 'SECTION_SETTINGS',
//            'NAME' => 'Устанавливать заголовок страницы для раздела',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        'SECTION_SET_BROWSER_TITLE' => array(
//            'PARENT' => 'SECTION_SETTINGS',
//            'NAME' => 'Устанавливать заголовок окна браузера для раздела',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        'SECTION_SET_META_KEYWORDS' => array(
//            'PARENT' => 'SECTION_SETTINGS',
//            'NAME' => 'Устанавливать мета-тег keywords для раздела',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        'SECTION_SET_META_DESCRIPTION' => array(
//            'PARENT' => 'SECTION_SETTINGS',
//            'NAME' => 'Устанавливать мета-тег description для раздела',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//
//        /*
//         * 4. Параметры страницы элемента
//         */
//        'ELEMENT_SET_PAGE_TITLE' => array(
//            'PARENT' => 'ELEMENT_SETTINGS',
//            'NAME' => 'Устанавливать заголовок страницы для элемента',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        'ELEMENT_SET_BROWSER_TITLE' => array(
//            'PARENT' => 'ELEMENT_SETTINGS',
//            'NAME' => 'Устанавливать заголовок окна браузера для элемента',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        'ELEMENT_SET_META_KEYWORDS' => array(
//            'PARENT' => 'ELEMENT_SETTINGS',
//            'NAME' => 'Устанавливать мета-тег keywords для элемента',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//        'ELEMENT_SET_META_DESCRIPTION' => array(
//            'PARENT' => 'ELEMENT_SETTINGS',
//            'NAME' => 'Устанавливать мета-тег description для элемента',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//
//        /*
//         * Это отдельный блок настроек, который задает работу
//         * в обычном режиме (без ЧПУ) и в режиме ЧПУ
//         */
//        'VARIABLE_ALIASES' => array( // это для работы в режиме без ЧПУ
//            'SECTION_ID' => array('NAME' => 'Идентификатор раздела'),
//            'SECTION_CODE' => array('NAME' => 'Символьный код раздела'),
//            'ELEMENT_ID' => array('NAME' => 'Идентификатор элемента'),
//            'ELEMENT_CODE' => array('NAME' => 'Символьный код элемента'),
//        ),
//        'SEF_MODE' => array( // это для работы в режиме ЧПУ
//            'popular' => array(
//                'NAME' => 'Главная страница',
//                'DEFAULT' => '',
//            ),
//            'section' => array(
//                'NAME' => 'Страница раздела',
//                'DEFAULT' => 'category/id/#SECTION_ID#/',
//            ),
//            'element' => array(
//                'NAME' => 'Страница элемента',
//                'DEFAULT' => 'item/id/#ELEMENT_ID#/',
//            ),
//        ),
//
//        /*
//         * Настройки кэширования
//         */
//        'CACHE_TIME'  =>  array('DEFAULT' => 3600),
//        'CACHE_GROUPS' => array( // учитываться права доступа при кешировании?
//            'PARENT' => 'CACHE_SETTINGS',
//            'NAME' => 'Учитывать права доступа',
//            'TYPE' => 'CHECKBOX',
//            'DEFAULT' => 'Y',
//        ),
//    ),
//);
//
