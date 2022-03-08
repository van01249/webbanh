﻿
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
            {{-- <label>Tên sản phẩm</label></br>
            	
            <script src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js"></script>
            <textarea row="3" id="summary" name="txtIntro"></textarea>
            <script type="text/javascript">CKEDITOR.replace("summary")</script>  --}}
             <div class="title_main_form_admin">
                    Thêm thành viên
                </div>
            <div class="main_form_admin">
                <div class="div_form_thong_tin">
                @if(Session::has('status'))
                        <p class="alert alert-warning">{{ Session::get('status') }}</p>
                    @endif
                    <ul class="validation_error">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                     <script language="javascript" src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js" type="text/javascript"></script>
                    <form method="POST" action="{{route('postthemthanhvien')}}" accept-charset="UTF-8" id="form_them_san_pham_moi" class="form_them_san_pham_moi" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="form_cap_nhat">
                            <tbody><tr>
                                <td>
                                    Email(*):
                                </td>
                                <td>
                                    <input required="required" placeholder="Tên email" name="email" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mật khẩu(*):
                                </td>
                                <td>
                                    <input style="width: 80%;padding: 5px 10px" required="required" placeholder="Mật khẩu" name="password" type="password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Loại tài khoản(*):
                                </td>
                                <td>
                                
                                    <select name="power">
                                    <?php array_shift ($dsquyen) ?>
                                    @foreach($dsquyen as $quyen)
                                      <option value="{{$quyen->id_power}}">{{$quyen->name_power}}</option>
                                     @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Họ tên(*):
                                </td>
                                <td>
                                    <input required="required" placeholder="Họ tên" name="name" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Số điện thoại:
                                </td>
                                <td>
                                    <input placeholder="Số điện thoại" name="phone" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Địa chỉ:
                                </td>
                                <td>
                                    <input placeholder="Địa chỉ" name="address" type="text">
                                </td>
                            </tr>
                        </tbody></table>
                        <p style="padding-left:90px;font-size:15px; color:grey">(*)Bắt buộc nhập</p>
                        <div class="ds_button_admin">
                        
                            <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/danh-sach-thanh-vien';">Hủy thao tác</div>
                            <input class="btn_them" type="submit" value="Lưu">
                            <div class="clear"> </div>
                        </div>
                    </form>
                </div>

            </div>
          </div>
   
@endsection
@section('script')

    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="{{url('/')}}/admin/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

    <script src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js"></script>
    <script src="{{url('/')}}/admin/vendors/ckfinder/ckfinder.js"></script>
   
    <script src="{{url('/')}}/admin/vendors/ckeditor/adapters/jquery.js"></script>

    <script type="text/javascript" src="{{url('/')}}/admin/vendors/tinymce/js/tinymce/tinymce.min.js"></script>

    {{-- <script src="{{url('/')}}/admin/js/custom.js"></script> --}}
    <script src="{{url('/')}}/admin/js/editors.js"></script>
@endsection