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
    width: 400px;
    margin: 10px;
    padding:10px;
    text-align: center;
}
</style>
@endsection
@section('content')
 <div class="title_main_form_admin">
                    Danh sách loại sản phẩm
                </div>
<div class="main_form_admin">
    
    <form method="POST" action="{{route('postxoaloaisanpham')}}" accept-charset="UTF-8" id="form_xoa_san_pham" class="form_xoa_san_pham"><input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="div_danh_sach_items">
            <table class="danh_sach_items">
            
               <tbody>
                    <tr class="row_header">
                        <td>
                            Mã loại
                        </td>
                        <td>
                            Tên loại
                        </td>
                        <td>
                            Mô tả
                        </td>
                        <td>
                            Hình
                        </td>
                        <td>
                            Trạng thái
                        </td>
                        <td>
                            Chọn
                        </td>
                        
                    </tr>
                    @foreach($loaisp as $loai)
                    <tr class="item_admin">
                        <td class="cell_center">
                            {{$loai->id}}
                        </td>
                        <td>
                            <a href="{{url('/')}}/admin/cap-nhat-loai-san-pham/{{$loai->id}}"> {{$loai->name}} </a>
                        </td>
                        <td class="comment">
                            {{$loai->intro}}
                        </td>
                        <td class="cell_center">
                            <img src="{{url('/')}}/source/images/product-type/{{$loai->image}}">
                        </td>
                        <td class="cell_center">
                            <img style="width: 40px;" src="
                            @if($loai->status == 1){{url('/')."/source/images/home/sale.png"}} @else {{url('/')."/source/images/home/outofstock.png"}}
                             @endif" title="@if($loai->status == 1){{"Hiển thị"}} @else {{"Không hiển thị"}} @endif">
                        </td>
                        <td class="cell_center">
                            <input name="thao_tac[]" type="checkbox" value="{{$loai->id}}">
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </form>
    <div class="phan_trang_admin">
        {{$loaisp->render()}}
    </div>
    <div class="ds_button_admin">
        <div class="btn_xoa" onclick="kiem_tra_xoa()">Ngừng bán các loại đã chọn</div>
        <a href="{{route('themloaisanpham')}}">
            <div class="btn_them">Thêm loại sản phẩm</div>
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
        <script type="text/javascript">
   $(".comment").shorten({
    "showChars" : 200,
    "moreText"  : "Xem thêm",
    "lessText"  : "Rút gọn",
});
</script>
@endsection