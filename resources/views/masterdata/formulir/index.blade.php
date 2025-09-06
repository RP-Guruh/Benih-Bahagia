@extends('app')
@section('content')
    <div class="main-content-container overflow-hidden">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h3 class="mb-0">Master Data Formulir</h3>

            <nav style="--bs-breadcrumb-divider: '&gt;';" aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center mb-0 lh-1">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                            <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                            <span class="text-secondary fw-medium hover">Dashboard</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Master Data</span>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <span class="fw-medium">Formulir</span>
                    </li>
                </ol>
            </nav>
        </div>

        @include('partials.alert')


        <!-- Datatable Component -->
        @php
        $columns = [
            ['label'=>'ID','data'=>'id'],
            ['label'=>'Judul','data'=>'judul'],
            ['label'=>'Jumlah Pertanyaan','data'=>'jumlah_pertanyaan'],
            ['label'=>'Usia Anak Min','data'=>'usia_min'],
            ['label'=>'Usia Anak Max','data'=>'usia_max'],
            ['label'=>'Status','data'=>'status'],
            
            
        ];
        @endphp

        <x-datatable 
            id="menu-table" 
            :ajaxUrl="url('masterdata/formulir/datatable')" 
            :columns="$columns"
            buttonAddTitle="Add new formulir"
            buttonAddUrl="masterdata/formulir/create"
            showAddButton=1 />

    </div>
@endsection
