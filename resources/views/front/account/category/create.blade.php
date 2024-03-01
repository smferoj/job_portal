@extends('front.layout.app')
@section('content')
<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <div class="container py-5">
        
        <div class="row">
            @include('front.layout.partials._sidebar')
            <div class="col-lg-9">
                @include('message')
                {{-- Form --}}
                <form action="" method="post" id="createCategoryForm" name="createCategoryForm">
                    @csrf
                    <div class="card border-0 shadow mb-4 ">
                        <div class="card-body card-form p-4">
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <h2 for="category" class="m-2 ">Category</h2>
                                    <br>
                                    <input type="text" placeholder="Category Name" id="category" name="category" class="form-control mt-2">
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                        window.location.href = "{{route('account.category') }}";
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
