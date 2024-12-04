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
    const response = await fetch(`${API_BASE_URL}/events.php`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify(eventData)
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

export const deleteEvent = async (eventId) => {
  try {
    const response = await fetch(`${API_BASE_URL}/events.php?id=${eventId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    });

    if (!response.ok) {
      const text = await response.text();
      const errorData = JSON.parse(text);
      throw new Error(errorData.message || `Erreur HTTP: ${response.status}`);
    }

    return true;
  } catch (error) {
    console.error('Erreur lors de la suppression de l\'événement:', error);
    throw error;
  }
}; 