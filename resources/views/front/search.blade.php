<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">
    <title>Web2</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(\Request::is('front/home')) active @endif">
                    <a class="nav-link" href="{{ route('front.home') }}">Home</a>
                </li>
                <li class="nav-item @if(\Request::is('front/bookings') || \Request::is('front/bookings/*')) active @endif">
                    <a class="nav-link" href="{{ route('front.bookings.index') }}">Reservaciones</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('front.logout') }}" method="post">
                @csrf
                <button class="btn my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </div>
    </nav>
</header>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-5">
                    <div class="card-header text-center">
                        Elegir Carro
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 text-left">
                                <a href="{{ route('front.home') }}" class="btn btn-primary">Regresar</a>
                            </div>
                        </div>
                        @if($vehicles->count())
                            @foreach($vehicles as $vehicle)
                                @if($vehicle->category)
                                    @if($vehicle->category->isAvailable())
                                        <form action="{{ route('front.preview') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="picking_location_id" value="{{ $picking_location_id }}"/>
                                            <input type="hidden" name="dropping_location_id" value="{{ $dropping_location_id }}"/>
                                            <input type="hidden" name="start_from" value="{{ $start_from }}"/>
                                            <input type="hidden" name="finish_date" value="{{ $finish_date }}"/>
                                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}"/>
                                            <div class="row mb-5 justify-content-md-center">
                                                <div class="col-2 text-center">
                                                    <img src="{{ $vehicle->image_url }}" width="100px" height="100px">
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-6 text-center">
                                                            <label class="bold">Categoría:</label> <label>{{ $vehicle->category->name }}</label>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <label class="bold">Nombre:</label> <label>{{ $vehicle->name }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6 text-center">
                                                            <label class="bold">Marca:</label> <label>{{ $vehicle->model }}</label>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <label class="bold">Color:</label> <label>{{ $vehicle->color }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <label class="bold">Precio por hora:</label> <label>{{ number_format($vehicle->price, 2) }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <button class="btn btn-primary orange" type="submit">Ver Detalle</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <div class="alert alert-danger">
                                <p>Lo sentimos mucho, no encontramos un auto con las caraterísticas que buscas.<p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
