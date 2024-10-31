<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .invoice-header-table {
            width: 100%;
            border-bottom: 1px solid black;
            margin-bottom: 30px;
        }

        .invoice-header-table td {
            vertical-align: top;
            padding: 5px;
        }

        .invoice-header-left {
            text-align: left;
            width: 70%;
        }

        .invoice-header-right {
            text-align: right;
            width: 30%;
        }

        .invoice-header-right p {
            text-align: left;
            margin: 0;
        }

        .info-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            border: none;
        }

        .room-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .room-table th,
        .room-table td {
            padding: 8px;
            border: 1px solid #333;
        }

        .room-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <table class="invoice-header-table">
        <tr>
            <td class="invoice-header-left">
                <h1>Invoice</h1>
                <p>No : {{ $invoice->id }}</p>
                <p>Tgl : {{ \Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y') }}</p>
            </td>
            <td class="invoice-header-right">
                <img src="{{ public_path('images/hafara_logo.png') }}" alt="logo-hafara"
                    style="height: 80px; width:auto; margin-bottom: 10px;">
                <p style="margin-bottom: 30px;">Jl. Sawahan No.48, RT.003/01, Sawahan, Kec. Padang Tim., Kota Padang,
                    Sumatera Barat 25121</p>
            </td>
        </tr>
    </table>

    <table class="info-table">
        <tr>
            <td>Nama Tamu :</td>
            <td>{{ $invoice->user->name }}</td>
            <td>Tgl Check In :</td>
            <td>{{ \Carbon\Carbon::parse($invoice->checkin_date)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Alamat :</td>
            <td>Jl. Jalan No. 1</td>
            <td>Tgl Check Out :</td>
            <td>{{ \Carbon\Carbon::parse($invoice->checkout_date)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>No. Hp :</td>
            <td>{{ $invoice->user->phone }}</td>
            <td>Email :</td>
            <td>{{ $invoice->user->email }}</td>
        </tr>
    </table>

    <table class="room-table">
        <tr>
            <th>Room/Type</th>
            <th>Price</th>
            <th>Sub Total</th>
        </tr>
        {{ $dateLength = abs(\Carbon\Carbon::parse($invoice->checkout_date)->diffInDays(\Carbon\Carbon::parse($invoice->checkin_date))) }}
        {{ $total = 0 }}
        @foreach ($invoice->bookingDetail as $room)
            <tr>
                <td>{{ $room->room->room_number }}/{{ $room->room->roomTypes->name }}</td>
                <td>Rp{{ number_format($room->room->roomTypes->price) }}</td>
                <td>Rp{{ number_format($room->room->roomTypes->price * $dateLength) }}</td>
            </tr>
            {{ $total += $room->room->roomTypes->price * $dateLength }}
        @endforeach
        <tr>
            <td>Penalty</td>
            <td colspan="2">Rp{{ number_format($invoice->fine_price) }}</td>
        </tr>
        <tr>
            <td>Additional Cost</td>
            <td colspan="2">Rp{{ number_format($invoice->total_price + $invoice->fine_price - $total) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">Total</td>
            <td>Rp{{ number_format($invoice->total_price + $invoice->fine_price) }}</td>
        </tr>
    </table>

    <div class="notes-section">
        <p><strong>Notes :</strong></p>
        <p>{{ $invoice->remarks }}</p>
    </div>

    <div class="invoice-footer">
        <p>Thank you for staying with us!</p>
    </div>

</body>

</html>
