<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-status-wrapper">
        <div class="ic-stage active">
            <a href="{{ route('company.shipment.create') }}">Manually</a>
        </div>
        <div class="ic-stage ">
            <a href="{{ route('company.shipment.csv.create') }}">CSV Import</a>
        </div>
    </div>
    {{-- <div class="inventory-heading">
        <div class="right-button-group justify-content-end w-100">
            <a role="button" class="ic-button white " href="product-inventory.php">
                <i class="ri-checkbox-circle-line"></i> Create Shipment
            </a>
            <button class="ic-button primary">

                <span class="d-flex align-items-center gap-2"><i class="ri-thumb-up-line"></i> Create & Release</span>
            </button>
        </div>
    </div> --}}
    <div class="ic-upload-content ic-table-content rounded-0">
        <x-form method="POST" action="{{ route('company.shipment.store') }}" enctype="multipart/form-data">
            <div class="row mt_30 mb_30">
                <div class="col-md-8  col-12">
                    <div>
                        <div class="ic-manual-content">
                            <div class="ic-info-list-accordian-wrapper">

                                <div class="ic-single-accordian ic-shipment-recipient-area">
                                    <div class="ic-single-accordian-heading">
                                        <div class="d-flex gap-3">
                                            <h5 class=""> Recipient </h5>
                                            <span class="ic-package-type">(Please select)</span>
                                        </div>
                                        <div class="icon ic_arrow">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="ic-single-accordian-content" >
                                        <div class="row ic_form">
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <div class="ic-add-parcel-pallet-single-item">
                                                        <label class="form-label">Recipient Name</label>
                                                        <select class="ic-select3" id="addressSelect"
                                                            aria-label="Select customer address"
                                                            placeholder="Select customer address" name="address_id">
                                                            @foreach ($coustomer_address as $address)
                                                                <option value="{{ $address->id }}"
                                                                    data-countryid="{{ $address->country_id }}"
                                                                    data-countryname="{{ $address->country->name }}"
                                                                    data-street="{{ $address->street }}"
                                                                    data-phone="{{ $address->phone }}"
                                                                    data-additional="{{ $address->additional }}"
                                                                    data-postcode="{{ $address->post_code }}"
                                                                    data-city="{{ $address->city }}"
                                                                    data-state="{{ $address->state }}"
                                                                    data-companyname="{{ $address->company_name }}"
                                                                    data-companyemail="{{ $address->company_email }}"
                                                                    data-companyphone="{{ $address->company_phone }}">
                                                                    {{ $address->country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if (!empty('address_id'))
                                                            @error('address_id')
                                                                <span class="err-txt">{{ $message }}</span>
                                                            @enderror
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb_20 mt_30">
                                                    <div class="d-inline-flex gap-1 ic-shipment-collapse-btn-area">
                                                        <button class="ic-button white add-btn " type="button"
                                                            @if ($errors->any()) style="display: none" @endif
                                                            data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                                            aria-expanded="false" aria-controls="collapseExample">
                                                            <i class="ri-add-circle-line"></i> Add new
                                                        </button>
                                                        <button class="ic-button white close-btn" type="button"
                                                            @if ($errors->any()) style="display: block" @endif
                                                            data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                                            aria-expanded="false" aria-controls="collapseExample">
                                                            <i class="ri-close-circle-line"></i> Clear all
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="collapse @if ($errors->any()) show @endif"
                                                id="collapseExample">
                                                <div class="card card-body p-3">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb_20">
                                                                <x-form_input label="Street*" placeholder="Street name"
                                                                    name="street" errorName='street'
                                                                    value="{{ old('street') }}">
                                                                </x-form_input>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div class="mb_20">
                                                                <x-form_input label="Number"
                                                                    placeholder="enter your number" name="phone"
                                                                    errorName='phone' value="{{ old('phone') }}"
                                                                    optional>
                                                                </x-form_input>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div class="mb_20">
                                                                <x-form_input label="Additional"
                                                                    placeholder="Additional" name="additional"
                                                                    errorName='additional'
                                                                    value="{{ old('additional') }}" optional>
                                                                </x-form_input>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div class="mb_20">
                                                                <x-form_input label="Postal Code*"
                                                                    placeholder="Postal Code" name="post_code"
                                                                    errorName='post_code'
                                                                    value="{{ old('post_code') }}">
                                                                </x-form_input>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-md-6">
                                                            <div class="mb_20">
                                                                <x-form_input label="City*" placeholder="City"
                                                                    name="city" errorName='city'
                                                                    value="{{ old('city') }}">
                                                                </x-form_input>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb_20">
                                                                <x-form_input label="State*" placeholder="state"
                                                                    name="state" errorName='state'
                                                                    value="{{ old('state') }}">
                                                                </x-form_input>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb_20">
                                                                <div class="ic-add-parcel-pallet-single-item">
                                                                    <label for=""
                                                                        class="form-label">Country</label>
                                                                    <select class="ic-select" name="country_id"
                                                                        id="countryName" aria-label="Select country"
                                                                        placeholder="Select country"
                                                                        data-live-search="true">
                                                                        @foreach ($countrys as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ old('country_id') == $item->id ? 'selected' : '' }}>
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if (!empty('country_id'))
                                                                        @error('country_id')
                                                                            <span
                                                                                class="err-txt">{{ $message }}</span>
                                                                        @enderror
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div
                                                            class="ic-recipient-company-form mt-xl-4 mt-lg-3   mt-2 bg-light-gray">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb_20">
                                                                        <x-form_input label="Company Name"
                                                                            placeholder="Company Name"
                                                                            name="company_name"
                                                                            errorName='company_name'
                                                                            value="{{ old('company_name') }}"
                                                                            optional>
                                                                        </x-form_input>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb_20">
                                                                        <x-form_input label="Recipient Email"
                                                                            placeholder="Recipient Email"
                                                                            name="company_email"
                                                                            errorName='company_email'
                                                                            value="{{ old('company_email') }}"
                                                                            optional>
                                                                        </x-form_input>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb_20">
                                                                        <x-form_input label="Recipient Number"
                                                                            placeholder="Recipient Number"
                                                                            name="company_number"
                                                                            errorName='company_number'
                                                                            value="{{ old('company_number') }}"
                                                                            optional>
                                                                        </x-form_input>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ic-single-accordian">
                                    <div class="ic-single-accordian-heading">
                                        <div class="d-flex gap-3">
                                            <h5 class="">Shipment Contents</h5>
                                            <span class="ic-package-type">(Please select)</span>
                                        </div>
                                        <div class="icon ic_arrow">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="ic-single-accordian-content ">
                                        <div class="row ic_form">
                                            <div class="col-12">
                                                <div class="mb_20">
                                                    <div class="ic-prepacked ic-preview-picks bg-light-gray">
                                                        <div class="top-content">
                                                            <div class="d-flex">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        checked name="type" id="flexRadioDefault1"
                                                                        value="product">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault1">
                                                                        Product
                                                                    </label>
                                                                </div>
                                                                <div class="form-check ms-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="type" id="flexRadioDefault2"
                                                                        value="bundle">
                                                                    <label class="form-check-label"
                                                                        for="flexRadioDefault2">
                                                                        Bundle
                                                                    </label>
                                                                </div>

                                                            </div>
                                                            <div class="ic-shipment-content-select">
                                                                <select class="ic-select ic-shipment-content-select"
                                                                    data-placeholder="Select warehouse"
                                                                    name="warehouse_id" id="SelecteWareHouse">
                                                                    @foreach ($warehouse as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            data-badge="">{{ $item->name }}
                                                                        </option>
                                                                    @endforeach

                                                                    {{-- <option value="O2" data-badge="">Option2</option> --}}
                                                                </select>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            @if (!empty('type'))
                                                @error('type')
                                                    <span class="err-txt">{{ $message }}</span>
                                                @enderror
                                            @endif
                                            @if (!empty('warehouse_id'))
                                                @error('warehouse_id')
                                                    <span class="err-txt">{{ $message }}</span>
                                                @enderror
                                            @endif
                                            <div class="col-12 " id="pushProduct">

                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <div class="ic-add-parcel-pallet-single-item"
                                                        id="product_summary">
                                                        <label class="form-label">Product</label>
                                                        <select class="ic-select2"
                                                            data-placeholder="Select a warehouse">
                                                            <option value="" disabled>Select a warehouse
                                                            </option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ic-single-accordian">
                                    <div class="ic-single-accordian-heading">
                                        <div class="d-flex gap-3">
                                            <h5 class="">Order information</h5>
                                        </div>
                                        <div class="icon ic_arrow">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="ic-single-accordian-content">
                                        <div class="row ic_form">
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <x-form_input label="Order Number" placeholder="6-10 digit code"
                                                        name="order_number" errorName='order_number'
                                                        value="{{ old('order_number') }}" optional>
                                                    </x-form_input>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ic-input-alert mt-xl-4 mt-lg-3   mt-2 bg-light-gray">
                                                    <div>
                                                        <h5 class="mb_10">Customs Requirements</h5>
                                                        <p class="mb_20">

                                                            This information is important for customs clearance, please
                                                            enter it carefully and truthfully. See
                                                            <a class="cl-orange ic-more-info"
                                                                href="#">additional
                                                                information.</a>
                                                        </p>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb_20">
                                                                    <x-form_input label="Invoice Number"
                                                                        placeholder="6-10 digit code"
                                                                        name="invoice_number"
                                                                        errorName='invoice_number'
                                                                        value="{{ old('invoice_number') }}" optional>
                                                                    </x-form_input>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb_20">
                                                                    <label class="form-label">Type of Goods</label>
                                                                    <select class="ic-select" name="type_of_good"
                                                                        aria-label="Select Type of Goods "
                                                                        placeholder="Select Type of Goods">
                                                                        <option value="document"
                                                                            {{ old('type_of_good') == 'document' ? 'selected' : '' }}>
                                                                            Document
                                                                        </option>
                                                                        <option value="gift"
                                                                            {{ old('type_of_good') == 'gift' ? 'selected' : '' }}>
                                                                            Gift
                                                                        </option>
                                                                        <option value="simple"
                                                                            {{ old('type_of_good') == 'simple' ? 'selected' : '' }}>
                                                                            Simple
                                                                        </option>
                                                                        <option value="remand"
                                                                            {{ old('type_of_good') == 'remand' ? 'selected' : '' }}>
                                                                            Remand
                                                                        </option>
                                                                        <option value="others"
                                                                            {{ old('type_of_good') == 'others' ? 'selected' : '' }}>
                                                                            Othres
                                                                        </option>
                                                                    </select>
                                                                    @if (!empty('type_of_good'))
                                                                        @error('type_of_good')
                                                                            <span
                                                                                class="err-txt">{{ $message }}</span>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="ic-shipment-manual-note">
                        <div class="top">
                            <h6 class="fst-italic">Notes (optional)</h6>
                        </div>
                        <div class="bottom">
                            <input type="text" name="note" value="{{ old('note') }}" class="form-control"
                                placeholder="Type your notes here...">
                            <span class="err-txt"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="inventory-heading bottom mb-md-0 mb-3">

                        <div class="right-button-group justify-content-end w-100">
                            <a role="button" class="ic-button white " href="product-inventory.php">
                                Cancel
                            </a>
                            <button class="ic-button primary" type="submit">
                                <span class="d-flex align-items-center gap-2"><i class="ri-thumb-up-line"></i> Create
                                    & Release</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </x-form>
    </div>
    <x-slot name="bottomScript">
        <script>
            $(document).ready(function() {
                $('.close-btn').click(function() {
                    localStorage.removeItem('selectedAddress');
                    $('#addressSelect').select2({
                        placeholder: 'Select address',
                        templateResult: formatProduct,
                        templateSelection: formatProductSelection
                    }).val(localStorage.getItem('selectedAddress')).trigger('change');
                    $('#collapseExample').removeClass('show');
                    $('.add-btn').removeClass('d-none');
                    $('.close-btn').addClass('collapsed');
                    $('.close-btn').removeClass('d-block');
                    $('#street').val('');
                    $('#phone').val('');
                    $('#additional').val('');
                    $('#city').val('');
                    $('#state').val('');
                    $('#post_code').val('');
                    $('#company_name').val('');
                    $('#company_email').val('');
                    $('#company_number').val('');
                })

                // Initialize select2 with the stored value or default to null
                $('#addressSelect').select2({
                    placeholder: 'Select address',
                    templateResult: formatProduct,
                    templateSelection: formatProductSelection
                }).val(localStorage.getItem('selectedAddress')).trigger('change');
                // Save the selected value to local storage when the user changes the selection
                $('#addressSelect').on('select2:select', function(e) {
                    var selectedAddress = e.params.data.id;
                    localStorage.setItem('selectedAddress', selectedAddress);
                });
                // Clear the stored value when the page is reloaded
                $(window).on('beforeunload', function() {
                    localStorage.removeItem('selectedAddress');
                });

                function formatProduct(product) {
                    if (!product.id) {
                        return product.text;
                    }

                    var name = $(product.element).data('countryname');
                    var phone = $(product.element).data('phone');
                    var city = $(product.element).data('city');
                    var street = $(product.element).data('street');
                    var state = $(product.element).data('state');
                    return $(
                        '<h4>' + name + '</h4>' +
                        '<p> State :' + state + '</p>' +
                        '<p> City :' + city + '</p>' +
                        '<p> street :' + street + '</p>' +
                        '<p> Phone :' + phone + '</p>'
                    );
                }

                function formatProductSelection(product) {
                    return product
                        .text; // Assuming you want to display the product name in the selection
                }
                $('#addressSelect').change(function() {
                    $('#collapseExample').addClass('show');
                    $('.add-btn').addClass('d-none');
                    $('.close-btn').removeClass('collapsed');
                    $('.close-btn').addClass('d-block');
                    var selectedProductId = $(this).val();
                    if (selectedProductId) {
                        // Get the selected product name
                        var selectedOption = $(this).find('option:selected');
                        var countryid = selectedOption.data('countryid');
                        var street = selectedOption.data('street');
                        var phone = selectedOption.data('phone');
                        var additional = selectedOption.data('additional');
                        var postcode = selectedOption.data('postcode');
                        var city = selectedOption.data('city');
                        var state = selectedOption.data('state');
                        var companyname = selectedOption.data('companyname');
                        var companyemail = selectedOption.data('companyemail');
                        var companyphone = selectedOption.data('companyname');
                        $('#street').val(street);
                        $('#phone').val(phone);
                        $('#additional').val(additional);
                        $('#city').val(city);
                        $('#state').val(state);
                        $('#post_code').val(postcode);
                        $('#company_name').val(companyname);
                        $('#company_email').val(companyemail);
                        $('#company_number').val(companyphone);
                        $('select.ic-select[name="country_id"]').val(countryid).trigger('change.select2');
                    }
                });

                $('.form-check-input, #SelecteWareHouse').change(function() {
                    $('.add-product-wrapper').remove();
                    var selectedType = $('input[name="type"]:checked').val();
                    var selectedWarehouse = $('#SelecteWareHouse').val();
                    // Add your AJAX request here, including both selectedType and selectedWarehouse in the data object
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        url: "{{ route('company.product.stock') }}",
                        data: {
                            type: selectedType,
                            ware_house_id: selectedWarehouse,
                        },
                        success: function(data) {
                            if (data.html == 'product' || data.html == 'bundle') {
                                $('#product_summary').html(`
                                <label class="form-label">Product</label>
                                                    <select class="ic-select2" data-placeholder="Select a warehouse">
                                                        <option value="" disabled>Select a warehouse
                                                        </option>
                                                    </select>
                                `);
                                productSet()
                                $('.ic-select2').select2({
                                    placeholder: 'Select an product',
                                    allowClear: true,
                                });
                                if (data.html == 'product') {
                                    notify('error', 'Your product is empty in this warehouse');
                                }
                                if (data.html == 'bundle') {
                                    notify('error',
                                        'Your bundle product is empty in this warehouse');
                                }

                            } else {
                                // AIZ.plugins.notify(data.response_message.response, data.response_message.message);
                                $("#product_summary").html(data.html);
                                productSet()
                                // Initialize Select2 on .ic-select3
                                $('#productSelect').select2({
                                    placeholder: 'Select an product',
                                    allowClear: true,
                                    templateResult: formatProduct,
                                    templateSelection: formatProductSelection
                                });

                                function formatProduct(product) {
                                    if (!product.id) {
                                        return product.text;
                                    }

                                    var name = $(product.element).data('name');
                                    var sku = $(product.element).data('sku');
                                    var stock = $(product.element).data('stock');

                                    return $(
                                        '<h4>' + name + '</h4>' +
                                        '<p>' + sku + ' <span class="text-danger">' + stock +
                                        ' in stock' +
                                        '</span> </p>'
                                    );
                                }

                                function formatProductSelection(product) {
                                    return product
                                        .text; // Assuming you want to display the product name in the selection
                                }
                            }
                        }
                    });
                });

            });

            function productSet() {
                // Handle product selection change
                $('#productSelect').change(function() {
                    var selectedOption = $(this).find('option:selected');
                    if (selectedOption.length > 0) {
                        var selectedProductId = selectedOption.val();
                        var selectedName = selectedOption.data('name');
                        var selectedSku = selectedOption.data('sku');
                        var selectedStock = selectedOption.data('stock');
                        var selectedType = selectedOption.data('type');

                        var productHtml = `
                            <div class="ic-shipment-content-details add-product-wrapper">
                                <div class="ic-product-details mb_30">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="cl-body">${selectedType}</label>
                                            <p class="fw-600">${selectedName}</p>
                                            <p>${selectedSku}<span class="red"> ${selectedStock} in stock</span></p>
                                            <input type="hidden" name="products[]" value="${selectedProductId}" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="">
                                                <label class="form-label">Quantity</label>
                                                <div class="input-group">
                                                    <span class="input-group-text pointer decrease-quantity">-</span>
                                                    <input type="number" name="quantity[]" class="form-control text-center quantity-input" value="0">
                                                    <span class="input-group-text pointer increase-quantity">+</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="ic-btn-wrapper d-flex mt_30 justify-content-end">
                                                <div class="custom-btn form-delete-btn">
                                                    <i class="ri-delete-bin-6-line remove-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                        // Append the HTML to the pushProduct div
                        $('#pushProduct').append(productHtml);

                        // Remove the selected option from the dropdown
                        selectedOption.remove();

                        // Clear the selected product in the dropdown
                        $('#productSelect').prop('selectedIndex', 0);
                    }
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
                        var newQuantity = currentQuantity + 1;

                        // Check if the new quantity exceeds the available stock
                        if (newQuantity <= selectedStock) {
                            quantityInput.val(newQuantity);
                        }
                    });

                    // Handle manual input change
                    $('.quantity-input').on('input', function() {
                        var quantityInput = $(this);
                        var newQuantity = parseInt(quantityInput.val());

                        // Check if the new quantity is within the valid range (0 to stock)
                        if (newQuantity >= 0 && newQuantity <= selectedStock) {
                            quantityInput.val(newQuantity);
                        } else {
                            // Reset to 0 if the input is invalid
                            quantityInput.val(0);
                        }
                    });
                });

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
            }
        </script>
    </x-slot>
    </x-admin.app>
