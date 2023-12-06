<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!------ Include the above in your HEAD tag ---------->
    <style>
        .purchase {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px;
            font-family: Times New Roman;
        }

        .purchase header {
            padding: 0px 0px 0px 0px;
            margin-bottom: 0px;
            border-bottom: 1px solid #3989c6;
        }

        .purchase header img {
            max-width: 200px;
            margin-top: 0;
            margin-bottom: 0;
        }

        .purchase .company-details {
            text-align: right;
            margin-top: 0;
            margin-bottom: 0;
        }

        .purchase main {
            padding: 0px 0px;
            margin-bottom: 0px;
        }

        .purchase .to-details {
            text-align: left;
        }

        .purchase .to-name {
            font-weight: bold;
        }

        .purchase .to-name .to-address .to-city {
            margin-top: 0;
            margin-bottom: 0;
        }

        .purchase .purchase-info {
            text-align: right;
        }

        .purchase-info .info-code {
            font-weight: bold;
        }

        .purchase-info .info-code .info-date {
            margin-top: 0;
            margin-bottom: 0;
        }

        .table thead th {
            margin: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .table td {
            margin: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            border: none;
        }

        .table .blank-row {
            height: 25px !important;
            background-color: #FFFFFF;
            border: none;
        }

        .table tbody {
            min-height: 1000px !important;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
    <div>
        <main>
            <div class="row">
                <div class="col-sm-6 col-xs-6 to-details">
                    <h4>Thông tin người nhận:</h4>
                    @foreach ($orders as $key => $order)
                        <div class="to-name ml-1">Họ tên: {{ $order->transaction->user->name ?? 'N/A' }}</div>
                        <div class="to-address ml-1">Địa chỉ: {{ $order->transaction->tr_address ?? 'N/A' }}</div>
                        <div class="to-city ml-1">Số điện thoại: {{ $order->transaction->tr_phone ?? 'N/A' }}</div>
                    @break
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-6 col-xs-6 purchase-info">
                    <h4 class="info-code">Mã đơn hàng: DH{{ $order->transaction->id ?? 'N/A' }}</h4>
                    <div class="info-date ml-1">Ngày đặt: {{ $order->transaction->created_at ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xs-6 to-details">
                <h4>Thông tin người bán:</h4>
                @foreach ($orders as $key => $order)
                    <div class="to-name ml-1">Họ tên: {{ $order->transaction->userSale->name ?? 'N/A' }}</div>
                    <div class="to-address ml-1">Địa chỉ: {{ $profile->address_detail ?? '' }} -
                        {{ $profile->ward->name ?? '...' }} - {{ $profile->district->name ?? '...' }} -
                        {{ $profile->province->name ?? '...' }}</div>
                    <div class="to-city ml-1">Số điện thoại: {{ $order->transaction->userSale->phone ?? 'NA' }}
                    </div>
                @break
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-xs-12 table-responsive mt-2">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                @php
                    $tong = 0;
                    $i = 0;
                @endphp
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                {{ isset($order->product->avatar) ? $order->product->name : '' }}
                            </td>
                            <td>{{ $order->product->description ?? 'N/A' }}</td>
                            <td>{{ number_format($order->or_price) ?? 'N/A' }} đ</td>
                        </tr>
                        @php
                            $tong = $tong + $order->or_price;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">
                            Tổng cộng
                        </th>
                        <th> {{ number_format($tong) }} đ</th>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Phương thức thanh toán:</b>
                            @if ($order->transaction->tr_type_payment == 0)
                                Thanh toán online VNPay
                            @else
                                Thanh toán khi nhận hàng
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><b>Ghi chú:</b> {{ $order->transaction->tr_note ?? 'N/A' }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</main>

</div>
</body>

</html>
