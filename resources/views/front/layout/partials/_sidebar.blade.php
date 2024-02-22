<div class="col-lg-3">
    <div class="card border-0 shadow mb-4 p-3">
        <div class="s-body text-center mt-3">
           
            @if(Auth::user()->image != '')
            <img id="profileImage" src="{{asset('profile_pic/'.Auth::user()->image)}}" alt="avatar"   class="rounded-circle img-fluid" style="width: 75px;">
            @else
            <img src="{{asset('assets/images/avatar.png')}}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
            @endif
            
            <h5 class="mt-3 pb-0">{{Auth::user()->name}}</h5>
            <p class="text-muted mb-1 fs-6">{{Auth::user()->designation}}</p>
            <div class="d-flex justify-content-center mb-2">
                <button data-bs-toggle="modal" data-bs-target="#editPicModal" type="button" class="btn btn-primary">Change Profile Picture</button>
            </div>
        </div>
    </div>
    <div class="card account-nav border-0 shadow mb-4 mb-lg-0">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush ">
                <li class="list-group-item d-flex justify-content-between p-3">
                    <a href="{{route('account.myJobs')}}">Account Settings</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <a href="{{route('account.createJob')}}">Post a Job</a>
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

    <div class="modal fade" id="editPicModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
       
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="profilePicForm" name="profilePicForm" method="post">
                @csrf
            <div class="modal-body">
              <label for="" class="form-label"> Profile Image</label>
              <input type="file" class="form-control" id="image" name="image">
              <p class="text-danger" id="image-error"> </p>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
         </form>
          </div>
        </div>
      </div>
  
</div>

<script>
     $("#profilePicForm").submit(function(e){
        e.preventDefault();
        
        var formData = new FormData(this);
        $.ajax({
            url:"{{route('account.updateProfilePic')}}",
            type:'post',
            data: formData,
            dataType:'json',
            contentType:false,
            processData:false,
            success: function(response){
              if(response.status == false){
                var errors = response.errors;
                if(errors.image){
                   $("#image-error").html(errors.image);
                }else{
                    window.location.href ='{{url()->current()}}'
                }
              }else{
                $("#profileImage").attr("src", "{{ asset('profile_pic/') }}" + '/' + response.image);
                 $("#editPicModal").modal("hide"); 
              }
              
            }
        })
        
     })
</script>