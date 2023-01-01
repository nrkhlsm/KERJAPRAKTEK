<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true" data-img="{{ asset('restaurant/admin/images/backgrounds/02.jpg') }}">
    <div class="navbar-header">
        <ul class="flex-row nav navbar-nav">
            <li class="mr-auto nav-item">
                <a class="navbar-brand" href="index.html">
                    <!-- <img class="brand-logo" alt="Chameleon admin logo" src="theme-assets/images/logo/logo.png" /> -->
                    <h3 class="brand-text">
                        @if(Auth::user()->hasRole('pemohon'))
                        {{ __('Halaman Pemohon') }}
                        @else
                        {{ __('Halaman Admin') }}
                        @endif

                    </h3>
                </a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar">head<i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="active"><a href="{{route('home')}}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li>
            <li class="nav-item has-sub open"><a href="#"><i class="ft-layout"></i><span class="menu-title" data-i18n="">Pesan Akta</span></a>
                <ul class="menu-content" style="">
                    <li class="is-shown"><a class="menu-item" href="{{route('jualbeli.index')}}">Jual beli</a>
                    </li>
                    <li class="is-shown"><a class="menu-item" href="{{ route('perseroanterbatas.index') }}">Perseroan terbatas </a>
                    </li>
                    <li class="is-shown"><a class="menu-item" href="{{ route('perseroancommanditer.index') }}">Perseroan komanditer </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="navigation-background">
    </div>
</div>