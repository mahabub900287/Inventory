<x-admin.layouts.app :title="getbreadcumb()">
    <x-company.partials.invertory_head></x-company.partials.invertory_head>
    <div class="ic-status-wrapper">
        <div
            class="ic-stage {{ request()->routeIs('company.product.index') && request('status', 'all') == 'all' ? 'active' : '' }}">
            <a href="{{ route('company.product.index', ['status' => 'all']) }}" onclick="filtterStatus('all')">All</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.product.index') && request('status') == 'active' ? 'active' : '' }}">
            <a href="{{ route('company.product.index', ['status' => 'active']) }}"
                onclick="filtterStatus('active')">Active</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.product.index') && request('status') == 'inactive' ? 'active' : '' }}">
            <a href="{{ route('company.product.index', ['status' => 'inactive']) }}"
                onclick="filtterStatus('inactive')">Inactive</a>
        </div>
    </div>

    <div class="ic-table-content">
        <div class="ic-table-header mb_30">
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
                                            <option value="active"
                                                {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive"
                                                {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                    </div>
                                    @php
                                        $countries = App\Models\Country::get();
                                    @endphp
                                    <div class="mb_20">
                                        <label for="" class="form-label">Country</label>
                                        <select id="country" class="ic-select" aria-label="Select Gender"
                                            data-live-search="true">
                                            <option value="">Please select</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ request('country') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
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


            <a role="button" class="ic-button primary" href="{{ route('company.product.create') }}">
                <i class="ri-add-fill"></i>
                <span>New Product</span>
            </a>
            <a role="button" class="ic-button primary" id="apply-product-delete-action"
                href="{{ route('company.product.bulk.action') }}">
                <i class="ri-delete-bin-6-line"></i>
                <span class="delete-item-text">Delete Item</span>
            </a>
        </div>
        <x-admin.partials.datatable :dataTable="$dataTable" :create="'company.product.create'">
            <script>
                function filtterStatus(status) {
                    var statusValue = status;
                    var dataTable = $('#dataTableBuilder').DataTable();
                    dataTable.column('status:name').search(status).draw();
                }

                function makeChangeStatus(productId, itemType) {
                    console.log(itemType);
                    event.preventDefault();
                    var csrf_token = '{{ csrf_token() }}';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrf_token // Include the CSRF token in the request headers
                        }
                    });
                    $.ajax({
                        url: '{{ route('company.product.status.change') }}',
                        type: 'POST',
                        data: {
                            productId: productId,
                            itemType: itemType
                        },
                        success: function(response) {
                            notify('success', 'Your status update successfully');
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        },
                        error: function(error) {
                            console.error('Error updating status', error);
                        }
                    });
                }
                $(document).ready(function() {
                    $('#apply-product-delete-action').on('click', function(e) {
                        e.preventDefault();
                        var selectedIds = [];
                        var selectedType = [];
                        // Get all selected checkbox IDs
                        $('.bulk-checkbox:checked').each(function() {
                            selectedIds.push($(this).data('id'));
                            selectedType.push($(this).data('type'));
                        });

                        // Perform the selected bulk action
                        if (selectedIds.length > 0) {
                            // Example: Call a function to handle delete
                            var action = $('#apply-product-delete-action').attr('href');
                            handleProductDelete(selectedIds, action, selectedType);
                        } else {
                            alert('Please select at least one item to delete.');
                        }
                    });
                })
                // Function to handle bulk delete
                function handleProductDelete(ids, actions, types) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#02a499",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Corrected the dot before .ajax()
                            $.ajax({
                                url: actions,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                data: {
                                    ids: ids,
                                    types: types
                                },
                                success: function(response) {
                                    notify('success', 'Your item delete successfully');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2000);

                                },
                                error: function(error) {
                                    console.log(error);
                                },
                            });
                        }
                    });
                }
            </script>
            <script>
                $(document).ready(function() {
                    var filterForm = document.getElementById('filterDataForm');
                    filterForm.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission
                        // Get selected values
                        var productType = document.getElementById('productType').value;
                        var status = document.getElementById('status').value;
                        var country = document.getElementById('country').value;
                        // Create the URL with the selected parameters
                        var newUrl = "{{ route('company.product.index') }}?productType=" + productType +
                            "&status=" + status + "&country=" + country;
                        // Redirect to the new URL
                        window.location.href = newUrl;
                    });
                });
            </script>
        </x-admin.partials.datatable>
    </div>
    <x-slot name="bottomScript">
        <script>
            $('#apply-product-delete-action').hide();
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
