<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="MONDE">
    <meta name="author" content="">
    <link rel="icon" href="img/logo_noir_fond_transparent_thumbnail.png">

    <title>By-livraison Halal</title>

    <!-- FONTS -->
    <link href='//fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,700,800,300'
          rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/component.css"/>
    <link rel="stylesheet" href="css/animations.css"/>
    <link rel="stylesheet" href="css/components.css"/>
    <link rel="stylesheet" href="css/responsiveslides.css"/>
    <link rel="stylesheet" href="css/fotorama.css"/>
    <link rel="stylesheet" href="css/owl.carousel.css"/>
    <link rel="stylesheet" href="css/jquery-ui.css"/>

    <link rel="stylesheet" href="css/main.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script>
        document.createElement( 'video' );
    </script>
    <![endif]-->

</head>

<body class="image_bg">

<!--background & preloader-->
<div class="wrapp">

    <div class="preload-bg">
        <div class="preloaderWraper">
            <span id="loadPrecent">0%</span>

            <div class="scaleDiv">
                <object type="image/svg+xml" data="img/triangles.svg" class="mondePreloader loading opacity"
                        width="300"
                        height="300">
                </object>
                <div class="black-overlay"></div>
            </div>

        </div>
    </div>

</div>

<!-- MAIN FIXED BOTTOM MENU -->
<nav class="navbar navbar-fixed-bottom ">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand brand" style="height: 70px;" href="#home">
            <img src="{{ asset('img/logo_blanc_fond_transparent.png') }}" alt="logo">
        </a>
    </div>
    <div id="navbar">
        <div class="center-menu" id='all-pages'>
            <ul class="nav navbar-nav dl-menu">
                <li class='open-page-2'><a href="#about">À propos</a></li>
                <li class='open-page-3'><a href="#services">Services</a></li>
                <li class='open-page-4'><a href="#contacts">Contacts</a></li>
            </ul>
        </div>
        <div class="navbar_share-icons">
            <div class="navbar_icons">
                <ul>
                    <li><a href="https://m.facebook.com/bylivraisonhalalFR/"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/by_livraisonhalal/"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
            <span>bylivraisonhalal, {{ date('Y') }}</span>
            <a href="" class="navbar_show-icons">
                <!--<i class="fa fa-share-alt"></i>-->
            </a>
        </div>
    </div>
    <!--/.nav-collapse -->
</nav>
<!-- END MAIN MENU -->

