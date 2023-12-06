@extends('backend.layouts.app_backend')
@section('content')
    <h2>Tổng quan</h2>
    <div class="row mt-3">
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-primary text-white rounded text-center">
                <a href="#" class="text-decoration-none">
                    <h5 class="text-white">Số lượng nạp tiền <b>{{ $toltalRecharge }}</b></h5>
                </a>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-success text-white rounded text-center">
                <a href="#" class="text-decoration-none">
                    <h5 class="text-white">Tổng tiền <b>{{ number_format($totalMoney, 0, ',', '.') }} VNĐ</b></h5>
                </a>
            </div>
        </div>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}"
                    placeholder="Nhập mã giao dịch">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
        </form>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h2>Danh sách nạp tiền</h2>
        {{-- <a href="#" class="btn btn-primary" style="color: white;">Thêm mới</a> --}}
    </div>
    <div>
        {{-- <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
        </form> --}}
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã giao dịch</th>
                        <th>Khách hàng</th>
                        <th>Số tiền</th>
                        <th>Thanh toán</th>
                        <th>Ngày nạp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recharges ?? [] as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->id ?? 'NA' }}</td>
                            <td>{{ $item->user->name ?? '[N\A]' }}</td>
                            <td> {{ number_format($item->total_money ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->payment)
                                    <ul>
                                        <li>Ngân hàng: {{ $item->payment->p_code_bank }}</li>
                                        <li>Mã thanh toán: {{ $item->payment->p_code_vnpay }}</li>
                                        <li>Tổng tiền:
                                            {{ number_format($item->payment->p_money, 0, ',', '.') }} VNĐ
                                        </li>
                                        <li>Nội dung: {{ $item->payment->p_note }}</li>
                                    </ul>
                                @else
                                    <ul>
                                        <li>Thanh toán khi nhận hàng</li>
                                    </ul>
                                @endif
                            </td>
                            <td>{{ $item->created_at ?? '[N\A]' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $recharges->links() }}

@stop
