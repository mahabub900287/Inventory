<x-admin.layouts.app title="Dashboard">
    <div class="ic-dashboard-home">
        <div class="ic-card-wrapper mb_24">
            <div class="ic-single-card">
                <div class="ic-top-logo">
                    {{-- <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/total-user.png"
                        alt=""> --}}
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/products.png" alt="">
                </div>
                <p class="ic-title">Total Products</p>
                <h4 class="ic-count">{{ $products }}</h4>
            </div>

            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/gift.png" alt="">
                </div>
                <p class="ic-title">Total Bundles</p>
                <h4 class="ic-count">{{ $bundles }}</h4>
            </div>

            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/truck.png" alt="">
                </div>
                <p class="ic-title">Total Deliveries</p>
                <h4 class="ic-count">{{ $deliveries }}</h4>
            </div>

            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/shipment.png"
                        alt="">
                </div>
                <p class="ic-title">Total Shipment</p>
                <h4 class="ic-count">{{ $shipments }}</h4>
            </div>

            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/tracking.png"
                        alt="">
                </div>
                <p class="ic-title">Shipment(Process..)</p>
                <h4 class="ic-count">{{ $shipments_procrssing }}</h4>
            </div>

            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/package.png"
                        alt="">
                </div>
                <p class="ic-title">Shipment(Com..)</p>
                <h4 class="ic-count">{{ $shipments_complete }}</h4>
            </div>

            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/return.png"
                        alt="">
                </div>
                <p class="ic-title">Return Shipment</p>
                <h4 class="ic-count">{{ $shipments_return }}</h4>
            </div>
        </div>
        <div class="ic-report-user-wrapper mb_24 ">

            <div class="ic-report ic-common">
                <div class="ic-report-heding mb_20">
                    <h5 class="ic-table-title cl-black fw-600  ">Shipment Report</h5>
                    <ul class="ic-right-content">
                        <li>
                            <div class="ic-item">
                                Total: <span>{{ $shipments }}</span>
                            </div>
                        </li>
                        <li>
                            <div class="ic-item after subscription">
                                Complete
                            </div>
                        </li>
                        <li>
                            <div class="ic-item after revenue">
                                Return
                            </div>
                        </li>
                        {{-- <li>
                            <select class="ic-select" aria-label="Select Month">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </li> --}}
                    </ul>
                </div>


                <!-- chart-content -->
                <div class="chart-content">
                    <div class="" id="chart"></div>
                </div>
            </div>

            <div class="ic-quick-functions-wrapper">
                <div class="ic-quick-functions mb_16">
                    <div class="ic-function-header">
                        <h5 class="ic-table-title cl-black fw-600  ">Quick Functions</h5>
                    </div>
                    <div class="ic-content">
                        <a href="{{ route('company.shipment.create') }}">
                            <p class="mb_10"><i class="ri-bar-chart-grouped-line"></i></p>
                            <p class="fs_12">New Shipment</p>
                        </a>
                        <a href="{{ route('company.product.create') }}">
                            <p class="mb_10"><i class="ri-pie-chart-fill"></i></p>
                            <p class="fs_12">New Product</p>
                        </a>
                        <a href="{{ route('company.shipment.csv.create') }}">
                            <p class="mb_10">
                                <i class="ri-line-chart-fill"></i>
                            </p>
                            <p class="fs_12">Shipment Import</p>
                        </a>
                    </div>
                </div>
                {{-- <div class="ic-quick-functions">
                    <div class="ic-function-header">
                        <h5 class="ic-table-title cl-black fw-600">Top 5 Shipped-To Countries</h5>
                    </div>
                    <div class="ic-tab-area p-2">
                        <div class="ic-tab-btn-wrapper d-flex gap-2 align-items-center justify-content-end">
                            <p><strong>Time Period:</strong></p>
                            <ul class="nav nav-pills d-flex gap-1" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="ic-tab-btn active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">1W</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="ic-tab-btn" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">1M</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="ic-tab-btn" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">3M</button>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <h1 class="fw-300">1</h1>
                                <p>Shipments</p>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab" tabindex="0">
                                <h1 class="fw-300">2</h1>
                                <p>Shipments</p>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                aria-labelledby="pills-contact-tab" tabindex="0">
                                <h1 class="fw-300">3</h1>
                                <p>Shipments</p>
                            </div>

                        </div>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
    <x-slot name="bottomScript">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            var allCompleteShipments = <?php echo json_encode($all_complete_shipment->toArray()); ?>;
            var allReturnShipment = <?php echo json_encode($all_return_shipment->toArray()); ?>;

            var options = {
                colors: ['#9E77ED', '#EB5E28'],
                series: [{
                    name: 'Complete',
                    data: Object.values(allCompleteShipments)
                }, {
                    name: 'Returns',
                    data: Object.values(allReturnShipment)
                }],
                chart: {
                    height: 350,
                    type: 'area'
                },
                grid: {
                    show: true
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: Object.keys(allCompleteShipments)
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>

    </x-slot>
</x-admin.layouts.app>
