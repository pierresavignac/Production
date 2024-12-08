import React, { useState, useEffect } from 'react';
import { Modal, Button, Form, Row, Col, Alert } from 'react-bootstrap';
import { fetchRegions, fetchTechnicians, fetchCitiesForRegion, fetchEquipment, fetchProgressionTask } from '../../utils/apiUtils';
import '../../styles/Modal.css';

const AddEventModal = ({ show, onHide, onSubmit, event = null, mode = 'add', employees = [] }) => {
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
        progression_task_id: '',
        startDate: '',
        endDate: '',
    });

    const [regions, setRegions] = useState([]);
    const [cities, setCities] = useState([]);
    const [technicians, setTechnicians] = useState([]);
    const [equipment, setEquipment] = useState([]);
    const [showEquipmentModal, setShowEquipmentModal] = useState(false);
    const [newEquipment, setNewEquipment] = useState('');
    const [isLoading, setIsLoading] = useState(false);
    const [fetchError, setFetchError] = useState('');

    useEffect(() => {
        if (show) {
            loadRegions();
            loadTechnicians();
            loadEquipment();
            if (event && mode === 'edit') {
                const normalizedEvent = {
                    type: event.type || '',
                    date: event.date || '',
                    installation_time: event.installation_time || '',
                    full_name: `${event.first_name || ''} ${event.last_name || ''}`.trim(),
                    phone: event.phone || '',
                    address: event.address || '',
                    city: event.city || '',
                    summary: event.summary || '',
                    description: event.description || '',
                    installation_number: event.installation_number ? 
                        (event.installation_number.startsWith('INS0') ? event.installation_number : 'INS0' + event.installation_number) : 'INS0',
                    equipment: event.equipment || '',
                    amount: event.amount_with_taxes || '',
                    technician1_id: event.technician1_id || '',
                    technician2_id: event.technician2_id || '',
                    technician3_id: event.technician3_id || '',
                    technician4_id: event.technician4_id || '',
                    employee_id: event.employee_id || '',
                    progression_task_id: event.progression_task_id || ''
                };
                setFormData(normalizedEvent);
            }
        }
    }, [show, event, mode]);

    const loadRegions = async () => {
        try {
            const data = await fetchRegions();
            const formattedRegions = data.map(region => ({
                id: region.id,
                name: region.name
            }));
            setRegions(formattedRegions);
        } catch (error) {
            console.error('Error loading regions:', error);
        }
    };

    const loadCitiesForRegion = async (regionId) => {
        try {
            const data = await fetchCitiesForRegion(regionId);
            setCities(data);
        } catch (error) {
            console.error('Error loading cities:', error);
        }
    };

    const loadTechnicians = async () => {
        try {
            const data = await fetchTechnicians();
            setTechnicians(data);
        } catch (error) {
            console.error('Error loading technicians:', error);
        }
    };

    const loadEquipment = async () => {
        try {
            const data = await fetchEquipment();
            setEquipment(data);
        } catch (error) {
            console.error('Error loading equipment:', error);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        
        try {
            const submissionData = {
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
                progression_task_id: formData.progression_task_id,
                startDate: formData.type === 'vacances' ? formData.startDate : undefined,
                endDate: formData.type === 'vacances' ? formData.endDate : undefined,
            };
            onSubmit(submissionData);
        } catch (error) {
            console.error('Erreur lors de la soumission:', error);
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        
        if (name === 'installation_number') {
            // Ne garder que les chiffres, maximum 5
            const numericValue = value.replace(/[^0-9]/g, '').slice(0, 5);
            setFormData(prev => ({
                ...prev,
                [name]: 'INS0' + numericValue
            }));
        } else {
            setFormData(prev => ({
                ...prev,
                [name]: value
            }));
        }
    };

    const handleEquipmentManagement = () => {
        setShowEquipmentModal(true);
    };

    const handleAddEquipment = async () => {
        if (!newEquipment.trim()) return;
        
        try {
            const response = await fetch('/api/equipment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ name: newEquipment.trim() })
            });
            
            if (response.ok) {
                const newItem = await response.json();
                setEquipment([...equipment, newItem]);
                setNewEquipment('');
                await loadEquipment(); // Recharger la liste
            }
        } catch (error) {
            console.error('Erreur lors de l\'ajout de l\'équipement:', error);
        }
    };

    const handleDeleteEquipment = async (equipmentId) => {
        try {
            const response = await fetch(`/api/equipment/${equipmentId}`, {
                method: 'DELETE'
            });
            
            if (response.ok) {
                setEquipment(equipment.filter(item => item.id !== equipmentId));
                await loadEquipment(); // Recharger la liste
            }
        } catch (error) {
            console.error('Erreur lors de la suppression de l\'équipement:', error);
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

            if (!progressionData?.customer?.name) {
                throw new Error('Les informations client sont incomplètes ou invalides');
            }

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
            setFetchError(
                error.message.includes('500') 
                    ? 'Le serveur rencontre des difficultés. Veuillez réessayer dans quelques instants.'
                    : error.message
            );
        } finally {
            setIsLoading(false);
        }
    };

    const renderEquipmentModal = () => (
        <Modal show={showEquipmentModal} onHide={() => setShowEquipmentModal(false)}>
            <Modal.Header closeButton>
                <Modal.Title>Gestion des équipements</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Form.Group>
                    <Form.Label>Ajouter un nouvel équipement</Form.Label>
                    <div className="d-flex gap-2">
                        <Form.Control
                            type="text"
                            value={newEquipment}
                            onChange={(e) => setNewEquipment(e.target.value)}
                            placeholder="Nom de l'équipement"
                        />
                        <Button 
                            variant="primary" 
                            onClick={handleAddEquipment}
                            disabled={!newEquipment.trim()}
                        >
                            Ajouter
                        </Button>
                    </div>
                </Form.Group>
                <div className="mt-3">
                    <h6>Équipements existants</h6>
                    <ul className="list-group">
                        {equipment.map((item) => (
                            <li key={item.id} className="list-group-item d-flex justify-content-between align-items-center">
                                {item.name}
                                <Button 
                                    variant="danger" 
                                    size="sm" 
                                    onClick={() => handleDeleteEquipment(item.id)}
                                >
                                    Supprimer
                                </Button>
                            </li>
                        ))}
                    </ul>
                </div>
            </Modal.Body>
        </Modal>
    );

    return (
        <>
            <Modal 
                show={show} 
                onHide={onHide} 
                size="lg"
                centered
                dialogClassName="custom-modal"
            >
                <style>
                    {`
                        .modal {
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                        }
                        .custom-modal {
                            max-width: 1000px !important;
                            width: 125% !important;
                            margin: 0 auto !important;
                        }
                        .custom-modal .modal-dialog {
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                            margin: 1.75rem auto !important;
                            width: 100% !important;
                        }
                        .custom-modal .modal-content {
                            width: 100% !important;
                        }
                    `}
                </style>
                <Modal.Header closeButton>
                    <Modal.Title>{mode === 'edit' ? 'Modifier l\'événement' : 'Ajouter un événement'}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {fetchError && (
                        <Alert variant="danger" className="mb-3">
                            {fetchError}
                        </Alert>
                    )}
                    <Form onSubmit={handleSubmit}>
                        <Form.Group className="mb-3">
                            <Form.Label>Type de tâche</Form.Label>
                            <Form.Select 
                                name="type"
                                value={formData.type}
                                onChange={handleChange}
                                disabled={mode === 'edit'}
                                required
                            >
                                <option value="">Sélectionner un type</option>
                                <option value="installation">Installation</option>
                                <option value="conge">Congé</option>
                                <option value="maladie">Maladie</option>
                                <option value="formation">Formation</option>
                                <option value="vacances">Vacances</option>
                            </Form.Select>
                        </Form.Group>

                        {formData.type === 'installation' && (
                            <>
                                <Row className="mb-3">
                                    <Col md={6}>
                                        <Form.Group>
                                            <Form.Label>Numéro d'installation</Form.Label>
                                            <div className="d-flex gap-0">
                                                <div className="input-group">
                                                    <span className="input-group-text" style={{ backgroundColor: '#e9ecef' }}>INS0</span>
                                                    <Form.Control
                                                        type="text"
                                                        name="installation_number"
                                                        value={formData.installation_number.replace('INS0', '')}
                                                        onChange={handleChange}
                                                        maxLength={5}
                                                        pattern="[0-9]*"
                                                        required
                                                        style={{ borderTopLeftRadius: 0, borderBottomLeftRadius: 0 }}
                                                    />
                                                    <Button 
                                                        variant="primary" 
                                                        onClick={handleFetchData}
                                                        disabled={isLoading}
                                                    >
                                                        {isLoading ? 'Chargement...' : 'Fetch'}
                                                    </Button>
                                                </div>
                                            </div>
                                        </Form.Group>
                                    </Col>
                                    <Col md={3}>
                                        <Form.Group>
                                            <Form.Label>Date</Form.Label>
                                            <Form.Control
                                                type="date"
                                                name="date"
                                                value={formData.date}
                                                onChange={handleChange}
                                                required
                                            />
                                        </Form.Group>
                                    </Col>
                                    <Col md={3}>
                                        <Form.Group>
                                            <Form.Label>Heure</Form.Label>
                                            <Form.Control
                                                type="time"
                                                name="installation_time"
                                                value={formData.installation_time}
                                                onChange={handleChange}
                                                required
                                            />
                                        </Form.Group>
                                    </Col>
                                </Row>

                                <Row className="mb-3">
                                    <Col md={8}>
                                        <Form.Group>
                                            <Form.Label>Nom complet</Form.Label>
                                            <Form.Control
                                                type="text"
                                                name="full_name"
                                                value={formData.full_name}
                                                onChange={handleChange}
                                                placeholder="Nom complet"
                                                required
                                                readOnly
                                            />
                                        </Form.Group>
                                    </Col>
                                    <Col md={4}>
                                        <Form.Group>
                                            <Form.Label>Téléphone</Form.Label>
                                            <Form.Control
                                                type="tel"
                                                name="phone"
                                                value={formData.phone}
                                                onChange={handleChange}
                                                placeholder="Téléphone"
                                                required
                                                readOnly
                                            />
                                        </Form.Group>
                                    </Col>
                                </Row>

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
                                                readOnly
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
                                                readOnly
                                            />
                                        </Form.Group>
                                    </Col>
                                </Row>

                                <Row className="mb-3">
                                    <Col md={12}>
                                        <Form.Group>
                                            <Form.Label>Sommaire</Form.Label>
                                            <Form.Control
                                                type="text"
                                                name="summary"
                                                value={formData.summary}
                                                onChange={handleChange}
                                                placeholder="Sommaire de l'installation"
                                                readOnly
                                            />
                                        </Form.Group>
                                    </Col>
                                </Row>

                                <Row className="mb-3">
                                    <Col md={12}>
                                        <Form.Group>
                                            <Form.Label>Description</Form.Label>
                                            <Form.Control
                                                as="textarea"
                                                rows={5}
                                                name="description"
                                                value={formData.description}
                                                onChange={handleChange}
                                                placeholder="Description détaillée"
                                                style={{ maxHeight: '200px', overflowY: 'auto' }}
                                                readOnly
                                            />
                                        </Form.Group>
                                    </Col>
                                </Row>

                                <Form.Group className="mb-3">
                                    <Form.Label>Équipement</Form.Label>
                                    <div className="d-flex gap-2">
                                        <Form.Select
                                            name="equipment"
                                            value={formData.equipment}
                                            onChange={handleChange}
                                            required
                                        >
                                            <option value="">Sélectionner un équipement</option>
                                            {equipment.map(item => (
                                                <option key={item.id} value={item.name}>
                                                    {item.name}
                                                </option>
                                            ))}
                                        </Form.Select>
                                        <Button 
                                            variant="outline-primary"
                                            onClick={handleEquipmentManagement}
                                        >
                                            Gérer
                                        </Button>
                                    </div>
                                </Form.Group>

                                <Form.Group className="mb-3">
                                    <Form.Label>Montant à percevoir</Form.Label>
                                    <Form.Control
                                        type="number"
                                        step="0.01"
                                        name="amount"
                                        value={formData.amount}
                                        onChange={handleChange}
                                        required
                                        readOnly
                                    />
                                </Form.Group>

                                <div className="form-row">
                                    <Form.Group className="mb-3 me-3">
                                        <Form.Label>Technicien 1</Form.Label>
                                        <Form.Select
                                            name="technician1_id"
                                            value={formData.technician1_id}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner un technicien</option>
                                            {technicians.map(tech => (
                                                <option key={tech.id} value={tech.id}>
                                                    {`${tech.first_name} ${tech.last_name}`}
                                                </option>
                                            ))}
                                        </Form.Select>
                                    </Form.Group>

                                    <Form.Group className="mb-3">
                                        <Form.Label>Technicien 2</Form.Label>
                                        <Form.Select
                                            name="technician2_id"
                                            value={formData.technician2_id}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner un technicien</option>
                                            {technicians.map(tech => (
                                                <option key={tech.id} value={tech.id}>
                                                    {`${tech.first_name} ${tech.last_name}`}
                                                </option>
                                            ))}
                                        </Form.Select>
                                    </Form.Group>
                                </div>

                                <div className="form-row">
                                    <Form.Group className="mb-3 me-3">
                                        <Form.Label>Technicien 3</Form.Label>
                                        <Form.Select
                                            name="technician3_id"
                                            value={formData.technician3_id}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner un technicien</option>
                                            {technicians.map(tech => (
                                                <option key={tech.id} value={tech.id}>
                                                    {`${tech.first_name} ${tech.last_name}`}
                                                </option>
                                            ))}
                                        </Form.Select>
                                    </Form.Group>

                                    <Form.Group className="mb-3">
                                        <Form.Label>Technicien 4</Form.Label>
                                        <Form.Select
                                            name="technician4_id"
                                            value={formData.technician4_id}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner un technicien</option>
                                            {technicians.map(tech => (
                                                <option key={tech.id} value={tech.id}>
                                                    {`${tech.first_name} ${tech.last_name}`}
                                                </option>
                                            ))}
                                        </Form.Select>
                                    </Form.Group>
                                </div>
                            </>
                        )}

                        {(formData.type === 'conge' || formData.type === 'maladie' || formData.type === 'formation') && (
                            <>
                                <Form.Group className="mb-3">
                                    <Form.Label>Date</Form.Label>
                                    <Form.Control
                                        type="date"
                                        name="date"
                                        value={formData.date}
                                        onChange={handleChange}
                                        required
                                    />
                                </Form.Group>

                                <Form.Group className="mb-3">
                                    <Form.Label>Employé</Form.Label>
                                    <Form.Select
                                        name="employee_id"
                                        value={formData.employee_id}
                                        onChange={handleChange}
                                        required
                                    >
                                        <option value="">Sélectionner un employé</option>
                                        {employees?.map(emp => (
                                            <option key={emp.id} value={emp.id}>
                                                {`${emp.first_name} ${emp.last_name}`}
                                            </option>
                                        ))}
                                    </Form.Select>
                                </Form.Group>
                            </>
                        )}

                        {formData.type === 'vacances' && (
                            <>
                                <Form.Group className="mb-3">
                                    <Form.Label>Date de début</Form.Label>
                                    <Form.Control
                                        type="date"
                                        name="startDate"
                                        value={formData.startDate}
                                        onChange={handleChange}
                                        required
                                    />
                                </Form.Group>

                                <Form.Group className="mb-3">
                                    <Form.Label>Date de fin</Form.Label>
                                    <Form.Control
                                        type="date"
                                        name="endDate"
                                        value={formData.endDate}
                                        onChange={handleChange}
                                        required
                                        min={formData.startDate}
                                    />
                                </Form.Group>

                                <Form.Group className="mb-3">
                                    <Form.Label>Employé</Form.Label>
                                    <Form.Select
                                        name="employee_id"
                                        value={formData.employee_id}
                                        onChange={handleChange}
                                        required
                                    >
                                        <option value="">Sélectionner un employé</option>
                                        {employees?.map(emp => (
                                            <option key={emp.id} value={emp.id}>
                                                {`${emp.first_name} ${emp.last_name}`}
                                            </option>
                                        ))}
                                    </Form.Select>
                                </Form.Group>
                            </>
                        )}
                    </Form>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={onHide}>
                        Annuler
                    </Button>
                    <Button variant="primary" onClick={handleSubmit}>
                        {mode === 'edit' ? 'Modifier' : 'Ajouter'}
                    </Button>
                </Modal.Footer>
            </Modal>

            {renderEquipmentModal()}
        </>
    );
};

export default AddEventModal; 