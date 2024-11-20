<div class="kanban-col" >
    <div>

    </div>
    <div class="my-3">
        <div class="d-flex justify-content-between align-items-center border-bottom border-2 border-pink" >
            <div x-show="!$wire.expand">
                <h6 class="fw-semibold fs-16 text-muted mb-1" >{{$category->title}}</h6>
                <h6 class="fs-13 fw-semibold" >{{$category->sub_categories->count()}} Items </h6>
            </div>
            {{--   <div>
                   <img src="{{asset('public/assets/images/users/avatar-2.jpg')}}" alt="" height="100" class="rounded ">
               </div>--}}
            <div x-show="$wire.expand">
                <div class="mb-3 row">
                    <label for="inputTaskTitle1" class="col-sm-3 col-form-label text-end fw-medium">Title :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputTaskTitle1" wire:model="title" x-on:blur="$wire.update()">
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div><!--end col-->
                </div>
            </div>

            <div class="add-btn" x-show="!$wire.expand">

                <a class="dropdown-toggle arrow-none text-secondary" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis fs-18"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end">
                    <a class="dropdown-item" href="javascript:" x-on:click="$wire.expand = true"><i class="las la-pen fs-16 me-1 align-text-bottom"></i> Edit</a>
                    <a class="dropdown-item text-danger" href="javascript:" wire:click="$dispatch('deleteCategory', { id: {{ $category->id }} })"><i class="las la-trash fs-16 me-1 align-text-bottom"></i> Delete</a>
                </div>
            </div>
        </div>
    </div><!--end /div-->

    @foreach($category->sub_categories as $item)
        <livewire:category.sub-category :item="$item" :key="$item->id" />
    @endforeach


    <div id="project-list-left" class="pt-1" x-show="!$wire.expanded">
        <div class="card ">
            <div class="card-body">

                <div class="mb-3 row">
                    <label for="inputTaskTitle1" class="col-sm-3 col-form-label text-end fw-medium">Title :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputTaskTitle1" wire:model="item_title" x-on:blur="$wire.addItem()" >
                        @error('item_title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div><!--end col-->
                </div>

            </div><!--end card-body-->
        </div><!--end card-->

    </div><!--end project-list-left-->
    <a href="javascript:" class="btn btn-outline-danger w-100"  x-on:click="$wire.expanded = true" x-show="!$wire.expanded" > <i class="fa-solid fa-x me-1"></i>Close</a>

    <a href="javascript:" class="btn btn-outline-primary w-100"  x-show="$wire.expanded" x-on:click="$wire.expanded = false"> <i class="fa-solid fa-plus me-1"></i> Add New Item</a>

</div><!--end kanban-col-->
