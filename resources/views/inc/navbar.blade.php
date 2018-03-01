<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/"><span class="fa fa-home"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('catalog') ? 'active' : '' }}" href="/catalog">Каталог</a>
                </li>
            </ul>
        </div>
    </nav>
</header>