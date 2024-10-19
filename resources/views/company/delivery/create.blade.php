<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-home-content">
        <x-company.partials.invertory_head></x-company.partials.invertory_head>



        <form action="{{ route('company.delivery.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="ic-upload-content ic-table-content rounded-0">

                <div class="row mt_30 mb_30 justify-content-center">
                    <div class="col-xxl-7 col-xl-10 col-lg-9 col-12">

                        <div class="ic-manual-content  ic-delivery-content">

                            <div class="ic-info-list-accordian-wrapper mt_30">

                                <div class="ic-single-accordian">
                                    <div class="ic-single-accordian-heading">
                                        <div>
                                            <h5 class="">Delivery Contents</h5>

                                            <p>Choose products for delivery.</p>
                                        </div>
                                        <div class="icon ic_arrow active">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="ic-single-accordian-content">

                                        <div class="d-flex mb_30 ic_form">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="product_type"
                                                    id="product_type1" value="0" checked>
                                                <label class="form-check-label" for="product_type1">
                                                    Product
                                                </label>
                                            </div>
                                            <div class="form-check ms-3">
                                                <input class="form-check-input" type="radio" name="product_type"
                                                    value ="1" id="product_type2">
                                                <label class="form-check-label" for="product_type2">
                                                    Bundle
                                                </label>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center g-xxl-4 mb_30">

                                            <ul class="nav nav-pills ic-product-tab-wrapper " id="pills-tab"
                                                role="tablist">
                                                <!-- manual -->
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active " id="pills-manual-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-manual"
                                                        type="button" role="tab" aria-controls="pills-manual"
                                                        aria-selected="true">
                                                        <svg class="dashboard-squares" width="24px" height="24px"
                                                            version="1.1" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <rect class="layer-box" width="24" height="24">
                                                                </rect>
                                                                <path class="layer-fill"
                                                                    d="m10 14v7h-7v-7h7zm11-11v7h-7v-7h7z"
                                                                    fill="#000" fill-opacity="0"></path>
                                                                <g class="layer-stroke" transform="translate(3 3)"
                                                                    stroke="#000" stroke-linejoin="round"
                                                                    stroke-width="1.5">
                                                                    <rect x="11" y="11" width="7" height="7">
                                                                    </rect>
                                                                    <rect y="11" width="7" height="7"></rect>
                                                                    <rect x="11" width="7" height="7"></rect>
                                                                    <rect width="7" height="7"></rect>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span>Manual</span></button>
                                                </li>
                                                <!-- csv upload -->
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-csvUpload-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-csvUpload"
                                                        type="button" role="tab" aria-controls="pills-csvUpload"
                                                        aria-selected="false">
                                                        <svg class="upload" width="24" height="24"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <path class="layer-box" d="M0 0h24v24H0z"></path>
                                                                <path d="M3 16v4a1 1 0 001 1h16a1 1 0 001-1v-4"
                                                                    class="layer-fill" fill="none"></path>
                                                                <g class="layer-stroke" stroke="#000"
                                                                    stroke-width="1.5">
                                                                    <path
                                                                        d="M3 14v6a1 1 0 001 1h16a1 1 0 001-1v-6h0M7 9l5-5 5 5M12 4v14">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span>CSV Upload</span>
                                                    </button>
                                                </li>
                                            </ul>

                                            <a class="ic-guideline-requirement" href="">Delivery Guidelines and
                                                Requirements</a>
                                        </div>

                                        <div class="tab-content" id="pills-tabContent">
                                            <!-- manual -->
                                            <div class="tab-pane fade show active" id="pills-manual" role="tabpanel"
                                                aria-labelledby="pills-manual-tab">
                                                <p></p>
                                            </div>
                                            <!-- csv upload -->
                                            <div class="tab-pane fade" id="pills-csvUpload" role="tabpanel"
                                                aria-labelledby="pills-csvUpload-tab">
                                                <div class="row ic_form">

                                                    <div class="col-12">
                                                        <div class="upload-bottom-uploader">
                                                            <div class="ic-file-wrapper">
                                                                <input type="file" name="uploaded_file">

                                                                <div class="ic-content text-center">
                                                                    <div class="ic-upload-icon">
                                                                        <img src="{{ asset('assets/admin/images/logo/image-upload.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                    <p class="ic-main-content">
                                                                        <span class="upload">Click to upload</span>
                                                                        <span>or drag and drop</span>
                                                                    </p>
                                                                    <p class="ic-sub-content">
                                                                        CSV File
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <p class="ic-need-help mt-1">
                                                                Need help? <span><i
                                                                        class="ri-arrow-right-circle-line"></i></span>
                                                                <a href="{{ asset('csv/csv-delivery-items-example.csv') }}"
                                                                    download>Download template</a>
                                                            </p>

                                                            <!-- <div class="ic-input-alert mt-2 ">
                                                                <p>
                                                                    Product weight is mandatory if the product is
                                                                    dangerous good or
                                                                    needs to
                                                                    go through customs.
                                                                </p>
                                                            </div> -->
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            {{-- Start --}}
                                            <div class="product-wrapper"></div>
                                            {{-- end --}}
                                            <div class="row ic_form">
                                                <div class="col-md-6">
                                                    <label class="form-label"
                                                        id="select-product-label">Product</label>
                                                    <select class="ic-select2 data-ajax" id="add-product">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                    <span class="err-txt"></span>
                                                    <x-validation-error-message name="product_id" />
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="ic-single-accordian">
                                    <div class="ic-single-accordian-heading">
                                        <div>
                                            <h5 class="">How will it be sent?</h5>

                                            <p>In parcels or pallets?</p>
                                        </div>
                                        <div class="icon ic_arrow active">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="ic-single-accordian-content">

                                        <div class="d-flex justify-content-between align-items-center g-xxl-4 mb_30">

                                            <ul class="nav nav-pills ic-product-tab-wrapper " id="pills-tab"
                                                role="tablist">
                                                <!-- parcel -->
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active type" id="pills-parcell-tab"
                                                        data-type="Parcel" data-bs-toggle="pill"
                                                        data-bs-target="#pills-parcell" type="button" role="tab"
                                                        aria-controls="pills-parcell" aria-selected="true">
                                                        <svg class="dashboard-squares" width="24px" height="24px"
                                                            version="1.1" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <rect class="layer-box" width="24"
                                                                    height="24"></rect>
                                                                <path class="layer-fill"
                                                                    d="m10 14v7h-7v-7h7zm11-11v7h-7v-7h7z"
                                                                    fill="#000" fill-opacity="0"></path>
                                                                <g class="layer-stroke" transform="translate(3 3)"
                                                                    stroke="#000" stroke-linejoin="round"
                                                                    stroke-width="1.5">
                                                                    <rect x="11" y="11" width="7" height="7">
                                                                    </rect>
                                                                    <rect y="11" width="7" height="7"></rect>
                                                                    <rect x="11" width="7" height="7"></rect>
                                                                    <rect width="7" height="7"></rect>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span>Parcel(s)</span></button>
                                                </li>
                                                <!-- pallet -->
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link type" id="pills-pallet-tab"
                                                        data-type="Pallet" data-bs-toggle="pill"
                                                        data-bs-target="#pills-pallet" type="button" role="tab"
                                                        aria-controls="pills-pallet" aria-selected="false">
                                                        <svg class="upload" width="24" height="24"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <g fill="none" fill-rule="evenodd">
                                                                <path class="layer-box" d="M0 0h24v24H0z"></path>
                                                                <path d="M3 16v4a1 1 0 001 1h16a1 1 0 001-1v-4"
                                                                    class="layer-fill" fill="none"></path>
                                                                <g class="layer-stroke" stroke="#000"
                                                                    stroke-width="1.5">
                                                                    <path
                                                                        d="M3 14v6a1 1 0 001 1h16a1 1 0 001-1v-6h0M7 9l5-5 5 5M12 4v14">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <span>Pallet(s)</span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>


                                        {{-- Start --}}
                                        <div class="tab-pane fade show active" role="tabpanel"
                                            aria-labelledby="pills-parcell-tab">

                                            <div id="parcels-wrapper"></div>

                                            <div class="row ic_form align-items-center">
                                                <div class="col-md-6 ">
                                                    <label class="form-label">Colli Type</label>
                                                    <div class="search-bar-icon-wrapper form-control">
                                                        <div class="search-content">
                                                            Parcel
                                                        </div>
                                                        <div class="ic-serach-btn">
                                                            <svg class="dashboard-squares" width="20px"
                                                                height="20px" version="1.1" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <rect class="layer-box" width="24"
                                                                        height="24">
                                                                    </rect>
                                                                    <path class="layer-fill"
                                                                        d="m10 14v7h-7v-7h7zm11-11v7h-7v-7h7z"
                                                                        fill="#000" fill-opacity="0"></path>
                                                                    <g class="layer-stroke" transform="translate(3 3)"
                                                                        stroke="#000" stroke-linejoin="round"
                                                                        stroke-width="1.5">
                                                                        <rect x="11" y="11" width="7"
                                                                            height="7">
                                                                        </rect>
                                                                        <rect y="11" width="7" height="7">
                                                                        </rect>
                                                                        <rect x="11" width="7" height="7">
                                                                        </rect>
                                                                        <rect width="7" height="7"></rect>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label"
                                                        style="visibility : 0; opacity : 0">Colli
                                                        Type</label>
                                                    <button class="ic-button ic-add-new" id="add_new_parcel">
                                                        <i class="ri-checkbox-circle-line"></i>
                                                        <span>Add new</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="ic-input-alert mt-xl-4 mt-lg-3   mt-2">
                                                <div class="icon">
                                                    <i class="ri-information-line"></i>
                                                </div>
                                                <div>
                                                    <p>
                                                        <strong>Important:</strong>
                                                        Please remember to add parcels/pallets tracking numbers when
                                                        announcing the delivery.
                                                    </p>
                                                    <p>
                                                        <strong>Without this we won't be able to follow up on your
                                                            incoming deliveries.</strong>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="ic-input-alert details mt-xl-4 mt-lg-3   mt-2">
                                                <div>
                                                    <h5 class="mb-xl-3 mb-lg-2   mb-1">Inbounding Details</h5>

                                                    <div class="row ic_form">
                                                        <div class="col-12 form-check-wrapper">
                                                            <div class="form-check" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="If counting is requested, the warehouse will check the accuracy of the numbers during inbounding. Otherwise, the announced quantity will be considered to update the stock level">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="add-role" name="inbound">
                                                                <label class="form-check-label"
                                                                    for="add-role">Counting
                                                                    is required <i
                                                                        class="ri-question-line"></i></label>
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
                                        <div>
                                            <h5 class="">Warehouse Announcement</h5>

                                            <p>Where, how and when it will be delivered.</p>
                                        </div>
                                        <div class="icon ic_arrow active">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="ic-single-accordian-content">
                                        <div class="row ic_form">
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">To Warehouse</label>
                                                    <select class="ic-select2" name="warehouse_id">
                                                        @foreach ($warehouses as $warehouse)
                                                            <option value="{{ $warehouse->id }}"
                                                                {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}
                                                                data-badge="">
                                                                {{ $warehouse->name }}</option>
                                                        @endforeach

                                                    </select>
                                                    <x-validation-error-message name="warehouse_id" />

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <input type="hidden" name="delivery_type" class="form-control"
                                                        id="package_type" value="Parcel">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ic_form">

                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">Between</label>
                                                    <input type="date" class="form-control" name="start_date"
                                                        value="{{ old('start_date') }}"
                                                        placeholder="{{ date('Y-m-d') }}">
                                                    <span class="err-txt"></span>
                                                    <x-validation-error-message name="start_date" />
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">And</label>
                                                    <input type="date" class="form-control" name="end_date"
                                                        value="{{ old('end_date') }}"
                                                        placeholder="{{ date('Y-m-d') }}">
                                                    <span class="err-txt"></span>
                                                    <x-validation-error-message name="end_date" />
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>

                                <div class="ic-single-accordian">
                                    <div class="ic-single-accordian-heading">
                                        <div>
                                            <h5 class="">Additional Details</h5>

                                            <p>Optional information about the delivery.</p>
                                        </div>
                                        <div class="icon ic_arrow active">
                                            <i class="ri-arrow-down-s-line"></i>
                                        </div>
                                    </div>
                                    <div class="ic-single-accordian-content">
                                        <div class="row ic_form">
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">Reference Number (optional)</label>
                                                    <input type="text" class="form-control" name="ref_number"
                                                        value="{{ old('ref_number') }}" placeholder="Your unique ID">
                                                    <span class="err-txt"></span>
                                                    <x-validation-error-message name="ref_number" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">Description (optional)</label>
                                                    <input type="text" class="form-control" name="description"
                                                        value="{{ old('description') }}"
                                                        placeholder="Current summary info">
                                                    <span class="err-txt"></span>
                                                    <x-validation-error-message name="description" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">Sender Name (optional)</label>
                                                    <input type="text" class="form-control" name="sender_name"
                                                        value="{{ old('sender_name') }}" placeholder="William Byrd">
                                                    <span class="err-txt"></span>
                                                    <x-validation-error-message name="sender_name" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb_20">
                                                    <label class="form-label">Sender Address (optional)</label>
                                                    <input type="text" class="form-control" name="sender_address"
                                                        value="{{ old('sender_address') }}"
                                                        placeholder="Street name, number...">
                                                    <span class="err-txt"></span>
                                                    <x-validation-error-message name="sender_address" />
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
            <div class="inventory-heading">

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
        </form>
    </div>
    {{-- End --}}


    <x-slot name="bottomScript">
        <script>
            jQuery(document).ready(function() {
                var maxLimit = 20;
                var x = 1;

                // for addition
                jQuery('#add-product').change(function(e) {
                    e.preventDefault();
                    var selectedOption = $(this).find('option:selected');
                    if (selectedOption.length > 0) {
                        var selectedProductName = $('#add-product option:selected').text();
                        var item = $(this);
                        var appendHTML =
                            '<div class="ic-add-parcel-pallet-wrapper mb_20 ic_form input-wrapper"><div class="ic-add-parcel-pallet-single-item"><label class="form-label">' +
                            selectedProductName +
                            '</label><input type="hidden"class="form-control" name="product_id[]" value="' +
                            item.val() +
                            '"></div><div class="ic-add-parcel-pallet-single-item"><label class="form-label">Quantity</label><input type="number" class="form-control"  value="1" name="product_qty[]"><span class="err-txt"></span></div><div class="ic-add-parcel-pallet-single-item"><label class="form-label">Box Number</label><input type="text" class="form-control" name="product_tracking[]"><span class="err-txt"></span></div><div class="ic-add-parcel-pallet-single-item"><label class="form-label" style="visibility : 0; opacity : 0">delete</label><button class="ic-delete ic-common-border-icon" id="remove-product"><i class="ri-delete-bin-6-line"></i></button></div></div>';
                        if (x < maxLimit) {
                            jQuery('.product-wrapper').append(appendHTML);
                            x++;
                        }
                    }
                });

                // for deletion
                jQuery('.product-wrapper').on('click', '#remove-product', function(e) {
                    e.preventDefault();

                    jQuery(this).parents('.input-wrapper').remove();
                    x--;
                });
            });
        </script>
        <script>
            jQuery(document).ready(function() {
                var maxLimit = 20;
                var x = 1;

                // for addition
                jQuery('#add_new_parcel').click(function(e) {
                    e.preventDefault();

                    var appendHTML =
                        '<div class="ic-add-parcel-pallet-wrapper mb_20 ic_form parcel-input-wrapper"><div class="ic-add-parcel-pallet-single-item"><label class="form-label">Colli Type</label><div class="search-bar-icon-wrapper form-control"><div class="search-content type-name">Parcel</div><div class="ic-serach-btn"><svg class="dashboard-squares" width="20px" height="20px" version="1.1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><rect class="layer-box" width="24" height="24"></rect><path class="layer-fill" d="m10 14v7h-7v-7h7zm11-11v7h-7v-7h7z" fill="#000" fill-opacity="0"></path><g class="layer-stroke" transform="translate(3 3)" stroke="#000" stroke-linejoin="round" stroke-width="1.5"><rect x="11" y="11" width="7" height="7"></rect><rect y="11" width="7" height="7"></rect><rect x="11" width="7" height="7"></rect><rect width="7" height="7"></rect></g></g></svg></div></div></div><div class="ic-add-parcel-pallet-single-item"><label class="form-label">Quantity</label><input type="number" class="form-control" value="1" name="parcel_qty[]"><span class="err-txt"></span></div><div class="ic-add-parcel-pallet-single-item"><label class="form-label">Tracking Number</label><input type="text" class="form-control" name="parcel_tracking[]"><span class="err-txt"></span></div><div class="ic-add-parcel-pallet-single-item"><label class="form-label" style="visibility : 0; opacity : 0">delete</label><button class="ic-delete ic-common-border-icon" id="remove-parcel"><i class="ri-delete-bin-6-line"></i></button></div></div>';
                    if (x < maxLimit) {
                        jQuery('#parcels-wrapper').append(appendHTML);
                        x++;
                    }
                });

                // for deletion
                jQuery('#parcels-wrapper').on('click', '#remove-parcel', function(e) {
                    e.preventDefault();
                    jQuery(this).parents('.parcel-input-wrapper').remove();
                    x--;
                });

            });
            $('.type').click(function(e) {
                var type_name = $(this).data('type');
                $('.search-content').text(type_name)
                $('#package_type').val(type_name)
            })

            $('input[type=radio][name=product_type]').change(function() {
                if (this.value == 0) {
                    $('#select-product-label').text('Product');
                } else if (this.value == 1) {
                    $('#select-product-label').text('Bundle');
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax-get-product-bundle') }}",
                    data: {
                        product_type: this.value,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "html",
                    success: function(response) {
                        jQuery('.product-wrapper').empty();
                        $(".data-ajax").html(response);
                    }
                });
            });
            $.ajax({
                type: "POST",
                url: "{{ route('ajax-get-product-bundle') }}",
                data: {
                    product_type: 0,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "html",
                success: function(response) {
                    jQuery('.product-wrapper').empty();
                    $(".data-ajax").html(response);
                }
            });
        </script>
    </x-slot>

    </x-admin.app>
