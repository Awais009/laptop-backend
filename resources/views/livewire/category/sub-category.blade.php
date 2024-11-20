<div id="project-list-left" class="pt-1">
    <div class="card mb-3">
        <div class="card-body">
            <div class="dropdown  float-end" x-show="!$wire.expand">
                <a class="dropdown-toggle arrow-none text-secondary" data-bs-toggle="dropdown" href="javascript:" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis fs-18"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end">
                    <a class="dropdown-item" href="javascript:" x-on:click="$wire.expand = true"><i class="las la-pen fs-16 me-1 align-text-bottom" ></i> Edit</a>
                    <a class="dropdown-item text-danger" href="javascript:" wire:click="$dispatch('deleteItem', { id: {{ $item->id }} })"><i class="las la-trash fs-16 me-1 align-text-bottom" ></i> Delete</a>
                </div>
            </div><!--end dropdown-->
            <h5 class="my-2 font-14" x-show="!$wire.expand">{{$item->title}}</h5>
            <div x-show="$wire.expand">
                <div class="mb-3 row">
                    <label for="inputTaskTitle1" class="col-sm-3 col-form-label text-end fw-medium">Title :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputTaskTitle1" wire:model="title"  x-on:blur="$wire.update()">
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div><!--end col-->
                </div>
            </div>
            <div class="d-flex justify-content-between fw-semibold align-items-center">
                <p class="mb-1 d-inline-flex align-items-center"><i class="iconoir-task-list fs-18 text-muted me-1"></i>{{$item->filters->count()}} Products</p>
                <small class="text-end text-body-emphasis d-block ms-auto">70%</small>
            </div>

        </div><!--end card-body-->
    </div><!--end card-->

</div><!--end project-list-left-->
