@extends('layouts.app')

@section('page_title', 'Trash Product')

@section('back_url', route('products.index'))

@section('content')

<div class="container mt-2">


    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"></h2>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div> --}}

    <form method="POST" action="{{ route('products.trash.bulkAction') }}">
    @csrf


    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th width="180">Action</th>
                <th width="40">
                    <input type="checkbox" id="select-all">
                </th>
            </tr>
        </thead>
        <tbody>

        @forelse($products as $product)
            <tr>
                <td>#{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>₹ {{ number_format($product->price,2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('products.restore',$product->id) }}"
                       class="btn btn-success btn-sm">
                        Restore
                    </a>

                    <a href="{{ route('products.forceDelete',$product->id) }}"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete permanently?')">
                        Delete
                    </a>
                </td>
                <td>
                    <input type="checkbox"
                        name="ids[]"
                        value="{{ $product->id }}"
                        class="product-checkbox">
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-danger">
                    No products in trash
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>

    <div class="text-end mt-4">

        <button type="submit"
                name="action"
                value="restore"
                class="btn btn-success">
            ♻ Restore Selected
        </button>

        <button type="submit"
                name="action"
                value="forceDelete"
                class="btn btn-danger"
                onclick="return confirm('Delete permanently?')">
            ❌ Delete Permanently
        </button>

    </div>

    </form>


    {{ $products->links('pagination::bootstrap-5') }}

</div>

@endsection

@push('scripts')
<script>
document.getElementById('select-all').addEventListener('click', function() {
    document.querySelectorAll('.product-checkbox')
        .forEach(cb => cb.checked = this.checked);
});
</script>
@endpush


{{-- <script>
document.getElementById('select-all').addEventListener('click', function() {
    document.querySelectorAll('.product-checkbox')
        .forEach(cb => cb.checked = this.checked);
});
</script> --}}

