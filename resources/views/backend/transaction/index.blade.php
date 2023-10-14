@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Danh sách đơn hàng</h2>
        <a href="#" class="btn btn-primary" style="color: white;">Thêm mới</a>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}"
                    placeholder="Nhập số điện thoại">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Tìm kiếm</button>
        </form>
    </div>
    <div class="container">
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
                        <th>Thanh toán</th>
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
                                        <a href="{{ route('get_admin.transaction.active', $transaction->id) }}"
                                            style="text-decoration: none; color: white">Chờ xử lý</a>
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($transaction->payment)
                                    <ul>
                                        <li>Ngân hàng: {{ $transaction->payment->p_code_bank }}</li>
                                        <li>Mã thanh toán: {{ $transaction->payment->p_code_vnpay }}</li>
                                        <li>Tổng tiền: {{ number_format($transaction->payment->p_money, 0, ',', '.') }} VNĐ
                                        </li>
                                        <li>Nội dung: {{ $transaction->payment->p_note }}</li>
                                        <li>Thời gian: {{ date('d-m-Y H:i', strtotime($transaction->payment->p_time)) }}
                                        </li>
                                    </ul>
                                @else
                                    <ul>
                                        <li>Thanh toán khi nhận hàng</li>
                                    </ul>
                                @endif
                            </td>
                            {{-- <td>
                                <a href="{{ route('get_admin.transaction.viewOrder', $transaction->id) }}"
                                    class="btn btn-info js_order_item" data-toggle="modal" data-id="{{ $transaction->id }}"
                                    data-target="#myModelOrder" style="padding: 5px" id="">Chi
                                    tiết</a>
                                <a href="#" class="btn btn-danger" style="padding: 5px" id="delete_alert">Delete</a>
                            </td> --}}
                            <td>
                                <div class="product-more position-relative">
                                    <span class="justify-content-start">
                                        <i class="fa-regular fa-pen-to-square fa-xl icon"></i>
                                    </span>
                                    <div class="product-more-option">
                                        <ul class="mb-0" style="list-style: none;padding-left: 0px;">
                                            <li>
                                                <a href="{{ route('get_admin.transaction.viewOrder', $transaction->id) }}"
                                                    class="d-flex align-items-center p-2 text-decoration-none js_order_item" data-toggle="modal" data-id="{{ $transaction->id }}"
                                                    data-target="#myModelOrder" style="padding: 5px" id=""><p><i class="fa-regular fa-eye"></i> - Xem chi tiết</p> </a>
                                            </li>
                                            <li>
                                                <a href="#" class="d-flex align-items-center p-2 text-decoration-none">
                                                    <p><i class="fa-solid fa-pen"></i> - Cập nhật</p>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#  " class="d-flex align-items-center p-2 text-decoration-none" id="delete_alert">
                                                    <p><i class="fa-regular fa-trash-can"></i> - Xóa</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $transactions->links() }}
    
    <div class="modal fade" id="myModelOrder" role="dialog">
        <div class="modal-dialog modal-xl">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng #<b class="transaction_id"></b></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body" id="md_content">
                    {{-- Dùng js qua --}}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

@stop
