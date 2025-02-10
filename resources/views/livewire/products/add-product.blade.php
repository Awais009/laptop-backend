<div class="container-xxl">

    <div class="row justify-content-center">
        <div class="col-md-6 @if($images || $productImages) col-lg-8 @else col-lg-12 @endif ">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Add Product</h4>
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 ">
                                    <label class="form-label ">Navigation</label>
                                        <select class="form-select" aria-label="Default select example"  wire:model.live="navigation_id">
                                            <option disabled value="">Select Navigation</option>
                                            @forelse($navigations as $nav)
                                                <option value="{{$nav->id}}">{{$nav->title}}</option>

                                            @empty
                                                <option value="">Navigation not found</option>

                                            @endforelse
                                        </select>
                                        @error('navigation_id')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label ">Category</label>
                                        <select class="form-select" aria-label="Default select example"  wire:model="navigation_item_id">
                                            <option  value="">Select Category</option>
                                            @forelse($nav_items as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                            @empty
                                                <option value="">category not found</option>

                                            @endforelse
                                        </select>
                                        @error('navigation_item_id')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="username" wire:model="title" >
                                    @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="useremail">Price</label>
                                    <input type="number" class="form-control" id="useremail" wire:model="over_price" >
                                    @error('over_price')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="Discounted">Discounted Price</label>
                                    <input type="number" class="form-control" id="Discounted" wire:model="price" >
                                    @error('price')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="subject">Quantity</label>
                                    <input type="number" class="form-control" id="subject" wire:model="qty" >
                                    @error('qty')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="mb-2">Select Filter Tags</label>
                                <select id="multiSelect" multiple wire:model="sub_category_id">
                                    @forelse($sub_categories as $sub_category)
                                    <option @if($id && in_array($sub_category->id,$sub_category_id)) selected @endif value="{{$sub_category->id}}">{{$sub_category->title}}</option>
                                        @empty
                                    <option disabled  value="">Tags not found</option>
                                    @endforelse
                                </select>
                                @error('sub_category_id')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="message">Description</label>
                                    @error('description')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                    <textarea class="form-control" rows="5" id="message" wire:model="description" ></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-end">
                                @error('images')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                                <label class="btn btn-info text-light">
                                    Upload Image <input type="file" accept="image/*" multiple hidden wire:model="images">
                                </label>

                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->

        </div> <!--end col-->

        @if($images || $productImages)
        <div class="col-md-6 col-lg-4">
            @foreach($productImages  as $image)
                <div class="card" wire:key="item-{{ $image->id }}">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Image Upload</h4>
                            </div><!--end col-->
                        </div>  <!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">
                        <div class="d-grid">
                            <div class="d-flex">
                                <div class="form-group justify-content-center">
                                    <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/app/'.$image->path) }}" alt="" width="100" height="100" class="thumb-xxl rounded me-3">
                                    </div>
                                </div>
                            </div>

                            <p class="text-muted">description about image</p>
                            <textarea class="form-control editor" name=""   rows="5" wire:model="image_description.{{$image->id}}">
                        </textarea>


                            <a class="btn-upload btn btn-danger mt-3" href="#" wire:click.prevent="removeImage({{$image->id}})" >Remove</a>

                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            @endforeach

        @foreach($images as $index => $item)
            <div class="card" wire:key="item-{{ $index }}">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Image Upload</h4>
                        </div><!--end col-->
                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="d-grid">
                        <div class="d-flex">
                            <div class="form-group justify-content-center">
                                <div class="d-flex align-items-center">
                                    @if(isset($images[$index]))
                                    <img src="{{ optional($images[$index])->temporaryUrl() }}" alt="" width="100" height="100" class="thumb-xxl rounded me-3">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <p class="text-muted">description about image</p>
                        <textarea class="form-control editor" name=""   rows="5" wire:model="image_description.{{$index}}">
                        </textarea>

                        @error('images.'.$index)
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        <a class="btn-upload btn btn-danger mt-3" href="#" wire:click.prevent="remove_item({{$index}})" >Remove</a>

                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
            @endforeach




        </div> <!--end col-->

        @endif

    </div><!--end row-->

    @script
    <script>

            $wire.on('rendered', () => {

                setTimeout(()=>{
                    var selectr = new Selectr("#multiSelect", { multiple: true });

                    // Get all options in the multi-select that have the selected attribute
                    var options = document.querySelectorAll("#multiSelect option[selected]");

                    // Set the selected values in Selectr
                    selectr.setValue(selectedValues);

                })


            })


    </script>
    @endscript

</div>
