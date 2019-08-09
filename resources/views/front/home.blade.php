<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">

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
                    <form method="post" action="{{ route('front.search') }}">
                        @csrf
                        <div class="card-header text-center">
                            Buscar Carro
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label">Entrega:</label>
                                        <select id="picking_location_id" class="selectpicker full-width select2 form-control" data-style="form-control btn-secondary" name="picking_location_id" title="Selecciona la ubicación de entrega" required>
                                            <option></option>
                                            @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label">Devolución:</label>
                                        <select id="dropping_location_id" class="selectpicker full-width select2 form-control" data-style="form-control btn-secondary" name="dropping_location_id" title="La misma ubicación que entrega">
                                            <option></option>
                                            @foreach($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Fecha de Entrega</label>
                                        <input class="form-control" name="start_from" id="start_from" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Fecha de Devolución</label>
                                        <input class="form-control" name="finish_date" id="finish_date" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="control-label">Categoría:</label>
                                        <select id="categories" class="selectpicker full-width select2 form-control" data-style="form-control btn-secondary" name="category_id" title="Selecciona la categoría">
                                            <option></option>
                                            @foreach($categories as $category)
                                            @if($category->isAvailable())
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">
    $(function(){
        var tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        console.log(tomorrow);
        $('#categories').select2({
            placeholder: "Elige la categoria de carro",
            allowClear: true
        });
        $('#picking_location_id').select2({
            placeholder: "Elige el punto de entrega",
            allowClear: true
        });
        $('#dropping_location_id').select2({
            placeholder: "El mismo punto de entrega",
            allowClear: true
        });
        $('#start_from').datetimepicker({
            autoclose: true,
            startDate: tomorrow,

        });
        $('#finish_date').datetimepicker({
            autoclose: true,
            startDate: tomorrow,
        });
    });
    </script>
</body>
</html>