<main>

    <div id="pt-main" class="pt-perspective ">

        <!-- MAIN PAGE -->
        <div class="pt-page pt-page-1 show-timer" id="main">

            <!-- <header class="top-logotip">
                <img src="http://wallensteyn.com/wp-content/uploads/2016/09/wallpapers_16.jpg">
                My Logotip
            </header> -->
            <!-- DAYS LEFT -->
            <div class="main-page main_block">
                <header>
                    <h1>Bientôt le meilleur de la restauration Halal</h1>
                </header>
                <div class="container">
                    <div class="row">
                        <div class="main_block_text col-md-6 col-md-push-3">
                            <p class="main-text">
                                Nous ne commencerons pas sans vous !
                            </p>
                        </div>
                    </div>
                </div>

                <div class="subscribe">
                    <button class="subscribe-btn">S'inscrire</button>
                    <form class="notify-me subscribe-form" method="post" action="{{ route('subscribe') }}" name="subscribe-form">
                        <input class="form-control email submail" type="email" name="subscribe" placeholder="Entrez votre email">
                        <input type="submit" class="btn btn-info subsubmit" value="" name="subsubmit">
                        <span class="form-message" style="display: none;"></span>
                    </form>
                </div>

            </div>
        </div>
        <!-- END MAIN PAGE -->

        <!-- ABOUT PAGE -->
        <div class="pt-page pt-page-2" id="about">
            <div class="main_block">
                <header>
                    <h1>À propos</h1>
                </header>
                <div class="container">
                    <div class="row">
                        <div class="main_block_text col-md-6 col-md-push-3 col-sm-10 col-sm-push-1">
                            <blockquote>
                                <p>
                                    “ C’est Halal ou pas ? ”
                                </p>
                            </blockquote>
                            <p>
                                BY est la réponse à cette question désormais célèbre. Oui, oui ! Une solution et seulement deux lettres. Nous assurons un service de livraison, de commande et de réservation en ligne dans des restaurants exclusivement Halal. Vous n’avez plus qu’à cliquer, nous nous occupons de tout !
                            </p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END ABOUT PAGE -->

        <!-- SERVICES PAGE -->
        <div class="pt-page pt-page-3" id="services">
            <div class="main_block">
                <header>
                    <h1>Services</h1>
                </header>
                <div class="container">
                    <div class="row">

                        <div class="main_block_text col-md-6 col-md-push-3 col-sm-10 col-sm-push-1">
                            <ul class="category-group">
                                <li class='active'><a href="#">
                                        <i class="fa fa-laptop" aria-hidden="true"></i>
                                    </a></li>
                                <li><a href="#">
                                        <i class="fa fa-bicycle" aria-hidden="true"></i>
                                    </a></li>
                                <li><a href="#">
                                        <i class="fa fa-automobile" aria-hidden="true"></i>
                                    </a></li>
                                <li><a href="#">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </a></li>
                            </ul>

                            <div class="info open">
                                <p class='title-text'>Commander</p>
                                <p>
                                    Commandez directement en ligne parmi une sélection de restaurant certifiés Halal.
                                </p>
                            </div>

                            <div class="info">
                                <p class='title-text'>Livraison</p>
                                <p>
                                    Faites vous livrer chez vous ou au bureau en 30 min pour le déjeuner et le dîner.
                                </p>
                            </div>

                            <div class="info">
                                <p class='title-text'>Récupérer la commande</p>
                                <p>
                                    Soyez plus rapides que nos livreurs !
                                </p>
                            </div>

                            <div class="info">
                                <p class='title-text'>Réserver</p>
                                <p>
                                    Une occasion se présente, réserver une table parmi la sélection de restaurants.
                                    Prenez de l'avance et précisez votre menu au chef dès la réservation !
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END SERVICES PAGE -->

        <!-- CONTACTS PAGE -->
        <div class="pt-page pt-page-4" id="contacts">
            <div class="main_block contacts">
                <header>
                    <h1>Contacts</h1>
                </header>
                <div class="container">
                    <div class="row">

                        <div class="main_block_text col-md-6 col-md-push-3 col-sm-10 col-sm-push-1">

                            <ul class="category-group">
                                <li class='active'>
                                    <a href="#">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </a></li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>

                            <div class="info open">
                                <address>
                                    E-mail : contact@by-livraisonhalal.com
                                </address>
                            </div>

                            <div class="info">
                                <p>
                                    Tel : 0-603-112-287
                                </p>
                            </div>

                        </div>
                        <!--end main-block-text-->

                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </div>
        </div>
        <!-- END CONTACTS PAGE -->

        <!-- TEAMS PAGE -->
        <div class="pt-page pt-page-5" id="team">
            <div class="main_block carousel">
                <header>
                    <h1>Team</h1>
                </header>

                <div class="clipCarousel cover">

                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-1.jpg' alt="" width="256" height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name"> Carla Dichter <span class="team-work">Director</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/BY - livraison Halal"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-2.jpg' alt="" width="256" height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name">Patrick Donalds <span class="team-work">Creative director</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/ItemBridge"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-behance"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-3.jpg' alt="" width="256"
                                 height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name">Meghan Speyers <span class="team-work">Developer</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/ItemBridge"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-behance"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-4.jpg' alt="" width="256" height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name">Lisa Collins <span class="team-work">Manager</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/ItemBridge"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-behance"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-5.jpg' alt="" width="256"
                                 height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name">Bill Stewarts <span class="team-work">Software Engineer</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/ItemBridge"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-behance"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-6.jpg' alt="" width="256"
                                 height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name">Anthony Sowul <span class="team-work">SEO specialist</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/ItemBridge"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-behance"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-7.jpg' alt="" width="256"
                                 height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name">Jamie Marshall <span class="team-work">Financial analyst</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/ItemBridge"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-behance"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/team/team-8.jpg' alt="" width="256"
                                 height="167"/>
                        </div>
                        <div class="item-info">
                            <p class="team-name">Rachel Burkett <span class="team-work">Web designer</span></p>
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/ItemBridge"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://plus.google.com/+Itembridge/"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://twitter.com/Itembridge"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.behance.net/itembridge"><i class="fa fa-behance"></i></a></li>
                                <li><a href="https://dribbble.com/itembridge"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                            <a href="#" class="fotorama_show-icons">
                                <!--<i class="fa fa-share-alt"></i>-->
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- END TEAMS PAGE -->

        <!-- PORTFOLIO PAGE -->
        <div class="pt-page pt-page-6" id="portfolio">
            <div class="main_block carousel">
                <header>
                    <h1>Portfolio</h1>
                </header>

                <div class="clipCarousel portfolio">

                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-1.jpg' alt="Description"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-2.jpg' alt="Description"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-3.jpg' alt="Description"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-4.jpg' alt="Description"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-5.jpg' alt="Description"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-6.jpg' alt="Description"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-7.jpg' alt="Description"/>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item_img">
                            <img src="#" data-src='img/portfolio/portfolio-8.jpg' alt="Description"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END PORTFOLIO PAGE -->

        <!-- ABOUT APP PAGE -->
        <div class="pt-page pt-page-7" id="app">

            <div class="open-info-about-app top-left-block">
                <img src="img/app-1.png" alt="07" width="250" height="508"/>
            </div>

            <div class="main_block about-app">
                <header>
                    <h1>ABOUT APP</h1>
                </header>
                <div class="container">
                    <div class="row">

                        <div class="main_block_text col-md-6 col-md-push-3 col-sm-10 col-sm-push-1">
                            <p>
                                An awesome mobile APP for your smartphone. Our designers and developers made a piece of
                                art for you to enjoy your phone functioning. Portability, connectivity, user interface,
                                storage, performance, security and app capability – all these will make your daily life
                                much easier and more effective. Just have a look!
                            </p>
                        </div>

                    </div>
                </div>
                <button class="open-info-about-app">More info</button>
                <a class="app-store">
                    <i class="fa fa-apple"></i>
                    <span>Download on the</span>
                    App Store
                </a>
                <a class="google-play">
                    <i class="fa google-play-bg"></i>
                    <span>Get it now</span>
                    Google play
                </a>
            </div>

        </div>
        <!-- END ABOUT APP PAGE -->

    </div>

