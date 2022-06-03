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
    <script type="text/javascript" src="js/JQuery3.3.1.js"></script>
    <title>SF_Hosting</title>
</head>
<body>
<div class="nav-container">
    <nav class="navbar">
        <h1 id="navbar-logo">SF_Hosting</h1>
        <div class="menu-toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="nav-menu">
            <li><a href="/" class="nav-links">Главная</a></li>
            <li><a href="/user_profile" class="nav-links nav-links-btn" id="reg">Здравствуйте, <?=$_SESSION['user']['user_name']?></a></li>
            <li><
                <a id="exit_account_button" class="nav-links nav-links-btn2">
                    Выход
                </a>
            </li>
        </ul>
    </nav>
</div>


<!-- Cards -->
<div class="services" id="services">
    <h1>Мои файлы</h1>
    <div class="services_wrapper">
        <?php foreach ($params as $post) {
    ?>
        <div class="services_card">
            <h2><?=$post['name']?></h2>
            <p><?=$post['date_added']?></p>
            <div class="services_btn">
                <button data-id="<?=$post['id_post']?>"  class="detail_page_button">
                    Показать
                </button>
            </div>
        </div>
        <?php
}
        ?>
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
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
    function checkCheckBoxRegistration(){
        if($('#box1').is(':checked') ) {
            document.getElementById("modal-input-submit").style.visibility = "visible";
        } else {
            document.getElementById("modal-input-submit").style.visibility = "hidden";
        }
    }
</script>
<script src="js/app2.js"></script>
</body>
</html>
