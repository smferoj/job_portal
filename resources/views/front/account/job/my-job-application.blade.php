job application
@extends('front.layout.app')
@section('content')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Job Applied </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            @include('front.layout.partials._sidebar')
            
            <div class="col-lg-9">
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Job Applied</h3>
                            </div>
                            <div style="margin-top: -10px;">
                                <a href="{{route('account.createJob')}}" class="btn btn-primary">Post a Job</a>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Applied Date</th>
                                        <th scope="col">Applicants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if($jobApplications ->isNotEmpty())
                                     @foreach ($jobApplications as $jobApplication)
                                     <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{$jobApplication->job->title}}</div>
                                            <div class="info1">{{$jobApplication->job->jobType->name}}. {{$jobApplication->job->location}}</div>
                                        </td>
                                        <td>{{\Carbon\Carbon::parse($jobApplication->create_at)->format('d M, Y')}}</td>
                                        <td>{{$jobApplication->job->applications->count()}} Applications</td>
                                        <td>
                                            @if ($jobApplication->job->status == 1)
                                            <div class="job-status text-capitalize">active</div>
                                            @else
                                            <div class="job-status text-capitalize">Block</div>
                                            @endif
                                           
                                        </td>
                                        <td>
                                            <div class="action-dots float-end">
                                                <button href="#" class="btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>
                                                
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="{{route("jobDetail", $jobApplication->job_id)}}"> <i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="removeJob({{$jobApplication->id}})"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                     @endforeach
                                    @endif
                                   
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div> 
                {{$jobApplications->links()}}
            </div>

        </div>
        </div>
    </div>

	<script>
     function removeJob(id) {
    if (confirm('Are you sure to remove')) {
        $.ajax({
            url: '{{ route("account.removeJob") }}',
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { id: id },
            dataType: 'json',
            success: function (response) {
                window.location.href = "{{ route('account.myJobApplication') }}";
            }
        });
    }
}


    </script>
 @endsection







