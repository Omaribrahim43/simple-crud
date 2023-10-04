@extends('backend.pages.admin.layouts.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary my-4"><i class="fa-solid fa-plus"></i> Add Company</a>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa-solid fa-building me-1"></i>
                        Employees
                    </div>
                    <div class="card-body">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
