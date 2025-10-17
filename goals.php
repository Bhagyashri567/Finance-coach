<?php include 'navbar.php'; require_once 'includes/helpers.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">Your Financial Goals</h2>

    <!-- === Add Goal Form === -->
    <div class="card glass p-4 mb-5">
        <h5 class="fw-bold mb-3">Add a New Goal</h5>
        <form method="POST" action="">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="goal_name" class="form-control" placeholder="Goal (e.g., Buy Laptop)"
                        required>
                </div>
                <div class="col-md-4">
                    <input type="number" name="goal_target" class="form-control" placeholder="Target Amount" required>
                </div>
                <div class="col-md-4">
                    <input type="number" name="goal_saved" class="form-control" placeholder="Already Saved" required>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-success w-100">Add Goal</button>
            </div>
        </form>
    </div>

    <!-- === Goals Table === -->
    <div class="card glass p-4 mb-5">
        <h5 class="fw-bold mb-3">Your Current Goals</h5>
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Goal</th>
                    <th>Target</th>
                    <th>Saved</th>
                    <th>Progress</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Buy Laptop</td>
                    <td><?php echo formatINR(1000); ?></td>
                    <td><?php echo formatINR(400); ?></td>
                    <td>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%;">40%</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Emergency Fund</td>
                    <td><?php echo formatINR(2000); ?></td>
                    <td><?php echo formatINR(1200); ?></td>
                    <td>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%;">60%</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Vacation Trip</td>
                    <td><?php echo formatINR(1500); ?></td>
                    <td><?php echo formatINR(300); ?></td>
                    <td>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%;">20%</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- === Goals Charts === -->
    <div class="row g-4">
        <!-- Doughnut Chart -->
        <div class="col-md-6">
            <div class="card glass p-4">
                <h5 class="fw-bold mb-3 text-center">Goal Completion Overview</h5>
                <canvas id="goalsDoughnut"></canvas>
            </div>
        </div>

        <!-- Line Chart -->
        <div class="col-md-6">
            <div class="card glass p-4">
                <h5 class="fw-bold mb-3 text-center">Savings Growth</h5>
                <canvas id="goalsLine"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function chartColors(theme){
	const dark = theme==='dark';
	return {
		text: dark ? '#e5e7eb' : '#111827',
		grid: dark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)'
	};
}

let charts = [];
function buildCharts(){
	const theme = document.documentElement.dataset.theme || 'light';
	const colors = chartColors(theme);
	charts.forEach(c=>c.destroy());
	charts = [];

	const doughnutCtx = document.getElementById('goalsDoughnut').getContext('2d');
	charts.push(new Chart(doughnutCtx, {
		type: 'doughnut',
		data: {
			labels: ['Laptop', 'Emergency Fund', 'Vacation'],
        datasets: [{
            data: [40, 60, 20],
            backgroundColor: ['#1e3a8a', '#88C417', '#0ea5a0']
        }]
		},
		options: {
			plugins: { legend: { labels: { color: colors.text } } }
		}
	}));

	const lineCtx = document.getElementById('goalsLine').getContext('2d');
	charts.push(new Chart(lineCtx, {
		type: 'line',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
			datasets: [{
                label: 'Laptop Savings (₹)',
					data: [50, 150, 250, 300, 350, 400],
                borderColor: '#1e3a8a',
                backgroundColor: 'rgba(30,58,138,0.25)',
					fill: false,
					tension: 0.3
				},
				{
                label: 'Emergency Fund (₹)',
					data: [500, 700, 900, 1000, 1100, 1200],
                borderColor: '#88C417',
                backgroundColor: 'rgba(136,196,23,0.25)',
					fill: false,
					tension: 0.3
				}
			]
		},
		options: {
			plugins: { legend: { labels: { color: colors.text } } },
			scales: {
				y: { grid: { color: colors.grid }, ticks: { color: colors.text } },
				x: { grid: { color: 'transparent' }, ticks: { color: colors.text } }
			}
		}
	}));
}

buildCharts();
window.addEventListener('themechange', function(){ buildCharts(); });
</script>

<?php include 'footer.php'; ?>