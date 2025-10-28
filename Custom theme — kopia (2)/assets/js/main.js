
// EuroCert Interactive JavaScript

document.addEventListener('DOMContentLoaded', function() {

    // Period Selector
    initPeriodSelector();

    // Process Accordion with Image Change
    initProcessAccordion();

    // Verification Tabs
    initVerificationTabs();

    // FAQ Accordion
    initFAQAccordion();

});

// Period Selector for Product Line Section
function initPeriodSelector() {
    const periodButtons = document.querySelectorAll('.fr-period-btn');

    periodButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            periodButtons.forEach(btn => btn.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Get selected period
            const period = this.getAttribute('data-period');

            // Here you would typically update prices based on the selected period
            // For now, we'll just log it
            console.log('Selected period:', period);

            // You can add logic here to update product prices dynamically
            // updateProductPrices(period);
        });
    });
}

// Process Accordion with Image Change
function initProcessAccordion() {
    const accordionItems = document.querySelectorAll('.fr-accordion-item');
    const processImage = document.getElementById('processImage');

    if (!processImage) return;

    accordionItems.forEach(item => {
        const header = item.querySelector('.fr-accordion-header');

        header.addEventListener('click', function() {
            // Close all other accordion items
            accordionItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current item
            item.classList.toggle('active');

            // Change image based on active item
            if (item.classList.contains('active')) {
                const imageUrl = item.getAttribute('data-image');
                if (imageUrl) {
                    // Add fade effect
                    processImage.style.opacity = '0';

                    setTimeout(() => {
                        processImage.src = imageUrl;
                        processImage.style.opacity = '1';
                    }, 300);
                }
            }
        });
    });

    // Set first item as active by default
    if (accordionItems.length > 0) {
        accordionItems[0].classList.add('active');
    }
}

// Verification Tabs
function initVerificationTabs() {
    const tabButtons = document.querySelectorAll('.fr-tab-btn');
    const tabContents = document.querySelectorAll('.fr-tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Show corresponding content
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
}

// FAQ Accordion
function initFAQAccordion() {
    const faqItems = document.querySelectorAll('.fr-faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.fr-faq-question');

        question.addEventListener('click', function() {
            // Toggle current item
            const isActive = item.classList.contains('active');

            // Close all other items (optional - remove if you want multiple items open)
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });
}

// Smooth Scroll for Anchor Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');

        // Don't prevent default for empty anchors
        if (href === '#' || href === '') {
            return;
        }

        e.preventDefault();

        const targetId = href.substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Form Validation
const contactForm = document.querySelector('.fr-contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Get form values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const consent = document.getElementById('consent').checked;

        // Basic validation
        if (!name || !email || !phone) {
            alert('Proszę wypełnić wszystkie pola.');
            return;
        }

        if (!consent) {
            alert('Proszę wyrazić zgodę na przetwarzanie danych osobowych.');
            return;
        }

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert('Proszę podać prawidłowy adres e-mail.');
            return;
        }

        // Here you would typically send the form data to a server
        console.log('Form submitted:', { name, email, phone, consent });

        // Show success message
        alert('Dziękujemy za wiadomość! Skontaktujemy się z Tobą wkrótce.');

        // Reset form
        contactForm.reset();
    });
}

// Add scroll animations (optional enhancement)
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements you want to animate
    const animatedElements = document.querySelectorAll('.fr-feature-card, .fr-product-card, .fr-material-card');

    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

// Initialize scroll animations if needed
// initScrollAnimations();

// Handle window resize
let resizeTimer;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
        // Handle any resize-specific logic here
        console.log('Window resized');
    }, 250);
});

// Add loading state handler
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
    console.log('Page fully loaded');
});

// Utility function to update product prices (placeholder)
function updateProductPrices(period) {
    // This would contain logic to update prices based on selected period
    // Example structure:
    /*
    const prices = {
        '1': { classic: 289, cloud: 299 },
        '2': { classic: 550, cloud: 570 },
        '3': { classic: 800, cloud: 830 }
    };

    // Update DOM elements with new prices
    */
}

// Prevent FOUC (Flash of Unstyled Content)
document.documentElement.classList.add('js-enabled');



document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.st-view-btn');
    const productGrid = document.querySelector('.st-shop-section .row.row-cols-1.row-cols-md-2.g-4');

    buttons.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            // Reset aktywnej klasy
            buttons.forEach(b => b.classList.remove('st-view-btn-active'));
            btn.classList.add('st-view-btn-active');

            // Przełącz widok
            if(index === 0) {
                // Grid 2 kolumny
                productGrid.classList.remove('view-list');
                productGrid.classList.add('row-cols-md-2');
            } else {
                // Widok 1 kolumna
                productGrid.classList.add('view-list');
                productGrid.classList.remove('row-cols-md-2');
            }
        });
    });
});





document.addEventListener('DOMContentLoaded', function() {
    // Pobierz wszystkie przyciski "Dodaj do koszyka"
    document.querySelectorAll('.single_add_to_cart_button').forEach(button => {
        // Sprawdź, czy SVG już nie istnieje
        if (!button.querySelector('svg.shopping-cart-icon')) {
            const svg = `
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shopping-cart-icon" aria-hidden="true">
                    <circle cx="8" cy="21" r="1"></circle>
                    <circle cx="19" cy="21" r="1"></circle>
                    <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                </svg>
            `;
            button.insertAdjacentHTML('afterbegin', svg);
        }
    });
});
