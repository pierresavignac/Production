import React, { useState } from 'react';
import '../../styles/Modal.css';
import VacationActionModal from './VacationActionModal';

const EventDetailsModal = ({ event, onClose, onEdit, onDelete }) => {
  const [showVacationActionModal, setShowVacationActionModal] = useState(false);
  const [actionType, setActionType] = useState(null);

  const handleEdit = () => {
    if (event.type === 'vacances' && event.vacation_group_id) {
      setActionType('edit');
      setShowVacationActionModal(true);
    } else {
      onEdit(event);
    }
  };

  const handleDelete = () => {
    if (event.type === 'vacances' && event.vacation_group_id) {
      setActionType('delete');
      setShowVacationActionModal(true);
    } else {
      if (window.confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')) {
        onDelete(event.id);
      }
    }
  };

  const handleGroupAction = () => {
    if (actionType === 'edit') {
      onEdit(event, 'group');
    } else {
      onDelete(event.id, 'group');
    }
    setShowVacationActionModal(false);
  };

  const handleIndividualAction = () => {
    if (actionType === 'edit') {
      onEdit(event, 'individual');
    } else {
      onDelete(event.id, 'individual');
    }
    setShowVacationActionModal(false);
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
      case 'vacances':
        return 'Détails des vacances';
      default:
        return 'Détails de l\'événement';
    }
  };

  return (
    <>
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
                    : event.type === 'vacances' ? 'Vacances'
                    : 'Installation'}
                </span>
              </div>

              <div className="detail-item">
                <label>Date :</label>
                <span>{event.date}</span>
              </div>

              {event.type === 'vacances' && event.vacation_group_id && (
                <>
                  <div className="detail-item">
                    <label>Période de vacances :</label>
                    <span>Du {event.vacation_group_start_date} au {event.vacation_group_end_date}</span>
                  </div>
                </>
              )}

              {event.type === 'installation' ? (
                // ... existing installation details ...
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

      <VacationActionModal
        isOpen={showVacationActionModal}
        onClose={() => setShowVacationActionModal(false)}
        onGroupAction={handleGroupAction}
        onIndividualAction={handleIndividualAction}
        actionType={actionType}
      />
    </>
  );
};

export default EventDetailsModal; 