<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
use Socialite;
use App\SocialProvider;
use Mail;
use DB;
use Illuminate\Http\Request;
use App\products;


class PageController extends Controller
{
    public function getIndex()
    {
        $dsslide = DB::table('slide')->get();
        $sanphamtheoloai = DB::table('product_type')
                            ->join('product','product_type.id','=','product.id_type')
                            ->selectRaw('product.id as id_product,product.name as name_product,product.price ,product.status as status_product, product.image as image_product, product.intro as intro_product, product_type.*')
                            ->orderBy('product_type.id','asc')
                            ->where('product.status','=',1)
                            ->paginate(4);
        $dsloai = DB::table('product_type')
                ->orderBy('product_type.id','asc')
                ->get();
        $sanphamduocyeuthich = DB::table('product')
                            ->join('wishlist','product.id','=','wishlist.pro_id')
                            ->selectRaw('product.*, count(wishlist.pro_id) as soluong')
                            ->groupBy('product.id')
                            ->orderBy('soluong','desc')
                            ->skip(0)->take(4)->get();
        $sanphammoi = DB::table('product')->where('product.new' ,'=' , 1)->where('product.status','=',1)->orderBy('id','desc')->paginate(4);
         $sanphambanchay = DB::table('product')
        ->join('order_detail','product.id', '=', 'order_detail.product_id')
        ->selectRaw('product.*, sum(order_detail.quantity) as tongsl')
        ->where('product.status','=',1)
        ->groupBy('product.id')
        ->orderBy('tongsl','desc')
        ->skip(0)->take(8)->get();
        $sanpham = DB::table('product')->select('id','name','image','price')->orderBy('id','DESC')->paginate(4);
        return view('page.trangchu',
                    ['sanpham'=>$sanpham,'sanphammoi'=>$sanphammoi,'sanphambanchay'=>$sanphambanchay,
                    'sanphamtheoloai'=>$sanphamtheoloai,'dsloai'=>$dsloai,'dsslide'=>$dsslide,'sanphamduocyeuthich'=>$sanphamduocyeuthich]);
    }
    public function pagenotfound()
    {
        return view('errors.503');
    }
     public function search(Request $request)
    {
        $search = $request->search_data;
        if($search==''){
            return view('page.trangchu');
        }
        else{
        $sanpham = DB::table('product')->where('product.status','=',1)->where('name', 'like', '%'.$search.'%')->paginate(2);
        return view('page.shop',['msg' =>'Result:'. $search] , compact('sanpham'));

        //return back();
        }
    }

    public function shop(Request $request)
    {
        //$sanpham = Cart::content();
        if($request->ajax() && isset($request->start) && isset($request->end) ){

            $start = $request->start;
            $end = $request->end;
            $sanpham = DB::table('product')
            ->where('product.status','=',1)
            ->where('price', '>=', $start)
            ->where('price','<=',$end)
            ->orderby('price' , 'ASC')
            ->paginate(6);

           // dd($sanpham);

            response()->json($sanpham);
            return view('page.product', compact('sanpham'));

        }
        else if(isset($request->brand)){
            $brand = $request->brand; //brand
            $sanpham = DB::table('product')
            ->where('product.status','=',1)
            ->whereIN('id_type', explode(',', $brand))
            
            ->paginate(6);

          // dd($sanpham);

            response()->json($sanpham);
            return view('page.product', compact('sanpham')); 

        
        }
        else{
        $sanpham = DB::table('product')->where('status','=',1)->select('id','name','image','promo_price','price')->orderBy('id','DESC')->paginate(9);
        return view('page.shop',compact('sanpham'))
            ->with('ds_slide');
        }
        
    }
    
    public function proCats(Request $request){
        $protypeName = $request->name;
        $sanpham = DB::table('product')->leftJoin('product_type' , 'product_type.id' , '=' , 'product.id_type')->where('product.status','=',1)->where('product_type.name' ,'=' , $protypeName)->paginate(3);
        return view('page.shop', compact('sanpham'));
    }
         
    
    public function getRegister()
    {
        if(Auth::check())
        {
             return redirect()->route('index');
        }
        else
        {
    	    return view('page.dangki');
        }
    }

