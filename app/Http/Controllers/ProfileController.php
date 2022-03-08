<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Bill;
use App\khachhang;
class ProfileController extends Controller
{
    public function  index(){
    	
    	return view('profile.profile');

    }
    public function orders(){
        $user_id = Auth::user()->id;
        // $orders = DB::table('order')
        //         ->join('order_status' ,'order.status', '=' , 'order_status.id')
        //         ->join('order_detail','order.id','=','order_detail.order_id')
        //         ->join('customer','order.customer_id','=','customer.id')
        //         ->join('payment_status','order.payment_status','=','payment_status.id')
        //         ->selectRaw('order.id, order.updated_at, order.total, payment_status.name as name_payment, order_status.name')
        //         ->where('customer.user_id','=',$user_id)
        //         ->orderBy('order.updated_at','desc')
        //         ->paginate(10);
          $orders = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->join('payment_status','order.payment_status','=','payment_status.id')
            ->join('order_status','order.status','=','order_status.id')
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note as note_order,order.payments, order.payment_status,
            payment_status.id as id_payment, payment_status.name as name_payment, order_status.id as id_orderstatus, order_status.name as name_orderstatus, customer.*')
             ->where('customer.user_id','=',$user_id)
            ->orderBy('date_order','desc')->paginate(10);
        return view('profile.orders' , compact('orders'));

        //return view('profile.orders');
    }
    public function order_detail($id)
    {
        $thongtindonhang = DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            ->join('payment_status','order.payment_status','=','payment_status.id')
            ->join('order_status','order.status','=','order_status.id')
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note as note_order,order.payments, order.payment_status,
            payment_status.id as id_payment, payment_status.name as name_payment, order_status.id as id_orderstatus, order_status.name as name_orderstatus, customer.*')
            ->where('order.id','=',$id)
            ->first();
        $chitiet = DB::table('order_detail')
            ->join('order','order_detail.order_id','=','order.id')
            ->join('product','order_detail.product_id','=','product.id')
            ->join('product_type','product.id_type','=','product_type.id')
            ->selectRaw('order.id as id_order, order.status as status_order, order.date_order, order.total, order.note,order.payments, order.payment_status,
            order_detail.id as id_orderdetail, order_detail.order_id,order_detail.product_id, order_detail.quantity, order_detail.unit_price, order_detail.user_id,
            product.id as id_product, product.name as name_product, product.image,
            product_type.id as id_producttype, product_type.name as name_producttype')
            ->where('order_detail.order_id','=',$id)
            ->orderBy('id_product','asc')
            ->get();
        return view('profile.order_detail',['thongtindonhang'=>$thongtindonhang,'chitiet'=>$chitiet]);
    }

    public function  updateAddress(Request $request){
        $this->validate($request, [
            'fullname' => 'required|min:5|max:35',
            'sdt' => 'required|numeric',
            'diachi' => 'required|min:10|max:100',
            ],[
                'fullname.required' => 'Vui lòng nhập họ tên',
                'fullname.min' => 'Họ tên ít nhất 5 kí tự',
                'fullname.max' => 'Họ tên tối đa 35 kí tự',
                'diachi.required' => 'Vui lòng nhập địa chỉ',
                'diachi.min' => 'Địa chỉ phải ít nhất 10 kí tự',
                'diachi.max' => 'Địa chỉ tối đa 100 kí tự',
            ]);

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(
                [
                     'name' => $request->input('fullname'),
                     'address' => $request->input('diachi'),
                     'phone' => $request->input('sdt'),
                ]
        );
        return back()->with('msg' , 'Thông tin của bạn đã được cập nhật');
    }
    public function Password(){
        return view('profile.updatePassword');
    }

    public function updatePassword(Request $request){
         $this->validate($request,[
            'newPassword' => 'required|min:6',
            'rePassword' => 'required|same:newPassword',
            'oldPassword' => 'required',
        ],[
            'newPassword.required' => 'Mật khẩu không được để trống',
            'oldPassword.required' => 'Vui lòng nhập mật khẩu cũ',
            'newPassword.min' => 'Mật khẩu ít nhất 6 kí tự',
            'rePassword.required' => 'Nhập lại mật khẩu không được để trống',
            'rePassword.same' => 'Nhập lại mật khẩu không đúng với mật khẩu'
        ]);
        $oldPassword = $request->oldPassword;
        $newPassword = $request->newPassword;
        if(!Hash::check($oldPassword, Auth::user()->password)){
           return back()->with('msg' ,'Mật khẩu cũ không chính xác ');
        }
        else{
            $request->user()->fill(['password' => Hash::make($newPassword)])->save();
           return back()->with('msg' ,'Mật khẩu đã được thay đổi');
        }
    }

}








