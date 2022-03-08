	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="{{route('trangchu')}}">Cake Bakery</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
									{{-- <form method="post" action="">
	                  <div class="input-group form">
										
	                       <input type="text" class="form-control" name="search_data" placeholder="Nhập tên cần tìm...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="submit">Tìm kiếm</button>
	                       </span>
	                  </div>
										</form> --}}
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi,{{Auth::user()->name}} <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="{{route('thongtintaikhoan')}}">Thông tin tài khoản</a></li>
	                          <li><a href="{{route('dangxuatad')}}">Đăng xuất</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>
    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="{{route('trangchu')}}"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
                    <li class="submenu">
											<a href="{{route('quanlydonhang')}}">
												<i class="glyphicon glyphicon-calendar"></i> 	<span class="caret pull-right"></span> Quản lí đơn đặt hàng</a>
													<ul>
															<li><a href="{{route('danhsachdonhangmoi')}}"><i class="glyphicon glyphicon-record"></i> Danh sách đơn đặt hàng mới</a></li>
												</ul>
												<ul>
															<li><a href="{{ route('danhsachdonhangcu') }}"><i class="glyphicon glyphicon-record"></i> Danh sách đơn đặt hàng cũ</a></li>
												</ul>
												</li>
                    {{-- <li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Quản lí loại sản phẩm</a></li> --}}
										<li class="submenu">
												<a href="{{ route('quanlyloaisanpham') }}">
														<i class="glyphicon glyphicon-stats"></i>
														<span class="caret pull-right"></span> Quản lí loại sản phẩm
												</a>
										
												<ul>
															<li><a href="{{route('danhsachloaisanpham')}}"><i class="glyphicon glyphicon-record"></i> Danh sách loại sản phẩm</a></li>
												</ul>
												<ul>
															<li><a href="{{ route('themloaisanpham') }}"><i class="glyphicon glyphicon-record"></i> Thêm loại sản phẩm mới</a></li>
												</ul>
										</li>
                    <li class="submenu">
												<a href="{{ route('quanlysanpham') }}">
														<i class="glyphicon glyphicon-list"></i>
														<span class="caret pull-right"></span> Quản lí sản phẩm
												</a>
										
												<ul>
															<li><a href="{{route('danhsachsanpham')}}"><i class="glyphicon glyphicon-record"></i> Danh sách sản phẩm</a></li>
												</ul>
												<ul>
															<li><a href="{{ route('themsanpham') }}"><i class="glyphicon glyphicon-record"></i> Thêm sản phẩm mới</a></li>
												</ul>
												<ul>
															<li><a href="{{ route('themsanphamsize') }}"><i class="glyphicon glyphicon-record"></i> Thêm sản phẩm theo size</a></li>
												</ul>
										</li>
                    <li class="submenu">
												<a href="{{route('quanlythanhvien')}}">
														<i class="glyphicon glyphicon-pencil"></i>
														<span class="caret pull-right"></span> Quản lí thành viên</a>
												@if(Auth::user()->power==3)
															<ul>
															<li><a href="{{route('danhsachthanhvien')}}"><i class="glyphicon glyphicon-record"></i> Danh sách thành viên</a></li>
												</ul>
												<ul>
															<li><a href="{{ route('themthanhvien') }}"><i class="glyphicon glyphicon-record"></i> Thêm thành viên mới</a></li>
												</ul>
												@endif
												@if(Auth::user()->power==2)
														<ul>
															<li><a href="{{route('danhsachmember')}}"><i class="glyphicon glyphicon-record"></i> Danh sách tài khoản người dùng</a></li>
													</ul>
												@endif
										</li>
										<li class="submenu">
												<a href="{{ route('quanlysanpham') }}">
														<i class="glyphicon glyphicon-tasks"></i>
														<span class="caret pull-right"></span> Quản lí slide banner
												</a>
										
												<ul>
															<li><a href="{{route('danhsachslide')}}"><i class="glyphicon glyphicon-record"></i> Danh sách slide banner</a></li>
												</ul>
												<ul>
															<li><a href="{{ route('themslide') }}"><i class="glyphicon glyphicon-record"></i> Thêm side banner mới</a></li>
												</ul>
										</li>
										<li class="submenu">
												<a href="{{ route('quanlysanpham') }}">
														<i class="glyphicon glyphicon-tasks"></i>
														<span class="caret pull-right"></span> Quản lí tin tức
												</a>
										
												<ul>
															<li><a href="{{route('danhsachtintuc')}}"><i class="glyphicon glyphicon-record"></i> Danh sách tin tức</a></li>
												</ul>
												<ul>
															<li><a href="{{route('dangtinmoi')}}"><i class="glyphicon glyphicon-record"></i> Đăng tin mới</a></li>
												</ul>
										</li>
                </ul>
             </div>
		  </div>