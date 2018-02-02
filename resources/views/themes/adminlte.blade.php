<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Restaurant - Admin</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/vendor/adminlte/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/vendor/adminlte/skin-blue.min.css') }}">
        @section('head')
        @show
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
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
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="label" id="notification"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header text-center" id="notifMessage"></li>
                                    <li>
                                        <ul class="menu">
                                            <li class="text-center">
                                                <a href="{{ route('admin.index') }}">
                                                    <i class="fa fa-arrow-right text-aqua"></i> Voir toutes les réservations
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('img/restaurants/logo-by.png') }}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="{{ asset('img/restaurants/logo-by.png') }}" class="img-circle" alt="User Image">
                                        <p>
                                            {{ Auth::user()->name }}
                                            <small>Membre depuis {{ date('Y', strtotime(Auth::user()->created_at)) }}</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ route('admin.infos.show') }}" class="btn btn-default btn-flat">Informations</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('admin-logout') }}" class="btn btn-default btn-flat">Déconnexion</a>
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
                            <img src="{{ asset('img/restaurants/logo-by.png') }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->name }}</p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="header">HEADER</li>
                        <li class="{{ Request::path() == '/' ? 'active' : '' }}" ><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> <span>Récapitulatifs</span></a></li>
                        <li class="{{ Request::path() == 'bilan' ? 'active' : '' }}" ><a href="{{ route('admin.bilan.index') }}"><i class="fa fa-caret-right"></i> <span>Bilan</span></a></li>
                        <li class="{{ Request::path() == 'orders' ? 'active' : '' }}" ><a href="{{ route('admin.orders.index') }}"><i class="fa fa-caret-right"></i> <span>Liste des commandes</span></a></li>
                        <li class="{{ Request::path() == 'categories' ? 'active' : '' }}" ><a href="{{ route('admin.categories.show') }}"><i class="fa fa-caret-right"></i> <span>Catégories</span></a></li>
                        <li class="{{ Request::path() == 'products' ? 'active' : '' }}" ><a href="{{ route('admin.products.show') }}"><i class="fa fa-caret-right"></i> <span>Produits</span></a></li>
                        <li class="header">INFORMATIONS</li>
                        <li class="{{ Request::path() == 'infos' ? 'active' : '' }}" ><a href="{{ route('admin.infos.show') }}"><i class="fa fa-caret-right"></i> <span>Informations du restaurant</span></a></li>
                        <li class="{{ Request::path() == 'modifications' ? 'active' : '' }}" ><a href="{{ route('admin.modifications.edit') }}"> <i class="fa fa-pencil"></i><span>Modifier Informations</span></a></li>
                        <li class="{{ Request::path() == 'password' ? 'active' : '' }}" ><a href="{{ route('admin.password.index') }}"> <i class="fa fa-pencil"></i><span>Mot de passe</span></a></li>
                        <li class="{{ Request::path() == 'workhours' ? 'active' : '' }}" ><a href="{{ route('admin.workhours.show') }}"> <i class="fa fa-pencil"></i><span>Horaires</span></a></li>
                    </ul>
                </section>
            </aside>
            <main class="content-wrapper">
                <header class="content-header">
                    <h1>
                        @if(Request::path() == '/')
                            {{ trans('restaurant.dashboard') }}
                        @elseif(strpos(Request::path(), 'orders/') !== false )
                            {{ trans('restaurant.detailOrder') }}
                        @elseif(strpos(Request::path(), 'bookings/') !== false )
                            {{ trans('restaurant.showBooking') }}
                        @else
                            {{ trans('restaurant.'.Request::path()) }}
                        @endif
                        <small></small>
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
        <script src="{{ asset('js/jquery.tabledit.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        @section('scripts')
        @show
        <script src="{{ asset('js/admin.js') }}"></script>
    </body>
</html>
