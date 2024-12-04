import React from 'react';
import '../../styles/Modal.css';

const VacationActionModal = ({ 
  isOpen, 
  onClose, 
  onGroupAction, 
  onIndividualAction, 
  actionType 
}) => {
  if (!isOpen) return null;

  return (
    <div className="modal-overlay">
      <div className="modal-content">
        <div className="modal-header">
          <h2>
            {actionType === 'edit' ? 'Modifier les vacances' : 'Supprimer les vacances'}
          </h2>
          <button onClick={onClose} className="close-button">&times;</button>
        </div>
        <div className="modal-body">
          <p>
            {actionType === 'edit' 
              ? 'Comment souhaitez-vous modifier ces vacances ?'
              : 'Comment souhaitez-vous supprimer ces vacances ?'
            }
          </p>
          <div className="button-group">
            <button 
              onClick={() => onGroupAction()}
              className="action-button"
            >
              {actionType === 'edit' 
                ? 'Modifier toute la période'
                : 'Supprimer toute la période'
              }
            </button>
            <button 
              onClick={() => onIndividualAction()}
              className="action-button"
            >
              {actionType === 'edit'
                ? 'Modifier uniquement ce jour'
                : 'Supprimer uniquement ce jour'
              }
            </button>
            <button 
              onClick={onClose}
              className="cancel-button"
            >
              Annuler
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default VacationActionModal; 