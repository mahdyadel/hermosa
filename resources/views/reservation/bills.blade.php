<html dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
    <head>
        <style>
            body {
                background: gray;
            }

            .bill-container {
                width: 400px;
                background: white;
                margin: 0 auto;
                padding: 40px 20px;
                text-align: center;
            }

            .salon-logo {
                display: block;
            }

            .salon-logo img {
                width: 60px;
                /* height: 60px; */
            }

            .salon-logo h1 {
                font-size: 18px;
                margin: 4px 0;
            }

            .client-info, .reservation-info {
                display: block;
                margin: 20px 0;
            }

            .client-info span, .reservation-info span {
                display: block;
                margin: 5px 0;
            }
        </style>
    </head>

    <body>
        <div class="bill-container">
            <div class="salon-logo">
                <img src="{{ asset('storage/salons/'.$reservation->salon->logo) }}" />
                <h1>{{ $reservation->salon->name }}</h1>
                <span><b>{{ __('messages.tax_number') }}:</b> {{ $reservation->salon->tax_number }}</span>
            </div>

            <div class="reservation-info">
                <span><b>{{ __('messages.receipt') }} #</b>{{ $reservation->id }}</span>
                <span>{{ date("D j M Y g:i a", strtotime($reservation->created_at)) }}</span>
            </div>

            <div class="client-info">
                <span><b>{{ __('messages.client_name') }}:</b> {{ $reservation->user->name }}</span>
                <!-- <span><b>{{ __('messages.client_phone') }}:</b> {{ $reservation->user->mobile }}</span> -->
            </div>
            
            <hr/>
            <br />

            <table width="100%" border="0">
                <thead>
                    <tr>
                        <td>{{ __('messages.menu.service') }}</td>
                        <td>{{ __('messages.price') }}</td>
                        <td>{{ __('messages.home_service_fees') }}</td>
                        <td>{{ __('messages.menu.employee') }}</td>
                    </tr>   
                <thead>
                <tbody>
                    @foreach($reservation->reservationServices as $reservationServices)
                    <tr>
                        <td>{{ $reservationServices->salonService->name }}</td>
                        <td>{{ $reservationServices->final_price }}</td>
                        <td>{{ $reservationServices->home_service_fees }}</td>
                        <td>{{ $reservationServices->employee->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <hr/>
            <br />

            <table width="100%" border="0">
                <tbody>
                    <tr>
                        <td>{{ __('messages.fixed_price') }}</td>
                        <td>{{ sprintf('%0.2f', $reservation->fixed_price) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.discount_amount') }}</td>
                        <td>{{ sprintf('%0.2f', $reservation->discount_amount) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.home_service_fees') }}</td>
                        <td>{{ sprintf('%0.2f', $reservation->home_service_fees) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.tax_amount') }}</td>
                        <td>{{ sprintf('%0.2f', $reservation->tax_amount) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.final_price') }}</td>
                        <td>{{ sprintf('%0.2f', $reservation->final_price) }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.payment_type') }}</td>
                        <td>{{ $reservation->paymentType->name }}</td>
                    </tr>
                </tbody>
            </table>

            <p>Powerd by Hermosa</p>

        </div>
    </body>
</html>