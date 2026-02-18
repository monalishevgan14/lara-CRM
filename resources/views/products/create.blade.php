@extends('layouts.app')

@section('page_title', 'Add Product')

@section('back_url', route('products.index'))

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Product Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Enter product name"
                           value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Price</label>
                    <input type="number"
                           name="price"
                           class="form-control"
                           placeholder="Enter price"
                           value="{{ old('price') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Stock</label>
                    <input type="number"
                           name="stock"
                           class="form-control"
                           placeholder="Enter stock quantity"
                           value="{{ old('stock') }}">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i> Save Product
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
