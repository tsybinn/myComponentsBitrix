<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    // запрещаем сохранение в сессии номера последней страницы
    // при стандартной постраничной навигации
    CPageOption::SetOptionString('main', 'nav_page_in_session', 'N');
    if (!CModule::IncludeModule('iblock')) {
        ShowError('Модуль «Информационные блоки» не установлен');
        return;
    }


   //var_dump($arParams);
    // запрещаем сохранение в сессии номера последней страницы
    // при стандартной постраничной навигации
    CPageOption::SetOptionString('main', 'nav_page_in_session', 'N');

    if (!isset($arParams["CACHE_TIME"])){
        $arParams["CACHE_TIME"] = 180;
    }

    // тип инфоблока
    $arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
    // идентификатор инфоблока
    $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);
    // количество элементов на страницу
    $arParams['ELEMENT_COUNT'] = intval($arParams['ELEMENT_COUNT']);
    // учитывать права доступа при кешировании?
    $arParams['CACHE_GROUPS'] = $arParams['CACHE_GROUPS']=='Y';



    // Название категорий для постраничной навигации
    $arParams['PAGER_TITLE'] = trim($arParams['PAGER_TITLE']);
    // всегда показывать постраничную навигацию, даже если в этом нет необходимости
    $arParams['PAGER_SHOW_ALWAYS'] = $arParams['PAGER_SHOW_ALWAYS']=='Y';
    // имя шаблона постраничной навигации
    $arParams['PAGER_TEMPLATE'] = trim($arParams['PAGER_TEMPLATE']);
    // показывать ссылку «Все элементы», с помощью которой можно показать все элементы списка?
    //$arParams['PAGER_SHOW_ALL'] = $arParams['PAGER_SHOW_ALL']=='Y';

    // получаем все параметры постраничной навигации, от которых будет зависеть кеш
    $arNavParams = null;
    $arNavigation = false;
    if ($arParams['DISPLAY_TOP_PAGER'] || $arParams['DISPLAY_BOTTOM_PAGER']) {
        $arNavParams = array(
            'nPageSize' => $arParams['ELEMENT_COUNT'], // количество элементов на странице
            'bShowAll' => $arParams['PAGER_SHOW_ALL'], // показывать ссылку «Все элементы»?
        );
        $arNavigation = CDBResult::GetNavParams($arNavParams);
    } else
    {
        $arNavParams = array(
            "nTopCount" => $arParams["NEWS_COUNT"],
            "bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
        );
        $arNavigation = false;
    }

    //** проверка на актуальный кеш */
    if ($this->startResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $bUSER_HAVE_ACCESS, $arNavigation))) {
        if (!CModule::IncludeModule("iblock")) {
            $this->AbortResultCache();
            ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
            return;
        }
        $arResult = [];

        /*
     * Получаем информацию о разделе инфоблока
     */

        //** параметры сортировки */
        $arOrder = array($arParams["SORT_BY1"] => $arParams["SORT_ORDER1"]);
        // какие поля раздела инфоблока выбираем
        $arSelect = array();
        // условия выборки раздела инфоблока
        $arFilter = array('IBLOCK_TYPE'=> $arParams['IBLOCK_TYPE'] , 'GLOBAL_ACTIVE'=>'Y',);
        // выполняем запрос к базе данных
        $rsSection = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
        $arResult = $rsSection->GetNext();

        //var_dump($arResult);


        //**  выборка элементов инфоблока */
        $arSelect = array("ID",
            "NAME",
            "DETAIL_PICTURE",
            "PREVIEW_TEXT",
            "DETAIL_PAGE_URL",
            'IBLOCK_ID',  // это поле обязательно
            );
        $bGetProperty = count($arParams["PROPERTY_CODE"])>0;
        if($bGetProperty)
            $arSelect[]="PROPERTY_*"; // пользовательские свойства
 //var_dump($arSelect);
 //var_dump($arParams["PROPERTY_CODE"]);
        $arFilter = array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
        $res = CIBlockElement::GetList($arOrder, $arFilter, false, array("nPageSize" => $arParams['ELEMENT_COUNT']), $arSelect);
        while ($ob = $res->GetNextElement()) {
            // получаем поля текущего элемента
            $arFields = $ob->GetFields();
            // пользовательские свойства текущего элеиента
            $arFields['PROPERTIES'] = $ob->GetProperties();
            // получаем значения пользовательских свойств в удобном для отображения виде
            //var_dump($arFields['PROPERTIES'] );
            foreach ($arFields['PROPERTIES'] as $code => $data) {
                $arFields['DISPLAY_PROPERTIES'][$code] = CIBlockFormatProperties::GetDisplayValue($arFields, $data, '');
            }

            if ($arFields["DETAIL_PICTURE"]) {
                //* достаем массив картинки по ее ID */
                $arFields["DETAIL_PICTURE"] = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);

            }


            //** Метод возвращает массив, набор кнопок для управления элементами эрмитаж */
            $arButtons = CIBlock::GetPanelButtons(
                $arFields["IBLOCK_ID"],
                $arFields["ID"],
                array("SECTION_BUTTONS" => false, "SESSID" => false)
            );
            //var_dump($arButtons);
            $arFields["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $arFields["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
            //** собираем массив arResult */
            $arResult ["ITEMS"] [] = $arFields;
        }
//var_dump($arResult);
        /*
         * Постраничная навигация
         */
        $arResult['NAV_STRING'] = $res->GetPageNavString(
            $arParams['PAGER_TITLE'],
            $arParams['PAGER_TEMPLATE'],
            $arParams['PAGER_SHOW_ALWAYS'],
            $this
        );
        //var_dump($arResult);


        $this->IncludeComponentTemplate();  //connection template
    }
    // для корректной работы эрмитажа для случаев, когда кеш уже собран


    if (
        $arResult["LAST_ITEM_IBLOCK_ID"] > 0
        && $USER->IsAuthorized()
        && $APPLICATION->GetShowIncludeAreas()
        && CModule::IncludeModule("iblock")
    ) {
        $arButtons = CIBlock::GetPanelButtons($arResult["LAST_ITEM_IBLOCK_ID"], 0, 0, array("SECTION_BUTTONS" => false));
        $this->addIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
    }


?>
