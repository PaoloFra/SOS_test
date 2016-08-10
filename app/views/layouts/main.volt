<nav class="navbar navbar-default navbar-fixed-top navbar-snp" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">MADE ❤</a>
    </div>
    {{ elements.getMenu() }}
</nav>

<div class="container">
    <p>{{ flash.output() }}</p>
    {{ content() }}
    <hr>
    <footer>
        <p>&copy; {{ date('Y') }}, S&P</p>
    </footer>
</div>
