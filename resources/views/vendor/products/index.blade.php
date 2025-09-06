@extends('layouts.vendor')
@section('content')
<div class="content">

    <!-- Products Tab -->
    <div id="products">
        <div class="page-title d-flex justify-content-between align-items-center">
            <h1>Product Management</h1>
            <a href="{{ route('vendor.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Product</a>
        </div>

        <div class="product-grid mt-3">
            @foreach ($products as $p)
            <div class="product-card">
                <div class="product-image">
                    @if ($p->images && $p->images->count())
                        <img src="{{ asset('storage/' . $p->images->first()->image_path) }}" alt="{{ $p->name }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-title">{{ $p->name }}</div>
                    <div class="product-price">₦{{ number_format($p->price, 2) }}</div>
                    <div class="product-meta">
                        <span>{{ $p->quantity ?? 0 }} in stock</span>
                        <span>{{ $p->sales_count ?? 0 }} sold</span>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="action-buttons">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>
                        <a href="{{ route('vendor.products.edit', $p->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('vendor.products.destroy', $p->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return handleDeleteConfirm(this)"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function handleDeleteConfirm(button) {
        event.preventDefault(); // Prevent form submission
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('form').submit(); // Submit the form if confirmed
            }
        });
        return false;
    }

    @if(session('success'))
        Swal.fire('Success!', '{{ session('success') }}', 'success');
    @endif

    @if(session('error'))
        Swal.fire('Error!', '{{ session('error') }}', 'error');
    @endif
</script>
@endsection