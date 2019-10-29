<form action="{{ route('carts.store') }}" class="form-inline" method="post">
	@csrf
	<input type="hidden" name="product_id" value="{{ $product->id }}">
	<button type="submit" class="addtocart-btn">Add to Cart</button>
</form>