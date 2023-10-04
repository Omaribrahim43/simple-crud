@extends('backend.pages.admin.layouts.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <a href="{{ route('admin.companies.index') }}" class="btn btn-primary my-4">Back</a>
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="card-title">Add Employee</h6>
                        <form class="forms-sample" action="{{ route('admin.employees.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="col-md-12 col-xl-12">
                                        <div class="mb-3">
                                            <label for="fname" class="form-label">Employee First Name</label>
                                            <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                                name="fname">
                                            @error('fname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-md-12 col-xl-12">
                                        <div class="mb-3">
                                            <label for="lname" class="form-label">Employee Last Name</label>
                                            <input type="text" class="form-control @error('lname') is-invalid @enderror"
                                                name="lname">
                                            @error('lname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="mb-3">
                                    <label for="company_id" class="form-label">Company Name</label>
                                    <select name="company_id" class="form-control">
                                        <option value="">Choose</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Employee Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary my-4">Add Employee</button>
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
