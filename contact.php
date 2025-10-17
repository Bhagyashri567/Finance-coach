<?php include 'navbar.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card glass p-4">
                <h2 class="fw-bold mb-4 text-center" style="color: var(--brand-primary)">Contact Us</h2>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <h5 style="color: var(--brand-secondary)">Get in Touch</h5>
                        <p>Have questions about Financecoach? We're here to help!</p>
                        
                        <div class="mb-3">
                            <i class="fas fa-envelope me-2" style="color: var(--brand-accent)"></i>
                            <span>support@financecoach.in</span>
                        </div>
                        
                        <div class="mb-3">
                            <i class="fas fa-phone me-2" style="color: var(--brand-accent)"></i>
                            <span>+91 98765 43210</span>
                        </div>
                        
                        <div class="mb-3">
                            <i class="fas fa-map-marker-alt me-2" style="color: var(--brand-accent)"></i>
                            <span>Mumbai, Maharashtra, India</span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 style="color: var(--brand-secondary)">Send Message</h5>
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="4" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <h6 style="color: var(--brand-secondary)">Follow Us</h6>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#" class="text-muted"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-github fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>