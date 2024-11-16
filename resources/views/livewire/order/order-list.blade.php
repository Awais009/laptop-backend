<div class="container-xxl">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Orders</h4>
                        </div><!--end col-->

                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th class="text-end">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td><a href="{{route('order.detail',$order->id)}}">#{{$order->id}}</a></td>
                                    <td>
                                        <a href="{{route('order.detail',$order->id)}}">

                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="d-block align-middle mb-0 product-name text-body">Bata Shoes</span>
                                            <span class="text-muted font-13">size-08 (Model 2024)</span>
                                        </p>
                                        </a>
                                    </td>
                                    <td>{{$order->created_at?->format('F-d-Y')}}</td>
                                    <td>Bank Trnasfer</td>
                                    <td>
                                        @switch($order->status)
                                            @case('cancelled')
                                                <span class="badge bg-danger-subtle text-danger"><i class="fas fa-xmark me-1"></i>Cancelled</span>
                                                @break
                                            @case('delivery')
                                                <span class="badge bg-info-subtle text-info"><i class="fas fa-truck me-1"></i>On Delivery</span>
                                                @break
                                            @case('delivered')
                                                <span class="badge bg-primary-subtle text-primary"><i class="fas fa-check me-1"></i>Delivered</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary-subtle text-secondary"><i class="fas fa-clock me-1"></i> Pending</span>
                                        @endswitch

                                    </td>
                                    <td>${{$order->total}}</td>
                                    <td class="text-end">
                                        <a href="#"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                    </td>
                                </tr>

                            @empty
                                <tr  class="text-center table-danger" >
<td colspan="7">Order not found</td>
                                </tr>

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
