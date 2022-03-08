<?php

namespace App\Http\Controllers;
use App\Http\Requests\CapnhatTaikhoanAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests;
use DB;
use Hash;
use App\slide;
use App\news;
class AdminQuanlyController extends Controller
{
    
    // thông tin tài khoản admin
    public function thongtintaikhoan_admin()
    {
        return view('admin.thongtintaikhoan_admin');
    }
    public function postthongtintaikhoan_admin(CapnhatTaikhoanAdminRequest $reqthongtinad)
    {
        
        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(
                [
                     'name' => $reqthongtinad->input('name'),
                     'address' => $reqthongtinad->input('address'),
                     'phone' => $reqthongtinad->input('phone'),
                ]
        );
         $reqthongtinad->session()->flash('status', 'Lưu thành công');
        return back();
    }
    public function doimatkhau_admin()
    {
        return view('admin.doipass_admin');
    }
    public function postdoimatkhau_admin(Request $reqpass)
    {
        $this->validate($reqpass,[
            'password_new' => 'required|min:6',
            're_password' => 'required|same:password_new',
            'password_old' => 'required',
        ],[
            'password_new.required' => 'Mật khẩu không được để trống',
            'password_old.required' => 'Vui lòng nhập mật khẩu cũ',
            'password_new.min' => 'Mật khẩu ít nhất 6 kí tự',
            're_password.required' => 'Nhập lại mật khẩu không được để trống',
            're_password.same' => 'Nhập lại mật khẩu không đúng với mật khẩu'
        ]);
        if(Hash::check($reqpass->input('password_old'),Auth::user()->password))
        {
            DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(
                [
                     'password' => Hash::make($reqpass->input('password_new')),
                ]
            );
            $reqpass->session()->flash('status', 'Đổi mật khẩu thành công');
            
        }
        else{
            $reqpass->session()->flash('thatbai', 'Mật khẩu cũ không đúng!! Lưu thất bại');
        }
        return view('admin.doipass_admin');
    }
   //quản lí tài khoản
   public function danhsachtaikhoan_admin()
    {
        $dstaikhoan = DB::table('users')->leftJoin('power_type', 'users.power', '=', 'power_type.id_power')->orderBy('id','asc')->paginate(10);
        return view('admin.danhsachthanhvien_admin',['dstaikhoan'=>$dstaikhoan]);
    }
    public function themthanhvien_admin()
    {
        $dsquyen = DB::table('power_type')->get();
        return view('admin.themthanhvien_admin',['dsquyen'=>$dsquyen]);
    }
    public function postthemthanhvien_admin(Request $reqaddtk)
    {
        $this->validate($reqaddtk,[
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required',
            'phone' => 'numeric',
        ],[
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 kí tự',
            'name.required' => 'Vui lòng nhập họ tên',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
        ]);
        $kttaikhoan = DB::table('users')->where('email','=',$reqaddtk->email)->get();
        if(count($kttaikhoan)>0)
        {
            $reqaddtk->session()->flash('status', 'Email đã có tài khoản');
            return redirect('admin/them-thanh-vien-moi');
        }
        else
        {
            DB::table('users')->insertGetId(
        [
                'name' => $reqaddtk->input('name'),
                'email' => $reqaddtk->input('email'),
                'password' => Hash::make($reqaddtk->input('password')),
                'phone' => $reqaddtk->input('phone'),
                'address' => $reqaddtk->input('address'),
                'power' => $reqaddtk->input('power'),
                'active' => 1,
                'status' => 1,        
        ]);
            return redirect()->route('danhsachthanhvien');
        }
        
    }
    public function capnhattaikhoan_admin($id)
    {
        $dsquyen = DB::table('power_type')->get();
        $dsquyen = $this->chuyen_mang_doi_tuong_sang_mang_key($dsquyen);
        $taikhoan = User::find($id);
        return view('admin.capnhatthanhvien_admin',['taikhoan' => $taikhoan,'dsquyen'=>$dsquyen]);
    }
    public function postcapnhattaikhoan_admin(CapnhatTaikhoanAdminRequest $reqcapnhattk)
    {
        if(isset($reqcapnhattk->status))
         {
            $trangthai=1;
         }  
                
         else  
         {
            $trangthai=0;
         }
        //  if($reqcapnhattk->power=="1")
        //  {
        //      $power =1;
        //  }
        // if($reqcapnhattk->power=="2")
        // {
        //     $power = 2;
        // }
        // if($reqcapnhattk->power=="3")
        // {
        //     $power = 3;
        // }
        $power = $reqcapnhattk->power;
        if(Auth::user()->power==2 &&  $power >1)
        {
            $reqcapnhattk->session()->flash('status', 'Bạn không được chỉnh sửa quyền người dùng thành admin');
             return redirect(url('/')."/admin/danh-sach-thanh-vien/cap-nhat-tai-khoan/".$reqcapnhattk->ma);
        }
        else
        {
            if((Auth::user()->id==$reqcapnhattk->ma && Auth::user()->power!=$power && $trangthai==0) 
            ||(Auth::user()->id==$reqcapnhattk->ma && Auth::user()->power==$power && $trangthai==0)||
            (Auth::user()->id==$reqcapnhattk->ma && Auth::user()->power!=$power && $trangthai!=0))
            {
                $reqcapnhattk->session()->flash('status', 'Không thể tước quyền admin của bạn');
                return redirect(url('/')."/admin/danh-sach-thanh-vien/cap-nhat-tai-khoan/".$reqcapnhattk->ma);
            
            }
            else{
                DB::table('users')
                ->where('id', $reqcapnhattk->ma)
                ->update(
                    [
                        'name' => $reqcapnhattk->input('name'),
                        'address' => $reqcapnhattk->input('address'),
                        'phone' => $reqcapnhattk->input('phone'),
                        'power' => $power,
                        'status' => $trangthai,
                    ]
                );
                if(Auth::user()->power==3)
                {
                    return redirect()->route('danhsachthanhvien'); 
                }
                else
                {
                    return redirect('admin/danh-sach-member');
                }
            }
        }
        
        
    }
    public function postxoataikhoan_admin(Request $request)
    {
            // $ds_xoa = $request->input('thao_tac');
            // $kiemtraad = DB::table('users')->select('id','power')->whereIn('id',$ds_xoa)->get();
            // $kiemtraad = $this->chuyen_mang_doi_tuong_sang_mang_key($kiemtraad);
            // foreach($kiemtraad as $ad)
            //     {
            //         $test=$ad->power;
            //         print_r($test);
            //     }
            // {
            //     $taikhoan = DB::table('users')->whereIn('id', $ds_xoa)->update(['status' => 0]);
            //     return redirect("/admin/danh-sach-thanh-vien");
            // }
            // if($kiemtraad->power==1)
            //     print_r($kiemtraad);
        
    }
    //ds tài khoản member admin thường quản lí
    public function danhsachmember_admin()
    {
        $dstaikhoan = DB::table('users')->leftJoin('power_type', 'users.power', '=', 'power_type.id_power')->where('power','=','1')->orderBy('id','asc')->paginate(10);
        return view('admin.danhsachmember_admin',['dstaikhoan'=>$dstaikhoan]);
    }
    // quản lí slide banner
    public function danhsachslide_admin()
    {
        $dsslide = slide::paginate(10);
        return view('admin.danhsachslide_admin',['dsslide'=>$dsslide]);
    }
    public function getThemslide_admin()
    {
        return view('admin.themslide_admin');
    }
    public function postThemslide_admin(Request $reqthemslide)
    {
        if($reqthemslide->file('hinh_slide'))
        {
            if($reqthemslide->file('hinh_slide')->isValid())
            {
                $reqthemslide->file('hinh_slide')->move("source/images/slide",$reqthemslide->file('hinh_slide')->getClientOriginalName());
                $hinh_slide = $reqthemslide->file('hinh_slide')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {   $thongbao = "Bạn phải chọn hình cho slide mới";
            $reqthemslide->session()->flash('status', $thongbao);
            return redirect()->route('themslide');
        }
         DB::table('slide')->insertGetId(
            [
                'image' => $hinh_slide,
                'link' => $reqthemslide->input('link'),
            ]
        );
        return redirect("/admin/danh-sach-slide-banner");
    }
    public function getCapnhatslide_admin($id)
    {
        $slide = slide::find($id);
        return view('admin.capnhatslide_admin',['slide'=>$slide]);
    }
    public function postXoaslide_admin(Request $req)
    {
        $ds_xoa = $req->input('thao_tac');
        $slide = DB::table('slide')->whereIn('id',$ds_xoa)->delete();
        return redirect("/admin/danh-sach-slide-banner");
    }
    // quản lí tin tức
    public function danhsachtintuc_admin()
    {   
        $dstintuc = news::with('User')->orderBy('id','asc')->paginate(10);
        return view('admin.danhsachtintuc_admin',['dstintuc'=>$dstintuc]);
    }
    public function themtinmoi_admin()
    {
        return view('admin.themtinmoi_admin');
    }
    public function postthemtinmoi_admin(Request $reqaddtin)
    {
        $this->validate($reqaddtin,[
            'title' => 'required|min:6',
            'mo_ta' => 'required',
            'intro' => 'required',

        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'title.min' => 'Tiêu đề phải nhiều hơn 6 kí tự',
            'mo_ta.required' => 'Nội dung không được để trống',
            'intro.required' => 'Nội dung tóm tắt không được để trống',
        ]);
        if($reqaddtin->file('hinh'))
        {
            if($reqaddtin->file('hinh')->isValid())
            {
                $reqaddtin->file('hinh')->move("source/images/news",$reqaddtin->file('hinh')->getClientOriginalName());
                $hinh = $reqaddtin->file('hinh')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {   $thongbao = "Bạn phải chọn hình đại diện cho bài đăng";
            $reqaddtin->session()->flash('status', $thongbao);
            return redirect()->route('dangtinmoi');
        }
         DB::table('news')->insertGetId(
            [
                'id_user' => Auth::user()->id,
                'title' => $reqaddtin->input('title'),
                'intro' => $reqaddtin->input('intro'),
                'content' => $reqaddtin->input('mo_ta'),
                'images' => $hinh,
                'status' => 1,
            ]
        );
        return redirect("/admin/danh-sach-tin-tuc");
    }
    public function getCapnhattintuc_admin($id)
    {
        $tintuc = news::find($id);
        return view('admin.capnhattintuc_admin',['tintuc'=>$tintuc]);
    }
    public function postCapnhattintuc_admin(Request $reqcapnhattintuc)
    {
        $this->validate($reqcapnhattintuc,[
            'title' => 'required|min:6',
            'mo_ta' => 'required',
            'intro' => 'required',
        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'title.min' => 'Tiêu đề phải nhiều hơn 6 kí tự',
            'mo_ta.required' => 'Nội dung không được để trống',
            'intro.required' => 'Nội dung tóm tắt không được để trống',
        ]);
        if($reqcapnhattintuc->file('hinh_tt'))
        {
            if($reqcapnhattintuc->file('hinh_tt')->isValid())
            {
                $reqcapnhattintuc->file('hinh_tt')->move("source/images/news",$reqcapnhattintuc->file('hinh_tt')->getClientOriginalName());
                $hinh = $reqcapnhattintuc->file('hinh_tt')->getClientOriginalName();
                //print_r($request->file('hinh_san_pham')->getClientOriginalName());exit;
            }
        }
        else
        {
            $hinh = $reqcapnhattintuc->input('hinh');
        }
        if(isset($reqcapnhattintuc->status))
         {
            $trangthai=1;
         }  
                
         else  
         {
            $trangthai=0;
         }
        //echo $hinh_san_pham;exit;
        DB::table('news')
            ->where('id', $reqcapnhattintuc->input('ma'))
            ->update(
                [
                     'title' => $reqcapnhattintuc->input('title'),
                     'intro' => $reqcapnhattintuc->input('intro'),
                     'content' => $reqcapnhattintuc->input('mo_ta'),
                     'status' =>$trangthai,
                     'images' => $hinh,
                ]
            );
        
        return redirect(url('/')."/admin/danh-sach-tin-tuc");
    
    }
    public function postXoatintuc_admin(Request $request)
    {
        $ds_xoa = $request->input('thao_tac');
        $tintuc = DB::table('news')->whereIn('id',$ds_xoa)->update(['status'=>0]);
        return redirect("/admin/danh-sach-tin-tuc");
    }
    //hỗ trợ
    public function chuyen_mang_doi_tuong_sang_mang_key($mang_doi_tuong)
    {
        $mang_key = array();
        foreach($mang_doi_tuong as $doi_tuong)
        {
            $mang_key[$doi_tuong->id_power] = $doi_tuong->name_power;
        }
         return $mang_key;
    } 
}
