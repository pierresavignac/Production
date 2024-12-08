import React, { useState, useEffect } from 'react';
import { Modal, Button, Form, Row, Col, Alert } from 'react-bootstrap';
import { fetchProgressionTask } from '../../utils/apiUtils';

const HOUSE_TYPES = [
    'Bungalow', 'Cottage', 'Maison de ville', 'Split Level', 'Maison mobile',
    'Condo', 'Bloc appartement', 'Duplex', 'Triplex', 'Quatriplex'
];

const SUPPORT_TYPES = [
    'Au sol', 'Au mur', 'Au sol nain', 'Au mur nain'
];

const DEFAULT_ALUMINUM_COLORS = [
    'Blanc', 'Ivoire', 'Argile', 'Kaki', 'Sable', 'Gris Granite',
    'Brun Commercial', 'Noir', 'Rouge Majestueux'
];

const DEFAULT_PANELS = [
    'I-T-E', 'Commander', 'Cutler-Hammer', 'Fereral Pioneer', 'GE', 'Schneider',
    'Seimens', 'SquareD', 'Stab-Lok', 'Sylvania', 'Westinghouse'
];

const WorksheetModal = ({ show, onHide, installation, employees = [], mode = 'worksheet' }) => {
    const [isReadOnly] = useState(mode === 'worksheet');
    const [formData, setFormData] = useState({
        full_name: installation?.full_name || '',
        address: '',
        phone: '',
        city: '',
        date: '',
        time: '',
        installation_number: installation?.installation_number ? 
            (installation.installation_number.startsWith('INS0') ? installation.installation_number : 'INS0' + installation.installation_number) : 'INS0',
        summary: '',
        description: '',
        amount: '',
        progression_task_id: '',
        hasVisit: false,
        visitorName: '',
        houseType: '',
        aluminum1: '',
        lengthCount1: 1,
        aluminum2: '',
        lengthCount2: 1,
        supportType: '',
        electricPanel: '',
        hasPanelSpace: true,
        basement: '',
        installationType: '',
        subInstallationType: '',
        particularities: {
            drainPump: false,
            backToBack: false,
            replacement: false,
            attic: false,
            onRoof: false
        }
    });

    const [showPanelManagement, setShowPanelManagement] = useState(false);
    const [showAluminumManagement, setShowAluminumManagement] = useState(false);
    
    const [panels, setPanels] = useState(
        DEFAULT_PANELS
            .map((name, id) => ({ id, name }))
            .sort((a, b) => a.name.localeCompare(b.name, 'fr'))
    );
    const [aluminumColors, setAluminumColors] = useState(
        DEFAULT_ALUMINUM_COLORS
            .map((name, id) => ({ id, name }))
            .sort((a, b) => a.name.localeCompare(b.name, 'fr'))
    );
    const [newPanelName, setNewPanelName] = useState('');
    const [newColorName, setNewColorName] = useState('');
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [notification, setNotification] = useState({ type: '', message: '' });
    const [fetchError, setFetchError] = useState('');

    useEffect(() => {
        if (installation) {
            setFormData(prev => ({
                ...prev,
                full_name: installation.full_name || '',
                installation_number: installation.installation_number ? 
                    (installation.installation_number.startsWith('INS0') ? installation.installation_number : 'INS0' + installation.installation_number) : 'INS0'
            }));
        }
    }, [installation]);

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

    const handlePanelManagement = () => {
        setShowPanelManagement(true);
    };

    const handleAluminumManagement = () => {
        setShowAluminumManagement(true);
    };

    const handleAddPanel = async () => {
        if (!newPanelName.trim()) return;
        
        const newPanel = {
            id: panels.length,
            name: newPanelName.trim()
        };

        setPanels(prevPanels => 
            [...prevPanels, newPanel]
                .sort((a, b) => a.name.localeCompare(b.name, 'fr'))
        );
        setNewPanelName('');
    };

    const handleDeletePanel = async (panelId) => {
        setPanels(panels.filter(panel => panel.id !== panelId));
    };

    const handleAddColor = async () => {
        if (!newColorName.trim()) return;
        
        const newColor = {
            id: aluminumColors.length,
            name: newColorName.trim()
        };

        setAluminumColors(prevColors => 
            [...prevColors, newColor]
                .sort((a, b) => a.name.localeCompare(b.name, 'fr'))
        );
        setNewColorName('');
    };

    const handleDeleteColor = async (colorId) => {
        setAluminumColors(aluminumColors.filter(color => color.id !== colorId));
    };

    const handleSave = async () => {
        try {
            setIsSubmitting(true);
            setNotification({ type: '', message: '' });

            const worksheetData = {
                installation_id: parseInt(installation.id, 10),
                full_name: formData.full_name || '',
                address: formData.address || '',
                phone: formData.phone || '',
                city: formData.city || '',
                has_visit: Boolean(formData.hasVisit),
                visitor_name: formData.visitorName || '',
                house_type: formData.houseType || '',
                aluminum1: formData.aluminum1 || '',
                length_count1: parseInt(formData.lengthCount1, 10) || 1,
                aluminum2: formData.aluminum2 || '',
                length_count2: parseInt(formData.lengthCount2, 10) || 1,
                support_type: formData.supportType || '',
                electric_panel: formData.electricPanel || '',
                has_panel_space: Boolean(formData.hasPanelSpace),
                basement: formData.basement || '',
                installation_type: formData.installationType || '',
                sub_installation_type: formData.subInstallationType || '',
                amount: formData.amount || '',
                progression_task_id: formData.progression_task_id || '',
                particularities: {
                    drainPump: Boolean(formData.particularities.drainPump),
                    backToBack: Boolean(formData.particularities.backToBack),
                    replacement: Boolean(formData.particularities.replacement),
                    attic: Boolean(formData.particularities.attic),
                    onRoof: Boolean(formData.particularities.onRoof)
                }
            };

            console.log('Données formatées à envoyer:', worksheetData);

            const response = await fetch('../api/worksheets.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(worksheetData)
            });

            console.log('URL de l\'API:', response.url);

            const responseText = await response.text();
            console.log('Réponse brute du serveur:', responseText);

            let data;
            try {
                data = JSON.parse(responseText);
            } catch (e) {
                throw new Error(`Réponse invalide du serveur: ${responseText}`);
            }

            if (!response.ok) {
                throw new Error(data.error || `Erreur HTTP: ${response.status}`);
            }

            console.log('Réponse du serveur (parsée):', data);

            setNotification({
                type: 'success',
                message: 'Feuille de travail enregistrée avec succès'
            });

            setTimeout(() => {
                onHide();
            }, 1500);
        } catch (error) {
            console.error('Erreur détaillée:', error);
            setNotification({
                type: 'error',
                message: `Erreur lors de la sauvegarde: ${error.message}`
            });
        } finally {
            setIsSubmitting(false);
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

    const renderPanelManagementModal = () => (
        <Modal show={showPanelManagement} onHide={() => setShowPanelManagement(false)}>
            <Modal.Header closeButton>
                <Modal.Title>Gestion des panneaux électriques</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                {error && (
                    <div className="alert alert-danger">{error}</div>
                )}
                <Form.Group>
                    <Form.Label>Ajouter un nouveau panneau</Form.Label>
                    <div className="d-flex gap-2">
                        <Form.Control
                            type="text"
                            value={newPanelName}
                            onChange={(e) => setNewPanelName(e.target.value)}
                            placeholder="Nom du panneau"
                        />
                        <Button 
                            variant="primary" 
                            onClick={handleAddPanel}
                            disabled={isLoading || !newPanelName.trim()}
                        >
                            Ajouter
                        </Button>
                    </div>
                </Form.Group>
                <div className="mt-3">
                    <h6>Panneaux existants</h6>
                    {isLoading ? (
                        <p>Chargement...</p>
                    ) : (
                        <ul className="list-group">
                            {panels.map((panel) => (
                                <li key={panel.id} className="list-group-item d-flex justify-content-between align-items-center">
                                    {panel.name}
                                    <Button 
                                        variant="danger" 
                                        size="sm" 
                                        onClick={() => handleDeletePanel(panel.id)}
                                        disabled={isLoading}
                                    >
                                        Supprimer
                                    </Button>
                                </li>
                            ))}
                        </ul>
                    )}
                </div>
            </Modal.Body>
        </Modal>
    );

    const renderAluminumManagementModal = () => (
        <Modal show={showAluminumManagement} onHide={() => setShowAluminumManagement(false)}>
            <Modal.Header closeButton>
                <Modal.Title>Gestion des couleurs d'aluminium</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                {error && (
                    <div className="alert alert-danger">{error}</div>
                )}
                <Form.Group>
                    <Form.Label>Ajouter une nouvelle couleur</Form.Label>
                    <div className="d-flex gap-2">
                        <Form.Control
                            type="text"
                            value={newColorName}
                            onChange={(e) => setNewColorName(e.target.value)}
                            placeholder="Nom de la couleur"
                        />
                        <Button 
                            variant="primary" 
                            onClick={handleAddColor}
                            disabled={isLoading || !newColorName.trim()}
                        >
                            Ajouter
                        </Button>
                    </div>
                </Form.Group>
                <div className="mt-3">
                    <h6>Couleurs existantes</h6>
                    {isLoading ? (
                        <p>Chargement...</p>
                    ) : (
                        <ul className="list-group">
                            {aluminumColors.map((color) => (
                                <li key={color.id} className="list-group-item d-flex justify-content-between align-items-center">
                                    {color.name}
                                    <Button 
                                        variant="danger" 
                                        size="sm" 
                                        onClick={() => handleDeleteColor(color.id)}
                                        disabled={isLoading}
                                    >
                                        Supprimer
                                    </Button>
                                </li>
                            ))}
                        </ul>
                    )}
                </div>
            </Modal.Body>
        </Modal>
    );

    return (
        <>
            <Modal show={show} onHide={onHide} size="lg">
                <Modal.Header closeButton>
                    <Modal.Title>
                        {mode === 'worksheet' 
                            ? `Feuille de travail - Installation ${installation?.installation_number}`
                            : 'Ajouter une tâche Installation'
                        }
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    {fetchError && (
                        <Alert variant="danger" className="mb-3">
                            {fetchError}
                        </Alert>
                    )}
                    {notification.message && (
                        <div className={`alert ${notification.type === 'success' ? 'alert-success' : 'alert-danger'} mb-3`}>
                            {notification.message}
                        </div>
                    )}
                    <Form>
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
                                    />
                                </Form.Group>
                            </Col>
                            <Col md={3}>
                                <Form.Group>
                                    <Form.Label>Heure</Form.Label>
                                    <Form.Control
                                        type="time"
                                        name="time"
                                        value={formData.time}
                                        onChange={handleChange}
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
                                        readOnly={isReadOnly}
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
                                        readOnly={isReadOnly}
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
                                        readOnly={isReadOnly}
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
                                        readOnly={isReadOnly}
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
                                        readOnly={isReadOnly}
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
                                        readOnly={isReadOnly}
                                    />
                                </Form.Group>
                            </Col>
                        </Row>

                        <Form.Group className="mb-3">
                            <Form.Label>Équipement</Form.Label>
                            <Form.Control
                                type="text"
                                name="equipment"
                                value={formData.equipment}
                                onChange={handleChange}
                                required
                                readOnly={isReadOnly}
                            />
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
                                readOnly={isReadOnly}
                            />
                        </Form.Group>

                        <Row className="mb-3">
                            <Col md={6}>
                                <Form.Group>
                                    <Form.Label>Visite</Form.Label>
                                    <Form.Select
                                        name="hasVisit"
                                        value={formData.hasVisit}
                                        onChange={handleChange}
                                    >
                                        <option value={false}>Non</option>
                                        <option value={true}>Oui</option>
                                    </Form.Select>
                                </Form.Group>
                            </Col>
                            {formData.hasVisit && (
                                <Col md={6}>
                                    <Form.Group>
                                        <Form.Label>Nom du visiteur</Form.Label>
                                        <Form.Select
                                            name="visitorName"
                                            value={formData.visitorName}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner un employé</option>
                                            {employees.map(employee => (
                                                <option key={employee.id} value={`${employee.first_name} ${employee.last_name}`}>
                                                    {`${employee.first_name} ${employee.last_name}`}
                                                </option>
                                            ))}
                                        </Form.Select>
                                    </Form.Group>
                                </Col>
                            )}
                        </Row>

                        <Form.Group className="mb-3">
                            <Form.Label>Type de construction</Form.Label>
                            <Form.Select
                                name="houseType"
                                value={formData.houseType}
                                onChange={handleChange}
                            >
                                <option value="">Sélectionner un type</option>
                                {HOUSE_TYPES.map(type => (
                                    <option key={type} value={type}>{type}</option>
                                ))}
                            </Form.Select>
                        </Form.Group>

                        <Row className="mb-3">
                            <Col md={8}>
                                <Form.Group>
                                    <Form.Label>Aluminium #1</Form.Label>
                                    <div className="d-flex gap-2">
                                        <Form.Select
                                            name="aluminum1"
                                            value={formData.aluminum1}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner une couleur</option>
                                            {aluminumColors.map(color => (
                                                <option key={color.id} value={color.name}>
                                                    {color.name}
                                                </option>
                                            ))}
                                        </Form.Select>
                                        <Button variant="outline-primary" onClick={handleAluminumManagement}>
                                            Gérer
                                        </Button>
                                    </div>
                                </Form.Group>
                            </Col>
                            <Col md={4}>
                                <Form.Group>
                                    <Form.Label>Nombre de longueur #1</Form.Label>
                                    <Form.Control
                                        type="number"
                                        name="lengthCount1"
                                        value={formData.lengthCount1}
                                        onChange={handleChange}
                                        min="1"
                                        max="5"
                                    />
                                </Form.Group>
                            </Col>
                        </Row>

                        <Row className="mb-3">
                            <Col md={8}>
                                <Form.Group>
                                    <Form.Label>Aluminium #2</Form.Label>
                                    <div className="d-flex gap-2">
                                        <Form.Select
                                            name="aluminum2"
                                            value={formData.aluminum2}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner une couleur</option>
                                            {aluminumColors.map(color => (
                                                <option key={color.id} value={color.name}>
                                                    {color.name}
                                                </option>
                                            ))}
                                        </Form.Select>
                                        <Button variant="outline-primary" onClick={handleAluminumManagement}>
                                            Gérer
                                        </Button>
                                    </div>
                                </Form.Group>
                            </Col>
                            <Col md={4}>
                                <Form.Group>
                                    <Form.Label>Nombre de longueur #2</Form.Label>
                                    <Form.Control
                                        type="number"
                                        name="lengthCount2"
                                        value={formData.lengthCount2}
                                        onChange={handleChange}
                                        min="1"
                                        max="5"
                                    />
                                </Form.Group>
                            </Col>
                        </Row>

                        <Row className="mb-3">
                            <Col md={6}>
                                <Form.Group>
                                    <Form.Label>Type de support</Form.Label>
                                    <Form.Select
                                        name="supportType"
                                        value={formData.supportType}
                                        onChange={handleChange}
                                    >
                                        <option value="">Sélectionner un type</option>
                                        {SUPPORT_TYPES.map(type => (
                                            <option key={type} value={type}>{type}</option>
                                        ))}
                                    </Form.Select>
                                </Form.Group>
                            </Col>
                            <Col md={6}>
                                <Form.Group>
                                    <Form.Label>Panneau électrique</Form.Label>
                                    <div className="d-flex gap-2">
                                        <Form.Select
                                            name="electricPanel"
                                            value={formData.electricPanel}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner un type</option>
                                            {panels.map(panel => (
                                                <option key={panel.id} value={panel.id}>{panel.name}</option>
                                            ))}
                                        </Form.Select>
                                        <Button variant="outline-primary" onClick={handlePanelManagement}>
                                            Gérer
                                        </Button>
                                    </div>
                                </Form.Group>
                            </Col>
                        </Row>

                        <Row className="mb-3">
                            <Col md={6}>
                                <Form.Group>
                                    <Form.Label>Espace disponible dans le panneau</Form.Label>
                                    <Form.Select
                                        name="hasPanelSpace"
                                        value={formData.hasPanelSpace}
                                        onChange={handleChange}
                                    >
                                        <option value={true}>Oui</option>
                                        <option value={false}>Non</option>
                                    </Form.Select>
                                </Form.Group>
                            </Col>
                            <Col md={6}>
                                <Form.Group>
                                    <Form.Label>Sous-sol</Form.Label>
                                    <Form.Select
                                        name="basement"
                                        value={formData.basement}
                                        onChange={handleChange}
                                    >
                                        <option value="">Sélectionner un type</option>
                                        <option value="Ouvert">Ouvert</option>
                                        <option value="Fermé">Fermé</option>
                                        <option value="Suspendu">Suspendu</option>
                                    </Form.Select>
                                </Form.Group>
                            </Col>
                        </Row>

                        <Row className="mb-3">
                            <Col md={6}>
                                <Form.Group>
                                    <Form.Label>Type d'installation</Form.Label>
                                    <Form.Select
                                        name="installationType"
                                        value={formData.installationType}
                                        onChange={handleChange}
                                    >
                                        <option value="">Sélectionner un type</option>
                                        <option value="Plafonnier">Plafonnier</option>
                                        <option value="Murale">Murale</option>
                                        <option value="Addon">Addon</option>
                                        <option value="Complet">Complet</option>
                                    </Form.Select>
                                </Form.Group>
                            </Col>
                            {(formData.installationType === 'Addon' || formData.installationType === 'Complet') && (
                                <Col md={6}>
                                    <Form.Group>
                                        <Form.Label>Sous-type d'installation</Form.Label>
                                        <Form.Select
                                            name="subInstallationType"
                                            value={formData.subInstallationType}
                                            onChange={handleChange}
                                        >
                                            <option value="">Sélectionner un type</option>
                                            {formData.installationType === 'Addon' && (
                                                <>
                                                    <option value="Électrique">Électrique</option>
                                                    <option value="Gaz">Gaz</option>
                                                    <option value="Huile">Huile</option>
                                                </>
                                            )}
                                            {formData.installationType === 'Complet' && (
                                                <>
                                                    <option value="Électrique">Électrique</option>
                                                    <option value="Gaz">Gaz</option>
                                                    <option value="Ventillo Convecteur">Ventillo Convecteur</option>
                                                </>
                                            )}
                                        </Form.Select>
                                    </Form.Group>
                                </Col>
                            )}
                        </Row>

                        <Form.Group className="mb-3">
                            <Form.Label>Particularités</Form.Label>
                            <div className="d-flex flex-column gap-2">
                                <Form.Check
                                    type="checkbox"
                                    label="Pompe à Drain"
                                    name="drainPump"
                                    checked={formData.particularities.drainPump}
                                    onChange={handleChange}
                                />
                                <Form.Check
                                    type="checkbox"
                                    label="Back à Back"
                                    name="backToBack"
                                    checked={formData.particularities.backToBack}
                                    onChange={handleChange}
                                />
                                <Form.Check
                                    type="checkbox"
                                    label="Remplacement"
                                    name="replacement"
                                    checked={formData.particularities.replacement}
                                    onChange={handleChange}
                                />
                                <Form.Check
                                    type="checkbox"
                                    label="Grenier"
                                    name="attic"
                                    checked={formData.particularities.attic}
                                    onChange={handleChange}
                                />
                                <Form.Check
                                    type="checkbox"
                                    label="Sur le toit"
                                    name="onRoof"
                                    checked={formData.particularities.onRoof}
                                    onChange={handleChange}
                                />
                            </div>
                        </Form.Group>
                    </Form>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={onHide} disabled={isSubmitting}>
                        Fermer
                    </Button>
                    <Button 
                        variant="primary" 
                        onClick={handleSave}
                        disabled={isSubmitting}
                    >
                        {isSubmitting ? 'Enregistrement...' : 'Enregistrer'}
                    </Button>
                </Modal.Footer>
            </Modal>

            {renderPanelManagementModal()}
            {renderAluminumManagementModal()}
        </>
    );
};

export default WorksheetModal; 