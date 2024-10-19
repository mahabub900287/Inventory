<x-admin.layouts.app :title="getbreadcumb()">
    <x-company.partials.invertory_head></x-company.partials.invertory_head>
    <div class="ic-status-wrapper">
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status', 'all') == 'all' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'all']) }}">ALL</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == App\Models\Delivery::ANNOUNCED_STATUS ? 'active' : '' }}">
            <a
                href="{{ route('company.delivery.index', ['status' => App\Models\Delivery::ANNOUNCED_STATUS]) }}">Announced</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == App\Models\Delivery::PROCESSING_STATUS ? 'active' : '' }}">
            <a
                href="{{ route('company.delivery.index', ['status' => App\Models\Delivery::PROCESSING_STATUS]) }}">Processing</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == App\Models\Delivery::CANCELLED_STATUS ? 'active' : '' }}">
            <a
                href="{{ route('company.delivery.index', ['status' => App\Models\Delivery::CANCELLED_STATUS]) }}">Rejected</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == App\Models\Delivery::COMPLETED_STATUS ? 'active' : '' }}">
            <a
                href="{{ route('company.delivery.index', ['status' => App\Models\Delivery::COMPLETED_STATUS]) }}">Completed</a>
        </div>
    </div>
    <div class="ic-table-content">
        <div class="ic-table-header mb_30">
            <div class="ic-search-filter-left d-flex">
                <div class="ic-searchbar-wrapper">
                    <input type="text" placeholder="Type to search" id="customSearchInput">
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
                                        <label for="" class="form-label">Package type</label>
                                        <select id="packageType" class="ic-select" aria-label="Select Gender">
                                            <option value="">Please select</option>
                                            <option value="pallets"
                                                {{ request('packageType ') == 'pallets' ? 'selected' : '' }}>Pallets
                                            </option>
                                            <option value="parcels"
                                                {{ request('packageType') == 'parcels' ? 'selected' : '' }}>Parcels
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb_20">
                                        <label for="" class="form-label">Product type</label>
                                        <select id="productType" class="ic-select" aria-label="Select Gender">
                                            <option value="">Please select</option>
                                            <option value="1"
                                                {{ request('productType ') == '1' ? 'selected' : '' }}>Bundle
                                            </option>
                                            <option value="0"
                                                {{ request('productType') == '0' ? 'selected' : '' }}>
                                                Product
                                            </option>
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


            <a role="button" class="ic-button primary" href="{{ route('company.delivery.create') }}">
                <i class="ri-add-fill"></i>
                <span>New Delivery</span>
            </a>
            <a role="button" class="ic-button primary" id="apply-bulk-action"
                href="{{ route('company.delivery.bulk.action') }}">
                <i class="ri-delete-bin-6-line"></i>
                <span class="delete-item-text">Delete Item</span>
            </a>
        </div>
        <x-admin.partials.datatable :dataTable="$dataTable" :create="'company.delivery.create'">
            <script>
                $('#customSearchInput').on('keyup', function() {

                    $('#dataTableBuilder').DataTable().destroy();
                    $('#customSearchInput').on('keyup', function() {
                        var dataTable = $('#dataTableBuilder').DataTable();
                        var searchValue = $(this).val().trim();
                        if (searchValue !== '') {
                            dataTable.search(searchValue).draw();
                        } else {
                            location.reload();
                        }
                    });
                });

                function filtterStatus(status) {
                    var statusValue = status;
                    var dataTable = $('#dataTableBuilder').DataTable();
                    dataTable.column('status:name').search(status).draw();
                }

                function makeChangeStatus(productId, itemType) {

                    event.preventDefault();
                    var csrf_token = '{{ csrf_token() }}';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrf_token // Include the CSRF token in the request headers
                        }
                    });
                    $.ajax({
                        url: '{{ route('company.delivery.status.change') }}',
                        type: 'POST',
                        data: {
                            productId: productId,
                            itemType: itemType
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(error) {
                            console.error('Error updating status', error);
                        }
                    });
                }

                $(document).ready(function() {
                    var filterForm = document.getElementById('filterDataForm');
                    filterForm.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission
                        // Get selected values
                        var packageType = document.getElementById('packageType').value;
                        var productType = document.getElementById('productType').value;
                        // Create the URL with the selected parameters
                        var newUrl = "{{ route('company.delivery.index') }}?productType=" + productType +
                            "&packageType=" + packageType;
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
