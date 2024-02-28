@extends('front.layout.app')
@section('content')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <div class="container py-5">
        
        <div class="row">
            @include('front.layout.partials._sidebar')
            <div class="col-lg-9 pt-3">
                <div class="d-flex justify-content-between">
                    <h2 class=""> Categories list</h2> 
                    <a class="btn btn-primary pt-3" href ="{{route('account.createCategory')}}"> Create </a>
                </div>
              
                <div class="table-responsive">
                    <table class="table ">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">category name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @if($categories ->isNotEmpty())
                             @foreach ($categories as $category)
                             <tr class="active">
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    Edit</td>
                                <td>Delete</td>
                            </tr>
                             @endforeach
                            @endif
                           
                        </tbody>
                        
                    </table>
                </div>
              
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#createCategoryForm").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '{{route('account.saveCategory')}}',
                    type: 'POST',
                    dataType: 'json',
                    data: $("#createCategoryForm").serializeArray(),
                    success: function (response) {
                        window.location.href = "{{route('account.createJob') }}";
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
