import axios from 'axios';
import { Toast } from 'primevue/toast';

const toast = axios.interceptors.response.use(
    (response) => {
        console.log('succccesssss', response);
        if (response.flash.success) {
            Toast.add({
                severity: 'success',
                summary: 'Opération réussie',
                detail: 'L\'opération a été exécutée avec succès.',
                life: 3000,
            });
        }
        return response;
    },
    (error) => {
        console.log('errrrrorororor', error);
        Toast.add({
            severity: 'error',
            summary: 'Erreur',
            detail: 'Une erreur est survenue lors de l\'exécution de l\'opération.',
            life: 3000,
        });
        return Promise.reject(error);
    }
);

export default toast;