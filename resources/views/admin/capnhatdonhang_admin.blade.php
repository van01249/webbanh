
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
<div class="main_form_admin">

     <div class="title_main_form_admin">
                    Chi tiết đơn hàng có mã <span style="color: #ff1e29;">{{ $thongtindonhang->id_order }}</span>
                </div>
                     @if(Session::has('status'))
                        <p class="alert alert-success">{{ Session::get('status') }}</p>
                    @endif
                <div class="thong_tin_don_hang">
                    <div class="thong_tin_nguoi_mua">
                        <div>Thông tin người mua</div>
                        Họ tên: {{$thongtindonhang->name}}<br/>
                        Email: {{$thongtindonhang->email}}<br/>
                        Địa chỉ: {{$thongtindonhang->address}}<br/>
                        Điện thoại: {{$thongtindonhang->phone}}<br/>
                        Ngày mua hàng: {{date("d-m-y H:i:s",strtotime($thongtindonhang->updated_at))}}<br/>
                        Trạng thái đơn hàng: <br/>
                        <form method="POST" action="{{route('postcapnhatttdonhang')}}" accept-charset="UTF-8" id="form_them_san_pham_moi" class="form_them_san_pham_moi" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        {!! Form::select('trangthai',$dstrangthai,$thongtindonhang->status_order,['class'=>'trangthaidonhang']) !!}
                        {!! Form::hidden('id', $thongtindonhang->id_order) !!}
                        <input class="btncapnhat" type="submit" value="Cập nhật">
                    </form>
                    </div>
                    <div class="thong_tin_nguoi_nhan">
                        <div>Thông tin người nhận</div>
                        Họ tên: {{$thongtindonhang->name}}<br/>
                        Địa chỉ: {{$thongtindonhang->address}}<br/>
                        Điện thoại: {{$thongtindonhang->phone}}<br/>
                        Thông tin thanh toán:<br/>
                        <div class="trang_thai_don_hang">
                            <div class="thanh_chua_nut">
                        @if($thongtindonhang->payment_status == 1)
                            <div class="nut_trang_thai_don_hang_off" onclick="xac_nhan('{{ $thongtindonhang->id_order }}',1)">
                                Chưa thanh toán
                            </div>
                        @else
                            <div class="nut_trang_thai_don_hang_on" onclick="xac_nhan('{{ $thongtindonhang->id_order }}',2)">
                                Đã thanh toán
                            </div>
                        @endif
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="danh_sach_san_pham_cua_don_hang">
                        <div class="title_danh_sach_san_pham_cua_don_hang">
                            Danh sách mặt hàng trong hóa đơn
                        </div>
                        <div class="bang_ds_san_pham">
                            <table class="table_gio_hang" cellspacing="0" cellpadding="5" style="width:100%">
                                <tr class="header_gio_hang">
                                    <td style="width: 15px;">
                                        Mã sản phẩm
                                    </td>
                                    <td style="width: 150px;">
                                        Tên sản phẩm
                                    </td>
                                    <td style="width: 100px;">
                                        Hình
                                    </td>
                                    <td style="width: 100px;">
                                        Loại sản phẩm
                                    </td>
                                    <td style="width: 50px;">
                                        Đơn giá
                                    </td>
                                    <td style="width: 50px;">
                                        Số lượng
                                    </td>
                                    <td style="width: 100px;">
                                        Thành tiền
                                    </td>
                                </tr>
                                @foreach($chitiet as $ct)
                                <tr class="chan">
                                    <td>
                                        {{$ct->id_product}}
                                    </td>
                                    <td>
                                        {{$ct->name_product}}
                                    </td>
                                    <td>
                                        <img style="width:100px;height:70px"src="{{url('/')}}/source/images/product/{{$ct->image}}">
                                    </td>
                                    <td>
                                        {{$ct->name_producttype}}
                                    </td>
                                    <td>
                                        {{ number_format($ct->unit_price,0,",",".")}}
                                    </td>
                                    <td>
                                        {{$ct->quantity}}
                                    </td>
                                    <td>
                                        {{ number_format($thanhtien=($ct->quantity)*($ct->unit_price),0,",",".")}}
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="tr_tong_tien">
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td colspan="2">
                                        Tổng thành tiền
                                    </td>
                                    <td>
                                       {{number_format($thongtindonhang->total,0,",",".")}} VNĐ
                                    </td>
                                </tr>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- nd -->
        <div class="clear"> </div>

    </div>
@endsection
@section('script')
    <script>
        function xac_nhan(id,payment_status)
        {
            if(payment_status == 1)
            {
                kq = confirm("Bạn chắc chắn đơn hàng này đã được thanh toán?");
            }
            else if(payment_status == 2)
            {
                kq = confirm("Bạn chắc chắn muốn chuyển trạng thái đơn hàng này sang chưa thanh toán?");
            }
            //alert(kq);
            if(kq == true)
            {
                $.ajax({
                    url: '{{url("/")}}/admin/ajax_cap_nhat_trang_thai_don_hang',
                    type: "get",
                    data: {'id':id, 'payment_status':payment_status},
                    success: function(data){
                        if(data == '1')
                        {
                            $(".thanh_chua_nut").html('<div class="nut_trang_thai_don_hang_off" onclick="xac_nhan(\'{{ $thongtindonhang->id_order }}\',1)">Chưa thanh toán</div>');
                            //alert(data);
                        }
                        else if(data == '2')
                        {
                            $(".thanh_chua_nut").html('<div class="nut_trang_thai_don_hang_on" onclick="xac_nhan(\'{{ $thongtindonhang->id_order }}\',2)">Đã thanh toán</div>');
                            //alert(data);
                        }
                    }
                });
            }
            else
            {
                alert("Lần sau chắc chắn hãy cập nhật lại trạng thái đơn hàng nhé!");
            }
        }
    </script>
@endsection