document.addEventListener('DOMContentLoaded', () => {
    // Hamburger Menu Toggle
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
    }

    // Mobile Submenu Toggle
    document.querySelectorAll('.nav-item').forEach(item => {
        const link = item.querySelector('a');
        const submenu = item.querySelector('.submenu');
        
        if (submenu && link) {
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    item.classList.toggle('active');
                }
            });
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (navLinks && hamburger && !navLinks.contains(e.target) && !hamburger.contains(e.target)) {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
        }
    });

    // Header scroll effect
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (header) {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });

    // Review Slider Logic
    const review_slider = document.getElementById('review-slider');
    const review_dots_container = document.getElementById('slider-dots');
    
    if (review_slider && review_dots_container) {
        const dots = review_dots_container.querySelectorAll('.dot');
        let review_index = 0;

        const moveReviewSlider = (index) => {
            review_slider.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach(d => d.classList.remove('active'));
            if (dots[index]) dots[index].classList.add('active');
        };

        let sliderInterval = setInterval(() => {
            review_index = (review_index + 1) % dots.length;
            moveReviewSlider(review_index);
        }, 5000);

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                review_index = i;
                moveReviewSlider(review_index);
                clearInterval(sliderInterval);
                sliderInterval = setInterval(() => {
                    review_index = (review_index + 1) % dots.length;
                    moveReviewSlider(review_index);
                }, 5000);
            });
        });

        // Pause on hover
        const sliderWrapper = document.querySelector('.slider-wrapper');
        if (sliderWrapper) {
            sliderWrapper.addEventListener('mouseenter', () => clearInterval(sliderInterval));
            sliderWrapper.addEventListener('mouseleave', () => {
                sliderInterval = setInterval(() => {
                    review_index = (review_index + 1) % dots.length;
                    moveReviewSlider(review_index);
                }, 5000);
            });
        }
    }

    // Portfolio Slider
    const portfolio_slider = document.getElementById('portfolio-slider');
    const portfolio_prev = document.getElementById('portfolio-prev');
    const portfolio_next = document.getElementById('portfolio-next');

    if (portfolio_slider && portfolio_prev && portfolio_next) {
        const firstCard = portfolio_slider.querySelector('.portfolio-card');
        
        portfolio_next.addEventListener('click', () => {
            const card_width = firstCard ? (firstCard.offsetWidth + 32) : 350;
            portfolio_slider.scrollBy({ left: card_width, behavior: 'smooth' });
        });

        portfolio_prev.addEventListener('click', () => {
            const card_width = firstCard ? (firstCard.offsetWidth + 32) : 350;
            portfolio_slider.scrollBy({ left: -card_width, behavior: 'smooth' });
        });
    }

    // Scroll Reveal Animation
    const observer_options = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, observer_options);

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
});


