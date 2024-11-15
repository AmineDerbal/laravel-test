@extends('app')
@section('content')


<div>
  <div class="container mt-5 d-flex flex-column align-items-center p-1 ">
    <h1>Create New Product</h1>
    <form action="{{ route('products.store') }}" method="POST" class="mt-3">
      @csrf
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('title', $product->name ?? '') }}"
          required>
      </div>
      <div class="form-group">
        <label for="quantity">Quantity in Stock</label>
        <input type="number" class="form-control" name="quantity" id="quantity"
          value="{{ old('quantity', $product->quantity ?? '') }}" required>
      </div>
      <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" name="price" id="price"
          value="{{ old('price', $product->price ?? '') }}" required>
      </div>
      <button type="submit" class="btn btn-primary waves-effect waves-light my-3">Create Product</button>
    </form>
    <h2 class="mt-5">List of Products</h2>
    <ul id="task-list" class="list-group ">
      @foreach ($products as $product)
      <li class="list-group-item d-flex justify-content-between align-items-center gap-3">
        <p class="fw-bold">{{ $product['name'] }}:</p>
        <p class="fw-bold">Quantity: {{ $product['quantity'] }}</p>
        <p class="fw-bold">Price: ${{ $product['price'] }}</p>
        <p class="fw-bold">Created At: {{ $product['date_created'] }}</p>
        <p class="fw-bold">Total: ${{ $product['quantity'] * $product['price'] }}</p>
      </li>
      @endforeach
    </ul>
    <div class="mt-5 flex d-flex align-items-center gap-1">
      <h2>Total Value of All Products: </h2>
      <h2 class="fw-bold">${{ $totalPrice }}</h2>
    </div>
  </div>

</div>


@endsection