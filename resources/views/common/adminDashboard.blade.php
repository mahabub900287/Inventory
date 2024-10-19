<x-admin.layouts.app title="Dashboard">
    <div class="ic-dashboard-home">
        <div class="ic-card-wrapper mb_24">
            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/total-user.png"
                        alt="">
                </div>
                <p class="ic-title">Total Products</p>
                <h4 class="ic-count">{{ $products }}</h4>
            </div>

            <div class="ic-single-card">
                <div class="ic-top-logo">
                    <img class="img-fluid" src="{{ asset('assets/admin') }}/images/dashboard/total-tenant.png"
                        alt="">
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
                        <a
                            href="{{ route('admin.shipment.index', ['status' => App\Models\Shipment::RELEASE_STATUS]) }}">
                            <p class="mb_10"><i class="ri-bar-chart-grouped-line"></i></p>
                            <p class="fs_12">New Shipment</p>
                        </a>
                        <a
                            href="{{ route('admin.shipment.index', ['status' => App\Models\Shipment::PROCESSING_STATUS]) }}">
                            <p class="mb_10"><i class="ri-restart-line"></i></p>
                            <p class="fs_12">Processing Shipment</p>
                        </a>
                        <a href="{{ route('admin.shipment.index', ['status' => App\Models\Shipment::SENT_STATUS]) }}">
                            <p class="mb_10"><i class="ri-line-chart-fill"></i></p>
                            <p class="fs_12">Complete Shipment</p>
                        </a>

                    </div>
                    <div class="ic-content pt-0">
                        <a href="{{ route('admin.shipment.return-list') }}">
                            <p class="mb_10"><i class="ri-arrow-go-back-line"></i></p>
                            <p class="fs_12">Return </p>
                        </a>'
                        <a href="{{ route('admin.delivery.index') }}">
                            <p class="mb_10"><i class="ri-inbox-archive-line"></i></p>
                            <p class="fs_12">Delivery</p>
                        </a>
                        <a href="{{ route('admin.users.index') }}">
                            <p class="mb_10"><i class="ri-shield-user-line"></i></p>
                            <p class="fs_12">All User</p>
                        </a>


                    </div>
                </div>
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
