<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Manager - Admin</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/vendor/adminlte/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/vendor/adminlte/skin-black-light.min.css')}}">
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-black-light sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="{{ route('admin.index') }}" class="logo">
                <span class="logo-mini"><b>BY</b></span>
                <span class="logo-lg"><b>BY</b>Halal</span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('img/logo_circle_bg.png') }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ ucfirst(Auth::user()->username) }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="{{ asset('img/logo_circle_bg.png') }}" class="img" alt="User Image">
                                        <p>
                                        {{ ucfirst(Auth::user()->username) }}
                                        <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-right">
                                        <a href="{{ route('manager-logout') }}" class="btn btn-default btn-flat">Déconnexion</a>
                                    </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('img/logo_circle_bg.png') }}" class="img" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ ucfirst(Auth::user()->username) }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="header">HEADER</li>
                        <li class="{{ Request::path() == '/' ? 'active' : '' }}" ><a href="{{ route('manager.index') }}"><i class="fa fa-home"></i> <span>{{ trans('admin.dashboard') }}</span></a></li>
                        <li class="{{ Request::path() == 'restaurants' ? 'active' : '' }}" ><a href="{{ route('manager.restaurants.index') }}"><i class="fa fa-caret-right"></i> <span>{{ trans('admin.restaurants') }}</span></a></li>
                        <li class="{{ Request::path() == 'orders' ? 'active' : '' }}" ><a href="{{ route('manager.orders.index') }}"><i class="fa fa-caret-right"></i> <span>{{ trans('admin.orders') }}</span></a></li>
                        <li class="{{ Request::path() == 'bookings' ? 'active' : '' }}" ><a href="{{ route('manager.bookings.index') }}"><i class="fa fa-caret-right"></i> <span>{{ trans('admin.bookings') }}</span></a></li>
                        <li class="{{ Request::path() == 'users' ? 'active' : '' }}" ><a href="{{ route('manager.user.index') }}"><i class="fa fa-caret-right"></i> <span>{{ trans('admin.users') }}</span></a></li>
                        <li class="header">INFORMATIONS</li>
                        <li class="{{ Request::path() == 'managefront' ? 'active' : '' }}" ><a href="{{ route('manager.managefront.index') }}"><i class="fa fa-caret-right"></i> <span>{{ trans('admin.managefront') }}</span></a></li>
                        <li class="{{ Request::path() == 'changePassword' ? 'active' : '' }}" ><a href="{{ route('manager.changepassword.index') }}"><i class="fa fa-caret-right"></i> <span>{{ trans('admin.changePassword') }}</span></a></li>
                    </ul>
                </section>
            </aside>
                <main class="content-wrapper">
                    <header class="content-header">
                        <h1>
                            @if(Request::path() == '/')
                                {{ trans('admin.dashboard') }}
                            @elseif(strpos(Request::path(), 'orders/') !== false )
                                {{ trans('admin.detailOrder') }}
                            @elseif(strpos(Request::path(), 'bookings/') !== false )
                                {{ trans('admin.showBooking') }}
                            @elseif(strpos(Request::path(), 'restaurant/show') !== false )
                                {{ trans('admin.showrestaurant') }}
                            @else
                                {{ trans('admin.'.Request::path()) }}
                            @endif
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="{{ URL::previous() }}"><i class="fa fa-backward"></i> Retour</a></li>
                        </ol>
                    </header>
                    @yield('content')
                </main>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    Anything you want
                </div>
                <strong>Copyright &copy; 2017 <a href="{{ route('home') }}">BY</a></strong> Tous droits réservés.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <script src="{{ asset('js/vendor/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/vendor/adminlte/app.min.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        @section('scripts')
        @show
        <script src="{{ asset('js/manager.js') }}"></script>
    </body>
</html>
