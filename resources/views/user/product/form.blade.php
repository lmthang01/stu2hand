<form method="POST" id="alert_form_submit" action="" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tên sản phẩm <span style="color: red;">*</span> </label>
                <input type="text" name="name" placeholder="Tên sản phẩm" class="form-control"
                    value="{{ old('name', $product->name ?? '') }}">
                @error('name')
                    <small id="" class="form-text text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả <span style="color: red;">*</span> </label>
                <textarea name="description" id="" class="form-control" placeholder="Mô tả ..." cols="30" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
                @error('description')
                    <small id="" class="form-text text-danger">{{ $errors->first('description') }}</small>
                @enderror
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tỉnh thành</label>
                        <select name="province_id" class="form-control" id="loadDistrict">
                            <option value="">---Chọn---</option>
                            @foreach ($provinces ?? [] as $item)
                                <option value="{{ $item->id }}"
                                    {{ ($product->province_id ?? 0) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('province_id')
                            <small id="" class="form-text text-danger">{{ $errors->first('province_id') }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Quận huyện</label>
                        <select name="district_id" class="form-control" id="districtsData">
                            <option value="">---Chọn---</option>
                            @foreach ($activeDistricts ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <small id="" class="form-text text-danger">{{ $errors->first('district_id') }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phường xã</label>
                        <select name="ward_id" class="form-control" id="wardData">
                            <option value="">---Chọn---</option>
                            @foreach ($activeWards ?? [] as $key => $item)
                                <option value="{{ $key }}" selected>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('ward_id')
                            <small id="" class="form-text text-danger">{{ $errors->first('ward_id') }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Album ảnh</label>
                <div class="file-loading">
                    <input type="file" name="file[]" id="images" multiple class="file"
                        data-overwrite-inital="false" data-min-file-count="0">
                </div>
            </div>

            @if (isset($images) && !$images->isEmpty())
                @foreach ($images as $item)
                    <a href="{{ route('get_admin.product.delete_image', $item->id) }}"
                        style="margin-bottom: 10px; display: inline-block;">
                        <img src="{{ pare_url_file($item->path) }}"
                            style="width: 100px; height: auto; margin-right: 10px; border: 1px solid #dedede; border-radius: 5px"
                            alt="">
                    </a>
                @endforeach
            @endif
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Danh mục <span style="color: red;">*</span></label>
                <select name="category_id" class="form-control" id="">
                    <option value="">----Chọn danh mục----</option>
                    @foreach ($categories ?? [] as $item)
                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}
                            {{ ($product->category_id ?? 0) == $item->id ? 'selected' : '' }}>{{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small id="" class="form-text text-danger">{{ $errors->first('category_id') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Giá sản phẩm</label>
                <input type="number" name="price" placeholder="" class="form-control"
                    value="{{ old('price', $product->price ?? '') }}">
                @error('price')
                    <small id="" class="form-text text-danger">{{ $errors->first('price') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="hidden" name="total_money" value="{{ Auth::user()->total_money ?? '' }}">
                <label for="exampleInputEmail1">Phí đăng bán <span style="color: red;">10%</span> giá sản phẩm</label>
                <input readonly type="number" name="fee" placeholder="" class="form-control"
                    value="{{ old('fee', $product->fee ?? '') }}">
                @error('fee')
                    <small id="" class="form-text text-danger">{{ $errors->first('fee') }}</small>
                    <small id="" class="form-text text-danger">Số tiền hiện tại của bạn là
                        {{ Auth::user()->total_money ?? 'N\A' }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" name="avatar">
                @error('avatar')
                    <small id="" class="form-text text-danger">{{ $errors->first('avatar') }}</small>
                @enderror
                @if (isset($product->avatar) && $product->avatar)
                    <img src="{{ pare_url_file($product->avatar) }}"
                        style="width: 60px; height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                @endif
            </div>
        </div>
    </div>
</form>

<!-- bootstrap 5.x or 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    crossorigin="anonymous"> --}}

<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
    crossorigin="anonymous">


<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/css/fileinput.min.css" media="all"
    rel="stylesheet" type="text/css" />

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/buffer.min.js"
    type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/filetype.min.js"
    type="text/javascript"></script>

<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/piexif.min.js"
    type="text/javascript"></script>

<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/plugins/sortable.min.js"
    type="text/javascript"></script>

<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>

<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/fileinput.min.js"></script>

<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/themes/fas/theme.min.js"></script -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.2/js/locales/LANG.js"></script>

<script>
    // Đảm bảo rằng trang đã tải hoàn toàn trước khi thực hiện các thao tác JavaScript
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy phần tử giá sản phẩm và phí từ DOM
        var priceInput = document.querySelector('input[name="price"]');
        var feeInput = document.querySelector('input[name="fee"]');

        // Thêm sự kiện "input" để theo dõi thay đổi giá sản phẩm
        priceInput.addEventListener("input", function() {
            // Lấy giá trị của giá sản phẩm
            var price = parseFloat(priceInput.value);

            // Kiểm tra xem giá có phải là một số hợp lệ hay không
            if (!isNaN(price)) {
                // Tính phí (10% giá sản phẩm)
                var fee = price * 0.1;

                // Hiển thị phí trong ô nhập liệu phí
                feeInput.value = fee.toFixed(0); // Giữ chỉ hai chữ số sau dấu thập phân
            } else {
                // Nếu giá không hợp lệ, hiển thị 0.00 trong ô nhập liệu phí
                feeInput.value = "0.00";
            }
        });
    });
</script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $("#loadDistrict").change(function() {
            console.log("------LOAD----------");
            let province_id = $(this).find(":selected").val();
            console.log("------province_id: ", province_id);

            $.ajax({

                    url: "/account/location/district",
                    data: {

                        province_id: province_id
                    },
                    beforeSend: function(xhr) {
                        // xhr.overrideMimeType("text/plain; charset=x-user-defined");
                    }
                })
                .done(function(data) {
                    console.log("------Data: ", data);

                    let dataOptions = `<option value="">---Chọn quận huyện---</option>`;
                    data.map(function(index, key) {
                        dataOptions += `<option value=${index.id}>${index.name}</option>`
                    });
                    $("#districtsData").html(dataOptions);
                });
        });

        $("#districtsData").change(function() {
            let district_id = $(this).find(":selected").val();

            $.ajax({

                    url: "/account/location/ward",
                    data: {

                        district_id: district_id
                    },
                    beforeSend: function(xhr) {
                        // xhr.overrideMimeType("text/plain; charset=x-user-defined");
                    }
                })
                .done(function(data) {
                    // console.log("------Data: ", data);

                    let dataOptions = `<option value="">---Chọn phường xã---</option>`;
                    data.map(function(index, key) {
                        dataOptions += `<option value=${index.id}>${index.name}</option>`
                    });
                    $("#wardData").html(dataOptions);
                });
        });
    })
</script>
