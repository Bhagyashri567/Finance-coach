<?php include 'navbar.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">Manage Your Budgets</h2>

    <!-- === Budget Form === -->
    <div class="card glass p-4 mb-5">
        <h5 class="fw-bold mb-3">Add a New Budget</h5>
        <form method="POST" action="">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="category" class="form-control" placeholder="Category (e.g., Food)"
                        required>
                </div>
                <div class="col-md-4">
                    <input type="number" name="amount" class="form-control" placeholder="Budget Amount" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Add Budget</button>
                </div>
            </div>
        </form>
    </div>

    <!-- === Budget Table === -->
    <div class="card glass p-4 mb-5">
        <h5 class="fw-bold mb-3">Current Budgets</h5>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Budget Amount</th>
                    <th>Spent</th>
                    <th>Remaining</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Food</td>
                    <td>$500</td>
                    <td>$300</td>
                    <td>$200</td>
                </tr>
                <tr>
                    <td>Transport</td>
                    <td>$200</td>
                    <td>$120</td>
                    <td>$80</td>
                </tr>
                <tr>
                    <td>Entertainment</td>
                    <td>$150</td>
                    <td>$50</td>
                    <td>$100</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- === Charts Section === -->
    <div class="row g-4">
        <!-- Pie Chart -->
        <div class="col-md-6">
            <div class="card glass p-4">
                <h5 class="fw-bold mb-3 text-center">Budget Allocation</h5>
                <canvas id="budgetPieChart"></canvas>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-md-6">
            <div class="card glass p-4">
                <h5 class="fw-bold mb-3 text-center">Spending Progress</h5>
                <canvas id="budgetBarChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// === Pie Chart Data ===
const pieCtx = document.getElementById('budgetPieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Food', 'Transport', 'Entertainment'],
        datasets: [{
            data: [500, 200, 150],
            backgroundColor: ['#ad0ca8', '#fb24db', '#ec4899']
        }]
    }
});

// === Bar Chart Data ===
const barCtx = document.getElementById('budgetBarChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Food', 'Transport', 'Entertainment'],
        datasets: [{
                label: 'Budget',
                data: [500, 200, 150],
                backgroundColor: '#ad0ca8'
            },
            {
                label: 'Spent',
                data: [300, 120, 50],
                backgroundColor: '#fb24db'
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            }
        }
    }
});
</script>

<?php include 'footer.php'; ?>