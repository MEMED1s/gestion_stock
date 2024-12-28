import './bootstrap';
import '../css/app.css';
import '../css/custom.css';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Définir le composant modal globalement
Alpine.data('modalForm', () => ({
    isOpen: false,
    content: '',

    showModal(url) {
        console.log('Opening modal with URL:', url);
        fetch(url)
            .then(response => response.text())
            .then(html => {
                this.content = html;
                this.isOpen = true;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    },

    closeModal() {
        this.isOpen = false;
        setTimeout(() => {
            this.content = '';
        }, 300);
    }
}));

Alpine.start();
