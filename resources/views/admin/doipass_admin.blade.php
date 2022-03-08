
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
<div class="main_form_admin">
                <div class="title_main_form_admin">
                    Đổi mật khẩu
                </div>
                 <div class="div_form_thong_tin">
                 @if(Session::has('status'))
                        <p class="alert alert-success">{{ Session::get('status') }}</p>
                    @endif
                    @if(Session::has('thatbai'))
                        <p class="alert alert-danger">{{ Session::get('thatbai') }}</p>
                    @endif
                 <ul class="validation_error">
                     @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    
                    </ul>
            {!! Form::open(array('route'=>'postdoimatkhau','id'=>'form_cap_nhat_san_pham','class' => 'form_cap_nhat_san_pham', 'files'=>true)) !!}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="form_cap_nhat">
                            <tbody><tr>
                                <td>
                                    Mật khẩu cũ(*):
                                </td>
                                <td>
                                    <input style="width:80%;padding: 5px 10px" required="required" placeholder="Mật khẩu cũ"  name="password_old" type="password">
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td>
                                    Mật khẩu mới(*):
                                </td>
                                <td>
                                    <input style="width:80%;padding: 5px 10px" required="required" name="password_new" placeholder="Mật khẩu mới" type="password">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nhập lại mật khẩu(*):
                                </td>
                                <td>
                                    <input style="width:80%;padding: 5px 10px" required="required" placeholder="Nhập lại mật khẩu"  name="re_password" type="password">
                                </td>
                            </tr>
                        </tbody></table>
                        <p style="padding-left:90px;font-size:13px; color:grey">(*)Bắt buộc nhập</p>
                        <div class="ds_button_admin">
                        <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/thong-tin-tai-khoan';">Quay lại</div>
                            <input class="btn_them" type="submit" value="Lưu">
                            <div class="clear"> </div>
                        </div>
                    </form>
                    </div>
@endsection
