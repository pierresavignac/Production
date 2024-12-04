import React, { useState } from 'react';
import { Modal, Button, Form } from 'react-bootstrap';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import { fr } from 'date-fns/locale';
import '../../styles/Modal.css';

const VacationActionModal = ({ show, onHide, onConfirm, event, mode }) => {
    const [startDate, setStartDate] = useState(event?.vacation_group_start_date ? new Date(event.vacation_group_start_date) : new Date());
    const [endDate, setEndDate] = useState(event?.vacation_group_end_date ? new Date(event.vacation_group_end_date) : new Date());

    const handleSubmit = (e) => {
        e.preventDefault();
        onConfirm({
            startDate: startDate.toISOString().split('T')[0],
            endDate: endDate.toISOString().split('T')[0],
            mode
        });
    };

    return (
        <Modal show={show} onHide={onHide} centered className="custom-modal">
            <Modal.Header closeButton>
                <Modal.Title>
                    {mode === 'edit' ? 'Modifier les vacances groupées' : 'Supprimer les vacances groupées'}
                </Modal.Title>
            </Modal.Header>
            <Modal.Body>
                {mode === 'edit' ? (
                    <Form onSubmit={handleSubmit}>
                        <Form.Group className="mb-3">
                            <Form.Label>Date de début</Form.Label>
                            <DatePicker
                                selected={startDate}
                                onChange={date => setStartDate(date)}
                                selectsStart
                                startDate={startDate}
                                endDate={endDate}
                                dateFormat="dd/MM/yyyy"
                                locale={fr}
                                className="form-control"
                            />
                        </Form.Group>
                        <Form.Group className="mb-3">
                            <Form.Label>Date de fin</Form.Label>
                            <DatePicker
                                selected={endDate}
                                onChange={date => setEndDate(date)}
                                selectsEnd
                                startDate={startDate}
                                endDate={endDate}
                                minDate={startDate}
                                dateFormat="dd/MM/yyyy"
                                locale={fr}
                                className="form-control"
                            />
                        </Form.Group>
                    </Form>
                ) : (
                    <p>Êtes-vous sûr de vouloir supprimer toutes les vacances de ce groupe ?</p>
                )}
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={onHide}>
                    Annuler
                </Button>
                <Button 
                    variant={mode === 'edit' ? "primary" : "danger"} 
                    onClick={handleSubmit}
                >
                    {mode === 'edit' ? 'Modifier' : 'Supprimer'}
                </Button>
            </Modal.Footer>
        </Modal>
    );
};

export default VacationActionModal; 