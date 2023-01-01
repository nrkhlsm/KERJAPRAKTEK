@include('pemohon.partials.includes.head')

@section('navbar')
@include('pemohon.partials.includes.sections.navigation')
@show

@section('sidebar')
@include('pemohon.partials.includes.sections.sidebar')
@show
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            @yield('page-title')
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
@include('pemohon.partials.includes.footer')