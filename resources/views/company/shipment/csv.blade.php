<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-status-wrapper">
        <div class="ic-stage ">
            <a href="{{ route('company.shipment.create') }}">Manually</a>
        </div>
        <div class="ic-stage active">
            <a href="{{ route('company.shipment.csv.create') }}">CSV Import</a>
        </div>
    </div>
    <div class="inventory-heading">
        <h5 class="ic-top-title ">Upload CSV</h5>

        <a class="ic-close-btn" href="{{ route('company.shipment.index') }}"><i class="ri-close-fill"></i></a>
    </div>
    <div class="ic-upload-content ic-table-content">

        <div class="upload-bottom-uploader mt_30 mb_30">
            <div class="ic-help-template-wrapper mb_20">
                <a class="need-help" href="">Need Help?</a>

                <a role="button" class="ic-button primary px-3" download="" href="{{ asset('csv/shipment.csv') }}">
                    <i class="ri-add-fill"></i>
                    <span>Download Template</span>
                </a>
            </div>
            <x-form method="POST" action="{{ route('company.shipment.csv.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="ic-file-wrapper mb-3">
                    <input type="file" name="uploaded_file">

                    <div class="ic-content text-center">
                        <div class="ic-upload-icon">
                            <img src="{{ asset('assets/admin/images/logo/image-upload.png') }}" alt="">
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
                <div class="inventory-heading bottom">
                    <div class="right-button-group justify-content-end w-100">
                        <a role="button" class="ic-button white " href="{{ route('company.shipment.index') }}">
                            Cancel
                        </a>

                        <button class="ic-button primary">
                            <i class="ri-checkbox-circle-line"></i>
                            <span>Upload</span>
                        </button>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
    <x-slot name="bottomScript">
    </x-slot>
    </x-admin.app>
