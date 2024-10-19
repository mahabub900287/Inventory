<x-admin.layouts.app :title="getbreadcumb()">
    <x-company.partials.invertory_head></x-company.partials.invertory_head>
    <div class="ic-status-wrapper">
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status', 'all') == 'all' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'all']) }}">ALL</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == 'announced' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'announced']) }}">Announced</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == 'warehouse' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'warehouse']) }}">Warehouse</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == 'delivered' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'delivered']) }}">Delivered</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == 'processing' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'processing']) }}">Processing</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == 'cancelled' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'cancelled']) }}">Cancelled</a>
        </div>
        <div
            class="ic-stage {{ request()->routeIs('company.delivery.index') && request('status') == 'completed' ? 'active' : '' }}">
            <a href="{{ route('company.delivery.index', ['status' => 'completed']) }}">Completed</a>
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
            </div>
            <a role="button" class="ic-button primary" href="{{ route('company.delivery.create') }}">
                <i class="ri-add-fill"></i>
                <span>New Delivery</span>
            </a>
        </div>
        <x-admin.partials.datatable :dataTable="$dataTable">
            
        </x-admin.partials.datatable>
        
    </div>
    {{-- modal form --}}
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog  modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content  ic-modal-content">
                <!-- header -->
                <div class="modal-header">
                    <h5 class="modal-title">Delivery Summary</h5>
                </div>
                <!-- content -->
                <div class="modal-body">
    
                    <div class="ic-modal-mid-content mb_30">
                        <div class="ic-manual-content ">
                            <div class="ic-input-alert" style="background-color: #d9e8f2;">
                                <div class="icon">
                                    <i class="ri-error-warning-line"></i>
                                </div>
                                <div>
                                    <p>
                                        The content below is for preview purposes only. Please download the
                                        delivery note and attach the barcode to each pallet / parcel in the
                                        delivery.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row mb_30 mid-details-content">
                        <div class="col-md-6">
                            <div class="mb_20">
                                <h6 class="mb-1">From</h6>
                                <p>Doora Lee</p>
                            </div>
                            <div class="mb_20">
                                <h6 class="mb-1">Recipient</h6>
                                <p>
                                    Doora Lee
                                    <br>
                                    c/o byrd technologies
                                    <br>
                                    c/o messenger Fulfillment GmbH
                                    <br>
                                    Parkallee 26
                                    <br>
                                    14974 Ludwigsfelde DE
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="ic-barcode">
                                <feder-barcode _ngcontent-oav-c219="" class="feder-barcode" style="display: inline-block;">
                                    <svg class="feder-barcode-svg-MTL-877JVV" width="310px" height="142px" x="0px" y="0px"
                                        viewBox="0 0 310 142" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        style="transform: translate(0,0)">
                                        <rect x="0" y="0" width="310" height="142" style="fill:#FFFFFF;">
                                        </rect>
                                        <g transform="translate(10, 10)" style="fill:#000000;">
                                            <rect x="0" y="0" width="4" height="100"></rect>
                                            <rect x="6" y="0" width="2" height="100"></rect>
                                            <rect x="12" y="0" width="2" height="100"></rect>
                                            <rect x="22" y="0" width="2" height="100"></rect>
                                            <rect x="26" y="0" width="6" height="100"></rect>
                                            <rect x="34" y="0" width="4" height="100"></rect>
                                            <rect x="44" y="0" width="4" height="100"></rect>
                                            <rect x="50" y="0" width="6" height="100"></rect>
                                            <rect x="62" y="0" width="2" height="100"></rect>
                                            <rect x="66" y="0" width="2" height="100"></rect>
                                            <rect x="74" y="0" width="4" height="100"></rect>
                                            <rect x="80" y="0" width="6" height="100"></rect>
                                            <rect x="88" y="0" width="2" height="100"></rect>
                                            <rect x="94" y="0" width="4" height="100"></rect>
                                            <rect x="100" y="0" width="6" height="100"></rect>
                                            <rect x="110" y="0" width="6" height="100"></rect>
                                            <rect x="118" y="0" width="2" height="100"></rect>
                                            <rect x="124" y="0" width="4" height="100"></rect>
                                            <rect x="132" y="0" width="6" height="100"></rect>
                                            <rect x="140" y="0" width="4" height="100"></rect>
                                            <rect x="146" y="0" width="6" height="100"></rect>
                                            <rect x="154" y="0" width="6" height="100"></rect>
                                            <rect x="162" y="0" width="4" height="100"></rect>
                                            <rect x="168" y="0" width="6" height="100"></rect>
                                            <rect x="176" y="0" width="2" height="100"></rect>
                                            <rect x="180" y="0" width="4" height="100"></rect>
                                            <rect x="186" y="0" width="6" height="100"></rect>
                                            <rect x="198" y="0" width="6" height="100"></rect>
                                            <rect x="206" y="0" width="2" height="100"></rect>
                                            <rect x="210" y="0" width="4" height="100"></rect>
                                            <rect x="220" y="0" width="6" height="100"></rect>
                                            <rect x="228" y="0" width="2" height="100"></rect>
                                            <rect x="232" y="0" width="4" height="100"></rect>
                                            <rect x="242" y="0" width="6" height="100"></rect>
                                            <rect x="250" y="0" width="2" height="100"></rect>
                                            <rect x="258" y="0" width="4" height="100"></rect>
                                            <rect x="264" y="0" width="4" height="100"></rect>
                                            <rect x="274" y="0" width="6" height="100"></rect>
                                            <rect x="282" y="0" width="2" height="100"></rect>
                                            <rect x="286" y="0" width="4" height="100"></rect><text
                                                style="font: 20px Open Sans" text-anchor="middle" x="145"
                                                y="122">MTL-877JVV</text>
                                        </g>
                                    </svg>
                                </feder-barcode>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="">
                                <h6 class="mb-1">Details</h6>
                                <p>Delivery ID: MTL-877JVV</p>
                                <p>Delivery Date (From): 23/11/2023</p>
                                <p>Delivery Date (To): 30/11/2023</p>
                            </div>
                        </div>
                    </div>
    
    
                    <div class="table-responsive mb_30">
                        <table class="table ic_table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Amount</th>
                                    <th>Box code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- 1 -->
                                <tr>
                                    <td>
                                        Carton
                                    </td>
                                    <td>
                                        2394872938472934
                                    </td>
                                    <td>
                                        2
                                    </td>
                                    <td>
                                        —
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <div class="row justify-content-center mb_30">
                        <div class="col-xl-10 col-md-11 ">
                            <div class="ic-instruction">
                                Please print this barcode 1 time(s) and attach to each parcel/pallet.
                            </div>
                        </div>
                    </div>
    
                    <div class="row justify-content-center ">
                        <div class="col-xl-9 col-md-10 ">
                            <div class="ic-barcode-bottom">
                                <strong>Doora Lee</strong>
                                <div class="ic-barcode">
                                    <feder-barcode _ngcontent-oav-c219="" class="feder-barcode"
                                        style="display: inline-block;"><svg class="feder-barcode-svg-MTL-877JVV"
                                            width="310px" height="142px" x="0px" y="0px" viewBox="0 0 310 142"
                                            xmlns="http://www.w3.org/2000/svg" version="1.1"
                                            style="transform: translate(0,0)">
                                            <rect x="0" y="0" width="310" height="142" style="fill:#FFFFFF;">
                                            </rect>
                                            <g transform="translate(10, 10)" style="fill:#000000;">
                                                <rect x="0" y="0" width="4" height="100"></rect>
                                                <rect x="6" y="0" width="2" height="100"></rect>
                                                <rect x="12" y="0" width="2" height="100"></rect>
                                                <rect x="22" y="0" width="2" height="100"></rect>
                                                <rect x="26" y="0" width="6" height="100"></rect>
                                                <rect x="34" y="0" width="4" height="100"></rect>
                                                <rect x="44" y="0" width="4" height="100"></rect>
                                                <rect x="50" y="0" width="6" height="100"></rect>
                                                <rect x="62" y="0" width="2" height="100"></rect>
                                                <rect x="66" y="0" width="2" height="100"></rect>
                                                <rect x="74" y="0" width="4" height="100"></rect>
                                                <rect x="80" y="0" width="6" height="100"></rect>
                                                <rect x="88" y="0" width="2" height="100"></rect>
                                                <rect x="94" y="0" width="4" height="100"></rect>
                                                <rect x="100" y="0" width="6" height="100"></rect>
                                                <rect x="110" y="0" width="6" height="100"></rect>
                                                <rect x="118" y="0" width="2" height="100"></rect>
                                                <rect x="124" y="0" width="4" height="100"></rect>
                                                <rect x="132" y="0" width="6" height="100"></rect>
                                                <rect x="140" y="0" width="4" height="100"></rect>
                                                <rect x="146" y="0" width="6" height="100"></rect>
                                                <rect x="154" y="0" width="6" height="100"></rect>
                                                <rect x="162" y="0" width="4" height="100"></rect>
                                                <rect x="168" y="0" width="6" height="100"></rect>
                                                <rect x="176" y="0" width="2" height="100"></rect>
                                                <rect x="180" y="0" width="4" height="100"></rect>
                                                <rect x="186" y="0" width="6" height="100"></rect>
                                                <rect x="198" y="0" width="6" height="100"></rect>
                                                <rect x="206" y="0" width="2" height="100"></rect>
                                                <rect x="210" y="0" width="4" height="100"></rect>
                                                <rect x="220" y="0" width="6" height="100"></rect>
                                                <rect x="228" y="0" width="2" height="100"></rect>
                                                <rect x="232" y="0" width="4" height="100"></rect>
                                                <rect x="242" y="0" width="6" height="100"></rect>
                                                <rect x="250" y="0" width="2" height="100"></rect>
                                                <rect x="258" y="0" width="4" height="100"></rect>
                                                <rect x="264" y="0" width="4" height="100"></rect>
                                                <rect x="274" y="0" width="6" height="100"></rect>
                                                <rect x="282" y="0" width="2" height="100"></rect>
                                                <rect x="286" y="0" width="4" height="100"></rect><text
                                                    style="font: 20px Open Sans" text-anchor="middle" x="145"
                                                    y="122">MTL-877JVV</text>
                                            </g>
                                        </svg>
                                    </feder-barcode>
                                </div>
                            </div>
                        </div>
                    </div>
    
    
    
                </div>
                <!-- footer -->
                <div class="modal-footer">
                    <div class="right-button-group">
                        <a role="button" class="ic-button white " href="product-inventory.php">
                            <i class="ri-arrow-left-line"></i>
                            <span>Cancel</span>
                        </a>
    
                        <button class="ic-button grey ic-modal-trigger-btn2">
                            <i class="ri-download-2-line"></i>
                            <span>Download</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
                {{-- End Modal  --}}
    {{-- <x-slot name="bottomScript">
        <script>
            jQuery(document).ready(function(){
            $('#exampleModalToggle2').modal('show');
            });
        </script>
        
    </x-slot> --}}
</x-admin.layouts.app>
