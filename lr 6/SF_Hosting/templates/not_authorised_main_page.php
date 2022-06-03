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
    <link rel="stylesheet" href="css/style.css">
    <title>SF_Hosting</title>
</head>
<body>
<?php
require_once 'header.not_authorised.php';
?>

<div class="main">
    <div class="main-container">
        <div class="main-content">
            <h1>
                Начнём поиск файлов!
            </h1>
            <p>
               SF_Hosting поможет найти любую ерунду которая вам нужна
            </p>
            <button class="main-btn">
                <a href="#">
                    Поехали!
                </a>
            </button>
        </div>
        <div class="main-img-container">
            <img src="images/pic1.svg" alt="" id="main-img">
        </div>
    </div>
</div>

<!-- Modal1 -->
<div class="modal" id="email-modal">
    <div class="modal-content">
        <span  class="close-btn" style="position: absolute;top: 2%;right: 3%;font-size: 1.5rem;z-index: 1;">&times;</span>
        <div class="modal-content-left">
            <img id="modal-img" src="images/pic2.svg" alt="">
        </div>
        <div class="modal-content-right">
            <form class="modal-form" id="new-form">
                <h2>
                    Создать аккаунт 
                </h2>
                <h2 id="info-error">
                </h2>
                <div class="form-validation">
                    <input type="text" class="modal-input" id="name" name="name_reg" placeholder="Имя" required pattern="[а-яА-Я]+"
                           title="Имя может содержать только русские буквы.">
                </div>
                <div class="form-validation">
                    <input type="email" class="modal-input" id="email" name="email_reg" placeholder="Email">
                </div>
                <div class="form-validation">
                    <input type="tel" class="modal-input" id="tel" name="tel_reg" placeholder="Телефон" required pattern="^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$"
                           title="Используйте любой существующий российский формат мобильного телефона.">

                </div>
                <div class="form-validation">
                    <input type="password" class="modal-input" id="password" name="password_reg" placeholder="Пароль" required minlength="6" maxlength="128">
                </div>
                <div class="form-validation">
                    <input type="password" class="modal-input" id="password-confirm" name="password_confirm_reg" placeholder="Повторите пароль" required minlength="6" maxlength="128">
                    <div class="error" id="passwordConfirmError"></div>
                    <div class="error1" id="passwordConfirmError1"></div>
                    <div class="box-field">
                        <input type="checkbox" onclick="checkCheckBoxRegistration()" class="checkbox" id="box1">
                        <span style="color: #686567;font-size: 14px;">Я согласен на обработку персональных данных</span>
                    </div>
                </div>
                <button class="modal-input-btn" style="visibility: visible" id="modal-input-submit" disabled>Зарегистрироваться</button>
                <span class="modal-input-login">Уже есть аккаунт? <a href="#email-modal1">Войти</a></span>
            </form>
        </div>
    </div>
</div>

<!-- Modal2 -->
<div class="modal2" id="email-modal1">
    <div class="modal2-content">
        <span  class="close-btn1" style="position: absolute;top: 2%;right: 3%;font-size: 1.5rem;z-index: 1;">&times;</span>
        <div class="modal2-content-left">
            <img id="Modal-img" src="images/pic3.svg" alt="">
        </div>
        <div class="modal2-content-right">
            <form class="modal2-form">
                <h2>
                    Авторизация
                </h2>
                <h2 id="info-error2">
                </h2>
                <div class="form-validation2">
                    <input type="tel" class="modal2-input" name="tel_auth" placeholder="Телефон" required minlength="11" maxlength="12">
                </div>
                <div class="form-validation2">
                    <input type="password" class="modal2-input" name="password_auth" placeholder="Пароль" required minlength="6" maxlength="128">
                </div>
                <a class="modal2-input-btn" id="modal-input-submit-auth">Войти</a>
                <span class="modal-input-login">Еще нет аккаунта? <a href="#email-modal-form">Зарегистрироваться</a></span>
            </form>
        </div>
    </div>
</div>

<!-- add_post -->
<div class="modal3" id="email-modal3">
    <div class="modal3-content">
        <span  class="close-btn3" style="position: absolute;top: 2%;right: 3%;font-size: 1.5rem;z-index: 1;">&times;</span>
        <div class="modal3-content-left">
            <img id="Modal3-img" src="images/pic3.svg" alt="">
        </div>
        <div class="modal3-content-right">
            <form class="modal3-form">
                <h2>
                    Авторизация
                </h2>
                <div class="form-validation3">
                    <input type="tel" class="modal3-input" name="tel" placeholder="Телефон" required minlength="11" maxlength="12">
                </div>
                <div class="form-validation2">
                    <input type="password" class="modal3-input" name="password" placeholder="Пароль" required minlength="8" maxlength="128">
                </div>
                <button type="submit" class="modal3-input-btn" id="submit">Войти</button>
            </form>
        </div>
    </div>
</div>

<!-- Cards -->
<div class="services" id="services">
    <h1>Доступные файлы</h1>
    <div id="first_wrapper" class="services_wrapper">
        <?php
        foreach ($params as $post) {?>
            <div data-id="<?=$post['id_post']?>" class="services_card">
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
    <button class="btn-services">
        <a>
            Показать ещё
        </a>
    </button>
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
<script type="text/javascript" src="js/checker.js"></script>
<script type="text/javascript">
    function checkCheckBoxRegistration(){
        if($('#box1').is(':checked') ) {
            document.getElementById("modal-input-submit").removeAttribute('disabled');
        } else {
            document.getElementById("modal-input-submit").disabled = "disabled";
        }
    }
</script>
</body>
</html>