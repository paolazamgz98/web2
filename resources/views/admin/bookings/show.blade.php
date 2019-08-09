<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/back.css') }}">
    <title>Web2</title>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(\Request::is('admin/locations') || \Request::is('admin/locations/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.locations.index') }}">Ubicaciones</a>
                </li>
                <li class="nav-item @if(\Request::is('admin/categories') || \Request::is('admin/categories/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">Categorias</a>
                </li>
                <li class="nav-item @if(\Request::is('admin/bookings') || \Request::is('admin/bookings/*')) active @endif">
                    <a class="nav-link" href="{{ route('admin.bookings.index') }}">Reservaciones</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('admin.logout') }}" method="post">
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
                        Reservación No.{{ $booking->id }}
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-6 text-left">
                                <a href="{{ route('admin.bookings.index') }}" class="btn btn-danger">Regresar</a>
                            </div>
                            <div class="col-6 text-right">
                                @if($booking->cancelled)
                                    <div class="alert alert-danger text-center">
                                        <p>Reservación Cancelada<p>
                                    </div>
                                @elseif(!$booking->cancelled && $booking->is_payed)
                                    <div class="alert alert-success text-center">
                                        <p>Reservación Pagada<p>
                                    </div>
                                @else
                                    <div class="alert alert-info text-center">
                                        <p>Reservación Confirmada<p>
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-center">
                                    <img src="{{ $booking->vehicle->image_url }}" width="350px" height="350px">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p class="bold car-name">{{ $booking->vehicle->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <label class="bold">Marca</label>
                                            <p>{{ $booking->vehicle->model }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <label class="bold">Color</label>
                                            <p>{{ $booking->vehicle->color }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <label class="bold">Lugar de Entrega</label>
                                            <p>{{ $booking->pickingLocation->name }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <label class="bold">Lugar de Devolución</label>
                                            <p>@if($booking->droppingLocation) @if($booking->droppingLocation->id != $booking->pickingLocation->id){{ $booking->droppingLocation->name }} @else En el mismo lugar entrega @endif @else En el mismo lugar de entrega @endif</p>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-6 text-center">
                                            <label class="bold">Fecha y Hora de Entrega</label>
                                            <p>{{ $booking->start_from }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <label class="bold">Fecha y Hora de Devolución</label>
                                            <p>{{ $booking->finish_date }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold">Subtotal:</label>
                                            <label>{{ number_format($booking->subtotal,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold red">Descuento:</label>
                                            <label class="red">-{{ number_format($booking->discount,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold">Aeropuerto:</label>
                                            <label>{{ number_format($booking->airport_fee,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold">Diferente punto de devolución:</label>
                                            <label>{{ number_format($booking->different_location_fee,2) }}</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold total">Total:</label>
                                            <label class="total">{{ number_format($booking->total,2) }}</label>
                                        </div>
                                    </div>
                                    @if($booking->cancelled)
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <label class="bold">Devolución:</label>
                                            <label>{{ number_format($booking->getCancelAmount(),2) }}</label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
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
