<p>Hola {{ $booking->user->name }}, te anexamos la confirmación de renta del {{ $booking->vehicle->name }}</p>
<p> Fue un total de {{ '$' . number_format($booking->total) }}.</p>
<p> La fecha y hora de entrega es el {{ $booking->start_from }}.</p>
<p> La fecha y hora de devolución es el {{ $booking->finish_date }}.</p>
<p>Saludos</p>
