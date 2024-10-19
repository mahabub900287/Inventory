<x-admin.layouts.app :title="getbreadcumb()">
    <x-form method="POST" action="{{ route('admin.shipment.dhl-order') }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body row p-2">
                <div class="col-xxl-12">
                    <h4 class="mb-2">Customer Info</h4>
                </div>
                <div class="col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Street" placeholder="Street name" name="street" errorName='street'
                            value="{{ $item->customer_address->street ?? old('street') }}" required="required">
                        </x-form_input>
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Number" placeholder="enter your number" name="phone" errorName='phone'
                            value="{{ $item->customer_address->phone ?? old('phone') }}" optional>
                        </x-form_input>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Additional" placeholder="Additional" name="additional"
                            errorName='additional'
                            value="{{ $item->customer_address->additional ?? old('additional') }}" optional>
                        </x-form_input>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Postal Code" placeholder="Postal Code" name="post_code"
                            errorName='post_code' value="{{ $item->customer_address->post_code ?? old('post_code') }}"
                            required="required">
                        </x-form_input>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="City" placeholder="City" name="city" errorName='city'
                            value="{{ $item->customer_address->city ?? old('city') }}" required="required">
                        </x-form_input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb_20">
                        <x-form_input label="State" placeholder="state" name="state" errorName='state'
                            value="{{ $item->customer_address->state ?? old('state') }}" required="required">
                        </x-form_input>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="mb_20">
                        <div class="ic-add-parcel-pallet-single-item">
                            <x-form_input label="Country" placeholder="country" name="country" errorName='country'
                                value="{{ $item->customer_address->country->shortname ?? old('country') }}"
                                required="required">
                            </x-form_input>
                            @if (!empty('country'))
                                @error('country')
                                    <span class="err-txt">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>

                    </div>
                </div> --}}

                <div class="col-xxl-12">
                    <h4 class="mb-2">Warehouse Info</h4>
                </div>
                <div class="col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Street" placeholder="Street name" name="warehouse_street"
                            errorName='warehouse_street'
                            value="{{ $item->warehouse->street ?? old('warehouse_street') }}" required="required">
                        </x-form_input>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Number" placeholder="enter your number" name="warehouse_phone"
                            errorName='warehouse_phone' value="{{ $item->warehouse->phone ?? old('warehouse_phone') }}"
                            optional>
                        </x-form_input>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Additional" placeholder="Additional" name="warehouse_additional"
                            errorName='warehouse_additional'
                            value="{{ $item->warehouse->additional ?? old('warehouse_additional') }}" optional>
                        </x-form_input>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="Postal Code" placeholder="Postal Code" name="warehouse_post_code"
                            errorName='warehouse_post_code'
                            value="{{ $item->warehouse->post_code ?? old('warehouse_post_code') }}"
                            required="required">
                        </x-form_input>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6">
                    <div class="mb_20">
                        <x-form_input label="City" placeholder="City" name="city" errorName='city'
                            value="{{ $item->warehouse->city ?? old('city') }}" required="required">
                        </x-form_input>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb_20">
                        <x-form_input label="State" placeholder="state" name="warehouse_state"
                            errorName='warehouse_state'
                            value="{{ $item->warehouse->state ?? old('warehouse_state') }}" required="required">
                        </x-form_input>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="mb_20">
                        <div class="ic-add-parcel-pallet-single-item">
                            <x-form_input label="Country" placeholder="country" name="warehouse_country"
                                errorName='warehouse_country'
                                value="{{ $item->warehouse->country->shortname ?? old('warehouse_country') }}"
                                required="required">
                            </x-form_input>
                            @if (!empty('country'))
                                @error('country')
                                    <span class="err-txt">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>

                    </div>
                </div> --}}
                <div class="inventory-heading">
                    <div class="right-button-group justify-content-end w-100">
                        <a role="button" class="ic-button white " href="product-inventory.php">
                            Cancel
                        </a>

                        <button class="ic-button primary">
                            <i class="ri-checkbox-circle-line"></i>
                            <span>Create Dhl Order</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </x-form>
    </x-admin.app>
