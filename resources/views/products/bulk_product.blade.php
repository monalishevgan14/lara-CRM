@extends('layouts.app')

@section('page_title', 'Add Bulk Product')

@section('back_url', route('products.index'))

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">

            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form action="{{ route('products.import') }}" 
                            method="POST" 
                            enctype="multipart/form-data"
                            class="d-flex gap-2 align-items-center">
                            @csrf

                            <input type="file" 
                                name="csv_file" 
                                class="form-control form-control-sm"
                                required>

                            <button type="submit" 
                                    class="btn btn-success btn-sm px-3">
                                ⬆ Upload CSV
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
