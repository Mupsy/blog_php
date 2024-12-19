const bt2 = document.querySelector('.bt2');
const chatbotPopup = document.getElementById('chatbotPopup');
const chatbotMessages = document.getElementById('chatbotMessages');
const chatbotInput = document.getElementById('chatbotInput');
const chatbotSend = document.getElementById('chatbotSend');

// Afficher/Masquer le chatbot
bt2.addEventListener('click', () => {
    chatbotPopup.style.display = chatbotPopup.style.display === 'flex' ? 'none' : 'flex';
});

// Gérer l'envoi de messages
chatbotSend.addEventListener('click', () => sendMessage());

chatbotInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

function sendMessage() {
    const userMessage = chatbotInput.value.trim();
    if (userMessage) {
        // Ajouter le message utilisateur
        addMessage(userMessage, 'user');

        // Envoyer le message au serveur
        fetch('reponse.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: userMessage })
        })
            .then(reponse => reponse.json())
            .then(data => {
                // Ajouter la réponse du bot
                addMessage(data.message, 'bot');

                // Ajouter les options si disponibles
                if (data.options) {
                    addOptions(data.options);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des réponses :', error);
                addMessage("Une erreur s'est produite. Réessayez.", 'bot');
            });

        // Vider le champ d'entrée
        chatbotInput.value = '';
    }
}

function addMessage(message, type) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `chatbot-message ${type}`;
    messageDiv.textContent = message;
    chatbotMessages.appendChild(messageDiv);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}

function addOptions(options) {
    const optionsDiv = document.createElement('div');
    optionsDiv.className = 'chatbot-options';

    options.forEach(option => {
        const button = document.createElement('button');
        button.textContent = option;
        button.addEventListener('click', () => {
            addMessage(option, 'user');
            sendMessageFromOption(option);
        });
        optionsDiv.appendChild(button);
    });

    chatbotMessages.appendChild(optionsDiv);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}

function sendMessageFromOption(option) {
    fetch('./reponse.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ message: option })
    })
        .then(reponse => reponse.json())
        .then(data => {
            addMessage(data.message, 'bot');
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des réponses :', error);
            addMessage("Une erreur s'est produite. Réessayez.", 'bot');
        });
}
