<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    if (!isset($arParams["CACHE_TIME"]))
        $arParams["CACHE_TIME"] = 180;
        $arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']); // in integer
    //	var_dump($arParams);

        if ($arParams['IBLOCK_ID'] > 0 && $this->StartResultCache( // cache check
    	false, ($arParams["CACHE_GROUPS"] === "N" ? false : $USER->GetGroups()))) {
        	if(!CModule::IncludeModule("iblock")) {
			$this->AbortResultCache();
			ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
			return;
		}
        //var_dump($arParams);

            $arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE' => 'Y');
        $arSelect = array();
        $db_list = CIBlockSection::GetList(array("SORT" => "ASC"), $arFilter, $arSelect); //  choose sections
        while ($ar_result = $db_list->GetNext()) {
            //var_dump($ar_result);
            $arSectID[] = $ar_result["ID"];
            $arSectName[] = $ar_result["NAME"];
        };
        //var_dump($arSectName);
        $arSort = array("IBLOCK_SECTION_ID" => "ASC");
        $arFilter = array(
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
        );
        $arGroupBy = false;
        $arNavStartParams = array("nTopCount" => 50);
        $arSelect = array("NAME", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID", "EDIT_LINK");
        $DBres = CIBlockElement::GetList
        ($arSort,
            $arFilter,
            $arGroupBy,
            $arNavStartParams,
            $arSelect
        );

        $arCatlog = [];
                while ($arRes = $DBres->GetNext()) {
            $arButtons = CIBlock::GetPanelButtons( //Метод возвращает массив, набор кнопок для управления элементами
                $arRes["IBLOCK_ID"],
                $arRes["ID"],
                //0,
                array("SECTION_BUTTONS" => false, "SESSID" => false)
            );
            //var_dump($arButtons);
            $arRes["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $arRes["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

            if ($ar = array_intersect($arSectID, $arRes)) { // search
                $arCatlog [$arRes["IBLOCK_SECTION_ID"]][] = $arRes;// sort array by IBLOCK_SECTION_ID
                //var_dump($arRes);
            }

            $LAST_ITEM_IBLOCK_ID = $arRes["IBLOCK_ID"]; // for ERMITAZH
        }
        $arResult ["ITEMS"] = array_combine($arSectName, $arCatlog); //name catalog in key
            $arResult["LAST_ITEM_IBLOCK_ID"]=$LAST_ITEM_IBLOCK_ID;
        //var_dump($arResult);
        //return $arResult;

            $this->SetResultCacheKeys(array(LAST_ITEM_IBLOCK_ID)); // заносим в кеш
            $this->IncludeComponentTemplate();  //connection template
    }
        // для корректной работы эрмитажа для случаев, когда кеш уже собран


    if(
        $arResult["LAST_ITEM_IBLOCK_ID"] > 0
        && $USER->IsAuthorized()
        && $APPLICATION->GetShowIncludeAreas()
        && CModule::IncludeModule("iblock")
    )
    {
        $arButtons = CIBlock::GetPanelButtons($arResult["LAST_ITEM_IBLOCK_ID"], 0, 0, array("SECTION_BUTTONS"=>false));
        $this->addIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
    }


?>
