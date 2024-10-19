<x-admin.layouts.app :title="getbreadcumb()">
   
    <div class="ic-table-content">
        <div class="ic-table-header mb_30 container">
            <div class="ic-search-filter-left d-flex">
                <div class="ic-searchbar-wrapper">
                    <input type="text" placeholder="Search User" id="customSearchInput">
                    <div class="ic-serach-btn">
                        <i class="ri-search-line"></i>
                    </div>
                </div>

            </div>
        </div>
        <x-admin.partials.datatable :dataTable="$dataTable">
        </x-admin.partials.datatable>
    </div>
</x-admin.layouts.app>
