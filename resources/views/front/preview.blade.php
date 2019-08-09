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
                        Confirmar Reservación
                    </div>
                    <div class="card-body">
                        <form action="{{ route('front.bookings.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="picking_location_id" value="{{ $pickingLocation->id }}"/>
                            @if($droppingLocation)
                                <input type="hidden" name="dropping_location_id" value="{{ $droppingLocation->id }}"/>
                            @endif
                            <input type="hidden" name="start_from" value="{{ $start_from }}"/>
                            <input type="hidden" name="finish_date" value="{{ $finish_date }}"/>
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}"/>
                            <input type="hidden" name="user_id" value="{{ Auth()->id() }}"/>
                            <input type="hidden" name="subtotal" value="{{ $subtotalWithoutDiscount }}"/>
                            <input type="hidden" name="discount" value="{{ $discount }}"/>
                            <input type="hidden" name="airport_fee" value="{{ $airport_fee }}"/>
                            <input type="hidden" name="different_location_fee" value="{{ $different_location_fee }}"/>
                            <input type="hidden" name="total" value="{{ $total }}"/>
                            <input type="hidden" name="promo" value="{{ $promo }}"/>
                            <input type="hidden" name="days" value="{{ $days }}"/>
                            <input type="hidden" name="hours" value="{{ $hours }}"/>
                            <div class="row mb-4">
                                <div class="col-6 text-left">
                                    <a href="{{ route('front.home') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                                <div class="col-6 text-right">
                                    <button class="btn btn-primary"  type="submit">Reservar</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-center">
                                    <img src="{{ $vehicle->image_url }}" width="350px" height="350px">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p class="bold car-name">{{ $vehicle->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <label class="bold">Marca</label>
                                            <p>{{ $vehicle->model }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <label class="bold">Color</label>
                                            <p>{{ $vehicle->color }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <label class="bold">Lugar de Entrega</label>
                                            <p>{{ $pickingLocation->name }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <label class="bold">Lugar de Devolución</label>
                                            <p>@if($droppingLocation) @if($droppingLocation->id != $pickingLocation->id){{ $droppingLocation->name }} @else En el mismo lugar entrega @endif @else En el mismo lugar de entrega @endif</p>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-6 text-center">
                                            <label class="bold">Fecha y Hora de Entrega</label>
                                            <p>{{ $start_from }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <label class="bold">Fecha y Hora de Devolución</label>
                                            <p>{{ $finish_date }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold">Subtotal:</label>
                                            <label>{{ number_format($subtotalWithoutDiscount,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold red">Descuento:</label>
                                            <label class="red">-{{ number_format($discount,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold">Aeropuerto:</label>
                                            <label>{{ number_format($airport_fee,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold">Diferente punto de devolución:</label>
                                            <label>{{ number_format($different_location_fee,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold total">Total:</label>
                                            <label class="total">{{ number_format($total,2) }}</label>
                                        </div>
                                    </div>
                                    @if($promo >= 1)
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <p>Su reservación será de {{$days}} días por lo que se le descuenta(n) {{ $promo }} día(s)</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </form>
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
