@if ($orders)
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

        <div class="col-sm-6 col-xs-6 purchase-info">
            <h4 class="info-code">Mã đơn hàng: DH{{ $order->transaction->id ?? 'N/A' }}</h4>
            <div class="info-date ml-1">Ngày đặt: {{ $order->transaction->created_at ?? 'N/A' }}</div>
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
                <div class="to-city ml-1">Số điện thoại: {{ $order->transaction->userSale->phone ?? 'NA' }}</div>
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
                    <th>Hình ảnh</th>
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
                            <img src="{{ isset($order->product->avatar) ? pare_url_file($order->product->avatar) : '' }}"
                                style="width: 60px;height: 60px; border-radius: 10px" alt="">
                        </td>

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
                    <th colspan="4">
                        Tổng cộng
                    </th>
                    <th> {{ number_format($tong) }} đ</th>
                </tr>
                <tr>
                    <td colspan="5"><b>Phương thức thanh toán:</b>
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
@endif
