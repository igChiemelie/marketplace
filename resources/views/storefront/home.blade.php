@extends('layouts.app')
@section('content')
<h2>Featured Products</h2>
<div class="row">
  @foreach($featured as $p)
    <div class="col-md-3 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $p->name }}</h5>
          <p class="card-text">{{ number_format($p->price,2) }}</p>
          <a href="#" class="btn btn-sm btn-outline-primary">View</a>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Products</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $product->name }}</h5>
                    <p>{{ $product->price }} USD</p>
                    <a href="{{ route('products.show',$product->slug) }}" class="btn btn-primary">View</a>
                    <form action="{{ route('cart.add',$product) }}" method="post" class="d-inline">
                        @csrf
                        <button class="btn btn-success">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
