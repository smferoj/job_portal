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
							<h3 class="fs-4 mb-1">Saved Job</h3>
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
								@if($savedJobs ->isNotEmpty())
								@foreach ($savedJobs as $savedJob)
								<tr class="active">
									<td>
										<div class="job-name fw-500">{{$savedJob->job->title}}</div>
										<div class="info1">{{$savedJob->job->jobType->name}}. {{$savedJob->job->location}}</div>
									</td>
									<td>{{\Carbon\Carbon::parse($savedJob->create_at)->format('d M, Y')}}</td>
									<td>{{$savedJob->job->applications->count()}} Applications</td>
									<td>
										@if ($savedJob->job->status == 1)
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
												<li><a class="dropdown-item" href="{{ route('jobDetail', $savedJob->job_id) }}"><i class="fa fa-eye" aria-hidden="true"></i> View</a></li>
												<li><a class="dropdown-item" href="#" onclick="removeSavedJob('{{$savedJob->id}}')"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a></li>
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
			{{$savedJobs->links()}}
		</div>

	</div>
</div>
</div>

<script>
	function removeSavedJob(id) {
		if (confirm('Are you sure to remove')) {
			$.ajax({
				url: '{{ route("account.removeSavedJob") }}',
				type: 'get',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data: {
					id: id
				},
				dataType: 'json',
				success: function(response) {
					window.location.href = "{{ route('account.myJobApplication') }}";
				}
			});
		}
	}
</script>
@endsection