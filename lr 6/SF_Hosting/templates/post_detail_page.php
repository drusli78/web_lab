<?php
/* @var array $params */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>SF_Hosting</title>
</head>
<body>
<?php
if (isset($_SESSION['user']) && $_SESSION['user']['id_user'] !== null) {
    require_once 'header.authorised.php';
} else {
    require_once 'header.not_authorised.php';
}
?>
<div id="main_container__detail_page">
    <div class="main">
        <div  class="main-container1">
            <div class="main-content">
                <h1>
                    <?=$params['name']?>
                </h1>

                <p1 class="modal-input1">
                    <?=$params['description']?>
                </p1>

            </div>

            <div class="main-img-container">
                <img src="images/pic5.svg" alt="" id="main-img">
            </div>
        </div>
    </div>
    <!-- Information -->
    <div class="services4" id="services">
        <div class="services3" id="services">
            <div class="services2" id="services">
                <h1><?=$params['date_added']?></h1>
                <h1><?=$params['user_name']?></h1>
            </div>
            <button data-url="<?=$params['link']?>" class="main-btn1">
                <h1>
                    <a>
                        Скачать
                    </a>
                </h1>
            </button>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer_container">
    <section class="social_media">
        <div class="social_media-wrap">
            <div class="footer_logo">
                <a href="#" id="footer_logo">SF_Hosting</a>
            </div>
            <p class="website_right">Ⓒ SF_Hosting 2022. Все права защищены.</p>
            <div class="social_icons">
                <a href="/" class="social_icon-link" target="_blank"><i class='fab fa-facebook-f'></i></a>
                <a href="/" class="social_icon-link"><i class='fab fa-instagram f-10x'></i></a>
                <a href="/" class="social_icon-link"><i class="far fa-envelope" style="color: white;font-size: 35px"></i></a>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="js/JQuery3.3.1.js"></script>
<script type="text/javascript" src="js/app2.js"></script>

</body>
</html>