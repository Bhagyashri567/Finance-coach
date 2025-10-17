<?php require __DIR__ . '/navbar.php'; ?>

<style>
/* ==== NEW THEME COLORS ==== */
:root {
    --brand-primary: #1e3a8a; /* navy */
    --brand-secondary: #88C417; /* green from template/logo */
    --brand-accent: #0ea5a0; /* teal accent */
    --brand-dark: #1e1b4b; /* deep indigo */
    --brand-light: #f2f5f9; /* soft light */
}

body {
    background: var(--brand-light);
    color: var(--brand-dark);
    font-family: 'Inter', system-ui, sans-serif;
}

/* ==== BUTTONS ==== */
.btn-primary {
    background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent));
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(30, 58, 138, .4);
}

.btn-outline-light:hover {
    background: #fff;
    color: var(--brand-dark) !important;
}

.btn-outline-primary {
    border-color: var(--brand-primary);
    color: var(--brand-primary);
}

.btn-outline-primary:hover {
    background: var(--brand-primary);
    color: #fff;
}

/* ==== CARDS ==== */
.card {
    border: none;
    border-radius: 1rem;
    transition: all .3s;
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, .15);
}

.glass {
    background: rgba(255, 255, 255, .75);
    backdrop-filter: blur(12px);
}

/* ==== PROGRESS ==== */
.progress {
    height: .6rem;
    border-radius: .75rem;
    background: rgba(0, 0, 0, .1);
}

.progress-bar {
    background: linear-gradient(90deg, var(--brand-primary), var(--brand-secondary));
}

/* ==== HERO SLIDER ==== */
.hero-wrap {
    position: relative;
    border-radius: 1.5rem;
    overflow: hidden;
    isolation: isolate;
}

.hero-slides {
    position: absolute;
    inset: 0;
    z-index: -2;
}

.hero-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    animation: fade 18s infinite ease-in-out;
    transform: scale(1.06);
}

/* placeholder images for the sliding background */
.hero-slide.s1 {
    background-image: url('https://picsum.photos/1600/700?random=31');
    animation-delay: 0s
}

.hero-slide.s2 {
    background-image: url('https://picsum.photos/1600/700?random=32');
    animation-delay: 6s
}

.hero-slide.s3 {
    background-image: url('https://picsum.photos/1600/700?random=33');
    animation-delay: 12s
}

@keyframes fade {

    0%,
    100% {
        opacity: 0
    }

    5%,
    30% {
        opacity: 1
    }

    35%,
    95% {
        opacity: 0
    }
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(30, 27, 75, .65), rgba(30, 27, 75, .75));
    z-index: -1;
}

.hero-content {
    color: #fff;
    position: relative;
}
</style>

<!-- ===== HERO with sliding backgrounds ===== -->
<section class="hero-wrap p-4 p-lg-5 mb-5">
    <div class="hero-slides">
        <div class="hero-slide s1"></div>
        <div class="hero-slide s2"></div>
        <div class="hero-slide s3"></div>
    </div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge bg-light text-dark mb-2">Autonomous AI Coach</span>
                <h1 class="display-5 fw-bold">Money guidance that adapts to your life</h1>
                <p class="lead mt-2">
                    Built for gig workers, informal sector employees, and everyday citizens.
                    Financecoach learns your spending patterns and income swings to help you save, spend smarter, and
                    stay secure.
                </p>
                <div class="mt-3 d-flex flex-wrap gap-2">
                    <a href="/dashboard.php" class="btn btn-primary btn-lg">Open Dashboard</a>
                    <a href="/chatbot.php" class="btn btn-outline-light btn-lg">Chat with AI Coach</a>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="glass rounded-4 shadow p-3">
                    <h5 class="fw-semibold mb-3">Today’s Smart Tips</h5>
                    <div class="card p-3 mb-2">
                        <small class="text-muted">Cash-flow</small>
                        <div>Income dip detected. Cut dining by 12% this week.</div>
                    </div>
                    <div class="card p-3 mb-2">
                        <small class="text-muted">Goal boost</small>
                        <div>Auto-save ₹500 to stay on track for Emergency Fund.</div>
                    </div>
                    <div class="card p-3">
                        <small class="text-muted">Challenge</small>
                        <div>No-spend coffee challenge • Earn +50 pts</div>
                    </div>
                    <div class="progress mt-3">
                        <div class="progress-bar" style="width:40%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== QUICK ACTIONS ===== -->
<section class="py-4">
    <h2 class="h4 fw-bold mb-3">Quick Setup</h2>
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5" style="color:var(--brand-primary)">Add Budget</h3>
                    <form>
                        <input type="text" class="form-control mb-2" placeholder="Category">
                        <input type="number" class="form-control mb-2" placeholder="Limit (₹)">
                        <button class="btn btn-primary w-100">Save Budget</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5" style="color:var(--brand-accent)">Spending Guardrail</h3>
                    <form>
                        <select class="form-select mb-2">
                            <option>Weekly</option>
                            <option>Daily</option>
                            <option>Monthly</option>
                        </select>
                        <input type="number" class="form-control mb-2" placeholder="Max spend (₹)">
                        <button class="btn btn-outline-primary w-100">Enable</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5" style="color:var(--brand-secondary)">Income Profile</h3>
                    <form>
                        <select class="form-select mb-2">
                            <option>Gig / Contract</option>
                            <option>Salaried</option>
                            <option>Mixed</option>
                        </select>
                        <input type="text" class="form-control mb-2" placeholder="Range ₹15k – ₹40k">
                        <button class="btn btn-outline-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/footer.php'; ?>