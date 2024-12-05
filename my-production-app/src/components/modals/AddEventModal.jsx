import React, { useState, useEffect } from 'react';
import { Modal, Button, Form } from 'react-bootstrap';
import { fetchRegions, fetchTechnicians, fetchCitiesForRegion, fetchEquipment } from '../../utils/apiUtils';
import '../../styles/Modal.css';

const AddEventModal = ({ show, onHide, onSubmit, event = null, mode = 'add', employees = [] }) => {
    const [formData, setFormData] = useState({
        type: '',
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
        employee_name: '',
        employee_id: ''
    });

    const [regions, setRegions] = useState([]);
    const [cities, setCities] = useState([]);
    const [technicians, setTechnicians] = useState([]);
    const [equipment, setEquipment] = useState([]);

    useEffect(() => {
        if (show) {
            loadRegions();
            loadTechnicians();
            loadEquipment();
            if (event && mode === 'edit') {
                setFormData({
                    type: event.type || '',
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
                    employee_name: event.employee_name || '',
                    employee_id: event.employee_id || ''
                });
                if (event.region_id) {
                    loadCitiesForRegion(event.region_id);
                }
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

    const handleSubmit = (e) => {
        e.preventDefault();
        onSubmit({
            ...formData,
            id: event?.id,
            mode: mode,
            employee_id: formData.employee_id
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
                            <div className="form-row">
                                <Form.Group className="mb-3 me-3">
                                    <Form.Label>Numéro d'installation</Form.Label>
                                    <div className="d-flex align-items-center">
                                        <span className="me-2 pt-2">INS0</span>
                                        <Form.Control
                                            type="text"
                                            name="installation_number"
                                            value={formData.installation_number.replace(/^INS0/, '')}
                                            onChange={(e) => {
                                                const value = e.target.value.replace(/\D/g, '').slice(0, 5);
                                                handleChange({
                                                    target: {
                                                        name: 'installation_number',
                                                        value: `INS0${value}`
                                                    }
                                                });
                                            }}
                                            pattern="[0-9]{5}"
                                            maxLength="5"
                                            required
                                            style={{ width: '120px' }}
                                        />
                                    </div>
                                </Form.Group>

                                <Form.Group className="mb-3 me-3">
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
                            </div>

                            <div className="form-row">
                                <Form.Group className="mb-3 me-3">
                                    <Form.Label>Région</Form.Label>
                                    <Form.Select
                                        name="region"
                                        value={formData.region}
                                        onChange={(e) => {
                                            handleChange(e);
                                            setFormData(prev => ({
                                                ...prev,
                                                city: ''
                                            }));
                                            loadCitiesForRegion(e.target.value);
                                        }}
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
                                    <Form.Label>Ville</Form.Label>
                                    <Form.Select
                                        name="city"
                                        value={formData.city}
                                        onChange={handleChange}
                                        required
                                    >
                                        <option value="">Sélectionner une ville</option>
                                        {cities.map(city => (
                                            <option key={city.id} value={city.name}>
                                                {city.name}
                                            </option>
                                        ))}
                                    </Form.Select>
                                </Form.Group>
                            </div>

                            <div className="form-row">
                                <Form.Group className="mb-3 me-3">
                                    <Form.Label>Équipement</Form.Label>
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
                                </Form.Group>

                                <Form.Group className="mb-3">
                                    <Form.Label>Montant (CAD)</Form.Label>
                                    <Form.Control
                                        type="number"
                                        step="0.01"
                                        name="amount"
                                        value={formData.amount}
                                        onChange={handleChange}
                                        required
                                    />
                                </Form.Group>
                            </div>

                            <div className="form-row">
                                <Form.Group className="mb-3 me-3">
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
                            </div>

                            <div className="form-row">
                                <Form.Group className="mb-3 me-3">
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
    );
};

export default AddEventModal; 