<x-admin.layouts.app :title="getbreadcumb()">
    <x-company.partials.invertory_head></x-company.partials.invertory_head>
    <div class="inventory-heading">
        <h4 class="ic-top-title ">Update Product</h4>
    </div>
    <div class="ic-upload-content ic-table-content rounded-0">
        <div class="row mt_30 mb_30 justify-content-center">
            <div class="col-xxl-7 col-xl-10 col-lg-9 col-12">
                <x-form method="PUT" action="{{ route('company.product.update', $item->id) }}"
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
                                    <x-form_input label="Name" placeholder="Name of the product" name="name"
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


                        </div>

                        <div class="row ic_form mt_30">
                            <div class="col-md-6">
                                <div class="mb_20 form-check-wrapper">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="track-organic"
                                            name="type[]" value="Track Organic"
                                            {{ in_array('Track Organic', $item->type) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="track-organic">Track Organic</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="track-lot-expiry"
                                            name="type[]" value="Track Lot & Expiry"
                                            {{ in_array('Track Lot & Expiry', $item->type) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="track-lot-expiry">Track Lot &
                                            Expiry</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="fragile" name="type[]"
                                            value="Fragile" {{ in_array('Fragile', $item->type) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fragile">Fragile</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 ">
                                <div class="ic-prepacked">
                                    <div class="top-content">
                                        <div class="form-check form-switch  ic-check">
                                            <input class="form-check-input prepacked-switch"
                                                {{ $item->prepacked == 1 ? 'checked' : '' }} name="prepacked"
                                                type="checkbox" id="flexSwitchCheckChecked">
                                            <label class="form-check-label"
                                                for="flexSwitchCheckChecked">Prepacked</label>
                                        </div>
                                        <div class="icon">
                                            <svg class="pre-packaged" width="24px" height="24px" version="1.1"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <g fill="none" fill-rule="evenodd">
                                                    <rect class="layer-box" width="24" height="24">
                                                    </rect>
                                                    <path class="layer-fill"
                                                        d="m12 3 9 4-9 4 4.1213-1.8319c-0.90158-1.3096-2.4112-2.1681-4.1213-2.1681-1.7106 0-3.2205 0.85897-4.122 2.1691l9.7398e-4 -0.0010994-4.879-2.168 9-4z"
                                                        fill="#000" fill-opacity="0"></path>
                                                    <g class="layer-stroke" transform="translate(3 3)" stroke="#7f7f7f"
                                                        stroke-linejoin="round" stroke-width="1.5">
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
                                    @if ($item->prepacked == 1)
                                        @php
                                            $prepackedMetarial = json_decode($item->prepacked_metarial, true);
                                        @endphp
                                    @endif
                                    <div class="mid-content prepacked-content"
                                        style="{{ $item->prepacked == 1 ? 'display:block;' : 'display:none;' }}">
                                        <div class="mb_20">
                                            <label class="form-label">Length</label>
                                            <div class="input-group">
                                                <input type="number" name="pre_length" id="pre_length"
                                                    value="{{ $prepackedMetarial['length'] ?? 0 }}"
                                                    class="form-control" placeholder="0">
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
                                                    value="{{ $prepackedMetarial['width'] ?? 0 }}"
                                                    class="form-control" placeholder="0">
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
                                                    value="{{ $prepackedMetarial['height'] ?? 0 }}"
                                                    class="form-control" placeholder="0">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                            @if (!empty('pre_height'))
                                                @error('pre_height')
                                                    <span class="err-txt">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                    <div class="prepacked-content"
                                        style="{{ $item->prepacked == 1 ? 'display:block;' : 'display:none;' }}">
                                        <div class="bottom-content">
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
                                            value="{{ $item->weight ?? old('weight') }}"
                                            placeholder="Add product weight...">
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
                        <div class="ic-info-list-accordian-wrapper mt_30">
                            {{-- <div class="ic-single-accordian">
                                <div class="ic-single-accordian-heading">
                                    <div>
                                        <h5 class="">Additional Info</h5>

                                        <p>More options and information about the product</p>
                                    </div>
                                    <div class="icon ic_arrow">
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                </div>
                                <div class="ic-single-accordian-content">
                                    <div class="row ic_form">
                                        <div class="col-md-6">
                                            <div class="mb_20">
                                                <label for="" class="form-label">Barcode type</label>
                                                <select class="ic-select" name="barcode_type"
                                                    aria-label="Select Barcode Type"
                                                    placeholder="Select Barcode Type">
                                                    <option value="code-128"
                                                        {{ $item->barcode_type == 'code-128' ? 'selected' : '' }}>
                                                        Code-128
                                                    </option>
                                                    <option value="ean-13"
                                                        {{ $item->barcode_type == 'ean-13' ? 'selected' : '' }}>
                                                        EAN-13
                                                    </option>
                                                    <option value="gs1-128"
                                                        {{ $item->barcode_type == 'gs1-128' ? 'selected' : '' }}>
                                                        GS1-128
                                                    </option>
                                                    <option value="qr-code"
                                                        {{ $item->barcode_type == 'qr-code' ? 'selected' : '' }}>
                                                        QR-Code
                                                    </option>
                                                </select>
                                                @if (!empty('barcode_type'))
                                                    @error('barcode_type')
                                                        <span class="err-txt">{{ $message }}</span>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb_20">
                                                <x-form_input label="Barcode Number" placeholder="Alphanumeric code"
                                                    name="barcode_number" errorName='barcode_number'
                                                    value="{{ $item->barcode_number ?? old('barcode_number') }}">
                                                </x-form_input>
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
                                </div>
                            </div> --}}

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
                                                <x-form_input label="Tariff Number"
                                                    placeholder="Customs Tariff Number" name="tariff_number"
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
            });
        </script>
    </x-slot>
    </x-admin.app>
