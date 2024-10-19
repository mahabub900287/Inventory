<label class="form-label">Product</label>
<select class="ic-select3" id="productSelect">
    @foreach ($products as $product)
        <option value="{{ $product->product_id }}" data-name="{{ $product->product->name }}"
            data-sku="{{ $product->product->sku }}" data-stock="{{ $product->stock }}" data-type="product">
            {{ $product->product->name }}
        </option>
    @endforeach
</select>
