﻿
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
<style>
    a.morelink {
    text-decoration:none;
    outline: none;
}
.morecontent span {
    display: none;
}
.comment {
    width: 200px;
    margin: 10px;
    padding:10px;
    text-align: center;
}
</style>
@endsection
@section('content')

 <div class="title_main_form_admin">
                    Danh sách sản phẩm
                </div>
<div class="main_form_admin">
    
    <form method="POST" action="{{route('postxoasanpham')}}" accept-charset="UTF-8" id="form_xoa_san_pham" class="form_xoa_san_pham"><input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="div_danh_sach_items">
            <table class="danh_sach_items">
            
                <tbody>
                    <tr class="row_header">
                        <td>
                            Mã sp
                        </td>
                        <td>
                            Tên sản phẩm
                        </td>
                        <td>
                            Loại sản phẩm
                        </td>
                        <td>
                            Mô tả
                        </td>
                        <td>
                            Hình
                        </td>
                        <td>
                            Đơn vị tính
                        </td>
                        <td>
                            Đơn giá
                        </td>
                        <td>
                            Sản phẩm mới
                        </td>
                        <td>
                            Trạng thái
                        </td>
                        <td>
                            Chọn
                        </td>
                    </tr>

                    @foreach ($sanpham as $sp)
                    <tr class="item_admin">
                        <td class="cell_center">
                            {{$sp->id}}
                        </td>
                        <td class="comment">
                            <a href="{{url('/')}}/admin/cap-nhat-san-pham/{{$sp->id}}"> {{$sp->name}} </a>
                        </td>
                        <td class="cell_center">
                            {{$sp->Category->name}}
                        </td>
                        <td class="comment">
                            {{$sp->intro}}
                        </td>
                        <td class="cell_center">
                            <img src="{{url('/')}}/source/images/product/{{$sp->image}}">
                        </td>
                        <td class="cell_center">
                            {{$sp->unit}}
                        </td>
                        <td class="cell_center">
                        {{ number_format($sp->price,0,",",".")  }}
                            {{-- {{$sp->price}} --}}
                        </td>
                        <td class="cell_center">
                            <img style="width: 32px;" src="
                            @if($sp->new == 1){{url('/')."/source/images/home/on.png"}} @else {{url('/')."/source/images/home/off.png"}}
                             @endif" title="@if($sp->new == 1){{"Mới"}} @else {{"Cũ"}} @endif">
                        </td>
                        <td class="cell_center">
                            <img style="width: 50px;" src="
                            @if($sp->status == 1){{url('/')."/source/images/home/sale.png"}} @else {{url('/')."/source/images/home/outofstock.png"}}
                             @endif" title="@if($sp->status == 1){{"Hiển thị"}} @else {{"Không hiển thị"}} @endif">
                        </td>
                        <td class="cell_center">
                            <input name="thao_tac[]" type="checkbox" value="{{$sp->id}}">
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </form>
    <div class="phan_trang_admin">
        {{$sanpham->render()}}
    </div>
    <div class="ds_button_admin">
        <div class="btn_xoa" onclick="kiem_tra_xoa()">Ngừng bán danh sách đã chọn</div>
        <a href="{{route('themsanpham')}}">
            <div class="btn_them">Thêm sản phẩm</div>
        </a>
        <div class="clear"> </div>
    </div>
</div>

@endsection
@section('script')
 <script>
        function kiem_tra_xoa()
        {
            //alert();
            if($("input:checkbox:checked").length)
            {
                kq = confirm("Bạn chắc chắn muốn xóa danh sách đã được chọn?");
                if(kq)
                {
                    document.getElementById('form_xoa_san_pham').submit();
                }
            }
            else
            {
                alert("Bạn vui lòng chọn sản phẩm muốn xóa");
            }
        }
    </script>
    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

    
    {{-- <script src="{{url('/')}}/admin/js/custom.js"></script> --}}
     <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="{{url('/')}}/admin/js/jquery.shorten.1.0.js"></script>
    <script type="text/javascript">
   $(".comment").shorten({
    "showChars" : 200,
    "moreText"  : "Xem thêm",
    "lessText"  : "Rút gọn",
});
</script>
@endsection