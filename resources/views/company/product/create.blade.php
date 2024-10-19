<x-admin.layouts.app :title="getbreadcumb()">
    <x-company.partials.invertory_head></x-company.partials.invertory_head>
    <x-company.partials.product_head></x-company.partials.product_head>
    <div class="inventory-heading">
        <h4 class="ic-top-title ">Create Product</h4>
    </div>
    <div class="ic-upload-content ic-table-content rounded-0">
        <div class="row mt_30 mb_30 justify-content-center">
            <div class="col-xxl-7 col-xl-10 col-lg-9 col-12">
                <div class="d-flex justify-content-end">
                    <ul class="nav nav-pills ic-product-tab-wrapper mb_30" id="pills-tab" role="tablist">
                        <!-- Product -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ getActiveTab() == 'bundle' ? '' : 'active' }}"
                                id="pills-product-tab" data-bs-toggle="pill" data-bs-target="#pills-product"
                                type="button" role="tab" aria-controls="pills-product" aria-selected="true">
                                <svg class="product" width="24px" height="24px" version="1.1" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g fill="none" fill-rule="evenodd">
                                        <rect class="layer-box" width="24" height="24"></rect>
                                        <path class="layer-fill"
                                            d="m12.707 3.7071 7.5858 7.5858c0.39052 0.39052 0.39052 1.0237 0 1.4142l-7.5858 7.5858c-0.39052 0.39052-1.0237 0.39052-1.4142 0l-7.5858-7.5858c-0.39052-0.39052-0.39052-1.0237 0-1.4142l7.5858-7.5858c0.39052-0.39052 1.0237-0.39052 1.4142 0zm-0.70711 4.7929c-1.933 0-3.5 1.567-3.5 3.5s1.567 3.5 3.5 3.5 3.5-1.567 3.5-3.5-1.567-3.5-3.5-3.5z"
                                            fill="#000" fill-opacity="0"></path>
                                        <g class="layer-stroke" transform="translate(3 3)" stroke="#000"
                                            stroke-width="1.5">
                                            <path
                                                d="m9.7071 0.70711 7.5858 7.5858c0.39052 0.39052 0.39052 1.0237 0 1.4142l-7.5858 7.5858c-0.39052 0.39052-1.0237 0.39052-1.4142 0l-7.5858-7.5858c-0.39052-0.39052-0.39052-1.0237 0-1.4142l7.5858-7.5858c0.39052-0.39052 1.0237-0.39052 1.4142 0z"
                                                stroke-linejoin="round"></path>
                                            <circle cx="9" cy="9" r="3.5"></circle>
                                        </g>
                                    </g>
                                </svg>
                                <span>Product</span></button>
                        </li>
                        <!-- Bundle -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ getActiveTab() == 'bundle' ? 'active' : '' }}"
                                id="pills-bundle-tab" data-bs-toggle="pill" data-bs-target="#pills-bundle"
                                type="button" role="tab" aria-controls="pills-bundle" aria-selected="false">
                                <svg class="bundle" width="24px" height="24px" version="1.1" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g fill="none" fill-rule="evenodd">
                                        <rect class="layer-box" width="24" height="24"></rect>
                                        <circle class="layer-fill" cx="6.5" cy="17.5" r="3.5" fill="#000"
                                            fill-opacity="0"></circle>
                                        <g class="layer-stroke" stroke="#000" stroke-width="1.5">
                                            <g transform="translate(3 3)">
                                                <circle cx="3.5" cy="14.5" r="3.5"></circle>
                                                <rect x="11" y="11" width="7" height="7"
                                                    stroke-linejoin="round">
                                                </rect>
                                                <polygon points="9 0 13 7 5 7" stroke-linejoin="round">
                                                </polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <span>Bundle</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade {{ getActiveTab() == 'bundle' ? '' : 'show active' }}" id="pills-product"
                        role="tabpanel" aria-labelledby="pills-product-tab">
                        <x-form method="POST" action="{{ route('company.product.store') }}"
                            enctype="multipart/form-data">
                            <div class="ic-manual-content">
                                <div class="top-heading mb_30">
                                    <h4 class="mb-1">Type — Product</h4>
                                    <p class="" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Standard selling item">
                                        Standard selling item <i class="ri-question-line"></i>
                                    </p>
                                </div>

                                <div class="row ic_form">
                                    <div class="col-md-6">
                                        <div class="mb_20">

                                            <x-form_input label="Name" placeholder="Name of the product"
                                                name="name" errorName='name' value="{{ old('name') }}"
                                                required="required">
                                            </x-form_input>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb_20">
                                            <x-form_input label="SKU" placeholder="Sku of the product"
                                                name="sku" errorName='sku' value="{{ old('sku') }}"
                                                required="required">
                                            </x-form_input>
                                            {{-- <label class="form-label">SKU (Auto Genarate)</label>
                                            <input type="text" class="form-control"
                                                placeholder="This sku auto genarate" readonly> --}}
                                        </div>
                                    </div>


                                </div>

                                <div class="row ic_form mt_30">
                                    <div class="col-md-6">
                                        <div class="mb_20 form-check-wrapper">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="track-organic"
                                                    name="type[]"
                                                    {{ in_array('Track Organic', old('type', [])) ? 'checked' : '' }}
                                                    value="Track Organic">
                                                <label class="form-check-label" for="track-organic">Track
                                                    Organic</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="track-lot-expiry"
                                                    name="type[]"
                                                    {{ in_array('Track Lot & Expiry', old('type', [])) ? 'checked' : '' }}
                                                    value="Track Lot & Expiry">
                                                <label class="form-check-label" for="track-lot-expiry">Track Lot &
                                                    Expiry</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="fragile"
                                                    name="type[]"
                                                    {{ in_array('Fragile', old('type', [])) ? 'checked' : '' }}
                                                    value="Fragile">
                                                <label class="form-check-label" for="fragile">Fragile</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 ">
                                        <div class="ic-prepacked">
                                            <div class="top-content">
                                                <div class="form-check form-switch  ic-check">
                                                    <input class="form-check-input prepacked-switch" name="prepacked"
                                                        {{ old('prepacked') == 'on' ? 'checked' : '' }} type="checkbox"
                                                        id="flexSwitchCheckChecked">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckChecked">Prepacked</label>
                                                </div>
                                                <div class="icon">
                                                    <svg class="pre-packaged" width="24px" height="24px"
                                                        version="1.1" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <rect class="layer-box" width="24" height="24">
                                                            </rect>
                                                            <path class="layer-fill"
                                                                d="m12 3 9 4-9 4 4.1213-1.8319c-0.90158-1.3096-2.4112-2.1681-4.1213-2.1681-1.7106 0-3.2205 0.85897-4.122 2.1691l9.7398e-4 -0.0010994-4.879-2.168 9-4z"
                                                                fill="#000" fill-opacity="0"></path>
                                                            <g class="layer-stroke" transform="translate(3 3)"
                                                                stroke="#7f7f7f" stroke-linejoin="round"
                                                                stroke-width="1.5">
                                                                <polygon points="9 0 18 4 9 8 0 4"></polygon>
                                                                <polygon points="0 4 9 8 9 18 0 14"></polygon>
                                                                <polygon points="9 8 18 4 18 14 9 18"></polygon>
                                                                <path
                                                                    d="m9 4c1.7101 0 3.2197 0.85853 4.1213 2.1681l-4.1213 1.8319-4.122-1.8309c0.9015-1.3101 2.4114-2.1691 4.122-2.1691z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>

                                            </div>
                                            <div class="mid-content prepacked-content"
                                                {{ old('prepacked') == 'on' ? 'style=display:block' : 'style=display:none' }}>
                                                <div class="mb_20">
                                                    <label class="form-label">Length</label>
                                                    <div class="input-group">
                                                        <input type="number" name="pre_length" id="pre_length"
                                                            value="{{ old('pre_length') }}" class="form-control"
                                                            placeholder="0">
                                                        <span class="input-group-text">cm</span>
                                                        @if (!empty('pre_length'))
                                                            @error('pre_length')
                                                                <span class="err-txt">{{ $message }}</span>
                                                            @enderror
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb_20">
                                                    <label class="form-label">Width</label>
                                                    <div class="input-group">
                                                        <input type="number" name="pre_width" id="pre_width"
                                                            value="{{ old('pre_width') }}" class="form-control"
                                                            placeholder="0">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    @if (!empty('pre_width'))
                                                        @error('pre_width')
                                                            <span class="err-txt">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>

                                                <div class="mb_20">
                                                    <label class="form-label">Height</label>
                                                    <div class="input-group">
                                                        <input type="number" name="pre_height" id="pre_height"
                                                            value="{{ old('pre_height') }}" class="form-control"
                                                            placeholder="0">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                    @if (!empty('pre_height'))
                                                        @error('pre_height')
                                                            <span class="err-txt">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                            </div>
                                            <div class=" prepacked-content">
                                                <div class="bottom-content">
                                                    <div class="icon">
                                                        <svg class="pre-packaged" width="24px" height="24px"
                                                            version="1.1" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <rect class="layer-box" width="24"
                                                                    height="24">
                                                                </rect>
                                                                <path class="layer-fill"
                                                                    d="m12 3 9 4-9 4 4.1213-1.8319c-0.90158-1.3096-2.4112-2.1681-4.1213-2.1681-1.7106 0-3.2205 0.85897-4.122 2.1691l9.7398e-4 -0.0010994-4.879-2.168 9-4z"
                                                                    fill="#000" fill-opacity="0"></path>
                                                                <g class="layer-stroke" transform="translate(3 3)"
                                                                    stroke="#7f7f7f" stroke-linejoin="round"
                                                                    stroke-width="1.5">
                                                                    <polygon points="9 0 18 4 9 8 0 4"></polygon>
                                                                    <polygon points="0 4 9 8 9 18 0 14"></polygon>
                                                                    <polygon points="9 8 18 4 18 14 9 18"></polygon>
                                                                    <path
                                                                        d="m9 4c1.7101 0 3.2197 0.85853 4.1213 2.1681l-4.1213 1.8319-4.122-1.8309c0.9015-1.3101 2.4114-2.1691 4.122-2.1691z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <p>
                                                        Add measurements to see the size category
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row ic_form mt_30 align-items-center">
                                    <div class="col-12">
                                        <h4 class="mb_20">Product Weight</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb_20">
                                            <label class="form-label">Weight</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="weight"
                                                    value="{{ old('weight') }}" placeholder="Add product weight...">
                                                <span class="input-group-text">kg</span>
                                            </div>
                                            @if (!empty('weight'))
                                                @error('weight')
                                                    <span class="err-txt">{{ $message }}</span>
                                                @enderror
                                            @endif
                                            <!-- if needed to show erro/warning msg -->
                                            <!-- <span class="err-txt">Must be at least 1</span> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb_20">
                                            <div class="ic-input-alert ">
                                                <div class="icon">
                                                    <i class="ri-information-line"></i>
                                                </div>
                                                <p>
                                                    Product weight is mandatory if the product is dangerous good or
                                                    needs to
                                                    go through customs.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb_20">
                                            <label class="form-label">Description (optional)</label>
                                            <textarea class="form-control ic-textarea" name="description" value="{{ old('description') }}" rows="3"
                                                placeholder="Write description">{{ old('description') }}</textarea>
                                            @if (!empty('description'))
                                                @error('description')
                                                    <span class="err-txt">{{ $message }}</span>
                                                @enderror
                                            @endif
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
                                        <div class="ic-single-accordian-content"style="display: block">
                                            <div class="row ic_form">

                                                <div class="col-md-6">
                                                    <div class="mb_20">
                                                        <x-form_input label="Customs Tariff Number"
                                                            placeholder="6-10 digit code" name="tariff_number"
                                                            errorName='tariff_number'
                                                            value="{{ old('tariff_number') }}" optional>
                                                        </x-form_input>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb_20">
                                                        <label for="" class="form-label">Country</label>
                                                        <select class="ic-select" name="country_id"
                                                            aria-label="Select country" data-live-search="true"
                                                            placeholder="Select country">
                                                            @foreach ($countrys as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('country_id') == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
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
                                    <a role="button" class="ic-button white " href="product-inventory.php">
                                        Cancel
                                    </a>

                                    <button class="ic-button primary">
                                        <i class="ri-checkbox-circle-line"></i>
                                        <span>Confirm</span>
                                    </button>
                                </div>
                            </div>
                        </x-form>
                    </div>
                    <!-- bundle -->
                    <div class="tab-pane fade {{ getActiveTab() == 'bundle' ? 'show active' : '' }}"
                        id="pills-bundle" role="tabpanel" aria-labelledby="pills-bundle-tab">
                        <x-form method="POST" action="{{ route('company.bundle-product.store') }}"
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
                                            <x-form_input label="Name" placeholder="Name of the bundle"
                                                name="name" errorName='name' value="{{ old('name') }}"
                                                required="required">
                                            </x-form_input>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb_20">
                                            <x-form_input label="SKU" placeholder="Sku of the bundle"
                                                name="sku" errorName='sku' value="{{ old('sku') }}"
                                                required="required">
                                            </x-form_input>
                                            {{-- <label class="form-label">SKU (Auto Genarate)</label>
                                            <input type="text" class="form-control"
                                                placeholder="This sku auto genarate" readonly> --}}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb_20">
                                            <label class="form-label">Description (optional)</label>
                                            <textarea class="form-control ic-textarea" name="description" value="{{ old('description') }}" rows="3"
                                                placeholder="Write description">{{ old('description') }}</textarea>
                                        </div>
                                    </div>


                                </div>

                                <div class="row ic_form mt_30 align-items-center">
                                    <div class="col-12">
                                        <h4 class="mb_20">Bundle Ingredients</h4>
                                    </div>
                                    <!-- add-product-wrapper start -->
                                    <div class="col-12">
                                        <div id="pushProduct"></div>
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


                                        <div class="ic-single-accordian-content" style="display: block">
                                            <div class="row ic_form">
                                                <div class="col-md-6">
                                                    <div class="mb_20">
                                                        <x-form_input label="Customs Tariff Number"
                                                            placeholder="6-10 digit code" name="tariff_number"
                                                            errorName='tariff_number'
                                                            value="{{ old('tariff_number') }}" optional>
                                                        </x-form_input>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb_20">
                                                        <label for="" class="form-label">Country</label>
                                                        <select class="ic-select" name="country_id"
                                                            aria-label="Select country" data-live-search="true"
                                                            placeholder="Select country">
                                                            @foreach ($countrys as $item)
                                                                <option value="{{ $item->id }}"
                                                                    {{ old('country_id') == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inventory-heading bottom">
                                <div class="right-button-group justify-content-end w-100">
                                    <a role="button" class="ic-button white"
                                        href="{{ route('company.product.index') }}">
                                        Cancel
                                    </a>

                                    <button class="ic-button primary">
                                        <i class="ri-checkbox-circle-line"></i>
                                        <span>Confirm</span>
                                    </button>
                                </div>
                            </div>
                        </x-form>
                    </div>

                </div>
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
                // $('#workingHour').repeater({
                //     initEmpty: false,
                //     defaultValues: {
                //         'text-input': 'foo'
                //     },
                //     show: function() {
                //         if (!$('.ic-select-2:first').hasClass('ic-select-first')) {
                //             $('.ic-select-2').removeClass('ic-select-1')
                //         }
                //         // select picker
                //         $(this).find('.ic-select-2').selectpicker();
                //         $(this).slideDown();
                //     },
                //     hide: function(deleteElement) {
                //         $(this).find('.ic-select-2').selectpicker('destroy');
                //         $(this).slideUp(deleteElement);
                //     }
                // });
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
