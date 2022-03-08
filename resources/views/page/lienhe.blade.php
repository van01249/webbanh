@extends('master')
@section('content')
<style>
	.brandLi{
		padding: 10px;
	}
	.brandLi b { font-size: 16px; color: #FE980F; }
</style>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=328424237576689";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">  

					<h2 class="title text-center">LIÊN HỆ <strong>CHÚNG TÔI</strong></h2>    			    				    							
					<div id="gmap"  class="contact-map">
							
							<div class="abs-fullwidth beta-map wow flipInX">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5155634190037!2d105.73587971424573!3d21.0520609923599!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454f777de8cad%3A0xef948a65db9e4dce!2zMTEyLCAxMCBQaOG7kSBOZ3V5w6puIFjDoSwgTWluaCBLaGFpLCBU4burIExpw6ptLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1645251043612!5m2!1svi!2s" width="1150px" height="420px" frameborder="0" style="border:1px solid white;border-radius: 10px 10px 10px 10px;" allowfullscreen></iframe>						
					</div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Liên lạc</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form  action="{{route('lien-he')}}" method="post" class="contact-form" id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				    	<input type="hidden" name="_token" value="{{csrf_token()}}">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" placeholder="Họ tên" required="required" value="">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" placeholder="Email" required="required" value="">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Tiêu đề">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung liên lạc"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info" style="font-size: 13px">
	    				<h2 class="title text-center">THÔNG TIN LIÊN HỆ</h2>
	    				<address>
	    					<p>Cake Bakerry</p>
							<p>Số 6, 112/12 Nguyên Xá - Minh Khai - Bắc Từ Liêm - Hà Nội</p>
							<p></p>
							<p>Di Động: +84 396646090</p>
							<p></p>
							<p>Email: phonglang01249@gmail.com</p>
	    				</address>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
@endsection