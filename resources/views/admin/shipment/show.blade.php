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
                                        <strong class="text-info">Shipment Detalis</strong>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Order Number</th>
                                    <td class="pe-2">:</td>
                                    <td> {{ $item->order_number }}</td>
                                </tr>
                                <tr>
                                    <th>Company Name</th>
                                    <td class="pe-2">:</td>
                                    <td> {{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Sender WareHouse</th>
                                    <td class="pe-2">:</td>
                                    <td> {{ $item->warehouse->name }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td class="pe-2">:</td>
                                    <td>
                                        <badge
                                            class="badge p-2 {{ $item->status == 'released' ? 'bg-warning' : 'bg-success' }}">
                                            {{ $item->status }}</badge>
                                    </td>
                                </tr>

                                {{-- <tr>
                            <th>
                                <h6>Product Type: {{ $delivery->delivery_type }}</h6>
                            </th>
                        </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 mt-3">
                        <strong class="text-info">Sender Coustomer Information</strong>
                        <address>
                            <span>Country:{{ $item->customer_address->country->name }}</span></br>
                            <span>City:{{ $item->customer_address->city }}</span></br>
                            <span>Street:{{ $item->customer_address->street }}</span></br>
                            <span>Phone:{{ $item->customer_address->phone }}</span></br>
                        </address>
                    </div>

                </div>
            </div>
        </div>
        <div class="ic-table-content"style="border-radius:0px 0px 10px 10px ">
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
                                <th>Type</th>
                                <th>Shipment Date</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->get_product as $key => $product)
                                <tr>
                                    <!-- sl -->
                                    <td>
                                        <div>
                                            {{ $key + 1 }}
                                        </div>
                                    </td>

                                    <!-- Avatar -->
                                    @if (!is_null($product->product_id))
                                        <td>
                                            {{ $product->products->name }}
                                        </td>
                                        <td>
                                            Product
                                        </td>
                                    @endif
                                    @if (!is_null($product->bundle_id))
                                        <td>
                                            {{ $product->bundles->name }}
                                        </td>
                                        <td>
                                            Bundle
                                        </td>
                                    @endif
                                    <td>
                                        {{ $product->created_at->format('d F Y') }}
                                    </td>
                                    <!-- First Name -->
                                    <td>
                                        {{ $product->quantity }}
                                    </td>
                                    <!-- 1 -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-end">
                <h4 class="pe-2">Download:</h4>
                <a href="{{  }}" download=""><span class=""><i class="ri-printer-line py-2"></i></span></a>
            </div> --}}
        </div>

    </div>
</x-admin.app>
