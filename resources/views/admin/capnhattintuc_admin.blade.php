
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
<div class="main_form_admin">
              <div class="title_main_form_admin">
                    Cập nhật bài đăng
                </div>
                <div class="div_form_thong_tin">
                    <ul class="validation_error">
                     @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @if(Session::has('status'))
                        <p class="alert alert-danger">{{ Session::get('status') }}</p>
                    @endif
                    </ul>
                     <script language="javascript" src="{{url('/')}}/admin/vendors/ckeditor/ckeditor.js" type="text/javascript"></script>
                      {!! Form::open(array('route'=>'postcapnhattintuc','id'=>'form_cap_nhat_san_pham','class' => 'form_cap_nhat_san_pham', 'files'=>true)) !!}
                    {{-- <form method="POST" action="{{route('postcapnhatsanpham')}}" accept-charset="UTF-8" id="form_them_san_pham_moi" class="form_them_san_pham_moi" enctype="multipart/form-data"> --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="form_cap_nhat">
                            <tbody><tr>
                                <td>
                                    Tiêu đề(*): 
                                </td>
                                <td>
                                    <input required="required" placeholder="Tên tiêu đề" name="title" value="{{$tintuc->title}}" type="text">
                                     {!! Form::hidden('ma', $tintuc->id) !!}
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    Hình đại diện(*):
                                </td>
                                <td>
                                <div class="hinh_minh_hoa">
                                        @if($tintuc->images)
                                            <img style="width: 300px; border:inset 3px pink" alt="{{$tintuc->title}}" src="{{url('/')}}/source/images/news/{{$tintuc->images}}" />
                                        @endif
                                    </div>
                                    <div>
                                        <input accept=".png,.jpg,.gif" name="hinh_tt" type="file">
                                         {!! Form::hidden('hinh',$tintuc->images) !!}
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    Nội dung tóm tắt(*):
                                </td>
                                <td>
                                    {!! Form::textarea('intro', null,
                                        array('id'=>'intro', 'placeholder'=>'Nội dung tóm tắt','required')) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nội dung chi tiết(*):
                                </td>
                                <td>
                                    {!! Form::textarea('mo_ta', $tintuc->intro,
                                        array('required','id'=>'mo_ta', 'placeholder'=>'Nội dung bài viết','required')) !!}
                                     <script type="text/javascript">CKEDITOR.replace( 'mo_ta', { customConfig: '{{url('/')}}/admin/vendors/ckeditor/baiviet_config.js' } ); </script>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Người đăng:
                                </td>
                                <td>
                                    <input required="required" disabled value="{{$tintuc->User->name}}" name="nguoidang" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Trạng thái:
                                </td>
                                <td>
                                    @if($tintuc->status==1)
                                        <input type="checkbox" name="status" checked>
                                    @else
                                        <input type="checkbox" name="status">
                                    @endif
                                </td>
                            </tr>
                        </tbody></table>
                        <p style="padding-left:90px;font-size:15px; color:grey">(*)Bắt buộc nhập</p>
                        <div class="ds_button_admin">
                            <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/danh-sach-tin-tuc';">Hủy thao tác</div>
                            <input class="btn_them" type="submit" value="Lưu">
                            <div class="clear"> </div>
                        </div>
                    </form>
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