import React, { useState } from 'react';
import './ProgressionTask.css';

const ProgressionTask = () => {
  const [taskCode, setTaskCode] = useState('');
  const [task, setTask] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const searchTask = async () => {
    if (!taskCode) {
      setError('Veuillez entrer un code de tâche');
      return;
    }

    setLoading(true);
    setError(null);
    setTask(null);

    try {
      const response = await fetch(`/api/progression/tasks.php?code=${encodeURIComponent(taskCode)}`);
      const data = await response.json();

      if (!data.success) {
        throw new Error(data.error || 'Erreur lors de la recherche');
      }

      if (data.data && data.data.length > 0) {
        setTask(data.data[0]);
      } else {
        setError('Aucune tâche trouvée avec ce code');
      }
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  const formatDate = (dateString) => {
    if (!dateString) return 'Non définie';
    return new Date(dateString).toLocaleString('fr-CA');
  };

  const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-CA', {
      style: 'currency',
      currency: 'CAD'
    }).format(price);
  };

  const handleKeyPress = (e) => {
    if (e.key === 'Enter') {
      searchTask();
    }
  };

  return (
    <div className="progression-task">
      <div className="search-section">
        <input 
          value={taskCode}
          onChange={(e) => setTaskCode(e.target.value)}
          onKeyPress={handleKeyPress}
          placeholder="Entrez le code de la tâche"
        />
        <button onClick={searchTask} disabled={loading}>
          {loading ? 'Recherche...' : 'Rechercher'}
        </button>
      </div>

      {error && (
        <div className="error">
          {error}
        </div>
      )}

      {task && (
        <div className="task-details">
          <h2>Détails de la tâche</h2>
          <div className="task-header">
            <div className="task-code">Code: {task.code}</div>
            <div className="task-summary">{task.summary}</div>
          </div>

          <div className="task-description">
            {task.description}
          </div>

          <div className="task-info">
            <div className="info-item">
              <strong>Date:</strong> {formatDate(task.date)}
            </div>
            <div className="info-item">
              <strong>Client:</strong> {task.client}
            </div>
            <div className="info-item">
              <strong>Ressource:</strong> {task.resource}
            </div>
          </div>

          {task.items && task.items.length > 0 && (
            <div className="task-items">
              <h3>Items</h3>
              <table>
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  {task.items.map((item) => (
                    <tr key={item.label}>
                      <td>{item.label}</td>
                      <td>{item.quantity}</td>
                      <td>{formatPrice(item.price)}</td>
                      <td>{formatPrice(item.total)}</td>
                    </tr>
                  ))}
                </tbody>
                <tfoot>
                  <tr>
                    <td colSpan="3"><strong>Total</strong></td>
                    <td><strong>{formatPrice(task.total)}</strong></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          )}
        </div>
      )}
    </div>
  );
};

export default ProgressionTask; 