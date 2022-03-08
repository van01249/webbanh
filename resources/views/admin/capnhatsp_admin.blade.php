
@extends('template_admin.master_admin')
@section('css')
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">
@endsection
@section('content')
<div class="main_form_admin">
              <div class="title_main_form_admin">
                    Cập nhật sản phẩm
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
                      {!! Form::open(array('route'=>'postcapnhatsanpham','id'=>'form_cap_nhat_san_pham','class' => 'form_cap_nhat_san_pham', 'files'=>true)) !!}
                    {{-- <form method="POST" action="{{route('postcapnhatsanpham')}}" accept-charset="UTF-8" id="form_them_san_pham_moi" class="form_them_san_pham_moi" enctype="multipart/form-data"> --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <table class="form_cap_nhat">
                            <tbody><tr>
                                <td>
                                    Tên sản phẩm(*): 
                                </td>
                                <td>
                                    <input required="required" placeholder="Tên sản phẩm" name="ten_san_pham" value="{{$thongtinsp->name}}" type="text">
                                     {!! Form::hidden('ma', $thongtinsp->id) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Loại sản phẩm(*):
                                </td>
                                <td>
                                {{-- <select name="ma_loai">
                                      <option value="{{$thongtinsp->Category->id}}">{{$thongtinsp->Category->name}}</option>
                                </select> --}}
                                {!! Form::select('ma_loai',$dsloaisp,$thongtinsp->Category->id) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Hình sản phẩm(*):
                                </td>
                                <td>
                                <div class="hinh_minh_hoa">
                                        @if($thongtinsp->image)
                                            <img style="width: 300px; border:inset 3px pink" alt="{{$thongtinsp->name}}" src="{{url('/')}}/source/images/product/{{$thongtinsp->image}}" />
                                        @endif
                                    </div>
                                    <div>
                                        <input accept=".png,.jpg,.gif" name="hinh_san_pham" type="file">
                                         {!! Form::hidden('hinh',$thongtinsp->image) !!}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Mô tả(*):
                                </td>
                                <td>
                                    {!! Form::textarea('mo_ta', $thongtinsp->intro,
                                        array('required','id'=>'mo_ta', 'placeholder'=>'Mô tả tóm tắt')) !!}
                                     <script type="text/javascript">CKEDITOR.replace( 'mo_ta', { customConfig: '{{url('/')}}/admin/vendors/ckeditor/baiviet_config.js' } ); </script>
                                </td>
                            </tr>
                           
                            <tr>
                                <td>
                                
                                    Sản phẩm mới:
                                </td>
                                <td>
                                    @if($thongtinsp->new==1)
                                        <input type="checkbox" name="product_new" checked>
                                    @else
                                        <input type="checkbox" name="product_new">
                                    @endif
                                </td>
                            </tr>
                            <?php $so = 0; ?>
                            <?php $dem = 0; ?>
                                     
                            @if($dssize != null)
                                 @foreach($dssize as $size)
                                 <?php $dem += 1;
                                        $so +=1 ?>

                                 <tr>
                                    <td>
                                        Size:
                                    </td>
                                        <td>
                                            <input id="size" required="required" placeholder="Size lớn" value="{{$size->size}}" name="size{{$so}}"  type="text">
                                            <input id="size" placeholder="Size lớn" value="{{$size->size_id}}" name="id_size{{$so}}"  type="hidden">
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>
                                         Giá size:
                                    </td>
                                        <td>
                                            <input id="gia" required="required" placeholder="Giá" value="{{$size->p_price}}" name="gia{{$so}}" type="text">
                                        </td>
                                    </tr>
                                     @endforeach
                                     
                                @if(count($dssize)<3)
                                
                                    <?php $i = 3; ?>
                                    @while($i > $dem)
                                        <?php $dem += 1;
                                            $so +=1; ?>
                                     <tr>
                                    <td>
                                        Size:
                                    </td>
                                        <td>
                                            <input id="size" placeholder="Size"  name="size{{$so}}"  type="text">
                                        </td>
                                    </tr>
                                    <tr>
                                    <td>
                                         Giá size:
                                    </td>
                                        <td>
                                            <input id="gia"  placeholder="Giá" name="gia{{$so}}" type="text">
                                        </td>
                                    </tr>
                                    @endwhile
                                @endif
                                
                            @else
                            <tr>
                                <td>
                                    Đơn giá(*):
                                </td>
                                <td>
                                    <input required="required" id="dongia" value="{{$thongtinsp->price}}" placeholder="Đơn giá" name="don_gia" type="text">
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>
                                    Đơn vị tính(*):
                                </td>
                                <td>
                                    <select name="don_vi_tinh">
                                    @if($thongtinsp->unit=="Cái")
                                      <option value="Cái" selected>Cái</option>
                                      <option value="Hộp" >Hộp</option>
                                    @else
                                    <option value="Cái">Cái</option>
                                      <option value="Hộp" selected>Hộp</option>
                                    @endif
                                    </select>
                                    {{-- <input required="required" value="{{$thongtinsp->unit}}" placeholder="cái/hộp..." name="don_vi_tinh" type="text"> --}}
                                </td>
                            </tr>
                           
                             <tr>
                                <td>
                                    Trạng thái:
                                </td>
                                <td>
                                    @if($thongtinsp->status==1)
                                        <input type="checkbox" name="status" checked>
                                    @else
                                        <input type="checkbox" name="status">
                                    @endif
                                </td>
                            </tr>
                        </tbody></table>
                        <p style="padding-left:90px;font-size:15px; color:grey">(*)Bắt buộc nhập</p>
                        <div class="ds_button_admin">
                            <div class="btn_xoa" onclick="window.location='{{url('/')}}/admin/danh-sach-san-pham';">Hủy thao tác</div>
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
<script>
function show() {
	   document.getElementById("them_size").style.display= "block";
       document.getElementById("dongia").style.display = "block";
       document.getElementById("ipdongia").type = "hidden";
       //document.getElementById("dv").style.display = "none";
       //document.getElementById("andv").type = "hidden";
       //document.getElementById("giakm").style.display = "none";
      //document.getElementById("angia").type = "hidden";
       document.getElementById("size").type = "text";
       document.getElementById("gia").type = "text";
	}
</script>
@endsection