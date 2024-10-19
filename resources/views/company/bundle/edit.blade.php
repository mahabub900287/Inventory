<x-admin.layouts.app :title="getbreadcumb()">
    <div class="inventory-heading">
        <h4 class="ic-top-title ">Update Bundle Product</h4>
    </div>
    <div class="ic-upload-content ic-table-content rounded-0">
        <div class="row mt_30 mb_30 justify-content-center">
            <div class="col-xxl-7 col-xl-10 col-lg-9 col-12">
                <x-form method="PUT" action="{{ route('company.bundle-product.update', $item->id) }}"
                    enctype="multipart/form-data">
                    <div class="ic-manual-content">

                        <div class="top-heading mb_30">
                            <h4 class="mb-1">Type — Bundle</h4>
                            <p class="" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Multiple products sold as a single unit">
                                Multiple products sold as a single unit <i class="ri-question-line"></i>
                            </p>
                        </div>

                        <div class="row ic_form">
                            <div class="col-md-6">
                                <div class="mb_20">
                                    <x-form_input label="Name" placeholder="Name of the bundle" name="name"
                                        errorName='name' value="{{ $item->name ?? old('name') }}" required="required">
                                    </x-form_input>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb_20">
                                    <x-form_input label="SKU" placeholder="Sku of the bundle" name="sku"
                                        errorName='sku' value="{{ $item->sku ?? old('sku') }}" required="required">
                                    </x-form_input>
                                    {{-- <label class="form-label">SKU (Auto Genarate)</label>
                                    <input type="text" class="form-control" value="{{ $item->sku ?? old('sku') }}"
                                        placeholder="This sku auto genarate" readonly> --}}

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb_20">
                                    <label class="form-label">Description(optional)</label>
                                    <textarea class="form-control ic-textarea" name="description" value="{{ $item->description ?? old('description') }}"
                                        rows="3" placeholder="Write description">{{ $item->description }}</textarea>
                                    @if (!empty('description'))
                                        @error('description')
                                            <span class="err-txt">{{ $message }}</span>
                                        @enderror
                                    @endif
                                </div>
                            </div>


                        </div>

                        <div class="row ic_form mt_30 align-items-center">
                            <div class="col-12">
                                <h4 class="mb_20">Bundle Ingredients</h4>
                            </div>
                            <!-- add-product-wrapper start -->
                            <div class="col-12">
                                <div id="pushProduct">
                                    @foreach ($item->get_bundle_product as $value)
                                        <div class="row add-product-wrapper">
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">Product</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $value->get_product->name }}" readonly>
                                                    <input type="hidden" name="products[]"
                                                        value="{{ $value->product_id }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb_20">
                                                            <label class="form-label">Quantity</label>
                                                            <div class="input-group">
                                                                <span
                                                                    class="input-group-text pointer decrease-quantity">-</span>
                                                                <input type="number" name="quantity[]"
                                                                    class="form-control text-center quantity-input"
                                                                    value="{{ $value->quantity ?? old(0) }}">
                                                                <span
                                                                    class="input-group-text pointer increase-quantity">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb_20">
                                                            <label class="form-label"></label>
                                                            <div class="icon remove-icon">
                                                                <i class="ri-delete-bin-2-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row add-product-wrapper">
                                    <div class="col-md-6">
                                        <div class="mb_20">
                                            <label class="form-label">Product</label>
                                            <select id="productSelect" class="ic-select2">
                                                <option value="" selected disabled>Select a product
                                                </option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ic-info-list-accordian-wrapper mt_30">
                            <div class="ic-single-accordian">
                                <div class="ic-single-accordian-heading">
                                    <div>
                                        <h5 class="">Customs Info</h5>

                                        <p>Required if the product will be shipped through customs</p>
                                    </div>
                                    <div class="icon ic_arrow">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                </div>


                                <div class="ic-single-accordian-content">
                                    <div class="row ic_form">
                                        <div class="col-md-6">
                                            <div class="mb_20">
                                                <x-form_input label="Customs Tariff Number"
                                                    placeholder="Enter your tariff number" name="tariff_number"
                                                    errorName='tariff_number'
                                                    value="{{ $item->tariff_number ?? old('tariff_number') }}"
                                                    required="required">
                                                </x-form_input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb_20">
                                                <label for="" class="form-label">Country</label>
                                                <select class="ic-select" name="country_id"
                                                    aria-label="Select country" data-live-search="true"
                                                    placeholder="Select country">
                                                    @foreach ($countrys as $value)
                                                        <option value="{{ $value->id }}"
                                                            {{ $item->country_id == $value->id ? 'selected' : '' }}>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if (!empty('country_id'))
                                                    @error('country_id')
                                                        <span class="err-txt">{{ $message }}</span>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="inventory-heading bottom">

                        <div class="right-button-group justify-content-end w-100">
                            <a role="button" class="ic-button white " href="{{ route('company.product.index') }}">
                                Cancel
                            </a>

                            <button class="ic-button primary">
                                <i class="ri-checkbox-circle-line"></i>
                                <span>Update</span>
                            </button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
    <x-slot name="bottomScript">
        <script src="{{ asset('assets/admin/repeater/jquery.repeater.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.ic-select-1').selectpicker();
                $('#pre_length, #pre_width, #pre_height ,#weight ,.quantity-count').on('input', function() {
                    var inputValue = parseFloat($(this).val());
                    // Check if the entered value is less than 0
                    if (inputValue < 0) {
                        // If it is, set the value to 0
                        $(this).val('');
                        // Show an error message
                        $(this).siblings('.err-txt').text('Value cannot be negative').show();
                    } else {
                        // Hide the error message if the value is valid
                        $(this).siblings('.err-txt').hide();
                    }
                });

                $('.remove-icon').click(function() {
                    $(this).closest('.add-product-wrapper').remove();
                });
                // Handle product selection change
                $('#productSelect').change(function() {
                    var selectedProductId = $(this).val();
                    if (selectedProductId) {
                        // Get the selected product name
                        var selectedProductName = $('#productSelect option:selected').text();

                        // Create HTML for the selected product
                        var productHtml = '<div class="row add-product-wrapper">' +
                            '<div class="col-md-6">' +
                            '<div class="mb_20">' +
                            '<label class="form-label">Product</label>' +
                            '<input type="text" class="form-control" value="' + selectedProductName +
                            '"readonly>' +
                            '<input type="hidden" name="products[]" value="' + selectedProductId +
                            '" readonly>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<div class="row">' +
                            '<div class="col-md-8">' +
                            '<div class="mb_20">' +
                            '<label class="form-label">Quantity</label>' +
                            '<div class="input-group">' +
                            '<span class="input-group-text pointer decrease-quantity">-</span>' +
                            '<input type="number" name="quantity[]" class="form-control text-center quantity-input" value="0">' +
                            '<span class="input-group-text pointer increase-quantity">+</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<div class="mb_20">' +
                            '<label class="form-label"></label>' +
                            '<div class="icon remove-icon">' +
                            '<i class="ri-delete-bin-2-line"></i>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                        // Append the HTML to the pushProduct div
                        $('#pushProduct').append(productHtml);

                        // Clear the selected product in the dropdown
                        $('#productSelect').prop('selectedIndex', 0);

                        // Handle remove icon click
                        $('.remove-icon').click(function() {
                            $(this).closest('.add-product-wrapper').remove();
                        });

                        // Handle quantity change
                        $('.decrease-quantity').click(function() {
                            var quantityInput = $(this).closest('.row').find('.quantity-input');
                            var currentQuantity = parseInt(quantityInput.val());
                            if (currentQuantity > 0) {
                                quantityInput.val(currentQuantity - 1);
                            }
                        });

                        $('.increase-quantity').click(function() {
                            var quantityInput = $(this).closest('.row').find('.quantity-input');
                            var currentQuantity = parseInt(quantityInput.val());
                            quantityInput.val(currentQuantity + 1);
                        });
                    }
                });
            });
        </script>
    </x-slot>
    </x-admin.app>
