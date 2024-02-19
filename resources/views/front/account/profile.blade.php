
@extends('front.layout.app')
@section('content')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="s-body text-center mt-3">
                        <img src="assets/assets/images/avatar7.png" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="mt-3 pb-0">{{Auth::user()->name}}</h5>
                        <p class="text-muted mb-1 fs-6">{{Auth::user()->designation}}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change Profile Picture</button>
                        </div>
                    </div>
                </div>
                <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush ">
                            <li class="list-group-item d-flex justify-content-between p-3">
                                <a href="account.html">Account Settings</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="post-job.html">Post a Job</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="my-jobs.html">My Jobs</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="job-applied.html">Jobs Applied</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a href="saved-jobs.html">Saved Jobs</a>
                            </li>                                                        
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <a class="btn btn-primary" href="{{route('account.logout')}}">Logout</a>
                            </li>                                                        
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                @include('message')
                <form action="" method="put" id="userForm" name="userForm">
                    @csrf
                <div class="card border-0 shadow mb-4">
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{$user->name}}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" placeholder="Enter Email" value="{{$user->email}}" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation*</label>
                            <input type="text" name="designation" id="designation" placeholder="Designation" value="{{$user->designation}}" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile*</label>
                            <input type="text" name="mobile" id="modile" placeholder="Mobile" value="{{$user->mobile}}" class="form-control">
                            <p></p>
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
              </form>
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h3 class="fs-4 mb-1">Change Password</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">Old Password*</label>
                            <input type="password" placeholder="Old Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">New Password*</label>
                            <input type="password" placeholder="New Password" class="form-control">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Confirm Password*</label>
                            <input type="password" placeholder="Confirm Password" class="form-control">
                        </div>                        
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>
	<script>
       $("#userForm").submit(function(e){
               e.preventDefault();

               $.ajax({
                url: '{{route("account.updateProfile")}}',
                type: 'put',
                dataType: 'json',
                data: $("#userForm").serializeArray(),
                success: function(response){
                     if(response.status == true){

                        $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html("")
                        $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html("")
                        window.location.href = "{{route('account.profile')}}"

                     }else{
                        var errors = response.errors;
                        if(errors.name){
                        $("#name").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.name)
                    }else{
						$("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html("")
					}
                    if(errors.email){
                        $("#email").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.email)
                    }else{
						$("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html("")
					}
                     }
                }
               });
               
       }) 
    </script>
 @endsection


