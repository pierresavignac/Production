const handleFetchData = async () => {
    setIsLoading(true);
    setFetchError('');
    
    try {
        const installationNumber = formData.installation_number;
        if (!installationNumber || installationNumber === 'INS0') {
            throw new Error('Veuillez entrer un numéro d\'installation valide');
        }

        const numberPattern = /^INS0\d{1,5}$/;
        if (!numberPattern.test(installationNumber)) {
            throw new Error('Format du numéro d\'installation invalide');
        }

        const progressionData = await fetchProgressionTask(installationNumber);

        if (!progressionData?.customer?.name) {
            throw new Error('Données client manquantes ou invalides');
        }

        setFormData(prev => ({
            ...prev,
            full_name: progressionData.customer.name,
            phone: progressionData.customer.phoneNumber || '',
            address: progressionData.customer.address?.street || '',
            city: progressionData.customer.address?.city || '',
            summary: progressionData.task?.title || '',
            description: progressionData.task?.description || '',
            amount: progressionData.task?.priceWithTaxes || '',
            progression_task_id: progressionData.task?.id || ''
        }));
    } catch (error) {
        console.error('Erreur Fetch:', error);
        setFetchError(error.message || 'Une erreur est survenue lors de la récupération des données');
    } finally {
        setIsLoading(false);
    }
}; 