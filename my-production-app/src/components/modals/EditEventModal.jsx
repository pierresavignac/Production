import React, { useState, useEffect } from 'react';
import { Modal, Button, Form } from 'react-bootstrap';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import { fr } from 'date-fns/locale';
import '../../styles/Modal.css';

const EditEventModal = ({ show, onHide, event, onSubmit, employees, technicians, regions }) => {
    const [formData, setFormData] = useState({
        type: '',
        date: new Date(),
        first_name: '',
        last_name: '',
        installation_number: '',
        installation_time: '',
        city: '',
        equipment: '',
        amount: '',
        technician1_id: '',
        technician2_id: '',
        technician3_id: '',
        technician4_id: '',
        region_id: '',
        employee_id: '',
        vacation_group_start_date: null,
        vacation_group_end_date: null
    });

    useEffect(() => {
        if (event) {
            console.log("Event data:", event); // Debug
            setFormData({
                ...formData,
                type: event.type,
                date: new Date(event.date),
                first_name: event.first_name || '',
                last_name: event.last_name || '',
                installation_number: event.installation_number || '',
                installation_time: event.installation_time || '',
                city: event.city || '',
                equipment: event.equipment || '',
                amount: event.amount || '',
                technician1_id: event.technician1_id || '',
                technician2_id: event.technician2_id || '',
                technician3_id: event.technician3_id || '',
                technician4_id: event.technician4_id || '',
                region_id: event.region_id || '',
                employee_id: event.employee_id || '',
                vacation_group_start_date: event.vacation_group_start_date ? new Date(event.vacation_group_start_date) : null,
                vacation_group_end_date: event.vacation_group_end_date ? new Date(event.vacation_group_end_date) : null
            });
        }
    }, [event]);

    const handleSubmit = (e) => {
        e.preventDefault();
        console.log("Submitting form data:", formData); // Debug
        const submitData = {
            id: event.id,
            type: event.type,
            date: formData.date.toISOString().split('T')[0],
            first_name: formData.first_name,
            last_name: formData.last_name,
            installation_number: formData.installation_number,
            installation_time: formData.installation_time,
            city: formData.city,
            equipment: formData.equipment,
            amount: formData.amount,
            technician1_id: formData.technician1_id || null,
            technician2_id: formData.technician2_id || null,
            technician3_id: formData.technician3_id || null,
            technician4_id: formData.technician4_id || null,
            region_id: formData.region_id || null,
            employee_id: formData.employee_id || null
        };

        if (event.type === 'vacances') {
            submitData.vacation_group_start_date = formData.vacation_group_start_date?.toISOString().split('T')[0];
            submitData.vacation_group_end_date = formData.vacation_group_end_date?.toISOString().split('T')[0];
        }

        onSubmit(submitData);
    };

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
        }));
    };

    const renderFormFields = () => {
        switch (event.type) {
            case 'installation':
                return (
                    <>
                        <div className="form-row-grid">
                            <Form.Group>
                                <Form.Label>Numéro d'installation</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="installation_number"
                                    value={formData.installation_number}
                                    onChange={handleChange}
                                />
                            </Form.Group>
                            <Form.Group>
                                <Form.Label>Heure</Form.Label>
                                <Form.Control
                                    type="time"
                                    name="installation_time"
                                    value={formData.installation_time}
                                    onChange={handleChange}
                                />
                            </Form.Group>
                        </div>

                        <div className="form-row-grid">
                            <Form.Group>
                                <Form.Label>Prénom</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="first_name"
                                    value={formData.first_name}
                                    onChange={handleChange}
                                />
                            </Form.Group>
                            <Form.Group>
                                <Form.Label>Nom</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="last_name"
                                    value={formData.last_name}
                                    onChange={handleChange}
                                />
                            </Form.Group>
                        </div>

                        <div className="form-row-grid">
                            <Form.Group>
                                <Form.Label>Ville</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="city"
                                    value={formData.city}
                                    onChange={handleChange}
                                />
                            </Form.Group>
                            <Form.Group>
                                <Form.Label>Équipement</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="equipment"
                                    value={formData.equipment}
                                    onChange={handleChange}
                                />
                            </Form.Group>
                        </div>

                        <div className="form-row-grid">
                            <Form.Group>
                                <Form.Label>Montant</Form.Label>
                                <Form.Control
                                    type="number"
                                    name="amount"
                                    value={formData.amount}
                                    onChange={handleChange}
                                />
                            </Form.Group>
                            <Form.Group>
                                <Form.Label>Région</Form.Label>
                                <Form.Select
                                    name="region_id"
                                    value={formData.region_id || ''}
                                    onChange={handleChange}
                                >
                                    <option value="">Sélectionner une région</option>
                                    {regions?.map(region => (
                                        <option key={region.id} value={region.id}>
                                            {region.name}
                                        </option>
                                    ))}
                                </Form.Select>
                            </Form.Group>
                        </div>

                        <div className="form-row-grid technicians-grid">
                            <Form.Group>
                                <Form.Label>Technicien 1</Form.Label>
                                <Form.Select
                                    name="technician1_id"
                                    value={formData.technician1_id || ''}
                                    onChange={handleChange}
                                >
                                    <option value="">Sélectionner un technicien</option>
                                    {technicians?.map(tech => (
                                        <option key={tech.id} value={tech.id}>
                                            {tech.first_name} {tech.last_name}
                                        </option>
                                    ))}
                                </Form.Select>
                            </Form.Group>
                            <Form.Group>
                                <Form.Label>Technicien 2</Form.Label>
                                <Form.Select
                                    name="technician2_id"
                                    value={formData.technician2_id || ''}
                                    onChange={handleChange}
                                >
                                    <option value="">Sélectionner un technicien</option>
                                    {technicians?.map(tech => (
                                        <option key={tech.id} value={tech.id}>
                                            {tech.first_name} {tech.last_name}
                                        </option>
                                    ))}
                                </Form.Select>
                            </Form.Group>
                            <Form.Group>
                                <Form.Label>Technicien 3</Form.Label>
                                <Form.Select
                                    name="technician3_id"
                                    value={formData.technician3_id || ''}
                                    onChange={handleChange}
                                >
                                    <option value="">Sélectionner un technicien</option>
                                    {technicians?.map(tech => (
                                        <option key={tech.id} value={tech.id}>
                                            {tech.first_name} {tech.last_name}
                                        </option>
                                    ))}
                                </Form.Select>
                            </Form.Group>
                            <Form.Group>
                                <Form.Label>Technicien 4</Form.Label>
                                <Form.Select
                                    name="technician4_id"
                                    value={formData.technician4_id || ''}
                                    onChange={handleChange}
                                >
                                    <option value="">Sélectionner un technicien</option>
                                    {technicians?.map(tech => (
                                        <option key={tech.id} value={tech.id}>
                                            {tech.first_name} {tech.last_name}
                                        </option>
                                    ))}
                                </Form.Select>
                            </Form.Group>
                        </div>
                    </>
                );
            case 'formation':
            case 'maladie':
            case 'conge':
                return (
                    <Form.Group className="mb-3">
                        <Form.Label>Commercial</Form.Label>
                        <Form.Select
                            name="employee_id"
                            value={formData.employee_id || ''}
                            onChange={handleChange}
                        >
                            <option value="">Sélectionner un commercial</option>
                            {employees?.map(emp => (
                                <option key={emp.id} value={emp.id}>
                                    {emp.first_name} {emp.last_name}
                                </option>
                            ))}
                        </Form.Select>
                    </Form.Group>
                );
            case 'vacances':
                return (
                    <>
                        <Form.Group className="mb-3">
                            <Form.Label>Commercial</Form.Label>
                            <Form.Select
                                name="employee_id"
                                value={formData.employee_id || ''}
                                onChange={handleChange}
                            >
                                <option value="">Sélectionner un commercial</option>
                                {employees?.map(emp => (
                                    <option key={emp.id} value={emp.id}>
                                        {emp.first_name} {emp.last_name}
                                    </option>
                                ))}
                            </Form.Select>
                        </Form.Group>
                        {!formData.vacation_group_id && (
                            <>
                                <Form.Group className="mb-3">
                                    <Form.Label>Date de début</Form.Label>
                                    <DatePicker
                                        selected={formData.vacation_group_start_date || formData.date}
                                        onChange={date => setFormData(prev => ({
                                            ...prev,
                                            vacation_group_start_date: date
                                        }))}
                                        dateFormat="dd/MM/yyyy"
                                        locale={fr}
                                        className="form-control"
                                    />
                                </Form.Group>
                                <Form.Group className="mb-3">
                                    <Form.Label>Date de fin</Form.Label>
                                    <DatePicker
                                        selected={formData.vacation_group_end_date || formData.date}
                                        onChange={date => setFormData(prev => ({
                                            ...prev,
                                            vacation_group_end_date: date
                                        }))}
                                        dateFormat="dd/MM/yyyy"
                                        locale={fr}
                                        className="form-control"
                                        minDate={formData.vacation_group_start_date || formData.date}
                                    />
                                </Form.Group>
                            </>
                        )}
                    </>
                );
            default:
                return null;
        }
    };

    return (
        <Modal show={show} onHide={onHide} centered className="custom-modal">
            <Modal.Header closeButton>
                <Modal.Title>
                    {event ? 'Modifier l\'événement' : 'Ajouter un événement'}
                </Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <Form onSubmit={handleSubmit}>
                    <Form.Group className="mb-3">
                        <Form.Label>Type</Form.Label>
                        <Form.Select
                            name="type"
                            value={event?.type || formData.type}
                            onChange={handleChange}
                            disabled={true}
                        >
                            <option value="">Sélectionner un type</option>
                            <option value="installation">Installation</option>
                            <option value="formation">Formation</option>
                            <option value="conge">Congé</option>
                            <option value="maladie">Maladie</option>
                            <option value="vacances">Vacances</option>
                        </Form.Select>
                    </Form.Group>

                    <Form.Group className="mb-3">
                        <Form.Label>Date</Form.Label>
                        <DatePicker
                            selected={formData.date}
                            onChange={date => setFormData(prev => ({ ...prev, date }))}
                            dateFormat="dd/MM/yyyy"
                            locale={fr}
                            className="form-control"
                        />
                    </Form.Group>

                    {renderFormFields()}
                </Form>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={onHide}>
                    Annuler
                </Button>
                <Button variant="primary" onClick={handleSubmit}>
                    {event ? 'Modifier' : 'Ajouter'}
                </Button>
            </Modal.Footer>
        </Modal>
    );
};

export default EditEventModal; 