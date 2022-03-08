﻿
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
 <div class="title_main_form_admin">
                    Danh sách đơn đặt hàng cũ
                </div>
<div class="main_form_admin">
    
    <form method="POST" action="{{route('postxoasanpham')}}" accept-charset="UTF-8" id="form_xoa_san_pham" class="form_xoa_san_pham"><input name="_token" type="hidden" value="{{csrf_token()}}">
        <div class="div_danh_sach_items">
            <table class="danh_sach_items">
            
                <tbody>
                    <tr class="row_header">
                        <td>
                            Mã hoá đơn
                        </td>
                        <td>
                            Người đặt
                        </td>
                        <td>
                            Ngày đặt
                        </td>
                        <td>
                            Tổng tiền (VNĐ)
                        </td>
                        <td>
                            Hình thức thanh toán
                        </td>
                        <td>
                            Ghi chú
                        </td>
                        <td>
                            Thanh toán
                        </td>
                        <td>
                            Trạng thái
                        </td>
                    </tr>
                    
                    
                    @foreach($dsdonhang as $dh)
                    <tr class="item_admin">
                        <td class="cell_center">
                            {{$dh->id_order}}
                        </td>
                        <td>
                            <a href="{{url('/')}}/admin/danh-sach-don-dat-hang-moi/chi-tiet-don-hang/{{$dh->id_order}}"> {{$dh->name}} </a>
                        </td>
                        <td class="cell_center">
                            {{date("d-m-y H:i:s",strtotime($dh->updated_at))}}
                        </td>
                        <td class="cell_center">
                            {{ number_format($dh->total,0,",",".")  }}
                        </td>
                        <td class="cell_center">
                            {{$dh->payments}}
                        </td>
                        <td class="cell_center">
                            {{$dh->note_order}}
                        </td>
                        <td class="cell_center">
                            {{$dh->name_payment}}
                        </td>
                        <td class="cell_center">
                            {{-- <img style="width: 32px;" src="
                            @if($dh->status_order == 1){{url('/')."/source/images/home/on.png"}} @else {{url('/')."/source/images/home/off.png"}}
                             @endif" title="@if($dh->status_order == 1){{"Hiển thị"}} @else {{"Không hiển thị"}} @endif"> --}}
                             {{$dh->name_orderstatus}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
    <div class="phan_trang_admin">
        {{$dsdonhang->render()}}
    </div>
    {{-- <div class="ds_button_admin">
        <div class="btn_xoa" onclick="kiem_tra_xoa()">Xóa danh sách đã chọn</div>
         <div class="clear"> </div>
    </div> --}}
</div>

@endsection
@section('script')
 {{-- <script>
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
    </script> --}}
    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

    
    {{-- <script src="{{url('/')}}/admin/js/custom.js"></script> --}}
    
@endsection