
@extends('front.layout.app')

@section('content')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        @if(Session::has('success'))
        <div class="alert alert-success sessionMessage">
          <span> {{Session::get('success')}} </span>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger sessionMessage">
          <span> {{Session::get('error')}} </span>
        </div>
        @endif
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Login</h1>
                    <form action="{{route('account.auhtenticate')}}"  method="POST" name="registrationForm" id="registrationForm">
						@csrf
                        <div class="mb-3">
                            <label for="" class="mb-2">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
							 @error('email')
                             <p class="invalid-feedback">{{$message}}</p>
                             @enderror
                        </div> 
                        <div class="mb-3">
                            <label for="" class="mb-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Enter Password">
                            @error('password')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div> 
                     
                        <button type="submit" class="btn btn-primary mt-2">Login</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have'nt account? <a  href="{{route('account.registration')}}">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        function removeSessionMessage() {
            $('.sessionMessage').remove();
        }
        setTimeout(removeSessionMessage, 3000); 
    });
</script>

	
 @endsection


