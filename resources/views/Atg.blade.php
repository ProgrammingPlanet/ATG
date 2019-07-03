<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ATG - Task 2</title>
	<link rel="stylesheet" href="{{URL::to('/')}}/libs/css/bootstrap.min.css">
	<script src="{{URL::to('/')}}/libs/js/jquery.min.js"></script>
</head>
<body>
	<div class="container" onclick="$('#info').slideUp();"><br><br>
		<h2 class="text-center"> ATG Task 2	</h2><br><br>
		@if(Session::has('error'))
			<div class="alert alert-danger col-lg-6 mx-auto small">
				<li> {{session('error')}} </li>
			</div>
		@endif
		@if (Session::has('success'))
			<div class="alert alert-success col-lg-6 mx-auto small">
				{!! session('success') !!}
			</div>
		 @endif
		 <div class="alert alert-info col-lg-6 mx-auto small" id="info">
				
		</div>
		<!-- <form action="{{URL::to('/')}}/store" method="POST" onsubmit="return false"> -->
			<div class="col-lg-6 mx-auto">
				@csrf
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control form-control-sm" value="{{old('name')}}" id="name"><br>
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control form-control-sm" id="newpasswd" value="{{old('email')}}"><br>
				<label for="pin">PinCode</label>
				<input type="number" name="pin" class="form-control form-control-sm" id="pin" value="{{old('pin')}}"><br>
				<div class="text-center">
					<input type="submit" class="btn btn-sm btn-success" value="Submit" onclick="submit()">	
				</div>
			</div>
		<!-- </form> --><br><br><br>

		<script>
			$('#info').hide();
			function submit() {
				$('input[type=submit]').val('Wait...');
				var _name = $('input[name=name]').val();
				var _email = $('input[name=email]').val();
				var _pin = $('input[name=pin]').val();
				$.ajax({
		            url: '{{route('api.store')}}',
		            type: 'PUT',
		            data: { name: _name, email: _email, pin: _pin},
		            success:function(result){
		                result = $.parseJSON(result);
		                //console.log(result);
		                if(result.status==1){
		                    $('#info').html('<span class="text-success">'+result.msg+'</span>');
		                    $('#tbl').append('<tr><td>'+_name+'</td><td>'+_email+'</td><td>'+_pin+'</td></tr>'); 
		                }
		                else
		                    $('#info').html('<span class="text-danger">'+result.msg+'</span>');
		                $('#info').slideDown();
		                $('input[type=submit]').val('Submit');
		                //console.log(result);
		            },
		            error:function(response) {
		                
		                console.log(response);
		                $('input[type=submit]').val('Submit');
		            }
		        });
			}

		</script>

		<div class="container text-center">
			
			@if(sizeof($persons) > 0)
			<h3 class="text-center">Data Table</h3><br>
				<table class="table table-bordered">
					<thead class="bg-info">
						<tr>
							<td>Name</td>
							<td>Email</td>
							<td>Pin</td>
						</tr>
					</thead>
					<tbody class="bg-warning" id="tbl">				
						@foreach($persons as $person)
							
							<tr>
								<td>{{$person['name']}}</td>
								<td>{{$person['email']}}</td>
								<td>{{$person['pin']}}</td>
							</tr>

						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div><br><br><br><br>
</body>
</html>

$('div').last().hide()