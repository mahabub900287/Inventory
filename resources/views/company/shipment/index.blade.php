<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-stage-wrapper ic-shipment-heading-navigation">
        <div
            class="ic-stage {{ request()->routeIs('company.shipment.index') && request('status', 'all') == 'all' ? 'active' : '' }}">
            <a href="{{ route('company.shipment.index') }}">All</a>
        </div>
        <span class="ic-stage-arrow"><i class="ri-arrow-right-s-line"></i></span>
        <div
            class="ic-stage {{ request()->routeIs('company.shipment.index') && request('status') == App\Models\Shipment::RELEASE_STATUS ? 'active' : '' }}">
            <a class="position-relative p-2"
                href="{{ route('company.shipment.index', ['status' => App\Models\Shipment::RELEASE_STATUS]) }}">Released
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    @php
                        $total = App\Models\Shipment::where('status', App\Models\Shipment::RELEASE_STATUS)
                            ->where('created_by', Auth::id())
                            ->count();
                    @endphp
                    {{ $total }}
                </span>
            </a>

        </div>
        <span class="ic-stage-arrow"><i class="ri-arrow-right-s-line"></i></span>
        <div
            class="ic-stage {{ request()->routeIs('company.shipment.index') && request('status') == App\Models\Shipment::PROCESSING_STATUS ? 'active' : '' }}">
            <a
                href="{{ route('company.shipment.index', ['status' => App\Models\Shipment::PROCESSING_STATUS]) }}">Processing</a>
        </div>
        <span class="ic-stage-arrow"><i class="ri-arrow-right-s-line"></i></span>
        <div
            class="ic-stage {{ request()->routeIs('company.shipment.index') && request('status') == App\Models\Shipment::SENT_STATUS ? 'active' : '' }}">
            <a href="{{ route('company.shipment.index', ['status' => App\Models\Shipment::SENT_STATUS]) }}">Sent</a>
        </div>
    </div>
    <div class="ic-table-content">
        <div class="ic-table-header mb_30 ">
            <div class="ic-search-filter-left d-flex">
                <div class="ic-searchbar-wrapper">
                    <input type="text" placeholder="Search User" id="customSearchInput">
                    <div class="ic-serach-btn">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                <a role="button" class="ic-button primary ms-2" href="" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ri-filter-line"></i>
                    <span>Filters</span>
                </a>
                <div class="ic-filter-sidebar">
                    <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h4 class="offcanvas-title" id="offcanvasRightLabel">Filters</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <form id="filterDataForm">
                                <div class="ic_form row row-cols-12 gx-sm-2">
                                    <!-- Role -->
                                    <div class="mb_20">
                                        <label for="" class="form-label">Product type</label>
                                        <select id="productType" class="ic-select" aria-label="Select Gender">
                                            <option value="">Please select</option>
                                            <option value="bundle"
                                                {{ request('productType ') == 'bundle' ? 'selected' : '' }}>Bundle
                                            </option>
                                            <option value="product"
                                                {{ request('productType') == 'product' ? 'selected' : '' }}>Product
                                            </option>
                                        </select>
                                    </div>

                                    <div class="mb_20">
                                        <label for="" class="form-label">Status</label>
                                        <select id="status" class="ic-select" aria-label="Select Gender">
                                            <option value="all">All</option>
                                            <option value="{{ App\Models\Shipment::RELEASE_STATUS }}"
                                                {{ request('status') == App\Models\Shipment::RELEASE_STATUS ? 'selected' : '' }}>
                                                Release
                                            </option>
                                            <option value="{{ App\Models\Shipment::PROCESSING_STATUS }}"
                                                {{ request('status') == App\Models\Shipment::PROCESSING_STATUS ? 'selected' : '' }}>
                                                Processing
                                            </option>
                                            <option value="{{ App\Models\Shipment::SENT_STATUS }}"
                                                {{ request('status') == App\Models\Shipment::SENT_STATUS ? 'selected' : '' }}>
                                                Sent
                                            </option>
                                            <option value="{{ App\Models\Shipment::RETURN_STATUS }}"
                                                {{ request('status') == App\Models\Shipment::RETURN_STATUS ? 'selected' : '' }}>
                                                Return
                                            </option>
                                        </select>
                                    </div>
                                    @php
                                        $warehouses = App\Models\WareHouse::get();
                                    @endphp
                                    <div class="mb_20">
                                        <label for="" class="form-label">Warehouse</label>
                                        <select id="warehouse" class="ic-select" aria-label="Select Gender"
                                            data-live-search="true">
                                            <option value="">Please select warehouse</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}"
                                                    {{ request('warehouse') == $warehouse->id ? 'selected' : '' }}>
                                                    {{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="ic-button-wrapper">
                                    <div class="left">
                                        <button class="ic-button grey">Clear all</button>
                                    </div>
                                    <div class="right-button-group ">

                                        <button class="ic-button primary">Done</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <a role="button" class="ic-button primary" href="{{ route('company.shipment.create') }}">
                <i class="ri-add-fill"></i>
                <span>New Shipment</span>
            </a>
            <a role="button" class="ic-button primary" id="apply-bulk-action"
                href="{{ route('company.shipment.bulk.action') }}">
                <i class="ri-delete-bin-6-line"></i>
                <span class="delete-item-text">Delete Item</span>
            </a>
        </div>

        <x-admin.partials.datatable :dataTable="$dataTable">
            <script>
                $(document).ready(function() {
                    var filterForm = document.getElementById('filterDataForm');
                    filterForm.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission
                        // Get selected values
                        var productType = document.getElementById('productType').value;
                        var status = document.getElementById('status').value;
                        var warehouse = document.getElementById('warehouse').value;
                        // Create the URL with the selected parameters
                        var newUrl = "{{ route('company.shipment.index') }}?productType=" + productType +
                            "&status=" + status + "&warehouse=" + warehouse;
                        // Redirect to the new URL
                        window.location.href = newUrl;
                    });
                });
            </script>

        </x-admin.partials.datatable>
    </div>
    <x-slot name="bottomScript">
        <script>
            $('#apply-bulk-action').hide();
            // Handle checkbox changes
            function loadChecboxEvent() {
                $('.bulk-checkbox').on('change', function() {
                    // Check if any checkboxes are checked
                    var anyCheckboxChecked = $('.bulk-checkbox:checked').length > 0;
                    // Show/hide the "Delete Selected" button based on checkbox state
                    $('#apply-bulk-action').toggle(anyCheckboxChecked);
                });
            }
        </script>
    </x-slot>
</x-admin.layouts.app>
