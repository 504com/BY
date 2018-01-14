@extends('themes.adminlte2')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header bg-black" style="background-color:#F4F4F4 !important; background-size:cover;background: url('{{ asset('img/restaurants/'.$restaurant->picture) }}') no-repeat center center;">
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4 text-light-blue">
                            <strong><i class="fa fa-building-o margin-r-5"></i>Restaurant</strong>
                            <p class="text-muted">{{ $restaurant->name }}</p>
                        </div>
                        <div class="col-xs-4 text-light-blue">
                            <strong><i class="fa fa-envelope-o margin-r-5"></i>E-mail</strong>
                            <p class="text-muted">{{ $restaurant->email }}</p>
                        </div>
                        <div class="col-xs-4 text-light-blue">
                            <strong><i class="fa fa-mobile margin-r-5"></i>Téléphone</strong>
                            <p class="text-muted">{{ $restaurant->phone }}</p>
                        </div>
                        <div class="col-xs-12"><hr></div>
                        <div class="col-xs-6 text-light-blue">
                            <strong><i class="fa fa-map-marker margin-r-5"></i>Localisation</strong>
                            <p class="text-muted">{{ $restaurant->address }}, {{ $restaurant->zipcode }} {{ $restaurant->city }}</p>
                        </div>
                        <div class="col-xs-3 text-light-blue">
                            <strong><i class="fa fa-calendar-o margin-r-5"></i> Création</strong>
                            <p class="text-muted">{{ date('d/m/Y à H\hi', strtotime($restaurant->created_at)) }}</p>
                        </div>
                        <div class="col-xs-3 text-light-blue">
                            <strong><i class="fa fa-users margin-r-5"></i> Capacité</strong>
                            <p class="text-muted">{{ $restaurant->capacity }}</p>
                        </div>
                        <div class="col-xs-12 text-light-blue">
                            <hr>
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Description</strong>
                            <p class="text-muted">{{ $restaurant->description }}</p>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Détail de la carte</h3>
                    </div>
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            @if(sizeof($card) == 0)
                                <div class="text-center">
                                    <p class="lead">Aucune entrée saisie</p>
                                </div>
                            @else
                                @foreach($card as $category)
                                    <div class="panel box">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $category->id }}">
                                                {{ $category->name }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $category->id }}" class="panel-collapse collapse">
                                            @foreach($category->products as $item)
                                                <div class="box-body">
                                                    <dt>{{ $item->name }}</dt>
                                                    {{ $item->description }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="panel box box-info">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseHours" class="text-muted">
                                        Horaires
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseHours" class="panel-collapse collapse">
                                    <div class="box-body">
                                        @foreach($days as $day)
                                            <div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">
                                                <div class="workhours-hours">
                                                    <dt>{{ trans('admin.'.$day->name) }}</dt>
                                                    @if($workhours->contains('day_id', $day->id))
                                                        @foreach($workhours->whereIn('day_id', $day->id) as $workhour)
                                                            <p class="text-right">{{ date("H\hi", strtotime($workhour->start)) }} - {{ date("H\hi", strtotime($workhour->end)) }}</p>
                                                        @endforeach
                                                    @else
                                                        <p class="text-right">Fermé</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $restaurant->name }} / année en cours </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/vendor/chart.min.js') }}"></script>
    <script src="{{ asset('js/laroute.js') }}"></script>
@endsection