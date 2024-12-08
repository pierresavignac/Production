const handleFetch = async () => {
    try {
        const response = await fetch('/api/installations.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                fetch: true,
                installation_number: installationNumber
            })
        });

        const data = await response.json();
        
        if (data.success) {
            // Remplir le formulaire avec les données converties
            setFormData(data.data);
        } else {
            alert(data.error || 'Erreur lors de la récupération des données');
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de la communication avec le serveur');
    }
}; 