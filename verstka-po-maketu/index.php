<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Верстка по макету");
?>
    <section class="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h2 class="about__title">
                        About Us
                    </h2>
                    <p class="about__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                        incididunt ut labore
                        et dolore magna aliqua. Ut enim ad minim veniam</p></div>
            </div>
            <div class="row about__items justify-content-around">
                <div class="col-xl-3 ml-5 col-md-5  "><img src="<?=SITE_TEMPLATE_PATH?>/img/internet.png.png" alt="">
                    <h3 class="about_h3">Awesome Icons</h3>
                    <p class="about__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor</p>
                </div>
                <div class="col-xl-3 col-md-5 "><img src="<?=SITE_TEMPLATE_PATH?>/img/transfer.png.png" alt="">
                    <h3 class="about_h3">One Page</h3>
                    <p class="about__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor</p>
                </div>
                <div class="col-xl-3 mr-5 col-md-5  about__items_last  "><img src="<?=SITE_TEMPLATE_PATH?>/img/head.png.png" alt="">
                    <h3 class="about_h3">Responsive</h3>
                    <p class="about__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor</p>
                </div>

            </div>
        </div>
    </section>
    <section class="servises">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6  "><h2 class="servises__title">
                        Our Services
                    </h2>
                    <p class="servises__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p></div>
            </div>
            <div class="row servises__item   ">
                <div class="col-xl-3 "><img src="<?=SITE_TEMPLATE_PATH?>/img/smartphone_copy.png" alt="">
                    <h4 class="servises__title_item>">Portfolio</h4>
                    <p class="servises__text_item">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum iti
                        atque corrupti quos.
                    </p>
                    <button class="servises__button_item">
                        READ MORE
                    </button>
                </div>

                <div class="col-xl-3  ml-4  "><img src="<?=SITE_TEMPLATE_PATH?>/img/smartphone_copy.png" alt="">
                    <h4 class="servises__title_item>">Portfolio</h4>
                    <p class="servises__text_item">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum iti
                        atque corrupti quos.
                    </p>
                    <button class="servises__button_item">
                        READ MORE
                    </button>
                </div>
                <div class="col-xl-3 ml-4"><img src="<?=SITE_TEMPLATE_PATH?>/img/smartphone_copy.png" alt="">
                    <h4 class="servises__title_item>">Portfolio</h4>
                    <p class="servises__text_item">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum iti
                        atque corrupti quos.
                    </p>
                    <button class="servises__button_item">
                        READ MORE
                    </button>
                </div>

                <div class="col-xl-3 "><img src="<?=SITE_TEMPLATE_PATH?>/img/smartphone_copy.png" alt="">
                    <h4 class="servises__title_item>">Portfolio</h4>
                    <p class="servises__text_item">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum iti
                        atque corrupti quos.
                    </p>
                    <button class="servises__button_item">
                        READ MORE
                    </button>
                </div>
                <div class="col-xl-3 ml-4 "><img src="<?=SITE_TEMPLATE_PATH?>/img/smartphone_copy.png" alt="">
                    <h4 class="servises__title_item>">Portfolio</h4>
                    <p class="servises__text_item">
                        At vero eos et accusamus et iusto odio dignissimos ducimus <span>
                        blanditiis praesentium voluptatum iti
                    atque corrupti quos. </span>
                    </p>
                    <button class="servises__button_item">
                        READ MORE
                    </button>
                </div>
                <div class="col-xl-3 ml-4 "><img src="<?=SITE_TEMPLATE_PATH?>/img/smartphone_copy.png" alt="">
                    <h4 class="servises__title_item>">Portfolio</h4>
                    <p class="servises__text_item">
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum iti
                        atque corrupti quos.
                    </p>
                    <button class="servises__button_item">
                        READ MORE
                    </button>
                </div>


            </div>
        </div>
    </section>
    <section class="works">
        <div class="container">
            <div class="row  justify-content-center ">
                <div class="col-xl-6"><h3 class="works__title">Latest Works</h3>
                    <p class="works__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                </div>
            </div>

            <div class="row justify-content-center  ">
                <div class=" col-xl-8  works_button  ">
                    <ul class="d-flex justify-content-start ">
                        <li class="works_button_elem1">
                            <button>ALL</button>
                        </li>
                        <li class="works_button_elem">
                            <button>WEB DESIGN</button>
                        </li>
                        <li class="works_button_elem">
                            <button>UI/UX DESIGN</button>
                        </li>
                        <li class="works_button_elem">
                            <button>MOCKUPS</button>
                        </li>
                    </ul>
                </div>


            </div>
    </section>

    <section class="photo">
        <div class="container">
            <div class="row photo__elements ">
                <div class="col-xl-3 col-md-5 photo__elem"><img class="img-fluid" src="<?=SITE_TEMPLATE_PATH?>/img/ite1m.png" alt=""></div>
                <div class="col-xl-3 col-md-5 photo__elem"><img class="img-fluid" src="<?=SITE_TEMPLATE_PATH?>/img/item.png" alt=""></div>
                <div class="col-xl-3 col-md-5 photo__elem"><img class="img-fluid" src="<?=SITE_TEMPLATE_PATH?>/img/item2.png" alt=""></div>
                <div class="col-xl-3 col-md-5 photo__elem"><img class="img-fluid" src="<?=SITE_TEMPLATE_PATH?>/img/Layer_4.png" alt=""></div>
                <div class="col-xl-3 col-md-5 photo__elem"><img class="img-fluid" src="<?=SITE_TEMPLATE_PATH?>/img/Layer_5.png" alt=""></div>
                <div class="col-xl-3 col-md-5 photo__elem"><img class="img-fluid" src="<?=SITE_TEMPLATE_PATH?>/img/Layer_6.png" alt=""></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8 photo__button">
                    <button>VIEW ALL</button>
                </div>
            </div>
        </div>
    </section>
    <section class="plan">

        <div class="container ">

            <div class="row  justify-content-center ">
                <div class="col-xl-6 class plan__header  ">
                    <h4 class="plan__title">
                        Pricing Plan
                    </h4>
                    <p class="plan__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                </div>
            </div>
            <div class="row plan__table_row   justify-content-start">

                <div class="col-xl-3 col-md-4  plan__table_item1  plan__table ">
                    <div class="plan__table_head ">
                        <h3 class="plan__table_name">Free Trail</h3>
                        <div class="plan__table_price"><span class="plan__table_price_valut">$</span>
                            <span class="plan__table_price_number">00</span> <span
                                    class="plan__table_price_text">per month</span></div>

                    </div>

                    <ul class="plan__table_description ">
                        <li class="mx-auto">30 Free Traill</span></li>
                        <li class="mx-auto">5 Free Projects</span></li>
                        <li class="mx-auto">PHP 5 Enabled</span></li>
                        <li class="mx-auto ">24/7 Suports</li>
                    </ul>
                    <div class="plan__table_button ">
                        <button>Order Now</button>
                    </div>
                </div>

                <div class="col-xl-3 col-md-4 plan__table_item2 plan__table  ">
                    <div class="plan__table_head">
                        <h3 class="plan__table_name">Basic</h3>
                        <div class="plan__table_price"><span class="plan__table_price_valut">$</span>
                            <span class="plan__table_price_number">50</span> <span
                                    class="plan__table_price_text">per month</span></div>

                    </div>

                    <ul class="plan__table_description ">
                        <li class="mx-auto">30 Free Traill</span></li>
                        <li class="mx-auto">5 Free Projects</span></li>
                        <li class="mx-auto">PHP 5 Enabled</span></li>
                        <li class="mx-auto ">24/7 Suports</li>
                    </ul>
                    <div class="plan__table_button ">
                        <button>Order Now</button>
                    </div>
                </div>

                <div class="col-xl-3 col-md-4 plan__table_item3 plan__table  ">
                    <div class="plan__table_head">
                        <h3 class="plan__table_name">Ultimates</h3>
                        <div class="plan__table_price"><span class="plan__table_price_valut">$</span>
                            <span class="plan__table_price_number">99</span> <span
                                    class="plan__table_price_text">per month</span></div>

                    </div>


                    <ul class="plan__table_description ">
                        <li class="mx-auto">30 Free Traill</span></li>
                        <li class="mx-auto">5 Free Projects</span></li>
                        <li class="mx-auto">PHP 5 Enabled</span></li>
                        <li class="mx-auto ">24/7 Suports</li>
                    </ul>
                    <div class="plan__table_button ">
                        <button>Order Now</button>
                    </div>
                </div>
            </div>


        </div>


        </div>
    </section>

    <section class="contacts">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <h3 class="coctacts__title">Contact Us</h3>
                    <p class="contacts__test">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                </div>
            </div>
            <div class="row contacts__contact justify-content-center ">
                <div class="col-xl-3">
                    <img class="contacts__contact_img" src="<?=SITE_TEMPLATE_PATH?>/img/5555555.png" alt="">
                    <p class="contacts__contact_text">Nobinagar savar,Dhaka Bangladesh</p>
                </div>


                <div class="col-xl-3">
                    <img class="contacts__contact_img" src="<?=SITE_TEMPLATE_PATH?>/img/2-layers.png" alt="">
                    <p class="contacts__contact_text">+8801743331996
                        +8801928737807</p>
                </div>
                <div class="col-xl-3">
                    <img class="contacts__contact_img" src="<?=SITE_TEMPLATE_PATH?>/img/2-layers%20(1).png" alt="">
                    <p class="contacts__contact_text">quickmasud@gmail.com
                        quickmasud@yahoo.com</p>
                </div>
            </div>
            <section class="formFeedback">

                <div class="row">
                    <div class="col-xl-12">
                        <form>
                            <div class="row row justify-content-start " >
                                <div class="col-xl-4">
                                    <input type="text" class="form-control formFeedback_name " placeholder="Your NAME">
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <input type="email" class="form-control formFeedback_email" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-xl-12 col-md-3">
                                <textarea class="form-control formFeedback_textarea" id="exampleFormControlTextarea1"
                                          rows="3">Write Massage</textarea>
                                    <button type="submit" class="btn btn-outline-secondary formFeedback_button">SEND
                                    </button>

                                </div>

                            </div>
                    </div>
                    </form>

                </div>
        </div>

    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>