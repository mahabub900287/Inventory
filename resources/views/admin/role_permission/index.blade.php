<x-admin.layouts.app :title="getbreadcumb()">
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


            <a role="button" class="ic-button primary" href="{{ route('admin.roles.create') }}">
                <i class="ri-add-fill"></i>
                <span>New Role</span>
            </a>
            <a role="button" class="ic-button primary" id="apply-bulk-action"
                href="{{ route('admin.roles.bulk.action') }}">
                <i class="ri-delete-bin-6-line"></i>
                <span class="delete-item-text">Delete Item</span>
            </a>
        </div>
        <x-admin.partials.datatable :dataTable="$dataTable"></x-admin.partials.datatable>
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
