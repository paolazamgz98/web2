<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
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
                    <div class="card-header">
                        Reservaciones
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if($bookings->count())
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">No. Reservación</th>
                                                <th scope="col">Carro</th>
                                                <th scope="col">Lugar de Entrega</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->id }}</td>
                                                    <td>{{ $booking->vehicle->name }}</td>
                                                    <td>{{ $booking->pickingLocation->name }}</td>
                                                    <td>{{ number_format($booking->total, 2) }}</td>
                                                    <td><a href="{{ route('front.bookings.show', $booking->id) }}" class="btn btn-primary purple">Ver detalle</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-danger">
                                        <p>Lo sentimos, no tiene reservaciones por el momento.<p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
