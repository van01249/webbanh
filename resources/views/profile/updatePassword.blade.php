
@extends('profile.index')
@section('tieude')
Đổi mật khẩu
@endsection
@section('noidung')

        <div class=" alert alert-info">
            @if(session('msg'))
                <div class="alert alert-info">
                {{session('msg')}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                </div>
                @endif
                     <h3> <span style='color:green'>{{ucwords(Auth::user()->name)}}</span> ,Đổi mật khẩu</span></h3>
                     {!! Form::open(['url' => 'updatePassword' , 'method' =>'post']) !!} 
                       

                          <div class="form-group row">
                                    <div class="form-group col-md-6">
                                         <label for="example-text-input">Mật khẩu cũ</label>
                                         <input class="form-control" type="password" name="oldPassword">
                                         <span style="color:red">{{ $errors->first('oldPassword') }}</span>
                                    
                                    <br>

                                        <label for="example-text-input">Mật khẩu mới</label>
                                        <input class="form-control" type="password" name="newPassword">
                                        <span style="color:red">{{ $errors->first('newPassword') }}</span>
                                    <br>
                                        <label for="example-text-input">Nhập lại mật khẩu</label>
                                        <input class="form-control" type="password" name="rePassword">
                                        <span style="color:red">{{ $errors->first('rePassword') }}</span>
                                    <br>
                                        <div align="right"><input type="submit" value="Lưu" class="btn btn-primary"></div>
                                    </div>
                                
                        </div>
                    {!! Form::close() !!} 
            </div>
@endsection