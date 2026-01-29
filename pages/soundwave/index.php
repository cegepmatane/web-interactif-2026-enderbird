<?php
require_once dirname(__DIR__) . "/header.php";
?>

    <title>SoundWave - Ma Musique</title>
    <link rel="stylesheet" href="../css/general.css">

    
    <main id="contenu-principal">
        <!-- Légende Ajax -->
        <section id="legende-ajax">
            <div class="item-legende">
                <div class="icone-legende">🔍</div>
                <div class="titre-legende">Recherche</div>
                <div class="desc-legende">Auto-complete Ajax</div>
            </div>
            <div class="item-legende">
                <div class="icone-legende">🔖</div>
                <div class="titre-legende">Bookmark</div>
                <div class="desc-legende">Sauvegarder albums</div>
            </div>
            <div class="item-legende">
                <div class="icone-legende">⭐</div>
                <div class="titre-legende">Rating</div>
                <div class="desc-legende">Noter les albums</div>
            </div>
            <div class="item-legende">
                <div class="icone-legende">💬</div>
                <div class="titre-legende">Commentaire</div>
                <div class="desc-legende">Réagir sans reload</div>
            </div>
        </section>

        <!-- Album en vedette avec pochette personnalisable -->
        <section id="album-vedette">
            <div class="pochette-album">
                <img src="https://images.unsplash.com/photo-1614149162883-504ce4d13909?w=400&h=400&fit=crop" alt="Pochette album">
                <div class="overlay-personnaliser">
                    <span>🎨</span>
                    <p>Personnaliser la pochette</p>
                </div>
            </div>
            <div class="info-album-vedette">
                <h2>Neon Horizons</h2>
                <p class="artiste-vedette">par Synthwave Collective</p>

                <div class="stats-album">
                    <div class="stat-item">
                        <div class="stat-nombre">12</div>
                        <div class="stat-label">Pistes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre">47:32</div>
                        <div class="stat-label">Durée</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-nombre">2026</div>
                        <div class="stat-label">Année</div>
                    </div>
                </div>

                <!-- AJAX #3 : Rating -->
                <div class="zone-rating">
                    <span>Votre note :</span>
                    <div class="etoiles">
                        <span class="etoile active" data-note="1">⭐</span>
                        <span class="etoile active" data-note="2">⭐</span>
                        <span class="etoile active" data-note="3">⭐</span>
                        <span class="etoile active" data-note="4">⭐</span>
                        <span class="etoile" data-note="5">⭐</span>
                    </div>
                    <span class="moyenne-rating">4.3 / 5</span>
                </div>

                <!-- AJAX #2 : Bookmark -->
                <button class="bouton-bookmark">
                    <span>🔖</span> Ajouter à ma collection
                </button>
            </div>
        </section>

        <!-- Liste des pistes -->
        <section id="liste-pistes">
            <h2 class="titre-section">🎵 Pistes de l'album</h2>

            <article class="piste">
                <span class="piste-numero">1</span>
                <div class="piste-pochette">
                    <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=100&h=100&fit=crop" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre">Sunrise Protocol</div>
                    <div class="piste-artiste">Synthwave Collective</div>
                </div>
                <span class="piste-duree">4:12</span>
                <div class="piste-actions">
                    <button class="bouton-piste favori" title="Favoris">❤️</button>
                    <button class="bouton-piste" title="Jouer">▶️</button>
                </div>
            </article>

            <article class="piste">
                <span class="piste-numero">2</span>
                <div class="piste-pochette">
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=100&h=100&fit=crop" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre">Neon Boulevard</div>
                    <div class="piste-artiste">Synthwave Collective</div>
                </div>
                <span class="piste-duree">3:45</span>
                <div class="piste-actions">
                    <button class="bouton-piste favori actif" title="Favoris">❤️</button>
                    <button class="bouton-piste" title="Jouer">▶️</button>
                </div>
            </article>

            <article class="piste">
                <span class="piste-numero">3</span>
                <div class="piste-pochette">
                    <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=100&h=100&fit=crop" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre">Digital Dreams</div>
                    <div class="piste-artiste">Synthwave Collective feat. Luna</div>
                </div>
                <span class="piste-duree">5:23</span>
                <div class="piste-actions">
                    <button class="bouton-piste favori" title="Favoris">❤️</button>
                    <button class="bouton-piste" title="Jouer">▶️</button>
                </div>
            </article>

            <article class="piste">
                <span class="piste-numero">4</span>
                <div class="piste-pochette">
                    <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=100&h=100&fit=crop" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre">Cyber Nights</div>
                    <div class="piste-artiste">Synthwave Collective</div>
                </div>
                <span class="piste-duree">4:58</span>
                <div class="piste-actions">
                    <button class="bouton-piste favori" title="Favoris">❤️</button>
                    <button class="bouton-piste" title="Jouer">▶️</button>
                </div>
            </article>

            <article class="piste">
                <span class="piste-numero">5</span>
                <div class="piste-pochette">
                    <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?w=100&h=100&fit=crop" alt="Pochette">
                </div>
                <div class="piste-info">
                    <div class="piste-titre">Retrowave Sunset</div>
                    <div class="piste-artiste">Synthwave Collective</div>
                </div>
                <span class="piste-duree">6:01</span>
                <div class="piste-actions">
                    <button class="bouton-piste favori" title="Favoris">❤️</button>
                    <button class="bouton-piste" title="Jouer">▶️</button>
                </div>
            </article>
        </section>

        <!-- AJAX #4 : Commentaires -->
        <section id="section-commentaires">
            <h2 class="titre-section">💬 Commentaires (3)</h2>

            <div class="liste-commentaires">
                <div class="commentaire">
                    <div class="avatar-commentaire">🎧</div>
                    <div class="contenu-commentaire">
                        <div class="auteur-commentaire">DJ_Maxime</div>
                        <div class="texte-commentaire">Cet album est incroyable ! La piste 3 est mon coup de coeur 💜</div>
                    </div>
                </div>
                <div class="commentaire">
                    <div class="avatar-commentaire">🎹</div>
                    <div class="contenu-commentaire">
                        <div class="auteur-commentaire">SynthLover42</div>
                        <div class="texte-commentaire">Les vibes rétro sont parfaites. On se croirait dans les années 80 !</div>
                    </div>
                </div>
                <div class="commentaire">
                    <div class="avatar-commentaire">🎸</div>
                    <div class="contenu-commentaire">
                        <div class="auteur-commentaire">MusicFan_Sophie</div>
                        <div class="texte-commentaire">J'écoute en boucle depuis 3 jours. Chef d'oeuvre !</div>
                    </div>
                </div>
            </div>

            <div class="formulaire-commentaire">
                <input type="text" class="champ-commentaire" placeholder="Partagez votre avis sur cet album...">
                <button class="bouton-commenter">Envoyer</button>
            </div>
        </section>
    </main>



    <script>
        // Observateur pour animations au scroll
        const observateur = new IntersectionObserver((entrees) => {
            entrees.forEach((entree, index) => {
                if (entree.isIntersecting) {
                    setTimeout(() => {
                        entree.target.classList.add('visible');
                    }, index * 80);
                }
            });
        }, { threshold: 0.1 });

        // Observer les éléments
        document.querySelectorAll('.item-legende, #album-vedette, .piste, .commentaire').forEach(el => {
            observateur.observe(el);
        });

        // AJAX #1 : Recherche
        const champRecherche = document.getElementById('champ-recherche');
        const listeSuggestions = document.getElementById('liste-suggestions');

        champRecherche.addEventListener('input', () => {
            listeSuggestions.classList.toggle('active', champRecherche.value.length > 0);
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('#zone-recherche')) {
                listeSuggestions.classList.remove('active');
            }
        });

        // AJAX #2 : Bookmark
        document.querySelectorAll('.bouton-bookmark').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('actif');
                const texte = this.querySelector('span').nextSibling;
                if (this.classList.contains('actif')) {
                    this.innerHTML = '<span>✓</span> Dans ma collection';
                } else {
                    this.innerHTML = '<span>🔖</span> Ajouter à ma collection';
                }
            });
        });

        // AJAX #3 : Rating
        document.querySelectorAll('.zone-rating').forEach(zone => {
            const etoiles = zone.querySelectorAll('.etoile');
            etoiles.forEach(etoile => {
                etoile.addEventListener('click', function() {
                    const note = parseInt(this.dataset.note);
                    etoiles.forEach((e, i) => {
                        e.classList.toggle('active', i < note);
                    });
                });
            });
        });

        // Favoris pistes
        document.querySelectorAll('.bouton-piste.favori').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('actif');
            });
        });

        // AJAX #4 : Commentaires
        document.querySelectorAll('.bouton-commenter').forEach(btn => {
            btn.addEventListener('click', function() {
                const champ = this.previousElementSibling;
                const texte = champ.value.trim();
                if (texte) {
                    const liste = this.closest('section').querySelector('.liste-commentaires');
                    const nouveau = document.createElement('div');
                    nouveau.className = 'commentaire visible';
                    nouveau.innerHTML = `
                        <div class="avatar-commentaire">🎵</div>
                        <div class="contenu-commentaire">
                            <div class="auteur-commentaire">Moi</div>
                            <div class="texte-commentaire">${texte}</div>
                        </div>
                    `;
                    liste.appendChild(nouveau);
                    champ.value = '';
                }
            });
        });
    </script>

<!-- Pied de page -->
<?php
require_once dirname(__DIR__) . "/footer.php";
?>