<x-admin.layouts.app :title="getbreadcumb()">
<div class="ic-user">
	<!-- ic-profile-content-wrapper -->
	<!-- <h5 class="ic-top-title mb-3">User Info</h5> -->
	<div class="ic-profile-content-wrapper ic-tab-content">
		<div class="left-content">

			<div class="ic-profile-content">
				<div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">


					<button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
						data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
						aria-selected="true">
						<i class="ri-settings-4-line"></i>
						General Settings
					</button>

					<button class="nav-link" id="v-pills-email-tab" data-bs-toggle="pill"
						data-bs-target="#v-pills-email" type="button" role="tab" aria-controls="v-pills-email"
						aria-selected="false">
						<i class="ri-mail-send-line"></i>
						Email Settings
					</button>
				</div>
			</div>
		</div>

		<div class="right-content">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
					aria-labelledby="v-pills-home-tab" tabindex="0">
					<div class="ic-profile-content">
						<h5 class="ic-top-title">General Settings</h5>
						<form action="{{route('admin.application.settings-update')}}" method="POST"
							enctype="multipart/form-data" class="ic-form1">
							@csrf
							<div class="ic_form row row-cols-md-2 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">

								<div class="mb_20">
									<label class="form-label">Company Title</label>
									<input type="text" name="general[application_title]"
										value="{{$settings['general']['application_title'] ?? '' }}"
										class="form-control" placeholder="Enter title">
									<x-validation-error-message name="general[application_title]"
										class="mt-2" />
								</div>
								<div class="mb_20">
									<label class="form-label">Currency Symbol</label>
									<input type="text" name="general[currency_symbol]"
										value="{{$settings['general']['currency_symbol'] ?? '' }}" class="form-control"
										placeholder="Enter Symbol">
									<x-validation-error-message name="general[currency_symbol]" class="mt-2" />
								</div>
								
								<div class="mb_20">
									<div class="form-check form-switch  ic-check">
										<input class="form-check-input" type="checkbox" name="general[sku_auto]" id="enable-trial"
											@if(isset($settings['general']['sku_auto']) && $settings['general']['sku_auto']=='on' ) checked @endif>
										<label class="form-check-label" for="enable-trial">Product SKU Auto</label>
									</div>
								</div>
								<!-- Status -->
								<div class="mb_20">
									<div class="form-check form-switch  ic-check">
										<input class="form-check-input" type="checkbox" id="disable-trial" name="general[sku_editable]"
											@if(isset($settings['general']['sku_editable']) && $settings['general']['sku_editable']=='on' ) checked
											@endif>
										<label class="form-check-label" for="disable-trial">Product SKU Editable</label>
									</div>
								</div>
								<div class="mb_20">
									<label class="form-label">Address</label>
									<input type="text" name="general[store_address]"
										value="{{$settings['general']['store_address'] ?? '' }}" class="form-control"
										placeholder="Enter Address">
									<x-validation-error-message name="general[store_address]" class="mt-2" />
								</div>
								<div class="mb_20">
									<label class="form-label">Phone Number</label>
									<input type="text" name="general[store_mobile]"
										value="{{$settings['general']['store_mobile'] ?? '' }}" class="form-control"
										placeholder="Enter Store Name">
									<x-validation-error-message name="general[store_mobile]" class="mt-2" />
								</div>

								<div class="mb_20">
									<label class="form-label mb-3">System Logo</label>
									<div class="ic-profile-image">
										<div class="ic-image">
											<img class="img-fluid d-block mx-auto" id="banner_image"
												src="{{ $settings['general']['system_logo'] ?? asset('images/default.png') }}"
												alt="System Logo">
										</div>
										<div class="ic-setting-file-upload">
											<label for="formFile" class="form-label">Upload System Logo</label>
											<div class="input-group">
												<input type="file" class="form-control" name="general[system_logo]">
												<label class="input-group-text" for="banner-file">Upload</label>
											</div>
											<x-validation-error-message name="general[system_logo]"
												class="mt-2" />
										</div>
									</div>
								</div>

								<div class="mb_20">
									<label class="form-label mb-3">System short logo</label>
									<div class="ic-profile-image">
										<div class="ic-image">
											<img class="img-fluid d-block mx-auto" id="system_short_logo"
												src="{{ $settings['general']['system_short_logo'] ?? asset('images/default.png') }}"
												alt="System Short Logo">
										</div>
										<div class="ic-setting-file-upload">
											<label for="formFile" class="form-label">Upload Short Logo</label>
											<div class="input-group">
												<input type="file" class="form-control"
													name="general[system_short_logo]">
												<label class="input-group-text" for="banner-file">Upload</label>
											</div>
											<x-validation-error-message name="general[system_short_logo]"
												class="mt-2" />
										</div>
									</div>
								</div>
								<div class="mb_20">
									<label class="form-label mb-3">Favicon</label>
									<div class="ic-profile-image">
										<div class="ic-image">
											<img class="img-fluid d-block mx-auto" id="banner_image"
												src="{{ $settings['general']['favicon'] ?? asset('images/default.png') }}"
												alt="Favicon">
										</div>
										<div class="ic-setting-file-upload">
											<label for="formFile" class="form-label">Upload Favicon</label>
											<div class="input-group">
												<input type="file" class="form-control" name="general[favicon]">
												<label class="input-group-text" for="banner-file">Upload</label>
											</div>
											<x-validation-error-message name="general[favicon]" class="mt-2" />
										</div>
									</div>
								</div>
								
							</div>
							<div class="ic-button-wrapper d-flex justify-content-end">
								<div class="right-button-group ">
									<button class="ic-button white">Cancel</button>
									<button type="submit" class="ic-button grey">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="tab-pane fade " id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab"
					tabindex="0">

					<div class="ic-profile-content">
						<h5 class="ic-top-title">Email Settings</h5>
						<form action="{{route('admin.application.settings-update')}}" method="POST">
							@csrf
							<div class="ic_form row row-cols-md-2 row-cols-sm-2 gx-xxl-4 gx-xl-2 gx-sm-2">
								<!-- Mailer -->
								<div class="mb_20">
									<label class="form-label">Mailer</label>
									<input type="text" class="form-control" name="mail_settings[mailer]"
										value="{{$settings['mail_settings']['mailer'] ?? '' }}" placeholder="Mailer">
								</div>
								<!-- Host -->
								<div class="mb_20">
									<label class="form-label">Host</label>
									<input type="text" class="form-control" name="mail_settings[host]"
										value="{{$settings['mail_settings']['host'] ?? '' }}" placeholder="Enter Host">
								</div>
								<!-- User name -->
								<div class="mb_20">
									<label for="" class="form-label">User Name</label>
									<input type="text" class="form-control" name="mail_settings[username]"
										value="{{$settings['mail_settings']['username'] ?? '' }}"
										placeholder="Enter Username">
								</div>
								<!-- Password -->
								<div class="mb_20">
									<label for="" class="form-label">Password</label>
									<input type="number" class="form-control" name="mail_settings[password]"
										value="{{$settings['mail_settings']['password'] ?? '' }}"
										placeholder="Enter Password">
								</div>
								<!-- SMTP Port -->
								<div class="mb_20">
									<label for="" class="form-label">SMTP Port</label>
									<input type="number" class="form-control" name="mail_settings[port]"
										value="{{$settings['mail_settings']['port'] ?? '' }}" placeholder="Enter Port">
								</div>
								<!-- Mail Encryption -->
								<div class="mb_20">
									<label for="" class="form-label">Mail Encryption</label>
									<input type="text" class="form-control" name="mail_settings[encryption]"
										value="{{$settings['mail_settings']['encryption'] ?? '' }}"
										placeholder="Enter Encryption">
								</div>
								<!-- From Address -->
								<div class="mb_20">
									<label class="form-label">From Address</label>
									<input type="text" class="form-control" name="mail_settings[from_address]"
										value="{{$settings['mail_settings']['from_address'] ?? '' }}"
										placeholder="From Address">
								</div>
								<!-- From Name -->
								<div class="mb_20">
									<label class="form-label">From Name</label>
									<input type="text" class="form-control" name="mail_settings[from_name]"
										value="{{$settings['mail_settings']['from_name'] ?? '' }}"
										placeholder="From Name">
								</div>
							</div>
							<div class="ic-button-wrapper d-flex justify-content-end">
								<div class="right-button-group ">
									<button class="ic-button white">Cancel</button>
									<button type="submit" class="ic-button grey">Submit</button>
								</div>
							</div>


						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
	</x-admin.app>