    public function postRegister(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                'phone'=>'numeric',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'phone.numeric'=>'Điện thoại phải thuộc kiểu số',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user->name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->power = 1;
        $user->save();
        Mail::send('page.mail',['nguoidung'=>$user], function ($message) use($user)
        {
            $message->from('phonglang01249@gmail.com',"Bakery Store");
            $message->to($user->email,'$user->HoTen');
            $message->subject('Xác nhận tài khoản');
        });
        // return redirect('dang-ki')->with('thongbao', 'Đăng kí thành công,Kiểm tra mail để kích hoạt');
        $req->session()->flash('thongbao', 'Đăng kí thành công, Kiểm tra mail để kích hoạt');
        return redirect('login');
    }
    
    public function activeUser($id){
        $user =  User::Find($id);
        if($user){
            $user->active = 1;
            $user->save();
            return redirect()->route('dangnhap')->with(['thanhcong'=>'Đã kích hoạt tài khoản']);
        }
    }

    public function getLogin(){
            return view('page.dangnhap');
    }
    public function postLogin(Request $req){
          $this->validate($req,
             [
                 'email'=>'required|email',
                 'password'=>'required|min:6|max:20'
             ],
             [
                 'email.required'=>'Vui lòng nhập email',
                 'email.email'=>'Email không đúng định dạng',
                 'password.required'=>'Vui lòng nhập mật khẩu',
                 'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                 'password.max'=>'Mật khẩu không quá 20 kí tự'
             ]
         );
         $credentials = array('email'=>$req->email,'password'=>$req->password);
         $user = User::where([
                 ['email','=',$req->email],
                 ['active','=','1']
             ])->first();
        
         if($user){
             if($user->power==1)
             {
                if($user->status<1)
                {
                    return redirect()->back()->with(['flag'=>'danger','message'=>'Tài khoản không còn khả dụng']); 
                }
                else{
                    if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1,'status'=>1])){
                        return redirect()->route('index');
                    }
                    else{
                        return redirect()->back()->with('thatbai','Sai email hoặc mật khẩu');
                    }
                    // if(Auth::attempt($credentials)){

                    // return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
                    // }
                    // else{
                    //     return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
                    // } 
                }
            }
             else
             {
                 return redirect()->back()->with(['flag'=>'danger','message'=>'Tài khoản bạn bị giới hạn quyền sử dụng trang này']); 
             }
         }
         else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Tài khoản chưa kích hoạt']); 
         }
        //  if(Auth::check()){

        //  }
        //  else{
        //      $user = User::where([
        //          ['email', '=',$req->email],
        //          ['active', '=' , 1],
        //           ['status','=','1']
        //  ])->first();

        //     // dd($user);
        //  }
        //  if($user){
           
        //     // Auth::logout();
        //     // return redirect()->route('index');
        //     if(Auth::attempt(['email'=>$req->email,'password'=>$req->password,'active'=>1,'status'=>1])){
        //         return redirect()->route('index');
        //     }
        //     else{
        //         return redirect()->back()->with('thatbai','Sai thông tin đăng nhập');
        //     }
        // }
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }    


    public function contact()
    {
    	return view('page.lienhe');
    }
    public function  getgh()
    {
        return view('page.index');
    }

    public function post_lienhe(Request $request){
        $user = new User();
        
        $data = ['hoten'=>Request::input('name'),'email'=>Request::input('email'),'subject'=>Request::input('subject'),'tinnhan'=>Request::input('message')];
        Mail::send('page.blanks',$data, function($msg){
            $msg->from('phonglang01249@gmail.com','Nguyễn Đức Vân');
            $msg->to('phonglang01249@gmail.com', 'Nguyễn Đức Vân')->subject('Đây là mail khách hàng');
        });
        echo "<script>
            alert('Cám ơn bạn đã góp ý .Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất');
            window.location ='".url('/index')."'        
            </script>";
        }
    public function gettintuc()
    {
        $dstintuc = DB::table('news')->where('status',1)->paginate(8);
        return view('page.dstintuc',['dstintuc'=>$dstintuc]);
    }
    public function getchitiet($id)
    {
        $cttintuc = DB::table('news')->where('status',1)->where('id',$id)->first();
        return view('page.chitiettintuc',['cttintuc'=>$cttintuc]);
    }
    public function getloaisp($id)
    {
        $loaisp = products::where('id_type','=',$id)->paginate(9);
        return view('page.loaisp',['loaisp'=>$loaisp]);
    }
}
