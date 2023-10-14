@if ($orders)
    {{-- <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Địa chỉ</th>
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
    </div> --}}
   
    <div>
        <div class="purchase">
            <!--<div style="min-width: 600px">-->
            <main>
                <div class="row">
                    <div class="col-sm-6 col-xs-6 to-details">
                        <h4>Đặt hàng mua cho:</h4>
                        <div class="to-name">Họ tên: Lê Minh Thắng</div>
                        <div class="to-address">Địa chỉ: 203 - Thới Khánh - Tân Thạnh - Thới Lai - TP Cần Thơ</div>
                        <div class="to-city">Thành phố: Cần Thơ</div>
                    </div>
                    <div class="col-sm-6 col-xs-6 purchase-info">
                        <h4 class="info-code">Mã đơn hàng: DH0001</h4>
                        <div class="info-date">Ngày đặt: 10/12/2023</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 table-responsive mt-2">
                        <table class="table table-condensed" border="0" cellspacing="0" cellpadding="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center col-xs-1 col-sm-1">STT</th>
                                    <th class="text-center col-xs-7 col-sm-7">Mô tả</th>
                                    <th class="text-center col-xs-1 col-sm-1">Số lượng</th>
                                    <th class="text-center col-xs-3 col-sm-3">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-xs-1 col-sm-1 text-center">1</td>
                                    <td class="text-center">Item bought number 1</td>
                                    <td class="text-center">5 Pcs</td>
                                    <td class="text-center">50.000,00</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="text-center">Item bought number 2</td>
                                    <td class="text-center">10 Pcs</td>
                                    <td class="text-center">100.000,00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">
                                        Tổng cộng
                                    </th>
                                    <th class="text-center">150.000,00</th>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Phương thức thanh toán:</b> Thanh toán VNPAY</td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Phương thức thanh toán:</b> Giao hàng nhanh giúp tớ nhé!</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </main>
            <!--</div>-->
        </div>
    </div>
@endif
