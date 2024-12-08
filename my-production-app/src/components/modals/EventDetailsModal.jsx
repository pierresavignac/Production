import React, { useState, useEffect } from 'react';
import { Modal, Button, Row, Col, Form, Alert } from 'react-bootstrap';
import '../../styles/Modal.css';
import VacationActionModal from './VacationActionModal';
import WorksheetModal from './WorksheetModal';
import { fetchProgressionTask } from '../../utils/apiUtils';

const EventDetailsModal = ({ show, onHide, event, onEdit, onDelete }) => {
    const [showVacationModal, setShowVacationModal] = useState(false);
    const [vacationModalMode, setVacationModalMode] = useState('edit');
    const [showWorksheet, setShowWorksheet] = useState(false);
    const [employees, setEmployees] = useState([]);
    const [formData, setFormData] = useState({
        type: '',
        date: '',
        installation_time: '',
        full_name: '',
        phone: '',
        address: '',
        city: '',
        summary: '',
        description: '',
        installation_number: 'INS0',
        equipment: '',
        amount: '',
        technician1_id: '',
        technician2_id: '',
        technician3_id: '',
        technician4_id: '',
        employee_id: '',
        progression_task_id: ''
    });

    const [isLoading, setIsLoading] = useState(false);
    const [fetchError, setFetchError] = useState('');

    useEffect(() => {
        if (show) {
            fetchEmployees();
        }
    }, [show]);

    useEffect(() => {
        if (event) {
            setFormData({
                type: event.type || '',
                date: event.date || '',
                installation_time: event.installation_time || '',
                full_name: event.full_name || '',
                phone: event.phone || '',
                address: event.address || '',
                city: event.city || '',
                summary: event.summary || '',
                description: event.description || '',
                installation_number: event.installation_number ? 
                    (event.installation_number.startsWith('INS0') ? event.installation_number : 'INS0' + event.installation_number) : 'INS0',
                equipment: event.equipment || '',
                amount: event.amount || '',
                technician1_id: event.technician1_id || '',
                technician2_id: event.technician2_id || '',
                technician3_id: event.technician3_id || '',
                technician4_id: event.technician4_id || '',
                employee_id: event.employee_id || '',
                progression_task_id: event.progression_task_id || ''
            });
        }
    }, [event]);

    const fetchEmployees = async () => {
        try {
            const response = await fetch('/api/employees');
            if (response.ok) {
                const data = await response.json();
                setEmployees(data);
            }
        } catch (error) {
            console.error('Erreur lors du chargement des employés:', error);
        }
    };

    const handleFetchData = async () => {
        setIsLoading(true);
        setFetchError('');
        
        try {
            const installationNumber = formData.installation_number;
            if (!installationNumber || installationNumber === 'INS0') {
                throw new Error('Veuillez entrer un numéro d\'installation valide');
            }

            const progressionData = await fetchProgressionTask(installationNumber);

            setFormData(prev => ({
                ...prev,
                full_name: progressionData.customer.name,
                phone: progressionData.customer.phoneNumber,
                address: progressionData.customer.address.street,
                city: progressionData.customer.address.city,
                summary: progressionData.task.title,
                description: progressionData.task.description,
                amount: progressionData.task.priceWithTaxes,
                progression_task_id: progressionData.task.id
            }));
        } catch (error) {
            console.error('Erreur Fetch:', error);
            setFetchError(error.message);
        } finally {
            setIsLoading(false);
        }
    };

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

    const handleOpenWorksheet = () => {
        setShowWorksheet(true);
    };

    const handleCloseWorksheet = () => {
        setShowWorksheet(false);
    };

    const handleEdit = () => {
        const formattedEvent = {
            id: event.id,
            type: event.type,
            date: event.date,
            installation_time: event.installation_time || '',
            first_name: event.first_name || '',
            last_name: event.last_name || '',
            installation_number: event.installation_number || '',
            city: event.city || '',
            equipment: event.equipment || '',
            amount: event.amount || '',
            region: event.region_id || null,
            technician1: event.technician1_id || null,
            technician2: event.technician2_id || null,
            technician3: event.technician3_id || null,
            technician4: event.technician4_id || null,
            employee_id: event.employee_id || null,
            mode: 'edit'
        };
        onEdit(formattedEvent);
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSave = async () => {
        try {
            const updatedEvent = {
                ...event,
                type: formData.type,
                date: formData.date,
                installation_time: formData.installation_time,
                full_name: formData.full_name,
                phone: formData.phone,
                address: formData.address,
                city: formData.city,
                equipment: formData.equipment,
                amount: formData.amount,
                technician1_id: formData.technician1_id,
                technician2_id: formData.technician2_id,
                technician3_id: formData.technician3_id,
                technician4_id: formData.technician4_id,
                employee_id: formData.employee_id,
                progression_task_id: formData.progression_task_id
            };
            onEdit(updatedEvent);
            onHide();
        } catch (error) {
            console.error('Erreur lors de la sauvegarde:', error);
        }
    };

    const renderEventDetails = () => {
        if (!event.type) return null;

        switch (event.type) {
            case 'installation':
                return (
                    <div className="details-grid">
                        <div className="detail-row">
                            <div className="detail-item">
                                <label>Type :</label>
                                <span>{getEventTypeLabel(event.type)}</span>
                            </div>
                            <div className="detail-item">
                                <label>Numéro d'installation :</label>
                                <span>{event.installation_number}</span>
                            </div>
                        </div>

                        <div className="detail-row">
                            <div className="detail-item">
                                <label>Date :</label>
                                <span>{new Date(event.date).toLocaleDateString()}</span>
                            </div>
                            <div className="detail-item">
                                <label>Heure :</label>
                                <span>{event.installation_time}</span>
                            </div>
                        </div>

                        <div className="detail-row">
                            <div className="detail-item">
                                <label>Région :</label>
                                <span>{event.region_name}</span>
                            </div>
                            <div className="detail-item">
                                <label>Ville :</label>
                                <span>{event.city}</span>
                            </div>
                        </div>

                        <div className="detail-row">
                            <div className="detail-item">
                                <label>Équipement :</label>
                                <span>{event.equipment}</span>
                            </div>
                            <div className="detail-item">
                                <label>Montant :</label>
                                <span>{new Intl.NumberFormat('fr-CA', { style: 'currency', currency: 'CAD' }).format(event.amount)}</span>
                            </div>
                        </div>

                        <div className="detail-row">
                            <div className="detail-item">
                                <label>Technicien 1 :</label>
                                <span>{event.technician1_name || '-'}</span>
                            </div>
                            <div className="detail-item">
                                <label>Technicien 2 :</label>
                                <span>{event.technician2_name || '-'}</span>
                            </div>
                        </div>

                        <div className="detail-row">
                            <div className="detail-item">
                                <label>Technicien 3 :</label>
                                <span>{event.technician3_name || '-'}</span>
                            </div>
                            <div className="detail-item">
                                <label>Technicien 4 :</label>
                                <span>{event.technician4_name || '-'}</span>
                            </div>
                        </div>

                        <Row className="mb-3">
                            <Col md={8}>
                                <Form.Group>
                                    <Form.Label>Adresse</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="address"
                                        value={formData.address}
                                        onChange={handleChange}
                                        placeholder="Adresse complète"
                                        required
                                    />
                                </Form.Group>
                            </Col>
                            <Col md={4}>
                                <Form.Group>
                                    <Form.Label>Ville</Form.Label>
                                    <Form.Control
                                        type="text"
                                        name="city"
                                        value={formData.city}
                                        onChange={handleChange}
                                        placeholder="Ville"
                                        required
                                    />
                                </Form.Group>
                            </Col>
                        </Row>
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
                <Modal.Footer className="d-flex justify-content-between">
                    <div>
                        {event.type === 'installation' && (
                            <Button 
                                variant="primary" 
                                onClick={handleOpenWorksheet}
                            >
                                Feuille de travail
                            </Button>
                        )}
                    </div>
                    <div>
                        <Button 
                            variant="primary" 
                            onClick={handleEdit}
                            className="me-2"
                        >
                            Modifier
                        </Button>
                        <Button variant="danger" onClick={() => onDelete(event)} className="me-2">
                            Supprimer
                        </Button>
                        <Button variant="secondary" onClick={onHide}>
                            Fermer
                        </Button>
                    </div>
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

            {showWorksheet && (
                <WorksheetModal
                    show={showWorksheet}
                    onHide={handleCloseWorksheet}
                    installation={event}
                    employees={employees}
                    mode="installation"
                />
            )}
        </>
    );
};

export default EventDetailsModal; 