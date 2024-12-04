import React from 'react';
import '../../styles/Modal.css';

const EventDetailsModal = ({ event, onClose, onEdit, onDelete }) => {
  const handleEdit = () => {
    onEdit(event);
  };

  const handleDelete = () => {
    if (window.confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
      onDelete(event.id);
    }
  };

  const getEventTitle = () => {
    switch (event.type) {
      case 'installation':
        return 'Détails de l\'installation';
      case 'conge':
        return 'Détails du congé';
      case 'maladie':
        return 'Détails de l\'arrêt maladie';
      case 'formation':
        return 'Détails de la formation';
      default:
        return 'Détails de l\'événement';
    }
  };

  return (
    <div className="modal-overlay">
      <div className="modal-content">
        <div className="modal-header">
          <h2>{getEventTitle()}</h2>
          <button onClick={onClose} className="close-button">&times;</button>
        </div>
        <div className="modal-body">
          <div className="details-grid">
            <div className="detail-item">
              <label>Type :</label>
              <span>
                {event.type === 'conge' ? 'Congé' 
                  : event.type === 'maladie' ? 'Maladie'
                  : event.type === 'formation' ? 'Formation'
                  : 'Installation'}
              </span>
            </div>

            <div className="detail-item">
              <label>Date :</label>
              <span>{event.date}</span>
            </div>

            {event.type === 'installation' ? (
              <>
                <div className="detail-item">
                  <label>Numéro d'installation :</label>
                  <span>{event.installation_number}</span>
                </div>

                <div className="detail-item">
                  <label>Heure :</label>
                  <span>{event.installation_time}</span>
                </div>

                <div className="detail-item">
                  <label>Client :</label>
                  <span>{event.first_name} {event.last_name}</span>
                </div>

                <div className="detail-item">
                  <label>Ville :</label>
                  <span>{event.city}</span>
                </div>

                <div className="detail-item">
                  <label>Équipement :</label>
                  <span>{event.equipment}</span>
                </div>

                <div className="detail-item">
                  <label>Montant :</label>
                  <span>${event.amount}</span>
                </div>

                <div className="detail-item">
                  <label>Technicien principal :</label>
                  <span>{event.technician1_name}</span>
                </div>

                {event.technician2_name && (
                  <div className="detail-item">
                    <label>Technicien supplémentaire 1 :</label>
                    <span>{event.technician2_name}</span>
                  </div>
                )}

                {event.technician3_name && (
                  <div className="detail-item">
                    <label>Technicien supplémentaire 2 :</label>
                    <span>{event.technician3_name}</span>
                  </div>
                )}

                {event.technician4_name && (
                  <div className="detail-item">
                    <label>Technicien supplémentaire 3 :</label>
                    <span>{event.technician4_name}</span>
                  </div>
                )}
              </>
            ) : (
              <div className="detail-item">
                <label>Employé :</label>
                <span>{event.employee_name}</span>
              </div>
            )}
          </div>
        </div>
        <div className="button-group">
          <button onClick={handleEdit} className="edit-button">
            Modifier
          </button>
          <button onClick={handleDelete} className="delete-button">
            Supprimer
          </button>
        </div>
      </div>
    </div>
  );
};

export default EventDetailsModal; 