﻿
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
 <div class="title_main_form_admin">
                    Danh sách tài khoản thành viên
                </div>
<div class="main_form_admin">
    @if(Session::has('status'))
         <p class="alert alert-danger">{{ Session::get('status') }}</p>
    @endif
    <form method="POST" action="{{route('postxoataikhoan')}}" accept-charset="UTF-8" id="form_xoa_san_pham" class="form_xoa_san_pham"><input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="div_danh_sach_items">
            <table class="danh_sach_items">
            
                <tbody>
                    <tr class="row_header">
                        <td>
                            Mã
                        </td>
                        <td>
                            Họ tên
                        </td>
                        <td>
                            Email
                        </td>
                        <td>
                            SĐT
                        </td>
                        <td>
                            Địa chỉ
                        </td>
                        <td>
                            Loại tài khoản
                        </td>
                        <td>
                            Trạng thái
                        </td>
                        {{-- <td>
                            Chọn
                        </td> --}}
                    </tr>

                     @foreach ($dstaikhoan as $taikhoan)
                    <tr class="item_admin">
                        <td class="cell_center">
                            {{$taikhoan->id}}
                        </td>
                        <td>
                            <a href="{{url('/')}}/admin/danh-sach-thanh-vien/cap-nhat-tai-khoan/{{$taikhoan->id}}"> {{$taikhoan->name}} </a>
                        </td>
                        <td class="cell_center">
                            {{$taikhoan->email}}
                        </td>
                        <td class="cell_center">
                            {{$taikhoan->phone}}
                        </td>
                        <td class="cell_center">
                            {{$taikhoan->address}}
                        </td>
                        <td class="cell_center">
                        {!! Form::hidden('power', $taikhoan->power) !!}
                            {{$taikhoan->name_power}}
                           
                        </td>
                        <td class="cell_center">
                            <img style="width: 32px;" src="
                            @if($taikhoan->status == 1){{url('/')."/source/images/home/on.png"}} @else {{url('/')."/source/images/home/off.png"}}
                             @endif" title="@if($taikhoan->status == 1){{"Hiển thị"}} @else {{"Không hiển thị"}} @endif">
                        </td>
                        {{-- <td class="cell_center">
                            <input name="thao_tac[]" type="checkbox" value="{{$taikhoan->id}}">
                        </td> --}}
                    </tr>
                   @endforeach 
                </tbody>
            </table>
        </div>
    </form>
    <div class="phan_trang_admin">
        {{$dstaikhoan->render()}}
    </div>
    <div class="ds_button_admin">
        {{-- <div class="btn_xoa" onclick="kiem_tra_xoa()">Xóa danh sách đã chọn</div> --}}
        <a href="{{route('themthanhvien')}}">
            <div class="btn_them">Thêm thành viên</div>
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