<?
define("IBLOCK_SNEAKERS", 2);
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/agents.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/agents.php");
};
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/events.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/php_interface/include/events.php");
};

// регистрируем обработчик
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", array("checkDelet", "OnBeforeIBlockElementDeleteHandler"));

