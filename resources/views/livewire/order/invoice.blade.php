
<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body bg-black">
                    <div class="row">
                        <div class="col-4 align-self-center">
                            <img src="{{asset('public/assets/images/logo.png')}}" alt="logo-small" class="logo-sm me-1" height="70" >
                        </div><!--end col-->
                        <div class="col-8 text-end align-self-center">
                            <h5 class="mb-1 fw-semibold text-white"><span class="text-muted">Invoice:</span> #{{$order?->id}}</h5>
                            <h5 class="mb-0 fw-semibold text-white"><span class="text-muted">Issue Date: </span> {{$order?->created_at?->format('F/d/Y')}}</h5>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end card-body-->
                <div class="card-body">
                    <div class="row row-cols-3 d-flex justify-content-md-between">
                        <div class="col-md-3 d-print-flex align-self-center">
                            <div class="">
                                <span class="badge rounded text-dark bg-light">Invoice to</span>
                                <h5 class="my-1 fw-semibold fs-18">{{$order?->full_name}}</h5>
                                <p class="text-muted ">{{$order?->email}}|{{$order?->phone_number}}</p>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-3 d-print-flex align-self-center">
                            <div class="">
                                <address class="fs-13">
                                    <strong class="fs-14">Address 1 :</strong><br>
                                    {{$order?->address}} <br>
                                    {{$order?->city}} {{$order?->state}}, {{$order?->country}} {{$order?->zip_code}}<br>
                                    <abbr title="Phone">P:</abbr> {{$order?->phone_number}}
                                </address>
                            </div>
                        </div><!--end col-->
                        <div class="col-md-3 d-print-flex align-self-center">
                            <div class="">
                                <address class="fs-13">
                                    <strong class="fs-14">Address 2:</strong><br>
                                    {{$order?->address}} <br>
                                    {{$order?->city}} {{$order?->state}}, {{$order?->country}} {{$order?->zip_code}}<br>
                                    <abbr title="Phone">P:</abbr> {{$order?->phone_number}}
                                </address>
                            </div>
                        </div> <!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive project-invoice">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Project Breakdown</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr><!--end tr-->
                                    </thead>
                                    <tbody>
                                    @if($order)
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <h5 class="mt-0 mb-1 fs-14">{{$item->product?->title}}</h5>
                                                <p class="mb-0 text-muted">{{$item->product?->description}}</p>
                                            </td>
                                            <td>${{$item->sub_total/$item->qty}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>${{$item->sub_total}}</td>
                                        </tr><!--end tr-->

                                    @endforeach
                                    @endif

                                    <tr>
                                        <td colspan="1" class="border-0"></td>
                                        <td colspan="2" class="border-0 fs-14 text-dark"><b>Sub Total</b></td>
                                        <td class="border-0 fs-14 text-dark"><b>${{$order?->total}}</b></td>
                                    </tr><!--end tr-->
                                    <tr>
                                        <th colspan="1" class="border-0"></th>
                                        <td colspan="2" class="border-0 fs-14 text-dark"><b>Shipping Rate</b></td>
                                        <td class="border-0 fs-14 text-dark"><b>Free</b></td>
                                    </tr><!--end tr-->
                                    <tr class="">
                                        <th colspan="1" class="border-0"></th>
                                        <td colspan="2" class="border-0 fs-14"><b>Total</b></td>
                                        <td class="border-0 fs-14"><b>${{$order?->total}}</b></td>
                                    </tr><!--end tr-->
                                    </tbody>
                                </table><!--end table-->
                            </div>  <!--end /div-->
                        </div>  <!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-4">Terms And Condition :</h5>
                            <ul class="ps-3">
                                <li><small class="fs-12">All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                <li><small class="fs-12">To be paid by cheque or credit card or direct payment online.</small ></li>
                                <li><small class="fs-12"> If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.</small></li>
                            </ul>
                        </div> <!--end col-->
                        <div class="col-lg-6 align-self-center">
                            <div class=" float-end mt-5" style="width: 30%;">
                                <p class="border-top">Recipient Signature</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 col-xl-4 ms-auto align-self-center">
                            <div class="text-center"><small class="fs-12">Thank you very much for doing business with us.</small></div>
                        </div><!--end col-->
                        <div class="col-lg-12 col-xl-4">
                            <div class="float-end d-print-none mt-2 mt-md-0">
                                <a href="javascript:window.print()" class="btn btn-info">Print</a>
                                <a href="#"  class="btn btn-danger">Cancel</a>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>
