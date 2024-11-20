<div class="container-xxl">
    <div class="row my-3">
        <div class="col-12">
            <div class="">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center ">

                        <div class="align-self-center">
                            <form class="row g-2">
                                <div class="col-auto">
                                    <label for="inputsearch"  class="visually-hidden">Title</label>
                                    <input type="text" wire:model.live="title" class="form-control" id="inputsearch" placeholder="Search">
                                   @error('title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div><!--end col-->

                                <div class="col-auto">
                                    <button type="button" class="btn btn-primary" wire:click="addCategory" ><i class="fa-solid fa-plus me-1"></i> Add Category</button>
                                </div><!--end col-->
                            </form>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div>
    <div class="row my-3">
        <div class="col-12">
            <div class="">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center ">
                        <div class="align-self-center">
                            <form class="row g-2">
                                <div class="col-auto">
                                    <h3>Filters</h3>
                                </div><!--end col-->
                            </form>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="kanban-board">
                @foreach($categories as $category)
                    <livewire:category.category-item :category="$category" :key="$category->id">
                @endforeach

            </div><!--end kanban-->
        </div> <!--end col-->
    </div>


</div>
