
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           <div class="row">
			     <div class="col-md-6 col-md-offset-3">
                 <div class="panel panel-default">
                 <div class="panel-heading">Quên mật khẩu</div>

            {!! Form::open(['url' =>'password/reset' , 'method' =>"POST"])!!}

            {{ Form::hidden('token', $token ) }}

            {{ Form::label('email' , 'Email:')}}
            {{ Form::email('email', $email, ['class' =>'form-control'])}}
             {{ Form::label('email' , 'Mật khẩu mới:')}}
            {{ Form::password('password' ,['class' =>'form-control'])}}
            {{ Form::label('password_confirmation' , 'Nhập lại mật khẩu')}}
            {{ Form::password('password_confirmation' , ['class' =>' form-control'])}}


            {{ Form::submit('Đổi mật khẩu' , ['class' =>'btn btn-primary'])}}

            {!! Form::close() !!}
            </div>
            </div>
            </div>

