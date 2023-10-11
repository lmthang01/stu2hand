@if ($orders)
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Địa chỉ</th>
                    {{-- <th scope="col">Email</th> --}}
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <td>
                            <img src="{{ isset($order->product->avatar) ? pare_url_file($order->product->avatar) : '' }}"
                                style="width: 60px;height: 60px; border-radius: 10px" alt="">
                        </td>
                        <td scope="row">
                            <a href="#"
                                target="_blank">{{ isset($order->product->avatar) ? $order->product->name : '' }}</a>
                        </td>
                        <td>{{ number_format($order->or_price) }} đ</td>
                        <td>
                            {{ $order->transaction->tr_address }}
                        </td>

                        {{-- <td>{{$order->transaction->tr_email}}</td> --}}
                        
                        <td>{{ $order->transaction->tr_phone }}</td>

                        <td>
                            @if ($loop->first)
                                {{ $order->transaction->tr_note }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
