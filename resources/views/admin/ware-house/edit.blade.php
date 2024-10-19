<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-user">

        <!-- back btn -->
        <a role="button" class="ic-back mb_25" href="{{ route('admin.ware-house.index') }}">
            <i class="ri-arrow-left-line"></i>
            <span>Back</span>
        </a>
        <!-- ic-profile-content-wrapper -->
        <x-form method="PUT" action="{{ route('admin.ware-house.update', $item->id) }}">
            <div class="ic-profile-content-wrapper">
                <h5 class="ic-top-title">Edit WareHouse</h5>
                <div class="ic-profile-content">

                    <div class="ic_form row row-cols-md-2 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">
                        <!-- First name -->
                        <div class="mb_20">
                            <x-form_input label="Ware-House Name" placeholder="Enter your name" name="name"
                                errorName='name' value="{{ $item->name ?? old('name') }}" required>
                            </x-form_input>
                        </div>
                        <!-- LAst name -->
                        <div class="mb_20">
                            <label for="" class="form-label">Contact Person <span
                                    class="error text-danger">*</span></label>
                            <select class="ic-select" name="user_id" data-live-search="true" aria-label="Select User"
                                placeholder="Select User">
                                @forelse ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $item->user_id ? 'selected' : '' }}>{{ $user->first_name }}
                                        {{ $user->last_name }}
                                    </option>
                                @empty
                                    <option value="">Nothing in the list</option>
                                @endforelse
                            </select>
                        </div>
                        <!-- Role -->
                        <div class="mb_20">
                            <x-form_input label="Email" placeholder="Enter your email" name="email" errorName='email'
                                value="{{ $item->email ?? old('email') }}" required>
                            </x-form_input>
                        </div>
                        <!-- Phone Number -->
                        <div class="mb_20">
                            <x-form_input label="Phone" placeholder="Enter your phone" name="phone" errorName='phone'
                                value="{{ $item->phone ?? old('phone') }}" required>
                            </x-form_input>
                        </div>
                        <div class="mb_20">
                            <x-form_input label="Street" placeholder="Enter your street" name="street"
                                errorName='street' value="{{ $item->street ?? old('street') }}" required>
                            </x-form_input>
                        </div>
                        <div class="mb_20">
                            <x-form_input label="City" placeholder="Enter your city" name="city" errorName='city'
                                value="{{ $item->city ?? old('city') }}" required>
                            </x-form_input>
                        </div>
                        <div class="mb_20">
                            <x-form_input label="State" placeholder="Enter your state" name="state" errorName='state'
                                value="{{ $item->state ?? old('state') }}" required>
                            </x-form_input>
                        </div>
                        <div class="mb_20">
                            <x-form_input label="Post Code" placeholder="Enter your post_code" name="post_code"
                                errorName='post_code' value="{{ $item->post_code ?? old('post_code') }}" required>
                            </x-form_input>
                        </div>
                        <div class="mb_20">
                            <div class="ic-add-parcel-pallet-single-item">
                                <label for="" class="form-label">Country</label>
                                <select class="ic-select" name="country_id" id="countryName" aria-label="Select country"
                                    placeholder="Select country" data-live-search="true">
                                    @foreach ($countrys as $country)
                                        <option value="{{ $country->id }}"
                                            {{ $item->country_id == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
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
                        <div class="mb_20">
                            <x-form_input label="additional" placeholder="Enter your additional" name="additional"
                                errorName='additional' value="{{ $item->additional ?? old('additional') }}" required>
                            </x-form_input>
                        </div>
                        <!-- status -->
                        <div class="mb_20">
                            <label for="exampleInputPassword1" class="form-label">Status</label>
                            <div class="form-check form-switch  ic-check">
                                <input class="form-check-input" name="status" type="checkbox"
                                    {{ $item->status == 'active' ? 'checked' : '' }} id="flexSwitchCheckChecked">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="ic-button-wrapper d-flex justify-content-end">
                        <div class="right-button-group ">
                            <a href="{{ route('admin.ware-house.index') }}" class="ic-button white">Cancel</a>
                            <button type="submit" class="ic-button primary">Update</button>
                        </div>
                    </div>

                </div>
            </div>
        </x-form>
    </div>
    </x-admin.app>
