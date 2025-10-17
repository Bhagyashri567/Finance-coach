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
                    <h6>Income vs Expenses (₹)</h6>
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
function chartColors(theme) {
    const dark = theme === 'dark';
    return {
        text: dark ? '#e5e7eb' : '#111827',
        grid: dark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)'
    };
}

let charts = [];

function buildCharts() {
    const theme = document.documentElement.dataset.theme || 'light';
    const colors = chartColors(theme);
    charts.forEach(c => c.destroy());
    charts = [];
    // Spending Breakdown - Pie
    charts.push(new Chart(document.getElementById('spendingChart'), {
        type: 'doughnut',
        data: {
            labels: ['Food', 'Transport', 'Rent', 'Shopping', 'Other'],
            datasets: [{
                data: [2200, 1500, 12000, 4000, 1800],
                backgroundColor: [
                    '#1e3a8a',
                    '#88C417',
                    '#0ea5a0',
                    '#1e1b4b',
                    '#facc15'
                ]
            }]
        }
    }));

    // Income vs Expenses - Bar
    charts.push(new Chart(document.getElementById('incomeExpenseChart'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                    label: 'Income',
                    data: [30000, 35000, 32000, 36000, 42000],
                    backgroundColor: '#1e3a8a'
                },
                {
                    label: 'Expenses',
                    data: [22000, 25000, 24000, 28000, 31000],
                    backgroundColor: '#88C417'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: colors.grid
                    },
                    ticks: {
                        color: colors.text
                    }
                },
                x: {
                    grid: {
                        color: 'transparent'
                    },
                    ticks: {
                        color: colors.text
                    }
                }
            }
        }
    }));

    // Cashflow Over Time - Line
    charts.push(new Chart(document.getElementById('cashflowChart'), {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Cashflow',
                data: [5000, 7000, 4500, 8000],
                borderColor: '#0ea5a0',
                backgroundColor: 'rgba(14,165,160,0.25)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: colors.text
                    }
                }
            }
        }
    }));

}

buildCharts();
window.addEventListener('themechange', function() {
    buildCharts();
});

// Load latest insights
(async function() {
    try {
        const res = await fetch('/api/insights.php');
        const data = await res.json();
        const box = document.getElementById('insights');
        if (data && Array.isArray(data.items) && data.items.length) {
            box.innerHTML = data.items.map(x => `<div class="mb-2">• ${x.text}</div>`).join('');
        } else {
            box.textContent = 'No insights yet. Chat with your coach to generate tips.';
        }
    } catch (e) {
        document.getElementById('insights').textContent = 'Failed to load insights.';
    }
})();
</script>

<?php
// Include footer
include 'footer.php';
?>
?>