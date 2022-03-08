
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <ul class="nav nav-pills nav-stacked col-md-4">
    {{-- <li ><a href="#">Thông tin của tôi</a></li> --}}
    <li class="active"><a href="{{url('/address')}}">Thông tin tài khoản</a></li>
    <li><a href="{{url('/password')}}">Đổi mật khẩu</a></li>
    <li><a href="#">Danh sách đơn đặt hàng</a></li>
  </ul>
</div>

</body>
</html>