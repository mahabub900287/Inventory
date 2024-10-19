<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-home-content">
        <div class="ic-shipment-product-details mt_30">
            <div class="ic-table-wrapper" style="border-radius: 10px 10px 0px 0px">
                <h4 class="ic-table-title h4-2">Recipient</h4>
                <div class="row">
                    <div class="col-md-8">
                        <table>
                            <tbody>
                                <tr>
                                    <th>
                                        <strong class="text-info">Delivery Detalis</strong>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td class="pe-2">:</td>
                                    <td> {{ $delivery->sender_name }}</td>
                                </tr>
                                <tr>
                                    <th>Address: </th>
                                    <td class="pe-2">:</td>
                                    <td>{{ $delivery->sender_address }}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Type</th>
                                    <td class="pe-2">:</td>
                                    <td>{{ $delivery->delivery_type }}</td>
                                </tr>
                                <tr>
                                    <th>Porduct Type</th>
                                    <td class="pe-2">:</td>
                                    <td>{{ $delivery->product_type == 0 ? 'Product' : 'Bundle' }}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Status</th>
                                    <td class="pe-2">:</td>
                                    <td>
                                        <badge
                                            class="badge p-2 {{ $delivery->status == 'rejected' ? 'bg-warning' : 'bg-success' }}">
                                            {{ $delivery->status }}</badge>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 mt-3">
                        <strong class="text-info px-3">Sender Company Information</strong>
                        <address class="px-3">
                            <span>Company:{{ $delivery->user->company_name }}</span></br>
                            <span>Coustomer Name:{{ $delivery->user->first_name . ' ' . $delivery->user->last_name }}
                            </span></br>
                            <span>Email:{{ $delivery->user->email }}</span></br>
                            <span>Phone:{{ $delivery->user->phone }}</span></br>
                            <span>Delivery Date:{{ $delivery->created_at->format('d F Y') }}</span></br>
                        </address>
                    </div>

                </div>
            </div>
        </div>
        <div class="ic-table-content" style="border-radius:0px 0px 10px 10px ">
            <div class="ic-table-header mb_30">
                <h4 class="h4-2">Product Info</h4>
            </div>
            <div class="ic-content">
                <div class="table-responsive mb_30">
                    <table class="table ic_table">
                        <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($delivery->product_type)
                                @foreach ($delivery->deliveryBundles as $key => $bundle)
                                    <tr>
                                        <!-- sl -->
                                        <td>
                                            <div>
                                                {{ $key + 1 }}
                                            </div>
                                        </td>

                                        <!-- Avatar -->
                                        <td>
                                            {{ $bundle->bundles->name }}
                                        </td>

                                        <!-- First Name -->
                                        <td>
                                            {{ $bundle->quantity }}
                                        </td>
                                        <!-- 1 -->
                                    </tr>
                                @endforeach
                            @elseif(!$delivery->product_type)
                                @foreach ($delivery->deliveryProducts as $key => $product)
                                    <tr>
                                        <!-- sl -->
                                        <td>
                                            <div>
                                                {{ $key + 1 }}
                                            </div>
                                        </td>

                                        <!-- Avatar -->
                                        <td>
                                            {{ $product->products->name }}
                                        </td>

                                        <!-- First Name -->
                                        <td>
                                            {{ $product->quantity }}
                                        </td>
                                        <!-- 1 -->

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>



            </div>
        </div>

    </div>
    </x-admin.app>
