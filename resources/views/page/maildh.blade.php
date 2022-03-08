
<a href="">Cám ơn bạn đã đặt hàng

</a>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap 3 Simple Tables</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        .example{
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="example">
        <div class="container">
            <div class="row">
            <div class="table-responsive">    
                <table class="table table-bordered"  style="margin: 155px  ; margin: auto; " >
                    <thead>
                        <tr >

                            <th style = "width: 95px; font-weight: bold; border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">Mã sản phẩm</th>
                            <th style = "width: 95px; font-weight: bold; border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">Tên sản phẩm</th>
                     
                            <th style = "width: 95px; font-weight: bold; border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">Giá</th>
                            <th style = "width: 95px; font-weight: bold; border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">Số lượng</th>
                            <th style = "width: 95px; font-weight: bold; border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cartItems as $cart)
                        <tr>

                            <td style = "border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">{{$cart->id}}</td>
                            <td style = "border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">{{$cart->name}}</td>
                            
                            <td style = "border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">{{number_format($cart->price,0,",",".")}}</td>
                            <td style = "border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">{{$cart->qty}}</td>
                            <?php $thanhtien = $cart->qty * $cart->price; ?>
                            <td style = "border-bottom: 1px solid #3E8DEC;border-right: 1px solid #3E8DEC;">{{number_format($thanhtien,0,",",".")}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
             </div>   
            </div>
        </div>
 
    </div>
</body>
</html>