@extends('layouts.app')

@section('page_title', 'Product List')

@section('content')

{{-- <h3 class="mb-2 fw-bold">Product List</h3> --}}

{{-- Success Message --}}
@if(session('success'))
    <div id="success-alert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


{{-- 🔍 Search + Filter --}}
<form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4">

    <div class="col-md-3">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search product..."
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="stock" class="form-select">
            <option value="">All Stock</option>
            <option value="in" {{ request('stock')=='in'?'selected':'' }}>In Stock</option>
            <option value="out" {{ request('stock')=='out'?'selected':'' }}>Out of Stock</option>
            <option value="low" {{ request('stock')=='low'?'selected':'' }}>Low Stock</option>
        </select>
    </div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-dark w-100">Filter</button>
    </div>

    <div class="col-md-2">
        <a href="{{ route('products.index') }}" class="btn btn-secondary w-100">Reset</a>
    </div>

    <div class="col-md-2">
        <a href="{{ route('products.create') }}" class="btn btn-primary w-100">Add Product</a>
    </div>

</form>


{{-- ================= PRODUCT TABLE ================= --}}
<form method="POST" action="{{ route('products.bulkDelete') }}">
    @csrf
    @method('DELETE')

<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                         <th>Total</th>
                        <th>Stock</th>
                        {{-- <th width="120">Action</th> --}}
                        <th class="text-center">
                            <input type="checkbox" id="select-all">
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>#{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>

                        <td>₹ {{ number_format($product->price, 2) }}</td>
                        <td> {{ $product->stock }}</td>
                        <td>

                            @if($product->stock == 0)
                                <span class="badge bg-danger ms-2">Out</span>
                            @elseif($product->stock < 10)
                                <span class="badge bg-warning text-dark ms-2">Low</span>
                            @else
                                <span class="badge bg-success ms-2">In</span>
                            @endif
                        </td>

                        {{-- <td>
                            <form method="POST"
                                  action="{{ route('products.destroy',$product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td> --}}

                        <td class="text-center">
                            <input type="checkbox"
                                   name="ids[]"
                                   value="{{ $product->id }}"
                                   class="product-checkbox">
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>


{{-- ================= PAGINATION + BUTTONS ================= --}}

<div class="d-flex justify-content-between align-items-center mt-4">

    {{-- Left: Pagination --}}
    <div>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

    {{-- Right: Buttons --}}
    <div class="d-flex gap-2">

        <a href="{{ route('products.trash') }}"
           class="btn btn-outline-warning btn-sm">
            <i class="bi bi-trash"></i> View Trash
        </a>

        <button type="submit"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure you want to delete selected products?')">
            <i class="bi bi-trash3"></i> Delete Selected
        </button>

    </div>

</div>

</form>

@endsection


@push('scripts')

<script>
// Select All Checkbox
document.getElementById('select-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.product-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

// Auto hide success message
setTimeout(function () {
    let alert = document.getElementById('success-alert');
    if (alert) alert.style.display = 'none';
}, 3000);

</script>

@endpush
