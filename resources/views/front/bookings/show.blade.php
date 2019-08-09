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
                        Reservación No.{{ $booking->id }}
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-6 text-left">
                                <a href="{{ route('front.bookings.index') }}" class="btn btn-danger">Regresar</a>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('front.bookings.sendEmai', $booking->id) }}" class="btn btn-primary">Reenviar Confirmación</a>
                                @if($booking->is_payed && $booking->payment_id)
                                <a href="{{ route('front.bookings.getPayment', $booking->id) }}" class="btn btn-primary">Ver Pago</a>
                                @endif
                                @if($booking->canCancel())
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#cancelModal">Cancelar</a>
                                @endif


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 text-center">
                                    <img src="{{ $booking->vehicle->image_url }}" width="350px" height="350px">
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    @if($booking->cancelled)
                                    <div class="alert alert-danger text-center">
                                        <p>Reservación Cancelada<p>
                                    </div>
                                    @endif
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
            @if(!$booking->is_payed)
            <div class="row">
                <div class="col-12">
                    <div class="card my-5">
                        <div class="card-header text-center">
                            Pagar
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('front.bookings.pay', $booking->id) }}" method="post" id="pay" name="pay" >
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cardNumber">Numero de Tarjeta:</label>
                                                    <input type="text" class="form-control" id="cardNumber" data-checkout="cardNumber" placeholder="4509 9535 6623 3704" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off value="4075595716483764" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="securityCode">CVC:</label>
                                                    <input type="text" class="form-control" id="securityCode" data-checkout="securityCode" placeholder="123" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off value="123"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cardExpirationMonth">Mes de Expiracion:</label>
                                                    <input type="text" class="form-control" id="cardExpirationMonth" data-checkout="cardExpirationMonth" placeholder="12" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off value="12"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cardExpirationYear">Año de Expiracion:</label>
                                                    <input type="text" class="form-control" id="cardExpirationYear" data-checkout="cardExpirationYear" placeholder="2015" onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off value="2020"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cardholderName">Nombre que aparece en la tarjeta:</label>
                                                    <input type="text" class="form-control" id="cardholderName" data-checkout="cardholderName" placeholder="APRO" value="APRO"/>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="paymentMethodId"/>
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-primary">Pagar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('front.bookings.cancel', $booking->id) }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cancelar Reservación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <p>Si la reservación se cancela hasta 24 horas posteriores a su registro, se hará un reembolso total del monto.</p>
                                        <p>Si la reservación se cancela hasta 48 horas anteriores a la fecha y hora de recolección del vehículo, se hará un reembolso del 50% del monto.</p>
                                        <p>Si la reservación se cancela en una ventana menor a 48 horas anteriores a la fecha y hora de la recolección del vehículo, únicamente será reembolsado el 25% del monto.</p>
                                        <p class="bold">Se le hará un reembolso de {{ '$' . number_format($booking->getCancelAmount(), 2) }} menos $50.00 de penalización.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                <button type="submit" class="btn btn-primary orange">Cancelar reservación</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
            <script type="text/javascript">
            function getBin() {
                const cardnumber = document.getElementById("cardnumber");
                return cardnumber.substring(0,6);
            }

            function guessingPaymentMethod(event) {
                var bin = getBin();

                if (event.type == "keyup") {
                    if (bin.length >= 6) {
                        window.Mercadopago.getPaymentMethod({
                            "bin": bin
                        }, setPaymentMethodInfo);
                    }
                } else {
                    setTimeout(function() {
                        if (bin.length >= 6) {
                            window.Mercadopago.getPaymentMethod({
                                "bin": bin
                            }, setPaymentMethodInfo);
                        }
                    }, 100);
                }
            };

            function setPaymentMethodInfo(status, response) {
                if (status == 200) {
                    const paymentMethodElement = document.querySelector('input[name=paymentMethodId]');

                    if (paymentMethodElement) {
                        paymentMethodElement.value = response[0].id;
                    } else {
                        const input = document.createElement('input');
                        input.setattribute('name', 'paymentMethodId');
                        input.setAttribute('type', 'hidden');
                        input.setAttribute('value', response[0].id);

                        form.appendChild(input);
                    }
                } else {
                    alert(`payment method info error: ${response}`);
                }
            };
            function sdkResponseHandler(status, response) {
                if (status != 200 && status != 201) {
                    alert("verify filled data");
                }else{
                    var form = document.querySelector('#pay');
                    var card = document.createElement('input');
                    card.setAttribute('name', 'token');
                    card.setAttribute('type', 'hidden');
                    card.setAttribute('value', response.id);
                    form.appendChild(card);
                    form.submit();
                }
            };
            $(function(){
                window.Mercadopago.setPublishableKey('{{ env('MP_PUBLIC_KEY') }}');
                $('#pay').submit(function(){
                    event.preventDefault();
                    var $form = document.querySelector('#pay');

                    window.Mercadopago.createToken($form, sdkResponseHandler); // The function "sdkResponseHandler" is defined below

                    return false;
                });
            });
            </script>

        </body>
        </html>
