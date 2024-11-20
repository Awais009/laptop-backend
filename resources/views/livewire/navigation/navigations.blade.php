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
    </div>


</div>
