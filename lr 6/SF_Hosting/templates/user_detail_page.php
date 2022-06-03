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
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <title>Личный кабинет</title>
</head>
<body>

<div class="wrapper">
    <div class="left">
        <img src="images/pic6.svg" alt="user" width="160">
        <h4><?=$params['user_name']?></h4>
        <p><?=$params['role']?></p>
    </div>
    <div class="right">
        <div class="info">
            <h2>Личный кабинет</h2>
            <div class="info_data">
                <div class="data">
                    <h4>Email</h4>
                    <p><?=$params['email']?></p>
                </div>
                <div class="data">
                    <h4>Телефон</h4>
                    <p><?=$params['phone']?></p>
                </div>
            </div>
        </div>

        <div class="services_wrapper">

            <button class="btn-services1">
                <a href="/user_all_posts">
                    Перейти к моим постам
                </a>
            </button>
        </div>
    </div>
</div>

</body>
</html>
