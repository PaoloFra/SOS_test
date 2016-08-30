<nav class="navbar navbar-default navbar-fixed-top navbar-snp" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">S&P inc.</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">Главная</a></li>
        <li><a href="#">Профиль</a></li>
        <li><a href="#">Сообщение</a></li>
    </ul>
    </div>
</nav>

<div class="container">
    <p>{{ flash.output() }}</p>
    {{ content() }}
    <hr>
    <footer>
        <p>&copy; {{ date('Y') }}, S&P</p>
    </footer>
</div>
