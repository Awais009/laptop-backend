
        <div class="container-xxl">
            <div class="row">
@php
    function formatNumber($num) {
            $num = intval($num) ;


            $suffixes = ['', 'K', 'M', 'B', 'T'];
            $exp = floor(log10($num) / 3);
            if ($num == 0) {
                return '0';
            }
            $value = $num / pow(10, $exp*3);
            $formatted = ($value == (int) $value) ? (int) $value : number_format($value, 1);
            return $formatted . $suffixes[$exp];
        }
@endphp
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Monthly Avg. Income</h4>
                                </div><!--end col-->
                                <div class="col-auto">
                                    <div class="dropdown">
                                        <a href="#" class="btn bt btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icofont-calendar fs-5 me-1"></i> This Year<i class="las la-angle-down ms-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Today</a>
                                            <a class="dropdown-item" href="#">Last Week</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">This Year</a>
                                        </div>
                                    </div>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div><!--end card-header-->
                        <div class="card-body pt-0">
                            <div id="monthly_income" class="apex-charts"></div>
                            <div class="row">
                                <div class="col-md-6 col-lg-3">
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">
                                                    <span class="fs-18 fw-semibold">${{number_format($today_revenue)}}</span>
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Today's Revenue</h6>
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->
                                </div><!--end col-->
                                <div class="col-md-6 col-lg-3">
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">
                                                    <span class="fs-18 fw-semibold">82.8%</span>
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Conversion Rate</h6>
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->
                                </div><!--end col-->

                                <div class="col-md-6 col-lg-3">
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">
                                                    <span class="fs-18 fw-semibold">$9982.00</span>
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Total Expenses</h6>
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-->
                                </div><!--end col-->
                                <div class="col-md-6 col-lg-3">
                                    <div class="card shadow-none border mb-3 mb-lg-0">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col text-center">
                                                    <span class="fs-18 fw-semibold">$80.5</span>
                                                    <h6 class="text-uppercase text-muted mt-2 m-0">Avg. Value</h6>
                                                </div><!--end col-->
                                            </div> <!-- end row -->
                                        </div><!--end card-body-->
                                    </div> <!--end card-body-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->
            </div><!--end row-->
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Orders</h4>
                                </div><!--end col-->
                                <div class="col-auto">
                                    <div class="img-group d-flex">
                                        <a class="user-avatar position-relative d-inline-block" href="#">
                                            <img src="{{asset('public/assets/images/users/avatar-1.jpg')}}" alt="avatar" class="thumb-md shadow-sm rounded-circle">
                                        </a>
                                        <a class="user-avatar position-relative d-inline-block ms-n2" href="#">
                                            <img src="{{asset('public/assets/images/users/avatar-2.jpg')}}" alt="avatar" class="thumb-md shadow-sm rounded-circle">
                                        </a>
                                        <a class="user-avatar position-relative d-inline-block ms-n2" href="#">
                                            <img src="{{asset('public/assets/images/users/avatar-4.jpg')}}" alt="avatar" class="thumb-md shadow-sm rounded-circle">
                                        </a>
                                        <a class="user-avatar position-relative d-inline-block ms-n2" href="#">
                                            <img src="{{asset('public/assets/images/users/avatar-3.jpg')}}" alt="avatar" class="thumb-md shadow-sm rounded-circle">
                                        </a>
                                        <a href="#" class="user-avatar position-relative d-inline-block ms-1">
                                            <span class="thumb-md shadow-sm justify-content-center d-flex align-items-center bg-info-subtle rounded-circle fw-semibold fs-6">+6</span>
                                        </a>
                                    </div>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div>
                        <div class="card-body pt-0">
                            <div id="customers" class="apex-charts"></div>

                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->

                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body border-dashed-bottom pb-3">
                            <div class="row d-flex justify-content-between">
                                <div class="col-auto">
                                    <div class="d-flex justify-content-center align-items-center thumb-xl border border-secondary rounded-circle">
                                        <i class="icofont-money-bag h1 align-self-center mb-0 text-secondary"></i>
                                    </div>
                                    <h5 class="mt-2 mb-0 fs-14">Total Revenue</h5>
                                </div><!--end col-->
                                <div class="col align-self-center">
                                    <div id="line-1" class="apex-charts float-end"></div>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                        <div class="card-body">
                            <div class="row d-flex justify-content-center ">
                                <div class="col-12 col-md-6">
                                    <h2 class="fs-22 mt-0 mb-1 fw-bold">${{number_format($total_revenue)}}</h2>
                                    <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p>
                                </div><!--end col-->
                                <div class="col-12 col-md-6 align-self-center text-start text-md-end">
                                    <button type="button" class="btn btn-primary btn-sm px-2 mt-2 mt-md-0 ">View Report</button>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Categories Data</h4>
                                </div><!--end col-->
                                <div class="col-auto">
                                    <div class="text-center">
                                        <h6 class="text-uppercase text-muted mt-1 m-0"><span class="fs-16 fw-semibold">24+</span> Categories</h6>
                                    </div>
                                </div><!--end col-->
                            </div>  <!--end row-->
                        </div>
                        <div class="card-body pt-0">
                            <div id="categories" class="apex-charts mt-n2"></div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary mx-auto">More Detail <i class="fa-solid fa-arrow-right-long"></i> </button>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div> <!--end col-->

            </div><!--end row-->
            <div class="row justify-content-center">


            </div><!--end row-->

            @script
            <script>
                document.addEventListener('livewire:initialized', () => {

                    var options1 = {
                            series: [{ data: {!! json_encode(array_column($monthlyAverageIncomes,'total_income') )  !!} }],
                            chart: { type: "line", width: 120, height: 35, sparkline: { enabled: !0 }, dropShadow: { enabled: !0, top: 4, left: 0, bottom: 0, right: 0, blur: 2, color: "rgba(132, 145, 183, 0.3)", opacity: 0.35 } },
                            colors: ["#95a0c5"],
                            stroke: { show: !0, curve: "smooth", width: [3], lineCap: "round" },
                            tooltip: {
                                fixed: { enabled: !1 },
                                x: { show: !1 },
                                y: {
                                    title: {
                                        formatter: function (o) {
                                            return "";
                                        },
                                    },
                                },
                                marker: { show: !1 },
                            },
                        },
                        chart1 = new ApexCharts(document.querySelector("#line-1"), options1),
                        options2 =
                            (chart1.render(),
                                {
                                    series: [{ data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54] }],
                                    chart: { type: "line", width: 120, height: 35, sparkline: { enabled: !0 }, dropShadow: { enabled: !0, top: 4, left: 0, bottom: 0, right: 0, blur: 2, color: "rgba(132, 145, 183, 0.3)", opacity: 0.35 } },
                                    colors: ["#95a0c5"],
                                    stroke: { show: !0, curve: "smooth", width: [3], lineCap: "round" },
                                    tooltip: {
                                        fixed: { enabled: !1 },
                                        x: { show: !1 },
                                        y: {
                                            title: {
                                                formatter: function (o) {
                                                    return "";
                                                },
                                            },
                                        },
                                        marker: { show: !1 },
                                    },
                                }),
                        chart2 = new ApexCharts(document.querySelector("#line-2"), options2),
                        colors = (chart2.render(), {!! json_encode(array_column($monthlyAverageIncomes,'color') )  !!}),
                        options = {
                            chart: { height: 270, type: "bar", toolbar: { show: !1 }, dropShadow: { enabled: !0, top: 0, left: 5, bottom: 5, right: 0, blur: 5, color: "#45404a2e", opacity: 0.35 } },
                            colors: colors,
                            plotOptions: { bar: { borderRadius: 6, dataLabels: { position: "top" }, columnWidth: "20", distributed: !0 } },
                            dataLabels: {
                                enabled: !0,
                                formatter: function (o) {
                                    return o + "%";
                                },
                                offsetY: -20,
                                style: { fontSize: "12px", colors: ["#8997bd"] },
                            },
                            series: [{ name: "Inflation", data: {!! json_encode(array_column($monthlyAverageIncomes,'percentage') )  !!} }],
                            xaxis: {
                                categories: {!! json_encode(array_column($monthlyAverageIncomes,'month')) !!},
                                position: "top",
                                axisBorder: { show: !1 },
                                axisTicks: { show: !1 },
                                crosshairs: { fill: { type: "gradient", gradient: { colorFrom: "#D8E3F0", colorTo: "#BED1E6", stops: [0, 100], opacityFrom: 0.4, opacityTo: 0.5 } } },
                                tooltip: { enabled: !0 },
                            },
                            yaxis: {
                                axisBorder: { show: !1 },
                                axisTicks: { show: !1 },
                                labels: {
                                    show: !0,
                                    formatter: function (o) {
                                        return "$" + o + "k";
                                    },
                                },
                            },
                            grid: { row: { colors: ["transparent", "transparent"], opacity: 0.2 }, strokeDashArray: 2.5 },
                            legend: { show: !1 },
                        },
                        chart = new ApexCharts(document.querySelector("#monthly_income"), options),
                        options =
                            (chart.render(),
                                {
                                    series: [{ name: "Items", data: {!! json_encode(array_column($navigations,'count')) !!} }],
                                    chart: { type: "bar", height: 275, toolbar: { show: !1 } },
                                    plotOptions: { bar: { borderRadius: 6, horizontal: !0, distributed: !0, barHeight: "85%", isFunnel: !0, isFunnel3d: !1 } },
                                    dataLabels: {
                                        enabled: !0,
                                        formatter: function (o, e) {
                                            return e.w.globals.labels[e.dataPointIndex];
                                        },
                                        dropShadow: { enabled: !1 },
                                        style: { colors: ["#22c55e"], fontWeight: 400, fontSize: "13px" },
                                    },
                                    xaxis: { categories: {!! json_encode(array_column($navigations,'name')) !!} },
                                    colors: ["rgba(34, 197, 94, 0.45)", "rgba(34, 197, 94, 0.4)", "rgba(34, 197, 94, 0.35)", "rgba(34, 197, 94, 0.3)", "rgba(34, 197, 94, 0.25)", "rgba(34, 197, 94, 0.2)", "rgba(34, 197, 94, 0.15)", "rgba(34, 197, 94, 0.1)"],
                                    legend: { show: !1 },
                                }),
                        options =
                            ((chart = new ApexCharts(document.querySelector("#categories"), options)).render(),
                                {
                                    chart: { height: 280, type: "donut" },
                                    plotOptions: { pie: { donut: { size: "80%" } } },
                                    dataLabels: { enabled: !1 },
                                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                                    series: [{!! json_decode($orderPercentages['pending'] ?? 0) !!},{!! json_decode($orderPercentages['delivered'] ?? 0) !!},{!! json_decode($orderPercentages['cancelled'] ?? 0) !!}],
                                    legend: { show: !0, position: "bottom", horizontalAlign: "center", verticalAlign: "middle", floating: !1, fontSize: "13px", fontFamily: "Be Vietnam Pro, sans-serif", offsetX: 0, offsetY: 0 },
                                    labels: ["Pending", "Delivered", "Cancelled"],
                                    colors: ["#08b0e7", "#22c55e", "#eb1111"],
                                    responsive: [{ breakpoint: 600, options: { plotOptions: { donut: { customScale: 0.2 } }, chart: { height: 240 }, legend: { show: !1 } } }],
                                    tooltip: {
                                        y: {
                                            formatter: function (o) {
                                                return o + " %";
                                            },
                                        },
                                    },
                                });
                    (chart = new ApexCharts(document.querySelector("#customers"), options)).render();

                })

            </script>
            @endscript
        </div>

