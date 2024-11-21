{{--<style>
    .start-25 {
        left: 33.33% !important;
    }
    .start-75 {
        left: 66.66% !important;
    }
</style>--}}
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <h4 class="card-title">Orders #{{$order?->id}}</h4>
                            <p class="mb-0 text-muted mt-1">{{$order?->created_at?->format('F-d-Y')}}</p>
                        </div><!--end col-->
                        <div class="col d-flex justify-content-end">
                            <a href="{{route('invoice',$order?->id)}}" class="btn btn-info">Create Invoice</a>
                        </div>

                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($order)

                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <img src="{{asset('storage/app/'.$item->product?->image?->path)}}" alt="" height="40">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="d-block align-middle mb-0 product-name text-body">{{$item->product?->title}}</span>
                                            <span class="text-muted font-13">{{$item->product?->SKU}}</span>
                                        </p>
                                    </td>
                                    <td class="text-end">${{$item->sub_total / $item->qty }}</td>
                                    <td class="text-end">{{$item->qty}}</td>
                                    <td class="text-end">${{$item->sub_total}}</td>
                                </tr>

                            @endforeach
                            @else
                                <tr class="table-danger text-center">
                                    <td colspan="4">Order not found</td>
                                </tr>
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div><!--card-body-->
            </div><!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Order - {{$order?->status}}</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <a href="#" class="text-secondary"><i class="fas fa-download me-1"></i> Download Invoice</a>
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">

                    <div class="position-relative m-4">
                        <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                            <div class="progress-bar"  style="width: @switch($order?->status) @case('delivery') 50% @break @case('delivered') 100% @break @default 0% @endswitch "></div>
                        </div>
                        <div  @if($order?->status !== 'cancelled') role="button" wire:click="changeStatus('pending')" @endif class="position-absolute top-0 start- translate-middle @switch($order?->status) @case('delivery') bg-primary text-white @break @case('delivered') bg-primary text-white @break @case('cancelled') bg-danger text-white @break @default bg-primary-subtle text-primary @endswitch   rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                        <div  @if($order?->status !== 'cancelled') role="button" wire:click="changeStatus('delivery')" @endif class="position-absolute top-0 start-50 translate-middle @switch($order?->status) @case('delivery') bg-primary-subtle text-primary @break @case('delivered') bg-primary text-white @break @case('cancelled') bg-danger text-white @break @default bg-light text-dark @endswitch  rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
                        <div  @if($order?->status !== 'cancelled') role="button" wire:click="changeStatus('delivered')" @endif class="position-absolute top-0 start-100 translate-middle @switch($order?->status) @case('delivery') bg-primary->subtle text-dark @break @case('delivered') bg-primary text-white @break @case('cancelled') bg-danger text-white @break @default bg-light text-dark @endswitch rounded-pill thumb-md"><i class="iconoir-map-pin"></i></div>
                    </div>
                    @if($order?->status == 'cancelled' )
                        <div class="bg-danger-subtle p-2 border-dashed border-danger rounded mt-3">
                            <span class="text-danger fw-semibold">Note :</span><span class="text-danger fw-normal"> Order has been cancelled</span>
                        </div>
                    @else
                    <div class="row row-cols-3">
                        <div class="col text-start">
                            <h6 class="mb-1">Order Pending</h6>
                        </div> <!-- end col -->

                        <div class="col text-center">
                            <h6 class="mb-1">On Delivery</h6>
                        </div> <!-- end col -->
                        <div class="col text-end">
                            <h6 class="mb-1">Order Delivered</h6>
                        </div> <!-- end col -->
                    </div> <!-- end row -->
                    @endif

                    @if($order?->message && $order?->status != 'cancelled')
                        <div class="bg-primary-subtle p-2 border-dashed border-primary rounded mt-3">
                            <span class="text-primary fw-semibold">Note :</span><span class="text-primary fw-normal"> {{$order->message}}</span>
                        </div>
                    @endif

                </div><!--card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Order Summary</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            @switch($order?->status)
                                @case('cancelled')
                                    <span class="badge rounded text-danger bg-danger-subtle fs-12 p-1">Order {{$order?->status}}</span>

                                @break
                                @case('delivery')
                                    <span class="badge rounded text-info bg-info-subtle fs-12 p-1">Order {{$order?->status}}</span>

                                    @break
                                @case('delivered')
                                    <span class="badge rounded text-primary bg-primary-subtle fs-12 p-1">Order {{$order?->status}}</span>

                                    @break
                                @default
                                    <span class="badge rounded text-secondary bg-secondary-subtle fs-12 p-1">Order {{$order?->status}}</span>
                            @endswitch
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold"> Items :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->items->count()}}</p>
                        </div>


                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold">Subtotal :</p>
                            <p class="text-body-emphasis fw-semibold">${{$order?->total}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold mb-0">Shipping Cost :</p>
                            <p class="text-body-emphasis fw-semibold mb-0">Free</p>
                        </div>
                    </div>
                    <hr class="hr-dashed">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Total :</h4>
                        <h4 class="mb-0">${{$order?->total}}</h4>
                    </div>
                </div><!--card-body-->
            </div><!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Order Information</h4>
                        </div><!--end col-->

                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-profile-circle text-secondary fs-20 align-middle me-1"></i>Username :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->user->name}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-people-tag text-secondary fs-20 align-middle me-1"></i>Full Name :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->full_name}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-mail text-secondary fs-20 align-middle me-1"></i>Phone Number :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->phone_number}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-dollar-circle text-secondary fs-20 align-middle me-1"></i>Total Payment :</p>
                            <p class="text-body-emphasis fw-semibold"><span class="text-primary">${{$order?->total}}</span> </p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-calendar text-secondary fs-20 align-middle me-1"></i>Order Date :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->created_at?->format('F-d-Y')}}</p>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-delivery-truck text-secondary fs-20 align-middle me-1"></i>Country :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->country}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-delivery-truck text-secondary fs-20 align-middle me-1"></i>State :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->state}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-delivery-truck text-secondary fs-20 align-middle me-1"></i>State :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->city}}</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p class="text-body fw-semibold"><i class="iconoir-delivery-truck text-secondary fs-20 align-middle me-1"></i>State :</p>
                            <p class="text-body-emphasis fw-semibold">{{$order?->zip_code}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold"><i class="iconoir-map-pin text-secondary fs-20 align-middle me-1"></i>Address :</p>
                            <p class="text-body-emphasis fw-semibold">
                                {{$order?->address}}
                            </p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-body fw-semibold"><i class="iconoir-map-pin text-secondary fs-20 align-middle me-1"></i>Address 2 :</p>
                            <p class="text-body-emphasis fw-semibold">
                                {{$order?->address2}}
                            </p>
                        </div>
                    </div>
                </div><!--card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
