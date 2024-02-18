
@extends('front.layout.app')

@section('content')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="" name="registrationForm" id="registrationForm">
						@csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
							<p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
							<p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
							<p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" name="c_password" id="c_password" class="form-control" placeholder="Enter Confirm Password">
							<p></p>
                        </div> 
                        <button class="btn btn-primary mt-2">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a  href="login.html">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>


	<script>
    $("#registrationForm").submit(function(e){
        e.preventDefault();
          
        $.ajax({
            url: "{{route('account.processRegistration')}}",
            type:'post',
            data:$("#registrationForm").serializeArray(),
            dataType: 'json',
            success:function(response){
                if(response.status == false){
                    var errors = response.errors;
                    if(errors.name){
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name)
                    }else{
						$("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
					}
                    if(errors.email){
                        $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email)
                    }else{
						$("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
					}
                    if(errors.password){
                        $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password)
                    }else{
						$("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("")
					}
                }else{

				}
            }
        });
    });
</script>


 @endsection