</main>

<!-- Google map API -->
<div class="map">
    <div id="map-canvas"></div>
    <div class="bottom">
        <a href="#" class="close-this"></a>
    </div>
</div>

<!-- INFORMATION ABOUT APP -->
<div class="info-about-app">

    <div class="info-about-app_block">

        <div class="stack ">

            <div class="stack-content">

                <ul id="elasticstack" class="stack__images">
                    <li><img src="img/app-1.png" alt="07" width="250" height="508"/></li>
                    <li><img src="img/app-2.png" alt="02" width="250" height="508"/></li>
                    <li><img src="img/app-3.png" alt="01" width="250" height="508"/></li>
                </ul>
                <ul id="stack-titles" class="stack__titles">
                    <li class="current">
                        <header>
                            <h1 class="main-heading">ABOUT APP</h1>
                        </header>
                        <p>
                            Enjoy intuitive features of our digital devices. Portability, connectivity, user interface,
                            storage, performance, security and applications capability – all these makes daily life much
                            easier and more effective.
                        </p>
                    </li>
                    <li class="">
                        <h1 class="main-heading">Features</h1>
                        <p>
                            Truly awesome mobile APP for your smartphone. Our designers and developers made a piece of
                            art for you to enjoy your phone functioning. Portability, connectivity, user interface,
                            storage, performance, security and app capability – all these will make your daily life much
                            easier and more effective.
                        </p>
                    </li>
                    <li class="">
                        <h1 class="main-heading">download</h1>
                        <p>
                            App download is easier than ever! You'll get not just an app, but also free software,
                            easy search, personal assistant, image editors and filters and regular updates. Don't miss
                            a chance, download it right now.
                        </p>
                        <a class="app-store">
                            <i class="fa fa-apple"></i>
                            <span>Download on the</span>
                            App Store
                        </a>
                        <a class="google-play">
                            <i class="fa google-play-bg"></i>
                            <span>Get it now</span>
                            Google play
                        </a>
                    </li>
                </ul>

            </div>

        </div>

    </div>

    <div class="bottom">
        <div class="center-menu">
            <ul class="nav navbar-nav center-menu">
                <li class="active"><a href="#">About APP</a></li>
                <li><a href="#">Features</a></li>
                <li><a href="#">Download</a></li>
            </ul>
        </div>
        <a href="#" class="close-this"></a>
    </div>
</div>
<!--     END INFORMATION ABOUT APP -->


<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/polyfill.js"></script>
<script src="js/draggabilly.pkgd.min.js"></script>
<script src="js/elastiStack.js"></script>
<script src="js/precentLoader.js"></script>
<script src="js/scrollStyler.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.dlmenu.js"></script>
<script src="js/fotorama.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/responsiveslides.js"></script>
<script src="js/retina.js"></script>
<script src="js/jquery-mousewheel.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="js/main.js"></script>

<noscript>
    <h1 class="no-script">We're sorry but our site <strong>requires</strong> JavaScript.</h1>
</noscript>

</body>
</html>
