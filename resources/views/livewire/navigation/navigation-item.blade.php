<div class="kanban-col" >
    <div>

    </div>
    <div class="my-3">
        <div class="d-flex justify-content-between align-items-center border-bottom border-2 border-pink" >
            <div x-show="!$wire.expand">
                <h6 class="fw-semibold fs-16 text-muted mb-1" >{{$navigation->title}}</h6>
                <h6 class="fs-13 fw-semibold" >{{$navigation->items->count()}} Items </h6>
            </div>
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
                <a class="text-secondary me-1 add-btn cursor-pointer" x-show="!$wire.expand" x-on:click="$wire.expand = true">
                    <i class="las la-pen fs-28"></i>
                </a>
        </div>
    </div><!--end /div-->

    @foreach($navigation->items as $item)
    <livewire:navigation.sub-item :item="$item" :key="$item->id" />
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
