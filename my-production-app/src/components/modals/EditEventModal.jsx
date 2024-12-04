import React, { useState, useEffect } from 'react';
import { format } from 'date-fns';
import { fr } from 'date-fns/locale';
import { fetchTechnicians } from '../../utils/apiUtils';
import '../../styles/Modal.css';

const EditEventModal = ({ event, onClose, onSubmit, employees }) => {
  const [formData, setFormData] = useState({
    type: event.type || 'installation',
    firstName: event.first_name || '',
    lastName: event.last_name || '',
    installationNumber: event.installation_number || '',
    installationTime: event.installation_time || '',
    city: event.city || '',
    equipment: event.equipment || '',
    amount: event.amount || '',
    technician1_id: event.technician1_id || '',
    technician2_id: event.technician2_id || '',
    technician3_id: event.technician3_id || '',
    technician4_id: event.technician4_id || '',
    employee_id: event.employee_id || '',
    region_id: event.region_id || '',
    date: event.date || format(new Date(), 'yyyy-MM-dd')
  });

  const [technicians, setTechnicians] = useState([]);
  const [regions, setRegions] = useState([]);
  const [cities, setCities] = useState([]);
  const [equipment, setEquipment] = useState([]);

  useEffect(() => {
    const loadTechnicians = async () => {
      try {
        const techniciansList = await fetchTechnicians();
        setTechnicians(techniciansList);
      } catch (error) {
        console.error('Erreur lors du chargement des techniciens:', error);
      }
    };

    loadTechnicians();
  }, []);

  // Charger les données initiales (régions et équipements)
  useEffect(() => {
    const loadInitialData = async () => {
      try {
        // Charger les régions
        const regionsResponse = await fetch('https://app.vivreenliberte.org/api/regions.php?type=regions');
        const regionsData = await regionsResponse.json();
        setRegions(regionsData);

        // Charger les équipements
        const equipmentResponse = await fetch('https://app.vivreenliberte.org/api/equipment.php');
        const equipmentData = await equipmentResponse.json();
        setEquipment(equipmentData);

        // Si une région est déjà sélectionnée, charger ses villes
        if (event.region_id) {
          const citiesResponse = await fetch(`https://app.vivreenliberte.org/api/regions.php?region_id=${event.region_id}`);
          const citiesData = await citiesResponse.json();
          setCities(citiesData);
        }
      } catch (error) {
        console.error('Erreur lors du chargement des données:', error);
      }
    };

    loadInitialData();
  }, [event.region_id]);

  // Effet pour charger les villes quand la région change
  useEffect(() => {
    const loadCities = async () => {
      if (formData.region_id) {
        try {
          const response = await fetch(`https://app.vivreenliberte.org/api/regions.php?region_id=${formData.region_id}`);
          const data = await response.json();
          setCities(data);
        } catch (error) {
          console.error('Erreur lors du chargement des villes:', error);
          setCities([]);
        }
      } else {
        setCities([]);
      }
    };

    loadCities();
  }, [formData.region_id]);

  // Gérer le changement de région
  const handleRegionChange = (e) => {
    const regionId = e.target.value;
    setFormData(prev => ({
      ...prev,
      region_id: regionId,
      city: '' // Réinitialiser la ville car elle n'est plus valide
    }));
  };

  // Gérer les changements de formulaire
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleInstallationNumberChange = (e) => {
    const value = e.target.value;
    const numbers = value.replace(/\D/g, '');
    const limitedNumbers = numbers.slice(0, 5);
    setFormData(prev => ({
      ...prev,
      installationNumber: `INS0${limitedNumbers}`
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onSubmit(formData);
  };

  return (
    <div className="modal-overlay">
      <div className={`modal-content ${formData.type === 'installation' ? 'installation-modal' : ''}`}>
        <div className="modal-header">
          <h2>Modifier la tâche</h2>
          <button onClick={onClose} className="close-button">&times;</button>
        </div>
        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <label>Type de tâche</label>
            <select 
              name="type" 
              value={formData.type} 
              onChange={handleChange}
              required
            >
              <option value="installation">Installation</option>
              <option value="conge">Congé</option>
              <option value="maladie">Maladie</option>
              <option value="formation">Formation</option>
            </select>
          </div>

          <div className="form-group">
            <label>Date</label>
            <input
              type="date"
              name="date"
              value={formData.date}
              onChange={handleChange}
              required
            />
          </div>

          {formData.type === 'installation' ? (
            <>
              <div className="form-row-grid">
                <div className="form-group">
                  <label>Numéro d'installation</label>
                  <div className="installation-number-input">
                    <span className="prefix">INS0</span>
                    <input
                      type="text"
                      name="installationNumber"
                      placeholder="12345"
                      value={formData.installationNumber.replace('INS0', '')}
                      onChange={handleInstallationNumberChange}
                      pattern="[0-9]*"
                      maxLength="5"
                      required
                    />
                  </div>
                </div>

                <div className="form-group">
                  <label>Heure d'installation</label>
                  <input
                    type="time"
                    name="installationTime"
                    value={formData.installationTime}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>

              <div className="form-row-grid">
                <div className="form-group">
                  <label>Prénom</label>
                  <input
                    type="text"
                    name="firstName"
                    placeholder="Prénom"
                    value={formData.firstName}
                    onChange={handleChange}
                    required
                  />
                </div>

                <div className="form-group">
                  <label>Nom</label>
                  <input
                    type="text"
                    name="lastName"
                    placeholder="Nom"
                    value={formData.lastName}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>

              <div className="form-row-grid">
                <div className="form-group">
                  <label>Région</label>
                  <select
                    name="region_id"
                    value={formData.region_id}
                    onChange={handleRegionChange}
                    required
                  >
                    <option value="">Sélectionnez une région</option>
                    {regions.map(region => (
                      <option key={region.id} value={region.id}>
                        {region.name}
                      </option>
                    ))}
                  </select>
                </div>

                <div className="form-group">
                  <label>Ville</label>
                  <select
                    name="city"
                    value={formData.city}
                    onChange={handleChange}
                    required
                    disabled={!formData.region_id}
                  >
                    <option value="">Sélectionnez une ville</option>
                    {cities.map(city => (
                      <option key={city.id} value={city.name}>
                        {city.name}
                      </option>
                    ))}
                  </select>
                </div>
              </div>

              <div className="form-row-grid">
                <div className="form-group">
                  <label>Équipements à installer</label>
                  <select
                    name="equipment"
                    value={formData.equipment}
                    onChange={handleChange}
                    required
                  >
                    <option value="">Sélectionnez un équipement</option>
                    {equipment.map(item => (
                      <option key={item.id} value={item.name}>
                        {item.name}
                      </option>
                    ))}
                  </select>
                </div>

                <div className="form-group">
                  <label>Montant à collecter ($ CAD)</label>
                  <div className="amount-input">
                    <span className="currency">$</span>
                    <input
                      type="number"
                      name="amount"
                      value={formData.amount}
                      onChange={handleChange}
                      required
                      step="0.01"
                      min="0"
                      placeholder="0.00"
                    />
                  </div>
                </div>
              </div>

              <div className="form-row-grid technicians-grid">
                <div className="form-group">
                  <label>Technicien principal</label>
                  <select
                    name="technician1_id"
                    value={formData.technician1_id}
                    onChange={handleChange}
                    required
                  >
                    <option value="">Sélectionnez le technicien</option>
                    {technicians.map(technician => (
                      <option key={technician.id} value={technician.id}>
                        {technician.full_name}
                      </option>
                    ))}
                  </select>
                </div>

                <div className="form-group">
                  <label>Technicien supplémentaire 1</label>
                  <select
                    name="technician2_id"
                    value={formData.technician2_id}
                    onChange={handleChange}
                  >
                    <option value="">Optionnel</option>
                    {technicians.map(technician => (
                      <option key={technician.id} value={technician.id}>
                        {technician.full_name}
                      </option>
                    ))}
                  </select>
                </div>

                <div className="form-group">
                  <label>Technicien supplémentaire 2</label>
                  <select
                    name="technician3_id"
                    value={formData.technician3_id}
                    onChange={handleChange}
                  >
                    <option value="">Optionnel</option>
                    {technicians.map(technician => (
                      <option key={technician.id} value={technician.id}>
                        {technician.full_name}
                      </option>
                    ))}
                  </select>
                </div>

                <div className="form-group">
                  <label>Technicien supplémentaire 3</label>
                  <select
                    name="technician4_id"
                    value={formData.technician4_id}
                    onChange={handleChange}
                  >
                    <option value="">Optionnel</option>
                    {technicians.map(technician => (
                      <option key={technician.id} value={technician.id}>
                        {technician.full_name}
                      </option>
                    ))}
                  </select>
                </div>
              </div>
            </>
          ) : (
            <div className="form-group">
              <label>Employé</label>
              <select
                name="employee_id"
                value={formData.employee_id}
                onChange={handleChange}
                required
              >
                <option value="">Sélectionnez un employé</option>
                {employees.map(employee => (
                  <option key={employee.id} value={employee.id}>
                    {employee.full_name}
                  </option>
                ))}
              </select>
            </div>
          )}

          <div className="modal-footer">
            <button type="button" onClick={onClose} className="cancel-button">
              Annuler
            </button>
            <button type="submit" className="submit-button">
              Mettre à jour
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default EditEventModal; 