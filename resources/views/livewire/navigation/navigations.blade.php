<div class="container-xxl">
    <div class="row my-3">
        <div class="col-12">
            <div class="">
                <div class="card-body">
                    <div class="d-block d-md-flex justify-content-between align-items-center ">
                        <div class="align-self-center">
                            <form class="row g-2">


                                <div class="col-auto">
<h3>Navigations</h3>
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
                @foreach($navigations as $navigation)
                <livewire:navigation.navigation-item :navigation="$navigation" :key="$navigation->id">
                @endforeach

            </div><!--end kanban-->
        </div> <!--end col-->
    </div><!--end row-->
    <div class="modal fade" id="addtask" tabindex="-1" role="dialog" aria-labelledby="addTask" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0">Add New Task</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="inputTaskTitle1" class="col-sm-3 col-form-label text-end fw-medium">Task Title :</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputTaskTitle1">
                        </div><!--end col-->
                    </div><!--end row-->
                    <div class="row">
                        <label for="inputPriority" class="col-sm-3 col-form-label text-end fw-medium">Navigation:</label>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="">
                                <option value="1" selected>Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm">Save</button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>

                </div><!--end modal-footer-->
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->


    <div class="modal fade" id="addBoard" tabindex="-1" role="dialog" aria-labelledby="addBoard" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0">Add New Board</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div><!--end modal-header-->
                <div class="modal-body">
                    <div class="row">
                        <label for="inputTaskTitle" class="col-sm-3 col-form-label text-end fw-medium">Board Title :</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputTaskTitle">
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm">Save</button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
                </div><!--end modal-footer-->
            </div><!--end modal-content-->
        </div><!--end modal-dialog-->
    </div><!--end modal-->
</div>
