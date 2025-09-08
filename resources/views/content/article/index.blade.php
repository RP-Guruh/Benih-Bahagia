@extends('app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Content - Article</h3>

            <nav style="--bs-breadcrumb-divider: '&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Edukasi</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Article</span>
                    </li>
                </ol>
            </nav>
        </div>

        @include('partials.alert')


        <!-- Datatable Component -->
        @php
        $columns = [
            ['label'=>'ID','data'=>'id'],
            ['label'=>'Title','data'=>'title'],
            ['label'=>'Slug','data'=>'slug'],
        ];
        @endphp

        <x-datatable 
            id="menu-table" 
            :ajaxUrl="url('content/article/datatable')" 
            :columns="$columns"
            buttonAddTitle="Tambah data artikel"
            buttonAddUrl="content/article/create"
            showAddButton=1 />

    </div>
@endsection
