<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
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
                        Categorias
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nombre:</label>
                                    <p>{{ $category->name }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Disponible:</label>
                                    <p>{{ $category->isAvailable() ? 'Si' : 'No' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-primary purple" data-toggle="modal" data-target="#updateAvailability">Cambiar Disponibilidad</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateAvailability" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.categories.updateAvailability', $category->id) }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar Disponibilidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <p>Seleccionar el rango de fecha en que la categoría no está disponible.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Desde</label>
                                    <input class="form-control" name="disabled_from" id="disabled_from" required value="{{ $category->disabled_from }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Hasta</label>
                                    <input class="form-control" name="disabled_to" id="disabled_to" required value="{{ $category->disabled_to }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary purple">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
    $( function() {
        $('#disabled_from').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        });
        $('#disabled_to').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        });
    } );
    </script>
</body>
</html>
