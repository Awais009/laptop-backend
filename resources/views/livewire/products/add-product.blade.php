<div class="container-xxl">



    <div class="row justify-content-center">
        <div class="col-md-6 @if($images) col-lg-8 @else col-lg-12 @endif ">
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
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="username" wire:model="title" >
                                    @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="useremail">Price</label>
                                    <input type="number" class="form-control" id="useremail" wire:model="price" >
                                    @error('price')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                <select id="multiSelect" wire:model="sub_category_id">
                                    @forelse($sub_categories as $sub_category)
                                    <option value="{{$sub_category->id}}">{{$sub_category->title}}</option>
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

        @if($images)
        <div class="col-md-6 col-lg-4">
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
                                    <img src="{{ optional($images[$index])->temporaryUrl() }}" alt="" class="thumb-xxl rounded me-3">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <p class="text-muted">description about image</p>
                        <textarea class="form-control" name="" id=""  rows="5" wire:model="image_description.{{$index}}"></textarea>

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


        new Selectr("#multiSelect", { multiple: !0 })
        var hueb = new Huebee(".color-input", { setBGColor: !0, saturations: 3 }),
            elem = document.querySelector('input[name="foo"]'),
            regExpMask =
                (new Datepicker(elem, {}),
                    (elem = document.getElementById("inline_calendar")),
                    new Datepicker(elem, {}),
                    (elem = document.getElementById("DateRange")),
                    new DateRangePicker(elem, {}),
                    IMask(document.getElementById("regexp-mask"), { mask: /^[1-6]\d{0,5}$/ })),
            startPhoneMask = IMask(document.getElementById("start-phone-mask"), { mask: "+{7}(000)000-00-00" })
                .on("accept", function () {
                    (document.getElementById("start-phone-complete").style.display = ""), (document.getElementById("start-phone-unmasked").innerHTML = startPhoneMask.unmaskedValue);
                })
                .on("complete", function () {
                    document.getElementById("start-phone-complete").style.display = "inline-block";
                }),
            overwriteMask = IMask(document.getElementById("date-overwrite-mask"), {
                mask: Date,
                lazy: !1,
                overwrite: !0,
                autofix: !0,
                blocks: {
                    d: { mask: IMask.MaskedRange, placeholderChar: "d", from: 1, to: 31, maxLength: 2 },
                    m: { mask: IMask.MaskedRange, placeholderChar: "m", from: 1, to: 12, maxLength: 2 },
                    Y: { mask: IMask.MaskedRange, placeholderChar: "y", from: 1900, to: 2999, maxLength: 4 },
                },
            }),
            momentFormat =
                (IMask(document.getElementById("uppercase-mask"), {
                    mask: /^\w+$/,
                    prepare: function (e) {
                        return e.toUpperCase();
                    },
                    commit: function (e, t) {
                        t._value = e.toLowerCase();
                    },
                }),
                    "YYYY/MM/DD HH:mm"),
            momentMask = IMask(document.getElementById("moment-mask"), {
                mask: Date,
                pattern: momentFormat,
                lazy: !1,
                min: new Date(1970, 0, 1),
                max: new Date(2030, 0, 1),
                format: function (e) {
                    return moment(e).format(momentFormat);
                },
                parse: function (e) {
                    return moment(e, momentFormat);
                },
                blocks: {
                    YYYY: { mask: IMask.MaskedRange, from: 1970, to: 2030 },
                    MM: { mask: IMask.MaskedRange, from: 1, to: 12 },
                    DD: { mask: IMask.MaskedRange, from: 1, to: 31 },
                    HH: { mask: IMask.MaskedRange, from: 0, to: 23 },
                    mm: { mask: IMask.MaskedRange, from: 0, to: 59 },
                },
            }).on("accept", function () {
                document.getElementById("moment-value").innerHTML = momentMask.masked.date || "-";
            });
                })

        })


    </script>
    @endscript

</div>
