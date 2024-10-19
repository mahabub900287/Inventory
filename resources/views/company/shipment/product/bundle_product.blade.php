<label class="form-label">Product</label>
<select class="ic-select3" id="productSelect">
    @foreach ($products as $product)
        <option value="{{ $product->bundle_id }}" data-name="{{ $product->bundle->name }}"
            data-sku="{{ $product->bundle->sku }}" data-stock="{{ $product->stock }}" data-type="bundle">
            {{ $product->bundle->name }}
        </option>
    @endforeach
</select>
