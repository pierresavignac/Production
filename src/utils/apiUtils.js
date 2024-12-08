export const fetchProgressionTask = async (installationNumber) => {
    try {
        const cleanNumber = installationNumber.replace('INS0', '').trim();
        if (!cleanNumber) {
            throw new Error('Numéro d\'installation invalide');
        }

        const response = await fetch(`${process.env.VITE_API_URL}/progression/tasks.php?code=INS0${cleanNumber}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        });

        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('La réponse du serveur n\'est pas au format JSON');
        }

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || `Erreur ${response.status}: ${response.statusText}`);
        }

        if (!data.success) {
            throw new Error(data.message || 'Erreur lors de la récupération des données');
        }

        return data.data;
    } catch (error) {
        console.error('Erreur lors de la récupération de la tâche:', error);
        throw error;
    }
} 