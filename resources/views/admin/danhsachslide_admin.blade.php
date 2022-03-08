﻿
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
 <div class="title_main_form_admin">
                    Danh sách slide banner
                </div>
<div class="main_form_admin">
    
    <form method="POST" action="{{route('postxoaslide')}}" accept-charset="UTF-8" id="form_xoa_san_pham" class="form_xoa_san_pham"><input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="div_danh_sach_items">
            <table class="danh_sach_items">
            
               <tbody>
                    <tr class="row_header">
                        <td>
                            Mã slide
                        </td>
                        <td>
                            Đường dẫn liên kết
                        </td>
                        <td>
                            Hình 
                        </td>
                        <td>
                            Chọn
                        </td>
                        
                    </tr>
                    @foreach($dsslide as $slide)
                    <tr class="item_admin">
                        <td class="cell_center">
                           <a href="{{url('/')}}/admin/cap-nhat-slide-banner/{{$slide->id}}">{{$slide->id}}</a>
                        </td>
                        
                        <td class="cell_center">
                            {{$slide->link}}
                        </td>
                        <td class="cell_center">
                            <img src="{{url('/')}}/source/images/slide/{{$slide->image}}">
                        </td>
                        <td class="cell_center">
                            <input name="thao_tac[]" type="checkbox" value="{{$slide->id}}">
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </form>
    <div class="phan_trang_admin">
        {{$dsslide->render()}}
    </div>
    <div class="ds_button_admin">
        <div class="btn_xoa" onclick="kiem_tra_xoa()">Xóa danh sách đã chọn</div>
        <a href="{{route('themslide')}}">
            <div class="btn_them">Thêm slide banner</div>
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
    
@endsection