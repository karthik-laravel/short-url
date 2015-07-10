

@extends('template')

@section('content')

<script>
function geturl(){
 $.ajax({
      url: 'urls',
      type: "post",
	  dataType:'json',
      data: {'long_url':$('input[name=long_url]').val(), '_token': $('input[name=_token]').val()},
      success: function(data){
	  console.log("{{url()}}");
		
        $('#url').val("{{url()}}/"+data['short_url']);
		$('#url').select();
      }
    });      

 } 
 </script>
	<div class="row" style="margin-top:100px;">
		<div class="col col-lg-3"></div>
		<div class="col col-lg-6" id="log_url_div">
			<div class="row" >
				<div class="col-lg-4">
				</div>
				<div class="col-lg-4">
					<img src="{{ URL::asset('resources/assets/img/logo_website.png') }}" style="padding-bottom:50px;"></img>
				</div>
				
			</div>
			{!! Form::open(['url' => 'urls']) !!}
			<div class="row" >
				<div class="col-lg-9">
					<div class="form-group">
					
						{!! Form::text('long_url',null,['class'=>'form-control ','id'=>'url','placeholder'=>'Put your long URL that is to be shortened, here!']) !!}
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						
						{!! Form::button('Shorten', array('class'=>'send-btn btn-primary form-control','onclick'=>'geturl()')) !!}
					</div>
				</div>
			
			
		   
			
			</div>
			@if(Session::has('message'))
				<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
			@endif
		</div>
		</div>
		
			<div class="col col-lg-4"></div>
			<div class="col col-lg-4">
				<div id='short_url_div' style="display:none">
					<div class="form-group">
						{!! Form::label('Short Url', 'Short Url:') !!}
						{!! Form::text('short_url',null,['class'=>'form-control','id'=>'short_url']) !!}
					</div>
				</div>
			</div>
	</div>
    {!! Form::close() !!}
	<footer class="footer"  >
		<div class="container">
			<div class="col col-lg-4"></div>
			<div class="col col-lg-6" >
				<p class="text-muted" style="margin-top:300px !important;">© Copyright 2015 Gito.me | All Rights Reserved.</p>
			</div>
		</div>
	</footer>
	
@stop
