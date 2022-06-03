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
            <li><a href="/user_profile" class="nav-links nav-links-btn" id="reg">Здравствуйте<?=', ' . $_SESSION['user']['user_name']?></a></li>
            <li><a id="exit_account_button" class="nav-links nav-links-btn2">Выход</a></li>
        </ul>
    </nav>
</div>