import React, { useState, useEffect } from 'react';
import { Modal, Button, Form } from 'react-bootstrap';
import { fetchRegions, fetchTechnicians } from '../../utils/apiUtils';
import '../../styles/Modal.css';

const AddEventModal = ({ show, onHide, onSubmit, event = null, mode = 'add' }) => {
    const [formData, setFormData] = useState({
        type: 'installation',
        date: '',
        installation_time: '',
        first_name: '',
        last_name: '',
        installation_number: '',
        city: '',
        equipment: '',
        amount: '',
        region: '',
        technician1: '',
        technician2: '',
        technician3: '',
        technician4: '',
        employee_name: ''
    });

    const [regions, setRegions] = useState([]);
    const [technicians, setTechnicians] = useState([]);

    useEffect(() => {
        if (show) {
            loadRegions();
            loadTechnicians();
            if (event && mode === 'edit') {
                setFormData({
                    type: event.type || 'installation',
                    date: event.date || '',
                    installation_time: event.installation_time || '',
                    first_name: event.first_name || '',
                    last_name: event.last_name || '',
                    installation_number: event.installation_number || '',
                    city: event.city || '',
                    equipment: event.equipment || '',
                    amount: event.amount || '',
                    region: event.region_id || '',
                    technician1: event.technician1_id || '',
                    technician2: event.technician2_id || '',
                    technician3: event.technician3_id || '',
                    technician4: event.technician4_id || '',
                    employee_name: event.employee_name || ''
                });
            }
        }
    }, [show, event, mode]);

    const loadRegions = async () => {
        try {
            const data = await fetchRegions();
            setRegions(data);
        } catch (error) {
            console.error('Error loading regions:', error);
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

    const handleSubmit = (e) => {
        e.preventDefault();
        onSubmit({
            ...formData,
            id: event?.id,
            mode: mode
        });
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
    };

    return (
        <Modal show={show} onHide={onHide} centered>
            <Modal.Header closeButton>
                <Modal.Title>{mode === 'edit' ? 'Modifier l\'événement' : 'Ajouter un événement'}</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Form onSubmit={handleSubmit}>
                    <Form.Group className="mb-3">
                        <Form.Label>Type</Form.Label>
                        <Form.Select 
                            name="type"
                            value={formData.type}
                            onChange={handleChange}
                            disabled={mode === 'edit'}
                        >
                            <option value="installation">Installation</option>
                            <option value="conge">Congé</option>
                            <option value="maladie">Maladie</option>
                            <option value="formation">Formation</option>
                            <option value="vacances">Vacances</option>
                        </Form.Select>
                    </Form.Group>

                    {formData.type === 'installation' && (
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
                                <Form.Label>Heure</Form.Label>
                                <Form.Control
                                    type="time"
                                    name="installation_time"
                                    value={formData.installation_time}
                                    onChange={handleChange}
                                    required
                                />
                            </Form.Group>

                            <Form.Group className="mb-3">
                                <Form.Label>Prénom</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="first_name"
                                    value={formData.first_name}
                                    onChange={handleChange}
                                    required
                                />
                            </Form.Group>

                            <Form.Group className="mb-3">
                                <Form.Label>Nom</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="last_name"
                                    value={formData.last_name}
                                    onChange={handleChange}
                                    required
                                />
                            </Form.Group>

                            <Form.Group className="mb-3">
                                <Form.Label>Numéro d'installation</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="installation_number"
                                    value={formData.installation_number}
                                    onChange={handleChange}
                                    required
                                />
                            </Form.Group>

                            <Form.Group className="mb-3">
                                <Form.Label>Ville</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="city"
                                    value={formData.city}
                                    onChange={handleChange}
                                    required
                                />
                            </Form.Group>

                            <Form.Group className="mb-3">
                                <Form.Label>Région</Form.Label>
                                <Form.Select
                                    name="region"
                                    value={formData.region}
                                    onChange={handleChange}
                                    required
                                >
                                    <option value="">Sélectionner une région</option>
                                    {regions.map(region => (
                                        <option key={region.id} value={region.id}>
                                            {region.name}
                                        </option>
                                    ))}
                                </Form.Select>
                            </Form.Group>

                            <Form.Group className="mb-3">
                                <Form.Label>Technicien 1</Form.Label>
                                <Form.Select
                                    name="technician1"
                                    value={formData.technician1}
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
                                    name="technician2"
                                    value={formData.technician2}
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
                                <Form.Label>Technicien 3</Form.Label>
                                <Form.Select
                                    name="technician3"
                                    value={formData.technician3}
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
                                    name="technician4"
                                    value={formData.technician4}
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
    );
};

export default AddEventModal; 