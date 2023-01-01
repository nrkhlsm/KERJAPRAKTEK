@include('admin.partials.includes.head')

@section('navbar')
@include('admin.partials.includes.sections.navigation')
@show

@section('sidebar')
@include('admin.partials.includes.sections.sidebar')
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
@include('admin.partials.includes.footer')