const API_BASE_URL = 'https://app.vivreenliberte.org/api';

export const fetchEvents = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/events.php`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const text = await response.text();
    const data = JSON.parse(text);
    
    if (!data.success || !Array.isArray(data.data)) {
      throw new Error('Format de données invalide');
    }
    
    return data.data;
  } catch (error) {
    console.error('Erreur lors du chargement des événements:', error);
    throw error;
  }
};

export const fetchEmployees = async () => {
  try {
    const response = await fetch('/api/employees.php');
    if (!response.ok) {
      throw new Error('Erreur lors de la récupération des employés');
    }
    return await response.json();
  } catch (error) {
    console.error('Erreur:', error);
    throw error;
  }
};

export const fetchTechnicians = async () => {
  try {
    const response = await fetch('/api/employees.php?type=technicians');
    if (!response.ok) {
      throw new Error('Erreur lors de la récupération des techniciens');
    }
    return await response.json();
  } catch (error) {
    console.error('Erreur:', error);
    throw error;
  }
};

export const fetchRegions = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/regions.php?type=regions`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return await response.json();
  } catch (error) {
    console.error('Erreur lors du chargement des régions:', error);
    throw error;
  }
};

export const fetchCitiesForRegion = async (regionId) => {
  try {
    const response = await fetch(`${API_BASE_URL}/regions.php?region_id=${regionId}`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return await response.json();
  } catch (error) {
    console.error('Erreur lors du chargement des villes:', error);
    throw error;
  }
};

export const fetchEquipment = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/equipment.php`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return await response.json();
  } catch (error) {
    console.error('Erreur lors du chargement des équipements:', error);
    throw error;
  }
};

export const createEvent = async (eventData) => {
  try {
    const response = await fetch(`${API_BASE_URL}/events.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(eventData)
    });

    const text = await response.text();
    let jsonResponse;
    try {
      jsonResponse = JSON.parse(text);
    } catch (e) {
      console.error('La réponse n\'est pas du JSON valide:', text);
      throw new Error('Réponse invalide du serveur');
    }

    if (!response.ok || !jsonResponse.success) {
      throw new Error(jsonResponse.message || `Erreur HTTP: ${response.status}`);
    }

    return jsonResponse;
  } catch (error) {
    console.error('Erreur lors de la création de l\'événement:', error);
    throw error;
  }
};

export const updateEvent = async (eventData) => {
  try {
    const normalizedData = {
      id: eventData.id,
      type: eventData.type,
      date: eventData.date,
      installation_time: eventData.installation_time,
      first_name: eventData.first_name,
      last_name: eventData.last_name,
      installation_number: eventData.installation_number,
      city: eventData.city,
      equipment: eventData.equipment,
      amount: eventData.amount,
      region_id: eventData.region,
      technician1_id: eventData.technician1,
      technician2_id: eventData.technician2,
      technician3_id: eventData.technician3,
      technician4_id: eventData.technician4,
      employee_id: eventData.employee_id
    };

    const response = await fetch(`${API_BASE_URL}/events.php`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(normalizedData)
    });

    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(errorText || `Erreur HTTP: ${response.status}`);
    }

    const text = await response.text();
    return JSON.parse(text);
  } catch (error) {
    console.error('Erreur lors de la modification de l\'événement:', error);
    throw error;
  }
};

export const deleteEvent = async (eventId, deleteMode = 'single') => {
  try {
    const response = await fetch(`${API_BASE_URL}/events.php?id=${eventId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ deleteMode })
    });
    
    if (!response.ok) {
      throw new Error('Erreur lors de la suppression');
    }
    
    return await response.json();
  } catch (error) {
    console.error('Erreur:', error);
    throw error;
  }
};

// Fonction de lecture seule pour ProgressionLive
export const fetchProgressionTask = async (installationNumber) => {
  try {
    // Nettoyer et formater le numéro d'installation
    const cleanNumber = installationNumber.replace(/[^0-9]/g, '');
    const formattedNumber = `INS0${cleanNumber}`;

    // Vérification préliminaire
    if (!cleanNumber) {
      throw new Error('Numéro d\'installation invalide');
    }

    // Utiliser URLSearchParams pour encoder correctement les paramètres
    const params = new URLSearchParams({
      code: formattedNumber
    });

    const response = await fetch(`${API_BASE_URL}/progression/tasks.php?${params}`, {
      method: 'GET',
      headers: {
        'Accept': 'application/json'
      },
      credentials: 'include'
    });

    // Log pour le débogage
    console.log('URL appelée:', `${API_BASE_URL}/progression/tasks.php?${params}`);
    console.log('Status:', response.status);
    console.log('Headers:', [...response.headers.entries()]);

    if (!response.ok) {
      const errorText = await response.text();
      console.error('Erreur serveur:', {
        status: response.status,
        statusText: response.statusText,
        errorText
      });
      
      if (response.status === 500) {
        throw new Error('Erreur interne du serveur. Veuillez réessayer plus tard.');
      }
      
      throw new Error(
        `Erreur lors de la récupération des données (${response.status})`
      );
    }

    let data;
    try {
      const text = await response.text();
      console.log('Réponse brute:', text);
      data = JSON.parse(text);
    } catch (e) {
      console.error('Erreur parsing JSON:', e);
      throw new Error('Format de réponse invalide');
    }

    if (!data || typeof data !== 'object') {
      throw new Error('Format de données invalide');
    }

    // Transformation des données dans le format attendu
    return {
      customer: {
        name: data.customer?.name || '',
        phoneNumber: data.customer?.phone || '',
        address: {
          street: data.customer?.address || '',
          city: data.customer?.city || ''
        }
      },
      task: {
        id: data.task?.id || '',
        title: data.task?.title || '',
        description: data.task?.description || '',
        priceWithTaxes: data.task?.price || 0
      }
    };

  } catch (error) {
    console.error('Erreur complète:', error);
    // Remonter une erreur plus conviviale
    throw new Error(
      error.message === 'Failed to fetch' 
        ? 'Impossible de contacter le serveur. Vérifiez votre connexion.'
        : error.message
    );
  }
}; 