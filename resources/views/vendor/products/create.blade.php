@extends('layouts.vendor')
@section('content')
<div class="content">
    <div class="page-title d-flex justify-content-between align-items-center">
        <h1>Add New Product</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendor.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label>SKU</label>
            <input type="text" class="form-control" name="sku" value="{{ old('sku') }}" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label>Price (₦)</label>
            <input type="number" class="form-control" name="price" step="0.01" value="{{ old('price') }}" required>
        </div>
        <div class="form-group">
            <label>Stock Quantity</label>
            <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}" required>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select class="form-control" name="category_id" required>
                <option value="">Select Category</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Product Images</label>
            <input type="file" class="form-control" name="images[]" multiple accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Save Product</button>
        <a href="{{ route('vendor.products.index') }}" class="btn">Cancel</a>
    </form>
</div>
@endsection