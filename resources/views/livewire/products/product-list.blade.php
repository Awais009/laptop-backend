<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Products</h4>
                        </div><!--end col-->
                        <div class="col-auto">
                            <form class="row g-2">
                                <div class="col-auto">
                                    <a type="button" class="btn btn-primary" href="{{route('product.add')}}" ><i class="fa-solid fa-plus me-1"></i> Add Product</a>
                                </div><!--end col-->
                            </form>
                        </div><!--end col-->
                    </div><!--end row-->
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
                                <th>Discounted Pics</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-end">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr wire:key="{{$product->id}}">
                                    <td style="width: 16px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="check"  id="customCheck1">
                                        </div>
                                    </td>
                                    <td class="ps-0">
                                        <img src="{{asset('storage/app/'.$product?->image?->path)}}" alt="" height="40">
                                        <p class="d-inline-block align-middle mb-0">
                                            <a href="#" class="d-inline-block align-middle mb-0 product-name">{{$product->title}}</a>
                                            <br>
                                            <span class="text-muted font-13">{{$product->SKU}}</span>
                                        </p>
                                    </td>
                                    <td>{{$product->navigation_item->title}}</td>
                                    <td>{{$product->images->count()}}</td>
                                    <td>${{$product->over_price}}</td>
                                    <td>${{$product->price}}</td>
                                    <td>
                                        @if($product->status)
                                        <span class="badge bg-success-subtle text-success"><i class="fas fa-check me-1"></i>Published</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger"><i class="fas fa-x me-1"></i>Pending</span>

                                        @endif
                                    </td>
                                    <td>
                                        <span>{{$product->created_at?->format('F-d-Y')}}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{route('product.add',$product->id)}}"><i class="las la-pen text-secondary fs-18"></i></a>
                                        <a href="#" wire:click.prevent="remove({{$product->id}})"><i class="las la-trash-alt text-secondary fs-18"></i></a>
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
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    @script
    <script>
    Livewire.on('rendered',()=>{
        try {
            new simpleDatatables.DataTable("#datatable_1", { searchable: !0, fixedHeight: !1 });
        } catch (e) {}
    })

    </script>
    @endscript
</div>
