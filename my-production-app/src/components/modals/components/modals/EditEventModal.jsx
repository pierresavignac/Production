const EditEventModal = ({ event, onClose, onSubmit, employees, editMode = 'individual' }) => {
  const [formData, setFormData] = useState({
    type: event.type || 'installation',
    firstName: event.first_name || '',
    lastName: event.last_name || '',
    installationNumber: event.installation_number || '',
    installationTime: event.installation_time || '',
    city: event.city || '',
    equipment: event.equipment || '',
    amount: event.amount || '',
    technician1_id: event.technician1_id || '',
    technician2_id: event.technician2_id || '',
    technician3_id: event.technician3_id || '',
    technician4_id: event.technician4_id || '',
    employee_id: event.employee_id || '',
    region_id: event.region_id || '',
    date: event.date || format(new Date(), 'yyyy-MM-dd'),
    startDate: event.vacation_group_start_date || event.date,
    endDate: event.vacation_group_end_date || event.date,
    vacation_group_id: event.vacation_group_id || null
  });

  // ... existing useEffect and other handlers ...

  const handleSubmit = (e) => {
    e.preventDefault();
    const submissionData = {
      ...formData,
      id: event.id,
      updateMode: editMode
    };

    onSubmit(submissionData);
  };

  return (
    <div className="modal-overlay">
      <div className={`modal-content ${formData.type === 'installation' ? 'installation-modal' : ''}`}>
        <div className="modal-header">
          <h2>Modifier la tâche</h2>
          <button onClick={onClose} className="close-button">&times;</button>
        </div>
        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <label>Type de tâche</label>
            <select 
              name="type" 
              value={formData.type} 
              onChange={handleChange}
              required
              disabled={true}
            >
              <option value="installation">Installation</option>
              <option value="conge">Congé</option>
              <option value="maladie">Maladie</option>
              <option value="formation">Formation</option>
              <option value="vacances">Vacances</option>
            </select>
          </div>

          {formData.type === 'vacances' && editMode === 'group' ? (
            <>
              <div className="form-row-grid">
                <div className="form-group">
                  <label>Date de début</label>
                  <input
                    type="date"
                    name="startDate"
                    value={formData.startDate}
                    onChange={handleChange}
                    required
                  />
                </div>
                <div className="form-group">
                  <label>Date de fin</label>
                  <input
                    type="date"
                    name="endDate"
                    value={formData.endDate}
                    min={formData.startDate}
                    onChange={handleChange}
                    required
                  />
                </div>
              </div>
              <div className="form-group">
                <label>Technicien</label>
                <select
                  name="employee_id"
                  value={formData.employee_id}
                  onChange={handleChange}
                  required
                  disabled={true}
                >
                  <option value="">Sélectionnez un technicien</option>
                  {technicians.map(technician => (
                    <option key={technician.id} value={technician.id}>
                      {`${technician.first_name} ${technician.last_name}`}
                    </option>
                  ))}
                </select>
              </div>
            </>
          ) : formData.type === 'vacances' ? (
            <>
              <div className="form-group">
                <label>Date</label>
                <input
                  type="date"
                  name="date"
                  value={formData.date}
                  onChange={handleChange}
                  required
                />
              </div>
              <div className="form-group">
                <label>Technicien</label>
                <select
                  name="employee_id"
                  value={formData.employee_id}
                  onChange={handleChange}
                  required
                  disabled={true}
                >
                  <option value="">Sélectionnez un technicien</option>
                  {technicians.map(technician => (
                    <option key={technician.id} value={technician.id}>
                      {`${technician.first_name} ${technician.last_name}`}
                    </option>
                  ))}
                </select>
              </div>
            </>
          ) : formData.type === 'installation' ? (
            // ... existing installation form ...
          ) : (
            // ... existing other types form ...
          )}

          <div className="button-group">
            <button type="button" onClick={onClose} className="close-button">
              Annuler
            </button>
            <button type="submit" className="action-button">
              Mettre à jour
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}; 