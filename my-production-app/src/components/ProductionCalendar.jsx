import { format } from 'date-fns';
import { fr } from 'date-fns/locale';
import React, { useState, useEffect, useRef } from 'react';
import styled from 'styled-components';
import './ProductionCalendar.css';

// Styled Components
const TopBar = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 60px;
  background: white;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 30px;
  z-index: 1000;
  width: 100%;
`;

const TopBarTitle = styled.h1`
  color: #2c3e50;
  font-size: 1.8rem;
  font-weight: 600;
`;

const TopBarButtons = styled.div`
  display: flex;
  align-items: center;
  gap: 15px;
`;

const ViewToggleButton = styled.button`
  background: #3498db;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.3s ease;
  margin-right: 15px;

  &:hover {
    background: #2980b9;
  }
`;

const CurrentWeekButton = styled.button`
  background: #2ecc71;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.3s ease;

  &:hover {
    background: #27ae60;
  }
`;

const CalendarContainer = styled.div`
  padding-top: 60px;
  height: 100vh;
  width: 100%;
  margin: 0;
  background: #f0f2f5;
  display: flex;
  flex-direction: column;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
`;

const ScrollContainer = styled.div`
  flex: 1;
  overflow-y: scroll;
  overflow-x: hidden;
  background: #f0f2f5;
  scroll-behavior: smooth;
  padding: 20px;
  width: 100%;
  height: calc(100vh - 60px);
  
  &::-webkit-scrollbar {
    width: 10px;
  }
  
  &::-webkit-scrollbar-track {
    background: #f1f1f1;
  }
  
  &::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
  }
  
  &::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
`;

const WeekSection = styled.section`
  margin: 0 0 20px 0;
  padding: 30px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  width: 100%;
  background: white;
  
  &:last-child {
    margin-bottom: 0;
  }

  ${props => props.$isCurrent && `
    background-color: #e8f6e9 !important;
    border-left: 4px solid #27ae60;
  `}

  &[data-is-current="true"] {
    background-color: #e8f6e9 !important;
  }

  &[data-is-current="true"] .day-block {
    background-color: #f2faf3 !important;
  }

  &[data-is-current="true"] h2 {
    color: #2c3e50;
  }
`;

const WeekContainer = styled.div`
  display: grid;
  grid-template-columns: repeat(5, 1fr) 250px;
  gap: 30px;
  width: 100%;
  margin: 0;
  padding: 0;
`;

const DayBlock = styled.div`
  background: #f8f9fa;
  border-radius: 10px;
  padding: 20px;
  min-height: ${props => props.hasEvents ? '150px' : 'auto'};
  height: fit-content;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  gap: 12px;

  &:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }

  h3 {
    font-size: 1.2rem;
    margin-bottom: ${props => props.hasEvents ? '15px' : '0'};
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
    display: flex;
    align-items: center;
  }

  h3 > span {
    display: flex;
    align-items: center;
  }

  &[data-is-current="true"] {
    background-color: #93d7b1 !important;
  }
`;

const AddInlineButton = styled.button`
  background: white;
  border: 1px dashed #bdc3c7;
  border-radius: 4px;
  color: #7f8c8d;
  cursor: pointer;
  font-size: 0.9rem;
  padding: 2px 8px;
  transition: all 0.3s ease;
  margin-left: 4px;
  
  &:hover {
    background: #f7f9fc;
    border-color: #3498db;
    color: #3498db;
  }
`;

const AddButton = styled.button`
  width: 100%;
  padding: 8px;
  background: #ffffff;
  border: 2px dashed #bdc3c7;
  border-radius: 8px;
  cursor: pointer;
  color: #7f8c8d;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  margin-top: auto;
  
  &:hover {
    background: #f7f9fc;
    border-color: #3498db;
    color: #3498db;
  }
`;

const WeekendContainer = styled.div`
  display: flex;
  flex-direction: column;
  gap: 30px;
  width: 100%;
`;

const WeekendButton = styled.button`
  background: #ffffff;
  border: 2px dashed #e9ecef;
  border-radius: 10px;
  padding: 15px;
  height: 60px;
  cursor: pointer;
  transition: all 0.2s ease;
  font-size: 1.1rem;
  color: #7f8c8d;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  
  &:hover {
    background: #f8f9fa;
    border-color: #2ecc71;
    color: #2ecc71;
  }
