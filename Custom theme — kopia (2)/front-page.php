<?php
get_header();
?> 


    <section class="fr-hero-section">
            <div class="fr-decorative-bg">
                <?php for ($i = 0; $i < 15; $i++): ?>
                    <div class="fr-dot" style="background-color: rgba(0, 100, 188, 0.3); width: <?= 8 + $i * 1.6 ?>px; height: <?= 8 + $i * 1.6 ?>px; top: <?= 10 + $i * 5.5 ?>%; left: <?= 5 + $i * 6.4 ?>%; transform: rotate(<?= $i * 30 ?>deg);"></div>
                <?php endfor; ?>
            </div>
            <div class="container">
                
                <div class="fr-hero-banner" style="background-image: url('<?php echo get_template_directory_uri() ?>/assets/img/hero-bg.png');">




                    <div class="fr-hero-content d-none d-md-flex">
                        <div class="fr-hero-text">
                            <p class="fr-hero-badge">BEZPIECZNE ROZWIĄZANIA CYFROWE</p>
                            <h1 class="fr-hero-title">Kwalifikowana <br>pieczęć elektroniczna</h1>
                            <p class="fr-hero-description">Zabezpiecz swoje dokumenty firmowe profesjonalną pieczęcią elektroniczną zgodną z eIDAS.</p>
                            <div class="fr-hero-buttons">
                                <button class="btn btn-primary">WYBIERZ PIECZĘĆ →</button>
                                <button class="btn btn-secondary">DOWIEDZ SIĘ WIĘCEJ</button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="fr-hero-mobile d-md-none">
                        <div class="fr-hero-text-mobile">
                            <p class="fr-hero-badge">PRODUKT</p>
                            <h1 class="fr-hero-title-mobile">Kwalifikowany<br>podpis elektroniczny</h1>
                            <p class="fr-hero-description-mobile">Podpisuj elektronicznie dokumenty PDF, XML i inne w formacie XAdES i PAdES.</p>
                            <div class="fr-hero-buttons-mobile">
                                <button class="btn btn-primary">SPRAWDŹ WARIANTY →</button>
                                <button class="btn btn-secondary">PORÓWNAJ FUNKCJONALNOŚCI</button>
                            </div>
                            <div class="fr-hero-features-mobile">
                                <div class="fr-feature-item">
                                    <svg class="fr-check-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg>
                                    <span>Moc prawna podpisu własnoręcznego w całej UE</span>
                                </div>
                                <div class="fr-feature-item">
                                    <svg class="fr-check-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg>
                                    <span>Ponad 100 000+ certyfikatów wydanych</span>
                                </div>
                                <div class="fr-feature-item">
                                    <svg class="fr-check-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"></path></svg>
                                    <span>Wsparcie 24/7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fr-hero-image-mobile d-md-none">
                        <img src="<?php echo get_template_directory_uri() ?> /assets/img/hero-bg2.png" alt="EuroCert Mobile App">
                    </div>
                    <div class="fr-hero-image-desktop d-none d-md-block">
                        <img src="<?php echo get_template_directory_uri() ?> /assets/img/hero-bg2.png" alt="EuroCert Mobile App">
                    </div>
                </div>
            </div>
        </section>


<?php
get_footer();
?>