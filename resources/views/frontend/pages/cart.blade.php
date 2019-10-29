@extends('frontend.layouts.maintemplate')

  @section('bodycontent')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <ul class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i></a></li>
        <li><a href="{{ route('carts') }}">Cart Page</a></li>
      </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h2>Cart Page</h2>

        <table class="table table-striped">
          
          <thead class="thead-dark">
            <tr>
              <th scope="col">Sl No.</th>
              <th scope="col">Product Title</th>
              <th scope="col">Product Image</th>
              <th scope="col">Product Quantity</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>

          <tbody>
            @foreach (App\Cart::totalCarts() as $cart)
            <tr>
              <th scope="row">{{ $loop->index + 1 }}</th>
              <td>{{ $cart->product->title }}</td>
              <td>
                @if( $cart->product->images->count() > 0 )
                  <img src="{{ asset('image/product-image/' . $cart->product->images->first()->image ) }}" width="100">
                @endif
              </td>
              <td>
                <form action="" method="POST">
                  @csrf
                  <input type="number" name="product_quantity" class="form-control">
                  <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </form>
              </td>
              <td>
                <form action="" method="POST">
                  @csrf
                  <input type="hidden" name="cart_id">
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
            </tr>

            @endforeach
            
          </tbody>
        </table>

      </div>
    </div>
  </div>




  @endsection