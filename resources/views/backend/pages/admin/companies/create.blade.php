@extends('backend.pages.admin.layouts.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <a href="{{ route('admin.companies.index') }}" class="btn btn-primary my-4">Back</a>
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title">Add Company</h6>
                        <form class="forms-sample" action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <img class="wd-50 rounded-circle mb-4" id="showLogo"
                                    src="{{ url('logos/no_image.jpg') }}"><br>
                                <label for="logo" class="form-label">Company Logo</label>
                                <input type="file" class="form-control" name="logo" id="logo">
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Company Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary my-4">Add Company</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        $(document).ready(function() {
            $('#logo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showLogo').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            })
        })
    </script>
@endsection
