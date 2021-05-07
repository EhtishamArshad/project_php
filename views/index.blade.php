<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>

<body>

    @include('header')
    <br>
    <div class="container">
        <div class="row">
            <h5>All time stats</h5>
            <div class="col-sm">
                <div class="stats-card">
                    <div><i class="bi bi-person icon"></i></div>
                    <div class="stats">
                        <div>Customers</div>
                        <div>{{$totalCustomers}}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="stats-card">
                    <div><i class="bi bi-file-text icon"></i></div>
                    <div class="stats">
                        <div>Orders</div>
                        <div>{{$totalOrders}}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="stats-card">
                    <div><i class="bi bi-graph-up icon"></i></div>
                    <div class="stats">
                        <div>Revenue</div>
                        <div>{{$totalRevenue}}</div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h5>Monthly Stats</h5>
        <br>
        <!-- <div>
            From <input type="date" id="dateRangeFrom" name="dateRangeFrom" style="margin-right:20px">
            To <input type="date" id="dateRangeFrom" name="dateRangeFrom">
        </div> -->
        <div>
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>
    @include('footer')
</body>

<script>
    const ordersMonthly = <?php echo json_encode($totalOrdersMonthly); ?>;
    orderPerMonth = [];
    numOfOrders = [];
    monthsArray = Object.keys(ordersMonthly).map((key, value) => {
        numOfOrders.push(Number(key));
    });
    for (i = 1; i <= 12; i++) {
        if (numOfOrders.indexOf(i) != -1) {
            orderPerMonth.push(Number(ordersMonthly[i]))
        } else {
            orderPerMonth.push(0)
        }
    }
    let ctx = document.getElementById('monthlyChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                data: orderPerMonth,
                label: "Orders per Month",
                borderColor: "#3e95cd",
                backgroundColor: "#7bb6dd",
                fill: false,
                tension: 0.1
            }, ]
        },
    });
</script>

</html>
