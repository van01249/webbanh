
@extends('profile.index')
@section('tieude')
Danh sách đơn đặt hàng
@endsection
@section('noidung')
 <div class=" alert alert-info" style="width: 900px;">

                 @if(session('msg'))
                <div class="alert alert-info">
                {{session('msg')}}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                </div>
                @endif

                <h4 class="heading"> <span style='color:green'>{{ucwords(Auth::user()->name)}} , Đơn đặt hàng gần đây</span></h4>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th style="text-align: center">Mã đơn hàng</th>
                            <th style="text-align: center">Ngày đặt hàng</th>
                            <th style="text-align: center">Tổng tiền</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center">Thanh toán</th>
                            <th style="text-align: center">Thao tác</th>

                        </tr>
                    </thead>
                  
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td style="text-align: center">{{$order->id_order}}</td>
                            <td style="text-align: center">{{$order->updated_at}}</td>
                            <td style="text-align: center">{{ number_format($order->total,0,",",".")}} đ</td>
                            <td style="text-align: center">{{$order->name_orderstatus}}</td>
                            <td style="text-align: center">{{$order->name_payment}}</td>
                            <td style="text-align: center"><a style="color:green" href="{{url('/')}}/order-detail/{{$order->id_order}}">Theo dõi đơn hàng</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-left:300px">
                {{$orders->render()}}
                </div>
               
                </div>
@endsection