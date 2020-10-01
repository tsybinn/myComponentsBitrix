<?
  //агент для парсинга xml, включается раз в сутки и обновляет файл arСourseValute.txt   //
            function udateFileXmlValutes()
            {
                $xml = file_get_contents('http://www.cbr.ru/scripts/XML_daily.asp');
                $data = serialize($xml); // PHP формат сохраняемого значения.
                $path = $_SERVER["DOCUMENT_ROOT"] . "/local/components/myComponents/ExchangeRates.list/file/arСourseValute.txt";
                file_put_contents($path, $data);// обновление локального файла с курсом валют
                return "udateFileXmlValutes();";
            }