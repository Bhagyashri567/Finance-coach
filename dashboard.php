<?php
// dashboard.php
// Include navbar
include 'navbar.php';
?>

<main class="container my-5">
    <div class="row g-4">
        <!-- User Summary Card -->
        <div class="col-md-4">
            <div class="card glass p-3">
                <h5 class="mb-2">Hello, Mahek 👋</h5>
                <p class="text-muted">Here’s your financial overview</p>
                <h3>₹ 42,500</h3>
                <small class="text-success">+12% vs last month</small>
            </div>
        </div>

        <!-- Savings Goal Progress -->
        <div class="col-md-4">
            <div class="card glass p-3">
                <h6>Savings Goal</h6>
                <div class="progress my-2">
                    <div class="progress-bar" style="width: 68%"></div>
                </div>
                <small>68% of ₹50,000 goal</small>
            </div>
        </div>

        <!-- AI Suggestions -->
        <div class="col-md-4">
            <div class="card glass p-3">
                <h6>Agentive AI Tip 🤖</h6>
                <p class="small mb-0">
                    Based on your last 2 weeks, if you reduce eating out by 15%, you can save an extra ₹3,200/month.
                </p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mt-3">
        <!-- Spending Breakdown -->
        <div class="col-md-6">
            <div class="card glass p-3">
                <h6>Spending Breakdown</h6>
                <canvas id="spendingChart"></canvas>
            </div>
        </div>

        <!-- Income vs Expenses -->
        <div class="col-md-6">
            <div class="card glass p-3">
                <h6>Income vs Expenses</h6>
                <canvas id="incomeExpenseChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <!-- Trend Over Time -->
        <div class="col-12">
            <div class="card glass p-3">
                <h6>Cashflow Over Time</h6>
                <canvas id="cashflowChart"></canvas>
            </div>
        </div>
    </div>
</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Spending Breakdown - Pie
new Chart(document.getElementById('spendingChart'), {
    type: 'doughnut',
    data: {
        labels: ['Food', 'Transport', 'Rent', 'Shopping', 'Other'],
        datasets: [{
            data: [2200, 1500, 12000, 4000, 1800],
            backgroundColor: [
                '#ad0ca8ff',
                '#fb24dbff',
                '#ec4899',
                '#1e1b4b',
                '#facc15'
            ]
        }]
    }
});

// Income vs Expenses - Bar
new Chart(document.getElementById('incomeExpenseChart'), {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
                label: 'Income',
                data: [30000, 35000, 32000, 36000, 42000],
                backgroundColor: '#ad0ca8ff'
            },
            {
                label: 'Expenses',
                data: [22000, 25000, 24000, 28000, 31000],
                backgroundColor: '#ec4899'
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Cashflow Over Time - Line
new Chart(document.getElementById('cashflowChart'), {
    type: 'line',
    data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
            label: 'Cashflow',
            data: [5000, 7000, 4500, 8000],
            borderColor: '#fb24dbff',
            backgroundColor: 'rgba(251,36,219,0.3)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>

<?php
// Include footer
include 'footer.php';
?>