<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
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
                    <div class="card-header">
                        Ubicaciones
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 text-right">
                                <a href="{{ route('admin.locations.create') }}" class="btn btn-primary purple">Crear Ubicación</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Dirección</th>
                                            <th scope="col">Aeropuerto</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($locations as $location)
                                            <tr>
                                                <td>{{ $location->name }}</td>
                                                <td>{{ $location->address }}</td>
                                                <td>{{ $location->is_airport ? 'Si' : 'No' }}</td>
                                                <td><a href="{{ route('admin.locations.eliminar', $location->id) }}" class="btn btn-danger">Eliminar</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
