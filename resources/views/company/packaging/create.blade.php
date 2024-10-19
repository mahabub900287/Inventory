<x-admin.layouts.app :title="getbreadcumb()">
    <x-company.partials.invertory_head></x-company.partials.invertory_head>
    <div class="inventory-heading">
        <h4 class="ic-top-title ">New Packaging Material</h4>
    </div>
    <div class="ic-upload-content ic-table-content rounded-0">

        <div class="row mt_30 mb_30 justify-content-center">
            <div class="col-lg-8">
                <x-form method="POST" action="{{ route('company.packaging.store') }}">
                    <div class="ic-manual-content mb-3">
                        <div class="row ic_form">
                            <div class="col-md-6">
                                <div class="ic-info-wrapper mb_30">
                                    <h4 class="mb_20">Basic info</h4>
                                    <div class="ic-basic-info-card mb_30">
                                        <div class="mb_20">
                                            <x-form_input label="Name" placeholder="Name of the product"
                                                name="name" errorName='name' value="{{ old('name') }}"
                                                required="required">
                                            </x-form_input>
                                        </div>
                                        <div class="mb_20">
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
                                </div>
                                <div class="ic-info-wrapper pt_30">
                                    <h4 class="mb_20">Additional Info</h4>
                                    <div class="ic-basic-info-card">
                                        <div class="mb_20">
                                            <label class="form-label">Description (optional)</label>
                                            <textarea class="form-control ic-textarea" name="description" value="{{ old('description') }}" rows="3"
                                                placeholder="Write description">{{ old('description') }}</textarea>
                                        </div>
                                        <div class="mb_20">
                                            <label class="form-label">Reorder Point <span>(optional)</span></label>
                                            <div class="input-group">
                                                <input type="number" name="reorder_point" id="reorder_point"
                                                    class="form-control" placeholder="0"
                                                    value="{{ old('reorder_point') }}">
                                                @if (!empty('reorder_point'))
                                                    @error('reorder_point')
                                                        <span class="err-txt">{{ $message }}</span>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="mb_20">
                                            <label for="" class="form-label">Barcode type</label>
                                            <select class="ic-select" name="barcode_type"
                                                aria-label="Select Barcode Type" placeholder="Select Barcode Type">
                                                <option value="code-128"
                                                    {{ old('barcode_type') == 'code-128' ? 'selected' : '' }}>
                                                    Code-128
                                                </option>
                                                <option value="ean-13"
                                                    {{ old('barcode_type') == 'ean-13' ? 'selected' : '' }}>
                                                    EAN-13
                                                </option>
                                                <option value="gs1-128"
                                                    {{ old('barcode_type') == 'gs1-128' ? 'selected' : '' }}>
                                                    GS1-128
                                                </option>
                                                <option value="qr-code"
                                                    {{ old('barcode_type') == 'qr-code' ? 'selected' : '' }}>
                                                    QR-Code
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb_20">
                                            <x-form_input label="Barcode value" placeholder="Alphanumeric code"
                                                name="barcode_number" errorName='barcode_number'
                                                value="{{ old('barcode_number') }}">
                                            </x-form_input>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ic-measurement-area">
                                    <div class="ic-type-wrapper">
                                        <h4 class="mb_20">Type</h4>
                                        <div class="ic-basic-info-card">
                                            <div class="mb_20">
                                                <label class="form-label">Type of Packaging</label>
                                                <select class="ic-select" name="type"
                                                    aria-label="Select Barcode Type" placeholder="Select Barcode Type">
                                                    <option value="box" {{ old('type') == 'box' ? 'selected' : '' }}>
                                                        Box
                                                    </option>
                                                    <option value="envelope"
                                                        {{ old('type') == 'envelope' ? 'selected' : '' }}>
                                                        envelope
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ic-prepacked">

                                        <div class="mid-content">
                                            <h3 class="mb_30">Measurements
                                                <span>(Outer)</span>
                                                <span class="" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Actual cost of the product. This is not the sale price.">
                                                    <i class="ri-question-line"></i>
                                                </span>
                                            </h3>
                                            <div class="mb_20">
                                                <label class="form-label">Length</label>
                                                <div class="input-group">
                                                    <input type="number" id="length" name="length"
                                                        value="{{ old('length') }}" class="form-control"
                                                        placeholder="0">
                                                    @if (!empty('length'))
                                                        @error('length')
                                                            <span class="err-txt">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                                <span class="err-txt">Must be at least 1</span>
                                            </div>
                                            <div class="mb_20">
                                                <label class="form-label">Width</label>
                                                <div class="input-group">
                                                    <input type="number" id="width" name="width"
                                                        value="{{ old('width') }}" class="form-control"
                                                        placeholder="0">
                                                    @if (!empty('width'))
                                                        @error('width')
                                                            <span class="err-txt">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                                <span class="err-txt"></span>
                                            </div>
                                            <div class="mb_20">
                                                <label class="form-label">Height</label>
                                                <div class="input-group">
                                                    <input type="number" id="height" name="height"
                                                        value="{{ old('height') }}" class="form-control"
                                                        placeholder="0">
                                                    @if (!empty('height'))
                                                        @error('height')
                                                            <span class="err-txt">{{ $message }}</span>
                                                        @enderror
                                                    @endif
                                                </div>
                                                <span class="err-txt"></span>
                                            </div>
                                        </div>
                                        <div class=" prepacked-content">
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
                        </div>
                    </div>
                    <div class="inventory-heading bottom">

                        <div class="right-button-group justify-content-end w-100">
                            <a role="button" class="ic-button white "
                                href="{{ route('company.packaging.index') }}">
                                Cancel
                            </a>

                            <button class="ic-button primary" type="submit">
                                <i class="ri-checkbox-circle-line"></i>
                                <span>Confirm</span>
                            </button>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
    <x-slot name="bottomScript">
        <script>
            $(document).ready(function() {
                $('#length, #width, #height ,#reorder_point').on('input', function() {
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
            })
        </script>
    </x-slot>
    </x-admin.app>
