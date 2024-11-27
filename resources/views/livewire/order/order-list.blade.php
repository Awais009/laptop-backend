<div class="container-xxl">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Orders</h4>
                        </div><!--end col-->

                    </div>  <!--end row-->
                </div><!--end card-header-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="datatable_1">
                            <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td><a href="{{route('order.detail',$order->id)}}">#{{$order->id}}</a></td>
                                    <td>
                                        <a href="{{route('order.detail',$order->id)}}">

                                        <p class="d-inline-block align-middle mb-0">
                                            <span class="d-block align-middle mb-0 product-name text-body">Bata Shoes</span>
                                            <span class="text-muted font-13">size-08 (Model 2024)</span>
                                        </p>
                                        </a>
                                    </td>
                                    <td>{{$order->created_at?->format('F-d-Y')}}</td>
                                    <td>Bank Trnasfer</td>
                                    <td>
                                        @switch($order->status)
                                            @case('cancelled')
                                                <span class="badge bg-danger-subtle text-danger"><i class="fas fa-xmark me-1"></i>Cancelled</span>
                                                @break
                                            @case('delivery')
                                                <span class="badge bg-info-subtle text-info"><i class="fas fa-truck me-1"></i>On Delivery</span>
                                                @break
                                            @case('delivered')
                                                <span class="badge bg-primary-subtle text-primary"><i class="fas fa-check me-1"></i>Delivered</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary-subtle text-secondary"><i class="fas fa-clock me-1"></i> Pending</span>
                                        @endswitch

                                    </td>
                                    <td>${{$order->total}}</td>
                                </tr>

                            @empty
                                <tr  class="text-center table-danger" >
<td colspan="7">Order not found</td>
                                </tr>

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <script>
        document.addEventListener('livewire:initialized',()=>{

            try {
                new simpleDatatables.DataTable("#datatable_1", { searchable: !0, fixedHeight: !1 });
            } catch (e) {}
            try {
                const b = new simpleDatatables.DataTable("#datatable_2");
                document.querySelector("button.csv").addEventListener("click", () => {
                    b.exportCSV({ type: "csv", download: !0, lineDelimiter: "\n\n", columnDelimiter: ";" });
                }),
                    document.querySelector("button.sql").addEventListener("click", () => {
                        b.export({ type: "sql", download: !0, tableName: "export_table" });
                    }),
                    document.querySelector("button.txt").addEventListener("click", () => {
                        b.export({ type: "txt", download: !0 });
                    }),
                    document.querySelector("button.json").addEventListener("click", () => {
                        b.export({ type: "json", download: !0, escapeHTML: !0, space: 3 });
                    });
            } catch (e) {}
            try {
                document.addEventListener("DOMContentLoaded", function () {
                    var c = document.querySelector("[name='select-all']"),
                        n = document.querySelectorAll("[name='check']"),
                        e =
                            (c?.addEventListener("change", function () {
                                var t = c.checked;
                                n.forEach(function (e) {
                                    e.checked = t;
                                });
                            }),
                                n.forEach(function (e) {
                                    e.addEventListener("click", function () {
                                        var e = n.length,
                                            t = document.querySelectorAll("[name='check']:checked").length;
                                        t <= 0 ? ((c.checked = !1), (c.indeterminate = !1)) : e === t ? ((c.checked = !0), (c.indeterminate = !1)) : ((c.checked = !0), (c.indeterminate = !0));
                                    });
                                }),
                                document.querySelectorAll("table > thead > tr > th"),
                                th.querySelector("button:first-child"));
                    e && e.classList.remove("datatable-sorter");
                }),
                    document.querySelector(".checkbox-all thead tr th:first-child button").classList.remove("datatable-sorter");
            } catch (e) {}
        })

    </script>
</div>
