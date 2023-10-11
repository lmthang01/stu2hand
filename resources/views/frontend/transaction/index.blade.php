@extends('frontend.layouts.app_frontend')
@section('content')
    <div class="container">
        <div class="row mt-3" style="background-color: white;">
            <div class="col-lg-12 mt-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Danh sách đơn hàng đã mua</h2>
                    {{-- <a href="#" class="btn btn-primary" style="color: azure;">Thêm mới</a> --}}
                    <a href="/" class="btn btn-primary">Trở về</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions ?? [] as $transaction)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $transaction->user->name ?? '[N\A]' }}</td>
                                    <td>{{ $transaction->tr_address }}</td>
                                    <td>{{ $transaction->tr_phone }}</td>
                                    <td>{{ number_format($transaction->tr_total, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        @if ($transaction->tr_status == 1)
                                            <span class="badge badge-success">
                                                <a href="#" style="text-decoration: none; color: white">Đã xử lý</a>
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                <a href="#"
                                                    style="text-decoration: none; color: white">Chờ xử lý</a>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('get_admin.transaction.viewOrder', $transaction->id) }}"
                                            class="btn btn-info js_order_item" data-toggle="modal"
                                            data-id="{{ $transaction->id }}" data-target="#myModelOrder"
                                            style="padding: 5px" id="">Chi
                                            tiết</a>
                                        {{-- <a href="#" class="btn btn-danger" style="padding: 5px"
                                            id="delete_alert">Delete</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $transactions->links() }}

    <div class="modal fade" id="myModelOrder" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng #<b class="transaction_id"></b></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="md_content">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@stop
