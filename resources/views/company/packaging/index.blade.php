<x-admin.layouts.app :title="getbreadcumb()">
    <x-company.partials.invertory_head></x-company.partials.invertory_head>
    <div class="ic-table-content">
        <div class="ic-table-header mb_30">
            <div class="ic-search-filter-left d-flex">
                <div class="ic-searchbar-wrapper">
                    <input type="text" placeholder="Search User" id="customSearchInput">
                    <div class="ic-serach-btn">
                        <i class="ri-search-line"></i>
                    </div>
                </div>

            </div>


            <a role="button" class="ic-button primary" href="{{ route('company.packaging.create') }}">
                <i class="ri-add-fill"></i>
                <span>New Packaging Material</span>
            </a>
            <a role="button" class="ic-button primary" id="apply-bulk-action"
                href="{{ route('company.packaging.bulk.action') }}">
                <i class="ri-delete-bin-6-line"></i>
                <span class="delete-item-text">Delete Item</span>
            </a>
        </div>
        <x-admin.partials.datatable :dataTable="$dataTable" :create="'company.product.create'">
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
                    console.log(itemType);
                    event.preventDefault();
                    var csrf_token = '{{ csrf_token() }}';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrf_token // Include the CSRF token in the request headers
                        }
                    });
                    $.ajax({
                        url: '{{ route('company.packaging.status.change') }}',
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
