<?php include 'navbar.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">Smart Investment Suggestions 💹</h2>
    <p class="text-center text-muted">Based on your income and saving behavior, here are some recommended investment
        plans:</p>

    <div class="row g-4 mt-4">

        <!-- Mutual Fund -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">📈 Mutual Funds (SIP)</h5>
                    <p class="card-text">Start with as low as ₹500/month. Best for long-term wealth creation with
                        moderate risk.</p>
                    <span class="badge bg-success">Risk: Medium</span>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-outline-primary w-100">View Details</button>
                </div>
            </div>
        </div>

        <!-- Fixed Deposit -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">🏦 Fixed Deposit</h5>
                    <p class="card-text">Safe and stable returns (6–7% annually). Ideal for emergency fund parking.</p>
                    <span class="badge bg-primary">Risk: Low</span>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-outline-primary w-100">View Details</button>
                </div>
            </div>
        </div>

        <!-- Stocks -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">📊 Stock Market</h5>
                    <p class="card-text">High returns potential with higher risks. Recommended for long-term investors.
                    </p>
                    <span class="badge bg-danger">Risk: High</span>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-outline-primary w-100">View Details</button>
                </div>
            </div>
        </div>

        <!-- Gold -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">🥇 Gold Investment</h5>
                    <p class="card-text">Hedge against inflation. Can invest via Digital Gold, ETFs, or Sovereign Bonds.
                    </p>
                    <span class="badge bg-warning text-dark">Risk: Low–Medium</span>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-outline-primary w-100">View Details</button>
                </div>
            </div>
        </div>

        <!-- Crypto -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">💻 Cryptocurrency</h5>
                    <p class="card-text">Volatile but high-reward investment. Only invest small % of savings if
                        risk-tolerant.</p>
                    <span class="badge bg-danger">Risk: Very High</span>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-outline-primary w-100">View Details</button>
                </div>
            </div>
        </div>

        <!-- Retirement Plan -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">👴 Retirement Fund (NPS)</h5>
                    <p class="card-text">Secure your future with pension-based returns. Good for tax-saving & stability.
                    </p>
                    <span class="badge bg-success">Risk: Low–Medium</span>
                </div>
                <div class="card-footer bg-white border-0">
                    <button class="btn btn-outline-primary w-100">View Details</button>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>