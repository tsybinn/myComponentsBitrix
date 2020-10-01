<?

class checkDelet
{
// создаем обработчик события "OnBeforeIBlockElementDelete"
    function OnBeforeIBlockElementDeleteHandler($ID)
    {
        if (!CModule::IncludeModule("iblock"))
            return;

//* находим id инфоблока по id элемента
        echo $IBLOCK_ID = CIBlockElement::GetIBlockByID($ID);

//* проверка на заданный инфоблок
        if ($IBLOCK_ID == IBLOCK_SNEAKERS) {

            //*  достаем из базы значения свойства удаленного элемента
            $db_props = CIBlockElement::GetProperty($IBLOCK_ID, $ID, array("sort" => "asc"), array("CODE" => "RAITING"));
            if ($ar_props = $db_props->Fetch())
                $RAITING_ID = IntVal($ar_props["VALUE"]);

            $arOreder = array("PROPERTY_RAITING" => "ASC");
            $arSelect = array("ID", "NAME", 'PROPERTY_RAITING');
            $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, ">PROPERTY_RAITING" => $RAITING_ID,);
            /*
            выбираем элементы из инфоблока  в  которых свойство RAITING больше чем в удаленном элементе
            */
            $rsResCat = CIBlockElement::GetList($arOreder, $arFilter, false, false, $arSelect);
            while ($arItemCat = $rsResCat->GetNext()) {
                $arItems[] = $arItemCat;
            }
//* если массив пустой значит удаленный элемент имеет самый больший рейтинг
            if (!$arItems) {
// !!!! в админке   создать тип почтотвого события//
// массив с полями для передачи в почтовый шаблон
                $arEventFields = array(
                    "ID_ELEMENT" => $RAITING_ID,
                    "ID_IBLOCK" => $IBLOCK_ID
                );
                //cоздает почтовое событие которое будет в дальнейшем отправлено в качестве E-Mail сообщения
                if (CEvent::Send("DElETE_ELEM_MAX_RAITING", "s1", $arEventFields))
                    echo "<p style='color:red'>message has been sent to admin</p>";
                echo "Вы пытаетесь удалить элемент с наибольшим рейтингом!!!
            <input type='button' onclick='history.back();' value='Назад'/>";
                exit();
            }
        }
    }
}

