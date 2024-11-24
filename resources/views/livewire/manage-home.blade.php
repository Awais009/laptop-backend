<div class="container-xxl">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Customers Data</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <div class="dropdown">
                                <a href="#" class="btn bt btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icofont-calendar fs-5 me-1"></i> {{$typeFilter ? ($typeFilter == 'all' ? "Un Assigned " : "Assigned ".$typeFilter) : "All Products" }}<i class="las la-angle-down ms-1"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a class="dropdown-item" wire:click="filterType('')" href="#">All</a>
                                    <a class="dropdown-item" wire:click="filterType('all')" href="#">Un Assigned</a>
                                    <a class="dropdown-item" wire:click="filterType('banner')" href="#">Banner</a>
                                    <a class="dropdown-item" wire:click="filterType('featured')" href="#">Featured</a>
                                    <a class="dropdown-item" wire:click="filterType('top_sale')" href="#">Top Sale</a>
                                    <a class="dropdown-item" wire:click="filterType('top_rated')" href="#">Top Rated</a>

                                </div>
                            </div>
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0 checkbox-all" id="datatable_1">
                            <thead class="table-light">
                            <tr>
                                <th style="width: 16px;">
                                    <div class="form-check mb-0 ms-n1">
                                        <input type="checkbox" class="form-check-input" name="select-all" id="select-all">
                                    </div>
                                </th>
                                <th class="ps-0">Product Name</th>
                                <th>Category</th>
                                <th>Pics</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-end">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck1">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="{{asset('storage/app/'.$product->image->path)}}" alt="" height="40">
                                        <p class="d-inline-block align-middle mb-0">
                                            <a href="ecommerce-order-details.html" class="d-inline-block align-middle mb-0 product-name">{{$product->title}}</a>
                                            <br>
                                            <span class="text-muted font-13">{{$product->SKU}}</span>
                                        </p>
                                    </td>
                                    <td>{{$product->navigation_item->title}}</td>
                                    <td>{{$product->images->count()}}</td>
                                    <td>${{$product->price}}</td>
                                    <td>
                                        @if($product->status)
                                            <span class="badge bg-success-subtle text-success"><i class="fas fa-check me-1"></i>Published</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger"><i class="fas fa-x me-1"></i>Pending</span>

                                        @endif                                    </td>
                                    <td>
                                        <span>{{$product->created_at?->format('F-d-Y')}}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <a href="#" class="btn bt btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icofont-calendar fs-5 me-1"></i> {{$product->type == 'all' ? "Un Assigned" : "Assigned ".$product->type}}<i class="las la-angle-down ms-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <a class="dropdown-item" wire:click.prevent="changeType({{$product->id}},'all')" href="#">Un Assigned</a>
                                                <a class="dropdown-item" wire:click.prevent="changeType({{$product->id}},'banner')" href="#">Banner</a>
                                                <a class="dropdown-item" wire:click.prevent="changeType({{$product->id}},'featured')" href="#">Featured</a>
                                                <a class="dropdown-item" wire:click.prevent="changeType({{$product->id}},'top_sale')" href="#">Top Sale</a>
                                                <a class="dropdown-item" wire:click.prevent="changeType({{$product->id}},'top_rated')" href="#">Top Rated</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="table-danger text-center">
                                    <td colspan="8" style="width: 16px;">
                                        product not found
                                    </td>

                                </tr>
                            @endforelse


                            </tbody>
                        </table>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div>
    </div>
</div>
