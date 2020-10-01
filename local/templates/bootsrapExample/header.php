<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?use Bitrix\Main\Page\Asset;
    Asset::getInstance()->addCss('/bitrix/css/main/bootstrap_v4/bootstrap.css'); // connect bootstrap 4  of core
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/font-awesome/css/font-awesome.min.css");
      ?>
</head>
<body>

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<p>Интеграция верстки в bitrix, верстал сам по макету, при помощи bootstrap4, perfect pixel, верстка адаптивная.</p>
<input class="fixed" type="button" onclick="history.back();" value="Назад"/>
<header class="menu-bar">
    <div class="container  ">
        <div class="row align-self-center  ">
            <div class="col-xl-2 align-self-center text-right ">
                <a href="#" class="logo">You Logo</a>

            </div>
            <div class="col-xl-8 ml-auto ">

                <nav>
                    <div class="ul menu d-flex justify-content-start ">
                        <li class="menu__item"><a href="#">Home</a></li>
                        <li class="menu__item"><a href="#">About</a></li>
                        <li class="menu__item"><a href="#">Servicing</a></li>
                        <li class="menu__item"><a href="#">Portfolio</a></li>
                        <li class="menu__item"><a href="#">Blog</a></li>
                        <li class="menu__item"><a href="#">Contact</a></li>
                        <li class="menu__item"><i class="fa fa-search" aria-hidden="true"></i></li>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>
<header class="header">
    <div class="container b">
        <div class="row">
            <div class="col-xl-12">
                <h1 class="header__title">Web development project</h1>
                <p class="header__text">Very suitable to support all web development projects</p>
                <button class="button button_empty ">Our services</button>
                <button class="button button_full">Hire is now</button>
            </div>
        </div>
    </div>
</header>

