import React, { useState } from 'react';
import { Modal, Button } from 'react-bootstrap';
import '../../styles/Modal.css';
import VacationActionModal from './VacationActionModal';

const EventDetailsModal = ({ show, onHide, event, onEdit, onDelete }) => {
    const [showVacationModal, setShowVacationModal] = useState(false);
    const [vacationModalMode, setVacationModalMode] = useState('edit');

    if (!event) {
        return null;
    }

    const getEventTypeLabel = (type) => {
        switch (type) {
            case 'installation':
                return 'Installation';
            case 'conge':
                return 'Congé';
            case 'maladie':
                return 'Maladie';
            case 'formation':
                return 'Formation';
            case 'vacances':
                return 'Vacances';
            default:
                return type;
        }
    };

    const handleVacationAction = (data) => {
        if (data.mode === 'edit') {
            onEdit({ ...event, updateMode: 'group', startDate: data.startDate, endDate: data.endDate });
        } else {
            onDelete({ ...event, deleteMode: 'group' });
        }
        setShowVacationModal(false);
    };

    const renderEventDetails = () => {
        if (!event.type) return null;

        switch (event.type) {
            case 'installation':
                return (
                    <div className="details-grid">
                        <div className="detail-item">
                            <label>Type :</label>
                            <span>{getEventTypeLabel(event.type)}</span>
                        </div>
                        <div className="detail-item">
                            <label>Date :</label>
                            <span>{new Date(event.date).toLocaleDateString()}</span>
                        </div>
                        <div className="detail-item">
                            <label>Heure :</label>
                            <span>{event.installation_time}</span>
                        </div>
                        <div className="detail-item">
                            <label>Prénom :</label>
                            <span>{event.first_name}</span>
                        </div>
                        <div className="detail-item">
                            <label>Nom :</label>
                            <span>{event.last_name}</span>
                        </div>
                        <div className="detail-item">
                            <label>Numéro d'installation :</label>
                            <span>{event.installation_number}</span>
                        </div>
                        <div className="detail-item">
                            <label>Ville :</label>
                            <span>{event.city}</span>
                        </div>
                        <div className="detail-item">
                            <label>Techniciens :</label>
                            <span>
                                {[
                                    event.technician1_name,
                                    event.technician2_name,
                                    event.technician3_name,
                                    event.technician4_name
                                ]
                                    .filter(tech => tech)
                                    .join(', ')}
                            </span>
                        </div>
                        <div className="detail-item">
                            <label>Équipement :</label>
                            <span>{event.equipment}</span>
                        </div>
                        <div className="detail-item">
                            <label>Montant :</label>
                            <span>{event.amount}€</span>
                        </div>
                        <div className="detail-item">
                            <label>Région :</label>
                            <span>{event.region || event.region_name}</span>
                        </div>
                    </div>
                );
            case 'formation':
            case 'maladie':
            case 'conge':
                return (
                    <div className="details-grid">
                        <div className="detail-item">
                            <label>Type :</label>
                            <span>{getEventTypeLabel(event.type)}</span>
                        </div>
                        <div className="detail-item">
                            <label>Date :</label>
                            <span>{new Date(event.date).toLocaleDateString()}</span>
                        </div>
                        <div className="detail-item">
                            <label>Commercial :</label>
                            <span>{event.employee_name}</span>
                        </div>
                    </div>
                );
            case 'vacances':
                return (
                    <div className="details-grid">
                        <div className="detail-item">
                            <label>Type :</label>
                            <span>{getEventTypeLabel(event.type)}</span>
                        </div>
                        <div className="detail-item">
                            <label>Date :</label>
                            <span>{new Date(event.date).toLocaleDateString()}</span>
                        </div>
                        <div className="detail-item">
                            <label>Commercial :</label>
                            <span>{event.employee_name}</span>
                        </div>
                        {event.vacation_group_id && (
                            <>
                                <div className="detail-item">
                                    <label>Période de vacances :</label>
                                    <span>
                                        Du {new Date(event.vacation_group_start_date).toLocaleDateString()} au {new Date(event.vacation_group_end_date).toLocaleDateString()}
                                    </span>
                                </div>
                            </>
                        )}
                    </div>
                );
            default:
                return null;
        }
    };

    return (
        <>
            <Modal show={show} onHide={onHide} centered className="custom-modal">
                <Modal.Header closeButton>
                    <Modal.Title>Détails de l'événement</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {renderEventDetails()}
                </Modal.Body>
                <Modal.Footer>
                    {event.type === 'vacances' && event.vacation_group_id && (
                        <>
                            <Button 
                                variant="warning" 
                                onClick={() => {
                                    setVacationModalMode('edit');
                                    setShowVacationModal(true);
                                }}
                            >
                                Modifier le groupe
                            </Button>
                            <Button 
                                variant="danger" 
                                onClick={() => {
                                    setVacationModalMode('delete');
                                    setShowVacationModal(true);
                                }}
                            >
                                Supprimer le groupe
                            </Button>
                        </>
                    )}
                    <Button variant="primary" onClick={() => onEdit(event)}>
                        Modifier
                    </Button>
                    <Button variant="danger" onClick={() => onDelete(event)}>
                        Supprimer
                    </Button>
                    <Button variant="secondary" onClick={onHide}>
                        Fermer
                    </Button>
                </Modal.Footer>
            </Modal>

            {showVacationModal && (
                <VacationActionModal
                    show={showVacationModal}
                    onHide={() => setShowVacationModal(false)}
                    onConfirm={handleVacationAction}
                    event={event}
                    mode={vacationModalMode}
                />
            )}
        </>
    );
};

export default EventDetailsModal; 