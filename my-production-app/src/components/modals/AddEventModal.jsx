import React, { useState, useEffect } from 'react';
import { fetchTechnicians } from '../../utils/apiUtils';
import '../../styles/Modal.css';

const AddEventModal = ({ onClose, onSubmit, selectedDate, employees }) => {
  const [formData, setFormData] = useState({
    type: '',
    firstName: '',
    lastName: '',
    installationNumber: 'INS0',
    installationTime: '08:00',
    region_id: '16',
    city: '',
    equipment: '',
    amount: '',
    technician1_id: '',
    technician2_id: '',
    technician3_id: '',
    technician4_id: '',
    employee_id: '',
    startDate: selectedDate,
    endDate: selectedDate
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

  // Charger les équipements
  useEffect(() => {
    const loadEquipment = async () => {
      try {
        const response = await fetch('https://app.vivreenliberte.org/api/equipment.php');
        const data = await response.json();
        setEquipment(data);
      } catch (error) {
        console.error('Erreur lors du chargement des équipements:', error);
      }
    };
    loadEquipment();
  }, []);

  // Effet pour charger les régions et les villes initiales
  useEffect(() => {
    const loadInitialData = async () => {
      try {
        // Charger les régions
        const regionsResponse = await fetch('https://app.vivreenliberte.org/api/regions.php?type=regions');
        const regionsData = await regionsResponse.json();
        setRegions(regionsData);

        // Charger les villes de la Montérégie par défaut
        const citiesResponse = await fetch('https://app.vivreenliberte.org/api/regions.php?region_id=16');
        const citiesData = await citiesResponse.json();
        setCities(citiesData);
      } catch (error) {
        console.error('Erreur lors du chargement des données:', error);
      }
    };

    loadInitialData();
  }, []);

  const handleChange = (e) => {
    const { name, value } = e.target;
    console.log('Changement de champ:', name, value); // Debug
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleRegionChange = async (e) => {
    const regionId = e.target.value;
    setFormData(prev => ({
      ...prev,
      region_id: regionId,
      city: ''
    }));

    if (regionId) {
      try {
        const response = await fetch(`https://app.vivreenliberte.org/api/regions.php?region_id=${regionId}`);
        const data = await response.json();
        setCities(data);
      } catch (error) {
        console.error('Erreur lors du chargement des villes:', error);
      }
    } else {
      setCities([]);
    }
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
    console.log('Données du formulaire avant soumission:', formData); // Debug
    
    const submissionData = {
      ...formData
    };

    if (formData.type === 'vacances') {
      console.log('Préparation des données de vacances'); // Debug
      submissionData.type = 'vacances';  // Forcer explicitement le type
      submissionData.employee_id = formData.employee_id;
      submissionData.startDate = formData.startDate;
      submissionData.endDate = formData.endDate;
    }

    console.log('Données soumises:', submissionData); // Debug
    onSubmit(submissionData);
  };

  return (
    <div className="modal-overlay">
      <div className={`modal-content ${formData.type === 'installation' ? 'installation-modal' : ''}`}>
        <div className="modal-header">
          <h2>Ajouter une tâche</h2>
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
              <option value="">Sélectionnez un type</option>
              <option value="installation">Installation</option>
              <option value="conge">Congé</option>
              <option value="maladie">Maladie</option>
              <option value="formation">Formation</option>
              <option value="vacances">Vacances</option>
            </select>
          </div>

          {formData.type === 'vacances' && (
            <>
              <div className="form-group">
                <label>Technicien</label>
                <select
                  name="employee_id"
                  value={formData.employee_id}
                  onChange={handleChange}
                  required
                >
                  <option value="">Sélectionnez un technicien</option>
                  {technicians.map(technician => (
                    <option key={technician.id} value={technician.id}>
                      {`${technician.first_name} ${technician.last_name}`}
                    </option>
                  ))}
                </select>
              </div>
              <div className="form-row-grid">
                <div className="form-group">
                  <label>Date de début</label>
                  <input
                    type="date"
                    name="startDate"
                    value={formData.startDate}
                    onChange={handleChange}
                    required
                  />
                </div>
                <div className="form-group">
                  <label>Date de fin</label>
                  <input
                    type="date"
                    name="endDate"
                    value={formData.endDate}
                    min={formData.startDate}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>
            </>
          )}

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
                    {employees.map(employee => (
                      <option key={employee.id} value={employee.id}>
                        {`${employee.first_name} ${employee.last_name}`}
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
                    {employees.map(employee => (
                      <option key={employee.id} value={employee.id}>
                        {`${employee.first_name} ${employee.last_name}`}
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
                    {employees.map(employee => (
                      <option key={employee.id} value={employee.id}>
                        {`${employee.first_name} ${employee.last_name}`}
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
                    {employees.map(employee => (
                      <option key={employee.id} value={employee.id}>
                        {`${employee.first_name} ${employee.last_name}`}
                      </option>
                    ))}
                  </select>
                </div>
              </div>
            </>
          ) : (formData.type === 'conge' || formData.type === 'maladie' || formData.type === 'formation') && (
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
                    {`${employee.first_name} ${employee.last_name}`}
                  </option>
                ))}
              </select>
            </div>
          )}

          <div className="button-group">
            <button type="button" onClick={onClose} className="close-button">
              Annuler
            </button>
            <button type="submit" className="action-button">
              Ajouter
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default AddEventModal; 