`;

// Composant Modal d'ajout d'événement
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
    employeeId: ''
  });

  const [regions, setRegions] = useState([]);
  const [cities, setCities] = useState([]);
  const [equipment, setEquipment] = useState([]);
  const [showEquipmentModal, setShowEquipmentModal] = useState(false);
  const [selectedEquipment, setSelectedEquipment] = useState(null);

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

  const handleEquipmentChange = (e) => {
    const value = e.target.value;
    if (value === 'add') {
      setShowEquipmentModal(true);
    } else if (value === 'manage') {
      setShowEquipmentModal(true);
      setSelectedEquipment(null);
    } else {
      setFormData(prev => ({
        ...prev,
        equipment: value
      }));
    }
  };

  const handleAddEquipment = async (name) => {
    try {
      const response = await fetch('https://app.vivreenliberte.org/api/equipment.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name })
      });
      
      if (!response.ok) throw new Error('Erreur lors de l\'ajout');
      
      // Recharger la liste des équipements
      const equipmentResponse = await fetch('https://app.vivreenliberte.org/api/equipment.php');
      const data = await equipmentResponse.json();
      setEquipment(data);
      setShowEquipmentModal(false);
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  const handleEditEquipment = async (id, name) => {
    try {
      const response = await fetch('https://app.vivreenliberte.org/api/equipment.php', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id, name })
      });
      
      if (!response.ok) throw new Error('Erreur lors de la modification');
      
      // Recharger la liste des équipements
      const equipmentResponse = await fetch('https://app.vivreenliberte.org/api/equipment.php');
      const data = await equipmentResponse.json();
      setEquipment(data);
      setShowEquipmentModal(false);
      setSelectedEquipment(null);
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  const handleDeleteEquipment = async (id) => {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')) return;
    
    try {
      const response = await fetch(`https://app.vivreenliberte.org/api/equipment.php?id=${id}`, {
        method: 'DELETE'
      });
      
      if (!response.ok) throw new Error('Erreur lors de la suppression');
      
      // Recharger la liste des équipements
      const equipmentResponse = await fetch('https://app.vivreenliberte.org/api/equipment.php');
      const data = await equipmentResponse.json();
      setEquipment(data);
      setSelectedEquipment(null);
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  // Effet pour charger les régions et les villes initiales
  useEffect(() => {
    const loadInitialData = async () => {
      try {
        // Charger les régions
        const regionsResponse = await fetch('https://app.vivreenliberte.org/api/regions.php?type=regions');
        const regionsData = await regionsResponse.json();
        console.log('Régions chargées:', regionsData);
        setRegions(regionsData);

        // Si l'événement a une ville mais pas de région, chercher la région correspondante
        if (formData.city && !formData.region_id) {
          // Charger toutes les villes pour trouver la région correspondante
          for (const region of regionsData) {
            const citiesResponse = await fetch(`https://app.vivreenliberte.org/api/regions.php?region_id=${region.id}`);
            const citiesData = await citiesResponse.json();
            const cityFound = citiesData.find(c => c.name.toLowerCase() === formData.city.toLowerCase());
            if (cityFound) {
              console.log('Région trouvée pour la ville:', region.id);
              setFormData(prev => ({
                ...prev,
                region_id: region.id
              }));
              setCities(citiesData);
              break;
            }
          }
        }
        // Si l'événement a une région, charger ses villes
        else if (formData.region_id) {
          console.log('Chargement des villes pour la région:', formData.region_id);
          const citiesResponse = await fetch(`https://app.vivreenliberte.org/api/regions.php?region_id=${formData.region_id}`);
          const citiesData = await citiesResponse.json();
          console.log('Villes chargées:', citiesData);
          setCities(citiesData);
        }
        // Si pas de région définie, charger les villes de la Montérégie par défaut
        else {
          const citiesResponse = await fetch('https://app.vivreenliberte.org/api/regions.php?region_id=16');
          const citiesData = await citiesResponse.json();
          setCities(citiesData);
        }
      } catch (error) {
        console.error('Erreur lors du chargement des données:', error);
      }
    };

    loadInitialData();
  }, [formData]);

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

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
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
    console.log('Données du formulaire avant soumission:', formData);
    onSubmit(formData);
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
            </select>
          </div>

          {formData.type === 'installation' && (
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
                    onChange={handleEquipmentChange}
                    required
                  >
                    <option value="">Sélectionnez un équipement</option>
                    {equipment.map(item => (
                      <option key={item.id} value={item.name}>
                        {item.name}
                      </option>
                    ))}
                    <option value="add">+ Ajouter un nouvel équipement</option>
                    <option value="manage">⚙️ Gérer les équipements</option>
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
          )}

          {(formData.type === 'conge' || formData.type === 'maladie') && (
            <div className="form-group">
              <label>Employé</label>
              <select
                name="employeeId"
                value={formData.employeeId}
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
            <button 
              type="submit" 
              className="action-button"
              disabled={!formData.type}
            >
              Ajouter
            </button>
          </div>
        </form>

        {showEquipmentModal && (
          <div className="modal-overlay">
            <div className="modal-content equipment-modal">
              <div className="modal-header">
                <h3>{selectedEquipment ? 'Modifier l\'équipement' : 'Gérer les équipements'}</h3>
                <button onClick={() => {
                  setShowEquipmentModal(false);
                  setSelectedEquipment(null);
                }} className="close-button">&times;</button>
              </div>
              
              {!selectedEquipment && (
                <div className="equipment-list">
                  {equipment.map(item => (
                    <div key={item.id} className="equipment-item">
                      <span>{item.name}</span>
                      <div className="equipment-actions">
                        <button onClick={() => setSelectedEquipment(item)}>✏️</button>
                        <button onClick={() => handleDeleteEquipment(item.id)}>️</button>
                      </div>
                    </div>
                  ))}
                  <button 
                    className="add-equipment-button"
                    onClick={() => setSelectedEquipment({ id: null, name: '' })}
                  >
                    + Ajouter un équipement
                  </button>
                </div>
              )}
              
              {selectedEquipment && (
                <form onSubmit={(e) => {
                  e.preventDefault();
                  if (selectedEquipment.id) {
                    handleEditEquipment(selectedEquipment.id, selectedEquipment.name);
                  } else {
                    handleAddEquipment(selectedEquipment.name);
                  }
                }}>
                  <div className="form-group">
                    <label>Nom de l'équipement</label>
                    <input
                      type="text"
                      value={selectedEquipment.name}
                      onChange={(e) => setSelectedEquipment(prev => ({
                        ...prev,
                        name: e.target.value
                      }))}
                      required
                    />
                  </div>
                  <div className="button-group">
                    <button type="button" onClick={() => setSelectedEquipment(null)}>
                      Annuler
                    </button>
                    <button type="submit">
                      {selectedEquipment.id ? 'Modifier' : 'Ajouter'}
                    </button>
                  </div>
                </form>
              )}
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

// Composant Modal de détails d'événement
const EventDetailsModal = ({ event, onClose, onDelete, onEdit }) => {
  return (
    <div className="modal-overlay">
      <div className="modal-content">
        <div className="modal-header">
          <h2>
            {event.type === 'conge' ? 'Détails du congé' : 
             event.type === 'maladie' ? 'Détails de l\'arrêt maladie' : 
             'Détails de l\'installation'}
          </h2>
          <button onClick={onClose} className="close-button">&times;</button>
        </div>
        <div className="modal-body">
          {event.type === 'installation' ? (
            <div className="installation-details">
              <strong>Installation</strong>
              <div className="time">{event.installation_time}</div>
              <div className="client">
                {event.first_name} {event.last_name}
              </div>
              <div className="installation-number">N° {event.installation_number}</div>
              <div className="location">
                {event.city}
                {event.region_name && ` (${event.region_name})`}
              </div>
              <div className="equipment">{event.equipment}</div>
              <div className="amount">Montant : {event.amount ? `${event.amount} $ CAD` : '0.00 $ CAD'}</div>
              <div className="technicians">
                {[
                  event.technician1_name,
                  event.technician2_name,
                  event.technician3_name,
                  event.technician4_name
                ]
                  .filter(Boolean)
                  .join(', ')}
              </div>
            </div>
          ) : (
            <>
              <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
              <div>{event.employee_name}</div>
            </>
          )}
          <p><strong>Date :</strong> {format(new Date(event.date), 'dd/MM/yyyy')}</p>
        </div>
        <div className="modal-footer">
          <button onClick={onClose} className="close-button">Fermer</button>
          <button onClick={onEdit} className="edit-button">Modifier</button>
          <button onClick={() => onDelete(event.id)} className="delete-button">
            Supprimer
          </button>
        </div>
      </div>
    </div>
  );
};

// Composant Modal de modification d'événement
const EditEventModal = ({ event, onClose, onSubmit, employees }) => {
  console.log('Données de l\'événement à éditer:', event);

  const [regions, setRegions] = useState([]);
  const [cities, setCities] = useState([]);
  const [equipment, setEquipment] = useState([]);
  const [showEquipmentModal, setShowEquipmentModal] = useState(false);
  const [selectedEquipment, setSelectedEquipment] = useState(null);
  const [formData, setFormData] = useState({
    type: event.type || '',
    firstName: event.first_name || '',
    lastName: event.last_name || '',
    installationNumber: event.installation_number || 'INS0',
    installationTime: event.installation_time || '08:00',
    region_id: event.region_id || '16',
    city: event.city || '',
    equipment: event.equipment || '',
    amount: event.amount || '',
    technician1_id: event.technician1_id || '',
    technician2_id: event.technician2_id || '',
    technician3_id: event.technician3_id || '',
    technician4_id: event.technician4_id || '',
    employeeId: event.employee_id || ''
  });

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

  const handleEquipmentChange = (e) => {
    const value = e.target.value;
    if (value === 'add') {
      setShowEquipmentModal(true);
    } else if (value === 'manage') {
      setShowEquipmentModal(true);
      setSelectedEquipment(null);
    } else {
      setFormData(prev => ({
        ...prev,
        equipment: value
      }));
    }
  };

  const handleAddEquipment = async (name) => {
    try {
      const response = await fetch('https://app.vivreenliberte.org/api/equipment.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name })
      });
      
      if (!response.ok) throw new Error('Erreur lors de l\'ajout');
      
      // Recharger la liste des équipements
      const equipmentResponse = await fetch('https://app.vivreenliberte.org/api/equipment.php');
      const data = await equipmentResponse.json();
      setEquipment(data);
      setShowEquipmentModal(false);
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  const handleEditEquipment = async (id, name) => {
    try {
      const response = await fetch('https://app.vivreenliberte.org/api/equipment.php', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id, name })
      });
      
      if (!response.ok) throw new Error('Erreur lors de la modification');
      
      // Recharger la liste des équipements
      const equipmentResponse = await fetch('https://app.vivreenliberte.org/api/equipment.php');
      const data = await equipmentResponse.json();
      setEquipment(data);
      setShowEquipmentModal(false);
      setSelectedEquipment(null);
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  const handleDeleteEquipment = async (id) => {
    if (!confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')) return;
    
    try {
      const response = await fetch(`https://app.vivreenliberte.org/api/equipment.php?id=${id}`, {
        method: 'DELETE'
      });
      
      if (!response.ok) throw new Error('Erreur lors de la suppression');
      
      // Recharger la liste des équipements
      const equipmentResponse = await fetch('https://app.vivreenliberte.org/api/equipment.php');
      const data = await equipmentResponse.json();
      setEquipment(data);
      setSelectedEquipment(null);
    } catch (error) {
      console.error('Erreur:', error);
    }
  };

  // Effet pour charger les régions et les villes initiales
  useEffect(() => {
    const loadInitialData = async () => {
      try {
        // Charger les régions
        const regionsResponse = await fetch('https://app.vivreenliberte.org/api/regions.php?type=regions');
        const regionsData = await regionsResponse.json();
        console.log('Régions chargées:', regionsData);
        setRegions(regionsData);

        // Si l'événement a une ville mais pas de région, chercher la région correspondante
        if (event.city && !event.region_id) {
          // Charger toutes les villes pour trouver la région correspondante
          for (const region of regionsData) {
            const citiesResponse = await fetch(`https://app.vivreenliberte.org/api/regions.php?region_id=${region.id}`);
            const citiesData = await citiesResponse.json();
            const cityFound = citiesData.find(c => c.name.toLowerCase() === event.city.toLowerCase());
            if (cityFound) {
              console.log('Région trouvée pour la ville:', region.id);
              setFormData(prev => ({
                ...prev,
                region_id: region.id
              }));
              setCities(citiesData);
              break;
            }
          }
        }
        // Si l'événement a une région, charger ses villes
        else if (event.region_id) {
          console.log('Chargement des villes pour la région:', event.region_id);
          const citiesResponse = await fetch(`https://app.vivreenliberte.org/api/regions.php?region_id=${event.region_id}`);
          const citiesData = await citiesResponse.json();
          console.log('Villes chargées:', citiesData);
          setCities(citiesData);
        }
        // Si pas de région définie, charger les villes de la Montérégie par défaut
        else {
          const citiesResponse = await fetch('https://app.vivreenliberte.org/api/regions.php?region_id=16');
          const citiesData = await citiesResponse.json();
          setCities(citiesData);
        }
      } catch (error) {
        console.error('Erreur lors du chargement des données:', error);
      }
    };

    loadInitialData();
  }, [event]);

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

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    });
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
    console.log('Données du formulaire avant soumission:', formData);
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
            </select>
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
                    onChange={handleEquipmentChange}
                    required
                  >
                    <option value="">Sélectionnez un équipement</option>
                    {equipment.map(item => (
                      <option key={item.id} value={item.name}>
                        {item.name}
                      </option>
                    ))}
                    <option value="add">+ Ajouter un nouvel équipement</option>
                    <option value="manage">⚙️ Gérer les équipements</option>
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
          ) : (
            <div className="form-group">
              <label>Employé</label>
              <select
                name="employeeId"
                value={formData.employeeId}
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
              Mettre à jour
            </button>
          </div>
        </form>

        {showEquipmentModal && (
          <div className="modal-overlay">
            <div className="modal-content equipment-modal">
              <div className="modal-header">
                <h3>{selectedEquipment ? 'Modifier l\'équipement' : 'Gérer les équipements'}</h3>
                <button onClick={() => {
                  setShowEquipmentModal(false);
                  setSelectedEquipment(null);
                }} className="close-button">&times;</button>
              </div>

              {!selectedEquipment && (
                <div className="equipment-list">
                  {equipment.map(item => (
                    <div key={item.id} className="equipment-item">
                      <span>{item.name}</span>
                      <div className="equipment-actions">
                        <button onClick={() => setSelectedEquipment(item)}>✏️</button>
                        <button onClick={() => handleDeleteEquipment(item.id)}>🗑️</button>
                      </div>
                    </div>
                  ))}
                  <button 
                    className="add-equipment-button"
                    onClick={() => setSelectedEquipment({ id: null, name: '' })}
                  >
                    + Ajouter un équipement
                  </button>
                </div>
              )}
              
              {selectedEquipment && (
                <form onSubmit={(e) => {
                  e.preventDefault();
                  if (selectedEquipment.id) {
                    handleEditEquipment(selectedEquipment.id, selectedEquipment.name);
                  } else {
                    handleAddEquipment(selectedEquipment.name);
                  }
                }}>
                  <div className="form-group">
                    <label>Nom de l'équipement</label>
                    <input
                      type="text"
                      value={selectedEquipment.name}
                      onChange={(e) => setSelectedEquipment(prev => ({
                        ...prev,
                        name: e.target.value
                      }))}
                      required
                    />
                  </div>
                  <div className="button-group">
                    <button type="button" onClick={() => setSelectedEquipment(null)}>
                      Annuler
                    </button>
                    <button type="submit">
                      {selectedEquipment.id ? 'Modifier' : 'Ajouter'}
                    </button>
                  </div>
                </form>
              )}
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

const BlockView = () => {
  const weeks = [];
  const startDate = new Date(currentDate);
  startDate.setDate(startDate.getDate() - 14);

  for (let i = 0; i < 5; i++) {
    const weekStart = new Date(startDate);
    weekStart.setDate(weekStart.getDate() + (i * 7));
    weeks.push(getWeekDates(weekStart));
  }

  return (
    <div className="block-view">
      {weeks.map((weekDays, weekIndex) => {
        const start = weekDays[0];
        const end = new Date(start);
        end.setDate(end.getDate() + 4);
        const weekKey = format(start, 'yyyy-MM-dd');
        const isCurrent = isCurrentWeek(start);

        // Calculer les dates du weekend
        const saturday = new Date(weekDays[weekDays.length - 1]);
        saturday.setDate(saturday.getDate() + 1);
        const sunday = new Date(saturday);
        sunday.setDate(sunday.getDate() + 1);

        // Vérifier s'il y a des événements pour le weekend
        const saturdayEvents = getEventsForDay(saturday, events);
        const sundayEvents = getEventsForDay(sunday, events);

        return (
          <WeekSection 
            key={weekKey} 
            data-is-current={isCurrent}
            $isCurrent={isCurrent}
          >
            <div className="week-header">
              <div className="week-title">
                <h2>
                  Semaine du {format(start, 'dd MMMM', { locale: fr })} au {format(end, 'dd MMMM yyyy', { locale: fr })}
                  <button 
                    className="weekend-button-small"
                    onClick={() => handleDateClick(saturday)}
                  >
                    S
                  </button>
                  <button 
                    className="weekend-button-small"
                    onClick={() => handleDateClick(sunday)}
                  >
                    D
                  </button>
                </h2>
              </div>
            </div>

            <WeekContainer>
              {weekDays.map((day, dayIndex) => {
                const dateStr = format(day, 'yyyy-MM-dd');
                const dayEvents = events[dateStr] || [];
                
                return (
                  <DayBlock 
                    key={dayIndex}
                    data-is-current={isCurrentDay(day)}
                    hasEvents={dayEvents.length > 0}
                  >
                    <h3>
                      <span>
                        {formatDayHeader(day)}
                        <AddInlineButton onClick={() => handleDateClick(day)}>+</AddInlineButton>
                      </span>
                    </h3>
                    {dayEvents.map((event, eventIndex) => (
                      <div
                        key={eventIndex}
                        onClick={() => handleEventClick(event)}
                        style={{ 
                          cursor: 'pointer',
                          padding: '8px',
                          margin: '4px 0',
                          background: event.type === 'installation' ? '#e3f2fd' : 
                                     event.type === 'maladie' ? '#ffebee' : '#e8f5e9',
                          borderRadius: '4px',
                          border: '1px solid ' + (
                            event.type === 'installation' ? '#bbdefb' : 
                            event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9'
                          )
                        }}
                      >
                        {event.type === 'installation' ? (
                          <div className="installation-details">
                            <strong>Installation</strong>
                            <div className="time">{event.installation_time || ''}</div>
                            <div className="client">
                              {event.first_name} {event.last_name}
                            </div>
                            <div className="installation-number">
                              N° {event.installation_number || ''}
                            </div>
                            <div className="location">
                              {event.city}
                              {event.region_name && ` (${event.region_name})`}
                            </div>
                            <div className="equipment">{event.equipment}</div>
                            <div className="amount">Montant : {event.amount ? `${event.amount} $ CAD` : '0.00 $ CAD'}</div>
                            <div className="technicians">
                              {[
                                event.technician1_name,
                                event.technician2_name,
                                event.technician3_name,
                                event.technician4_name
                              ]
                                .filter(Boolean)
                                .join(', ') || 'Aucun technicien assigné'}
                            </div>
                          </div>
                        ) : (
                          <>
                            <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
                            <div>{event.employee_name}</div>
                          </>
                        )}
                      </div>
                    ))}
                  </DayBlock>
                );
              })}

              {/* Afficher les jours du weekend seulement s'ils ont des événements */}
              {saturdayEvents.length > 0 && (
                <DayBlock hasEvents={true}>
                  <h3>
                    {format(saturday, 'EEEE dd', { locale: fr })}
                  </h3>
                  {saturdayEvents.map((event, eventIndex) => (
                    <div
                      key={eventIndex}
                      onClick={() => handleEventClick(event)}
                      style={{ 
                        cursor: 'pointer',
                        padding: '8px',
                        margin: '4px 0',
                        background: event.type === 'installation' ? '#e3f2fd' : 
                                   event.type === 'maladie' ? '#ffebee' : '#e8f5e9',
                        borderRadius: '4px',
                        border: '1px solid ' + (
                          event.type === 'installation' ? '#bbdefb' : 
                          event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9'
                        )
                      }}
                    >
                      {event.type === 'installation' ? (
                        <div className="installation-details">
                          <strong>Installation</strong>
                          <div className="time">{event.installation_time || ''}</div>
                          <div className="client">
                            {event.first_name} {event.last_name}
                          </div>
                          <div className="installation-number">
                            N° {event.installation_number || ''}
                          </div>
                          <div className="location">
                            {event.city}
                            {event.region_name && ` (${event.region_name})`}
                          </div>
                          <div className="equipment">{event.equipment}</div>
                          <div className="amount">Montant : {event.amount ? `${event.amount} $ CAD` : '0.00 $ CAD'}</div>
                          <div className="technicians">
                            {[
                              event.technician1_name,
                              event.technician2_name,
                              event.technician3_name,
                              event.technician4_name
                            ]
                              .filter(Boolean)
                              .join(', ') || 'Aucun technicien assigné'}
                          </div>
                        </div>
                      ) : (
                        <>
                          <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
                          <div>{event.employee_name}</div>
                        </>
                      )}
                    </div>
                  ))}
                </DayBlock>
              )}

              {sundayEvents.length > 0 && (
                <DayBlock hasEvents={true}>
                  <h3>
                    {format(sunday, 'EEEE dd', { locale: fr })}
                  </h3>
                  {sundayEvents.map((event, eventIndex) => (
                    <div
                      key={eventIndex}
                      onClick={() => handleEventClick(event)}
                      style={{ 
                        cursor: 'pointer',
                        padding: '8px',
                        margin: '4px 0',
                        background: event.type === 'installation' ? '#e3f2fd' : 
                                   event.type === 'maladie' ? '#ffebee' : '#e8f5e9',
                        borderRadius: '4px',
                        border: '1px solid ' + (
                          event.type === 'installation' ? '#bbdefb' : 
                          event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9'
                        )
                      }}
                    >
                      {event.type === 'installation' ? (
                        <div className="installation-details">
                          <strong>Installation</strong>
                          <div className="time">{event.installation_time || ''}</div>
                          <div className="client">
                            {event.first_name} {event.last_name}
                          </div>
                          <div className="installation-number">
                            N° {event.installation_number || ''}
                          </div>
                          <div className="location">
                            {event.city}
                            {event.region_name && ` (${event.region_name})`}
                          </div>
                          <div className="equipment">{event.equipment}</div>
                          <div className="amount">Montant : {event.amount ? `${event.amount} $ CAD` : '0.00 $ CAD'}</div>
                          <div className="technicians">
                            {[
                              event.technician1_name,
                              event.technician2_name,
                              event.technician3_name,
                              event.technician4_name
                            ]
                              .filter(Boolean)
                              .join(', ') || 'Aucun technicien assigné'}
                          </div>
                        </div>
                      ) : (
                        <>
                          <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
                          <div>{event.employee_name}</div>
                        </>
                      )}
                    </div>
                  ))}
                </DayBlock>
              )}
            </WeekContainer>
          </WeekSection>
        );
      })}
    </div>
  );
};

const ProductionCalendar = () => {
  const [currentDate, setCurrentDate] = useState(new Date());
  const [events, setEvents] = useState({});
  const [showAddEventModal, setShowAddEventModal] = useState(false);
  const [showEventDetailsModal, setShowEventDetailsModal] = useState(false);
  const [showEditEventModal, setShowEditEventModal] = useState(false);
  const [selectedDate, setSelectedDate] = useState(null);
  const [selectedEvent, setSelectedEvent] = useState(null);
  const [error, setError] = useState('');
  const [employees, setEmployees] = useState([]);
  const [viewMode, setViewMode] = useState('calendar');
  const scrollRef = useRef(null);

  useEffect(() => {
    loadEvents();
    loadEmployees();
  }, []);

  // Effet pour scroller à la semaine courante après le chargement initial
  useEffect(() => {
    const timer = setTimeout(() => handleGoToCurrentWeek(), 300);
    return () => clearTimeout(timer);
  }, []);

  // Effet pour scroller à la semaine courante lors du changement de mode
  useEffect(() => {
    const timer = setTimeout(() => handleGoToCurrentWeek(), 300);
    return () => clearTimeout(timer);
  }, [viewMode]);

  const loadEvents = async () => {
    try {
      const response = await fetch('https://app.vivreenliberte.org/api/events.php');
      const text = await response.text();
      console.log('Réponse brute du chargement:', text);
      
      const data = JSON.parse(text);
      console.log('Données du chargement parsées:', data);

      // Grouper les événements par date
      const groupedEvents = data.reduce((acc, event) => {
        console.log('Traitement événement:', event);
        
        if (!acc[event.date]) {
          acc[event.date] = [];
        }
        
        // S'assurer que tous les champs sont présents
        const processedEvent = {
          ...event,
          installation_number: event.installation_number || '',
          technician1_name: event.technician1_name || '',
          technician2_name: event.technician2_name || '',
          technician3_name: event.technician3_name || '',
          technician4_name: event.technician4_name || ''
        };
        
        acc[event.date].push(processedEvent);
        return acc;
      }, {});

      console.log('Événements groupés finaux:', groupedEvents);
      setEvents(groupedEvents);
    } catch (error) {
      console.error('Erreur lors du chargement:', error);
      setError(error.message);
    }
  };

  const loadEmployees = async () => {
    try {
      const response = await fetch('https://app.vivreenliberte.org/api/employees.php');
      const data = await response.json();
      setEmployees(data);
    } catch (error) {
      console.error('Erreur lors du chargement des employés:', error);
      setError(error.message);
    }
  };

  const handleDateClick = (date) => {
    setSelectedDate(date);
    setShowAddEventModal(true);
  };

  const handleEventClick = (event) => {
    console.log('Clic sur l\'événement:', event);
    setSelectedEvent(event);
    setShowEventDetailsModal(true);
  };

  const handleDeleteEvent = async (eventId) => {
    try {
      console.log('Suppression de l\'événement:', eventId);
      const response = await fetch(`https://app.vivreenliberte.org/api/events.php?id=${eventId}`, {
        method: 'DELETE',
        headers: {
          'Accept': 'application/json'
        }
      });

      console.log('Statut de la réponse:', response.status);
      const text = await response.text();
      console.log('Rponse de la suppression:', text);

      if (!response.ok) {
        throw new Error(`Erreur HTTP: ${response.status}`);
      }

      // Fermer le modal de détails
      setShowEventDetailsModal(false);
      setSelectedEvent(null);

      // Recharger les événements
      await loadEvents();

    } catch (error) {
      console.error('Erreur lors de la suppression:', error);
      setError(error.message);
    }
  };

  const handleAddEventSubmit = async (formData) => {
    try {
      console.log('FormData reçu:', formData);

      const eventData = {
        type: formData.type,
        date: formatDateForAPI(selectedDate),
        first_name: formData.firstName,
        last_name: formData.lastName,
        installation_number: formData.installationNumber,
        installation_time: formData.installationTime,
        city: formData.city,
        equipment: formData.equipment,
        amount: formData.amount,
        technician1_id: formData.technician1_id || null,
        technician2_id: formData.technician2_id || null,
        technician3_id: formData.technician3_id || null,
        technician4_id: formData.technician4_id || null,
        employee_id: formData.type === 'installation' ? null : formData.employeeId
      };

      console.log('Données envoyées à l\'API:', eventData);

      const response = await fetch('https://app.vivreenliberte.org/api/events.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(eventData)
      });

      const text = await response.text();
      console.log('Réponse brute de l\'API:', text);

      try {
        const jsonResponse = JSON.parse(text);
        console.log('Réponse parsée de l\'API:', jsonResponse);
      } catch (e) {
        console.log('La réponse n\'est pas du JSON valide');
      }

      if (!response.ok) {
        throw new Error(`Erreur HTTP: ${response.status}`);
      }

      setShowAddEventModal(false);
      setSelectedDate(null);
      await loadEvents();

    } catch (error) {
      console.error('Erreur lors de l\'ajout:', error);
      setError(error.message);
    }
  };

  // Fonction pour générer les dates d'une semaine
  const getWeekDates = (baseDate) => {
    const start = new Date(baseDate);
    start.setDate(start.getDate() - start.getDay() + 1); // Lundi
    const dates = Array(5).fill().map((_, i) => {
      const date = new Date(start);
      date.setDate(date.getDate() + i);
      return date;
    });
    return dates;
  };

  // Fonction pour vérifier si c'est la semaine courante
  const isCurrentWeek = (date) => {
    const today = new Date();
    const start = new Date(date);
    start.setHours(0, 0, 0,0);
    const end = new Date(date);
    end.setDate(end.getDate() + 4);
    end.setHours(23, 59, 59, 999);
    
    return today >= start && today <= end;
  };

  // Fonction pour vérifier si c'est le jour courant
  const isCurrentDay = (date) => {
    const today = new Date();
    return (
      date.getDate() === today.getDate() &&
      date.getMonth() === today.getMonth() &&
      date.getFullYear() === today.getFullYear()
    );
  };

  // Calcul des semaines à afficher
  const weeks = [];
  const startDate = new Date(currentDate);
  startDate.setDate(startDate.getDate() - 14); // 2 semaines avant

  for (let i = 0; i < 5; i++) { // 5 semaines au total
    const weekStart = new Date(startDate);
    weekStart.setDate(weekStart.getDate() + (i * 7));
    weeks.push(getWeekDates(weekStart));
  }

  // Fonction pour aller à la semaine précédente
  const handlePrevWeek = () => {
    setCurrentDate(prevDate => {
      const newDate = new Date(prevDate);
      newDate.setDate(newDate.getDate() - 7);
      return newDate;
    });
  };

  // Fonction pour aller à la semaine suivante
  const handleNextWeek = () => {
    setCurrentDate(prevDate => {
      const newDate = new Date(prevDate);
      newDate.setDate(newDate.getDate() + 7);
      return newDate;
    });
  };

  // Fonction pour aller à la semaine courante
  const handleGoToCurrentWeek = () => {
    setCurrentDate(new Date());
    
    setTimeout(() => {
      if (viewMode === 'list') {
        const listContainer = document.querySelector('.list-view');
        if (!listContainer) return;

        const weekElements = listContainer.querySelectorAll('.week-section');
        const today = new Date();
        
        for (let i = 0; i < weekElements.length; i++) {
          const weekElement = weekElements[i];
          if (weekElement.dataset.isCurrent === 'true') {
            const headerHeight = 60;
            const elementTop = weekElement.offsetTop;
            
            listContainer.scrollTo({
              top: elementTop - headerHeight - 20,
              behavior: 'smooth'
            });
            break;
          }
        }
      } else {
        const scrollContainer = scrollRef.current;
        if (!scrollContainer) return;

        const currentWeekElement = scrollContainer.querySelector('[data-is-current="true"]');
        if (currentWeekElement) {
          const headerHeight = 60;
          const elementTop = currentWeekElement.offsetTop;
          
          scrollContainer.scrollTo({
            top: elementTop - headerHeight - 20,
            behavior: 'smooth'
          });
        }
      }
    }, 100);
  };

  // Fonction pour formater la date en français
  const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
  };

  // Fonction pour formater la date pour l'API
  const formatDateForAPI = (date) => {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  };

  // Fonction pour obtenir les événements d'un jour donné
  const getEventsForDay = (date, allEvents) => {
    const dateStr = formatDateForAPI(date);
    return allEvents[dateStr] || [];
  };

  // Composant pour la vue liste
  const ListView = () => {
    const listViewRef = useRef(null);
    const weeks = [];
    const startDate = new Date(currentDate);
    startDate.setDate(startDate.getDate() - 14);

    for (let i = 0; i < 5; i++) {
      const weekStart = new Date(startDate);
      weekStart.setDate(weekStart.getDate() + (i * 7));
      weeks.push(getWeekDates(weekStart));
    }

    return (
      <div className="list-view" ref={listViewRef}>
        {weeks.map((weekDays, weekIndex) => {
          const start = weekDays[0];
          const end = new Date(start);
          end.setDate(end.getDate() + 4);
          const weekKey = format(start, 'yyyy-MM-dd');
          const isCurrent = isCurrentWeek(start);

          // Calculer les dates du weekend
          const saturday = new Date(weekDays[weekDays.length - 1]);
          saturday.setDate(saturday.getDate() + 1);
          const sunday = new Date(saturday);
          sunday.setDate(sunday.getDate() + 1);

          // Vérifier s'il y a des événements pour le weekend
          const saturdayEvents = getEventsForDay(saturday, events);
          const sundayEvents = getEventsForDay(sunday, events);
          
          return (
            <div 
              key={weekKey} 
              className={`week-section ${isCurrent ? 'current-week' : ''}`}
              data-week={weekKey}
              data-is-current={isCurrent}
            >
              <div className="week-header">
                <h2>
                  Semaine du {format(start, 'dd MMMM', { locale: fr })} au {format(end, 'dd MMMM yyyy', { locale: fr })}
                  <button 
                    className="weekend-button-small"
                    onClick={() => handleDateClick(saturday)}
                  >
                    S
                  </button>
                  <button 
                    className="weekend-button-small"
                    onClick={() => handleDateClick(sunday)}
                  >
                    D
                  </button>
                </h2>
              </div>
              
              {weekDays.map((currentDate, dayIndex) => {
                const dateStr = format(currentDate, 'yyyy-MM-dd');
                const dayEvents = events[dateStr] || [];
                
                return (
                  <div key={dateStr} className={`day-section ${isCurrentDay(currentDate) ? 'current-day' : ''}`}>
                    <div className="day-header-container">
                      <div className="date-group">
                        <h3 className="day-header">
                          {format(currentDate, 'EEEE dd MMMM', { locale: fr })}
                          <AddInlineButton onClick={() => handleDateClick(currentDate)}>+</AddInlineButton>
                        </h3>
                      </div>
                    </div>
                    
                    {dayEvents.length > 0 && (
                      <table>
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Détails</th>
                          </tr>
                        </thead>
                        <tbody>
                          {dayEvents.map((event, eventIndex) => {
                            const backgroundColor = event.type === 'installation' ? '#e3f2fd' : 
                                                     event.type === 'maladie' ? '#ffebee' : '#e8f5e9';
                            const borderColor = event.type === 'installation' ? '#bbdefb' : 
                                           event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9';
                            
                            return (
                              <tr 
                                key={eventIndex}
                                onClick={() => handleEventClick(event)}
                                style={{ 
                                  cursor: 'pointer',
                                  backgroundColor: backgroundColor,
                                  borderLeft: `4px solid ${borderColor}`
                                }}
                                className="event-row"
                              >
                                <td>
                                  {event.type === 'conge' ? 'Congé' : 
                                   event.type === 'maladie' ? 'Maladie' : 
                                   'Installation'}
                                </td>
                                <td>
                                  {event.type === 'installation' ? (
                                    <span>
                                      {event.first_name} {event.last_name} - {event.installation_number}
                                    </span>
                                  ) : (
                                    <span>{event.employee_name}</span>
                                  )}
                                </td>
                              </tr>
                            );
                          })}
                        </tbody>
                      </table>
                    )}
                  </div>
                );
              })}

              {/* Afficher les jours du weekend seulement s'ils ont des événements */}
              {saturdayEvents.length > 0 && (
                <div className="day-section">
                  <div className="day-header-container">
                    <div className="date-group">
                      <h3 className="day-header">
                        {format(saturday, 'EEEE dd MMMM', { locale: fr })}
                      </h3>
                    </div>
                  </div>
                  <table>
                    <thead>
                      <tr>
                        <th>Type</th>
                        <th>Détails</th>
                      </tr>
                    </thead>
                    <tbody>
                      {saturdayEvents.map((event, eventIndex) => {
                        const backgroundColor = event.type === 'installation' ? '#e3f2fd' : 
                                               event.type === 'maladie' ? '#ffebee' : '#e8f5e9';
                        const borderColor = event.type === 'installation' ? '#bbdefb' : 
                                       event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9';
                        
                        return (
                          <tr 
                            key={eventIndex}
                            onClick={() => handleEventClick(event)}
                            style={{ 
                              cursor: 'pointer',
                              backgroundColor: backgroundColor,
                              borderLeft: `4px solid ${borderColor}`
                            }}
                            className="event-row"
                          >
                            <td>
                              {event.type === 'conge' ? 'Congé' : 
                               event.type === 'maladie' ? 'Maladie' : 
                               'Installation'}
                            </td>
                            <td>
                              {event.type === 'installation' ? (
                                <span>
                                  {event.first_name} {event.last_name} - {event.installation_number}
                                </span>
                              ) : (
                                <span>{event.employee_name}</span>
                              )}
                            </td>
                          </tr>
                        );
                      })}
                    </tbody>
                  </table>
                </div>
              )}

              {sundayEvents.length > 0 && (
                <div className="day-section">
                  <div className="day-header-container">
                    <div className="date-group">
                      <h3 className="day-header">
                        {format(sunday, 'EEEE dd MMMM', { locale: fr })}
                      </h3>
                    </div>
                  </div>
                  <table>
                    <thead>
                      <tr>
                        <th>Type</th>
                        <th>Détails</th>
                      </tr>
                    </thead>
                    <tbody>
                      {sundayEvents.map((event, eventIndex) => {
                        const backgroundColor = event.type === 'installation' ? '#e3f2fd' : 
                                               event.type === 'maladie' ? '#ffebee' : '#e8f5e9';
                        const borderColor = event.type === 'installation' ? '#bbdefb' : 
                                       event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9';
                        
                        return (
                          <tr 
                            key={eventIndex}
                            onClick={() => handleEventClick(event)}
                            style={{ 
                              cursor: 'pointer',
                              backgroundColor: backgroundColor,
                              borderLeft: `4px solid ${borderColor}`
                            }}
                            className="event-row"
                          >
                            <td>
                              {event.type === 'conge' ? 'Congé' : 
                               event.type === 'maladie' ? 'Maladie' : 
                               'Installation'}
                            </td>
                            <td>
                              {event.type === 'installation' ? (
                                <span>
                                  {event.first_name} {event.last_name} - {event.installation_number}
                                </span>
                              ) : (
                                <span>{event.employee_name}</span>
                              )}
                            </td>
                          </tr>
                        );
                      })}
                    </tbody>
                  </table>
                </div>
              )}
            </div>
          );
        })}
      </div>
    );
  };

  // Fonction pour formater l'en-tête de la semaine
  const formatWeekHeader = (date) => {
    const start = new Date(date);
    const end = new Date(date);
    end.setDate(end.getDate() + 4);
    
    const startStr = format(start, 'dd MMMM', { locale: fr });
    const endStr = format(end, 'dd MMMM yyyy', { locale: fr });
    
    return `Semaine du ${startStr} au ${endStr}`;
  };

  // Fonction pour formater l'en-tête du jour
  const formatDayHeader = (date) => {
    return format(date, 'EEEE dd', { locale: fr });
  };

  // Fonction pour modifier un événement
  const handleEditEventSubmit = async (formData) => {
    try {
      console.log('Données reçues pour la modification:', formData);

      const eventData = {
        id: selectedEvent.id,
        type: formData.type,
        date: selectedEvent.date,
        first_name: formData.firstName,
        last_name: formData.lastName,
        installation_number: formData.installationNumber,
        installation_time: formData.installationTime,
        city: formData.city,
        equipment: formData.equipment,
        amount: formData.amount,
        technician1_id: formData.technician1_id || null,
        technician2_id: formData.technician2_id || null,
        technician3_id: formData.technician3_id || null,
        technician4_id: formData.technician4_id || null,
        employee_id: formData.type === 'installation' ? null : formData.employeeId
      };

      console.log('Données envoyées à l\'API pour modification:', eventData);

      const response = await fetch('https://app.vivreenliberte.org/api/events.php', {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(eventData)
      });

      const text = await response.text();
      console.log('Réponse de l\'API pour la modification:', text);

      if (!response.ok) {
        throw new Error(`Erreur HTTP: ${response.status}`);
      }

      setShowEditEventModal(false);
      setSelectedEvent(null);
      await loadEvents();

    } catch (error) {
      console.error('Erreur lors de la modification:', error);
      setError(error.message);
    }
  };

  return (
    <div>
      <TopBar>
        <TopBarTitle>Calendrier de Production</TopBarTitle>
        <TopBarButtons>
          <ViewToggleButton onClick={() => {
            setViewMode(viewMode === 'calendar' ? 'list' : 'calendar');
            setTimeout(() => handleGoToCurrentWeek(), 100);
          }}>
            {viewMode === 'calendar' ? 'Vue Liste' : 'Vue Bloc'}
          </ViewToggleButton>
          <button className="navigation-button" onClick={handlePrevWeek}>
            &lt; Semaine précédente
          </button>
          <CurrentWeekButton onClick={handleGoToCurrentWeek}>
            Semaine Courante
          </CurrentWeekButton>
          <button className="navigation-button" onClick={handleNextWeek}>
            Semaine suivante &gt;
          </button>
        </TopBarButtons>
      </TopBar>

      {viewMode === 'calendar' ? (
        <CalendarContainer>
          <ScrollContainer ref={scrollRef}>
            {weeks.map((weekDays, weekIndex) => {
              const start = weekDays[0];
              const end = new Date(start);
              end.setDate(end.getDate() + 4);
              const isCurrent = isCurrentWeek(weekDays[0]);

              // Calculer les dates du weekend
              const saturday = new Date(weekDays[weekDays.length - 1]);
              saturday.setDate(saturday.getDate() + 1);
              const sunday = new Date(saturday);
              sunday.setDate(sunday.getDate() + 1);

              // Vérifier s'il y a des événements pour le weekend
              const saturdayEvents = getEventsForDay(saturday, events);
              const sundayEvents = getEventsForDay(sunday, events);
              
              return (
                <WeekSection 
                  key={weekDays[0].getTime()}
                  data-is-current={isCurrent}
                  $isCurrent={isCurrent}
                >
                  <div className="week-header">
                    <h2>
                      Semaine du {format(start, 'dd MMMM', { locale: fr })} au {format(end, 'dd MMMM yyyy', { locale: fr })}
                      <button 
                        className="weekend-button-small"
                        onClick={() => handleDateClick(saturday)}
                      >
                        S
                      </button>
                      <button 
                        className="weekend-button-small"
                        onClick={() => handleDateClick(sunday)}
                      >
                        D
                      </button>
                    </h2>
                  </div>

                  <WeekContainer>
                    {weekDays.map((day, dayIndex) => {
                      const dayEvents = getEventsForDay(day, events);
                      
                      return (
                        <DayBlock 
                          key={dayIndex}
                          data-is-current={isCurrentDay(day)}
                          hasEvents={dayEvents.length > 0}
                        >
                          <h3>
                            <span>
                              {formatDayHeader(day)}
                              <AddInlineButton onClick={() => handleDateClick(day)}>+</AddInlineButton>
                            </span>
                          </h3>
                          {dayEvents.map((event, eventIndex) => (
                            <div
                              key={eventIndex}
                              onClick={() => handleEventClick(event)}
                              style={{ 
                                cursor: 'pointer',
                                padding: '8px',
                                margin: '4px 0',
                                background: event.type === 'installation' ? '#e3f2fd' : 
                                           event.type === 'maladie' ? '#ffebee' : '#e8f5e9',
                                borderRadius: '4px',
                                border: '1px solid ' + (
                                  event.type === 'installation' ? '#bbdefb' : 
                                  event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9'
                                )
                              }}
                            >
                              {event.type === 'installation' ? (
                                <div className="installation-details">
                                  <strong>Installation</strong>
                                  <div className="time">{event.installation_time || ''}</div>
                                  <div className="client">
                                    {event.first_name} {event.last_name}
                                  </div>
                                  <div className="installation-number">
                                    N° {event.installation_number || ''}
                                  </div>
                                  <div className="location">
                                    {event.city}
                                    {event.region_name && ` (${event.region_name})`}
                                  </div>
                                  <div className="equipment">{event.equipment}</div>
                                  <div className="amount">Montant : {event.amount ? `${event.amount} $ CAD` : '0.00 $ CAD'}</div>
                                  <div className="technicians">
                                    {[
                                      event.technician1_name,
                                      event.technician2_name,
                                      event.technician3_name,
                                      event.technician4_name
                                    ]
                                      .filter(Boolean)
                                      .join(', ') || 'Aucun technicien assigné'}
                                  </div>
                                </div>
                              ) : (
                                <>
                                  <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
                                  <div>{event.employee_name}</div>
                                </>
                              )}
                            </div>
                          ))}
                        </DayBlock>
                      );
                    })}

                    {/* Afficher les jours du weekend seulement s'ils ont des événements */}
                    {saturdayEvents.length > 0 && (
                      <DayBlock hasEvents={true}>
                        <h3>
                          {format(saturday, 'EEEE dd', { locale: fr })}
                        </h3>
                        {saturdayEvents.map((event, eventIndex) => (
                          <div
                            key={eventIndex}
                            onClick={() => handleEventClick(event)}
                            style={{ 
                              cursor: 'pointer',
                              padding: '8px',
                              margin: '4px 0',
                              background: event.type === 'installation' ? '#e3f2fd' : 
                                         event.type === 'maladie' ? '#ffebee' : '#e8f5e9',
                              borderRadius: '4px',
                              border: '1px solid ' + (
                                event.type === 'installation' ? '#bbdefb' : 
                                event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9'
                              )
                            }}
                          >
                            {event.type === 'installation' ? (
                              <div className="installation-details">
                                <strong>Installation</strong>
                                <div className="time">{event.installation_time || ''}</div>
                                <div className="client">
                                  {event.first_name} {event.last_name}
                                </div>
                                <div className="installation-number">
                                  N° {event.installation_number || ''}
                                </div>
                                <div className="location">
                                  {event.city}
                                  {event.region_name && ` (${event.region_name})`}
                                </div>
                                <div className="equipment">{event.equipment}</div>
                                <div className="amount">Montant : {event.amount ? `${event.amount} $ CAD` : '0.00 $ CAD'}</div>
                                <div className="technicians">
                                  {[
                                    event.technician1_name,
                                    event.technician2_name,
                                    event.technician3_name,
                                    event.technician4_name
                                  ]
                                    .filter(Boolean)
                                    .join(', ') || 'Aucun technicien assigné'}
                                </div>
                              </div>
                            ) : (
                              <>
                                <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
                                <div>{event.employee_name}</div>
                              </>
                            )}
                          </div>
                        ))}
                      </DayBlock>
                    )}

                    {sundayEvents.length > 0 && (
                      <DayBlock hasEvents={true}>
                        <h3>
                          {format(sunday, 'EEEE dd', { locale: fr })}
                        </h3>
                        {sundayEvents.map((event, eventIndex) => (
                          <div
                            key={eventIndex}
                            onClick={() => handleEventClick(event)}
                            style={{ 
                              cursor: 'pointer',
                              padding: '8px',
                              margin: '4px 0',
                              background: event.type === 'installation' ? '#e3f2fd' : 
                                         event.type === 'maladie' ? '#ffebee' : '#e8f5e9',
                              borderRadius: '4px',
                              border: '1px solid ' + (
                                event.type === 'installation' ? '#bbdefb' : 
                                event.type === 'maladie' ? '#ffcdd2' : '#c8e6c9'
                              )
                            }}
                          >
                            {event.type === 'installation' ? (
                              <div className="installation-details">
                                <strong>Installation</strong>
                                <div className="time">{event.installation_time || ''}</div>
                                <div className="client">
                                  {event.first_name} {event.last_name}
                                </div>
                                <div className="installation-number">
                                  N° {event.installation_number || ''}
                                </div>
                                <div className="location">
                                  {event.city}
                                  {event.region_name && ` (${event.region_name})`}
                                </div>
                                <div className="equipment">{event.equipment}</div>
                                <div className="amount">Montant : {event.amount ? `${event.amount} $ CAD` : '0.00 $ CAD'}</div>
                                <div className="technicians">
                                  {[
                                    event.technician1_name,
                                    event.technician2_name,
                                    event.technician3_name,
                                    event.technician4_name
                                  ]
                                    .filter(Boolean)
                                    .join(', ') || 'Aucun technicien assigné'}
                                </div>
                              </div>
                            ) : (
                              <>
                                <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
                                <div>{event.employee_name}</div>
                              </>
                            )}
                          </div>
                        ))}
                      </DayBlock>
                    )}
                  </WeekContainer>
                </WeekSection>
              );
            })}
          </ScrollContainer>
        </CalendarContainer>
      ) : (
        <ListView />
      )}

      {showAddEventModal && (
        <AddEventModal
          onClose={() => {
            setShowAddEventModal(false);
            setSelectedDate(null);
          }}
          onSubmit={handleAddEventSubmit}
          selectedDate={selectedDate}
          employees={employees}
        />
      )}

      {showEventDetailsModal && selectedEvent && (
        <EventDetailsModal
          event={selectedEvent}
          onClose={() => {
            setShowEventDetailsModal(false);
            setSelectedEvent(null);
          }}
          onEdit={() => {
            setShowEventDetailsModal(false);
            setShowEditEventModal(true);
          }}
          onDelete={handleDeleteEvent}
        />
      )}

      {showEditEventModal && selectedEvent && (
        <EditEventModal
          event={selectedEvent}
          onClose={() => {
            setShowEditEventModal(false);
            setSelectedEvent(null);
          }}
          onSubmit={handleEditEventSubmit}
          employees={employees}
        />
      )}

      {error && <div className="error-message">{error}</div>}
    </div>
  );
};

export default ProductionCalendar; 