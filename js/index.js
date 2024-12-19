window.addEventListener('scroll', () => {
    const footer = document.querySelector('footer');
    const footerContent = document.querySelector('.footer-content');
    const footerBottom = document.querySelector('.footer-bottom'); // Sélectionne la ligne ajoutée
    const scrollPosition = window.scrollY + window.innerHeight;
    const documentHeight = document.body.scrollHeight;

    if (scrollPosition >= documentHeight && !footerContent) {
        // Ajouter dynamiquement le contenu du footer
        const content = `
            <div class="footer-content">
                <div class="footer-left">
                    <p><a href="propos-de-nous.html">Qui sommes-nous</a></p>
                    <p><br>
                        <span>123 Rue de l'Exemple, 59000 Lille</span><br>
                        <span>contact@murmuresailleurs.fr</span><br>
                        <span>+33 3 12 34 56 78</span>
                    </p>
                </div>
                <div class="footer-right">
                    <p>Rejoignez-nous sur les réseaux sociaux</p>
                    <div class="social-media">
                        <a href="#"><img src="./svg/instagram.svg" alt="Instagram"></a>
                        <a href="#"><img src="./svg/facebook.svg" alt="Facebook"></a>
                        <a href="#"><img src="./svg/x.svg" alt="X"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom"></div>
        `;
        footer.insertAdjacentHTML('afterbegin', content);
        footer.style.paddingTop = "15px"; // Agrandit le haut du footer
    } else if (scrollPosition < documentHeight) {
        // Supprimer dynamiquement le contenu du footer
        if (footerContent) footerContent.remove();
        if (footerBottom) footerBottom.remove();
        footer.style.paddingTop = "0px"; // Rétablit la taille normale
    }
});


// Sélection des éléments
const helpButton = document.querySelector('.help-button');
const helpPopup = document.querySelector('#helpPopup');

// Affiche ou masque la popup au clic sur le bouton "?"
helpButton.addEventListener('click', () => {
    if (helpPopup.style.display === 'none' || helpPopup.style.display === '') {
        helpPopup.style.display = 'block';
    } else {
        helpPopup.style.display = 'none';
    }
});

// Fermer la popup si on clique en dehors
document.addEventListener('click', (event) => {
    if (!helpPopup.contains(event.target) && event.target !== helpButton) {
        helpPopup.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const generateButton = document.getElementById('generateButton');
    const ideaDisplay = document.getElementById('ideesDisplay');

    generateButton.addEventListener('click', () => {
        fetch('./idees.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                ideaDisplay.textContent = data;
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des idées :', error);
                ideaDisplay.textContent = "Une erreur s'est produite. Réessayez. Vérifiez si le fichier idees.php est accessible.";
            });
    });
});


