import { format } from 'date-fns';

export const getEventsForDay = (date, events) => {
  const dateStr = format(date, 'yyyy-MM-dd');
  return events[dateStr] || [];
};

export const sortEventsByTime = (events) => {
  return [...events].sort((a, b) => {
    if (a.type === 'installation' && b.type === 'installation') {
      return a.installation_time.localeCompare(b.installation_time);
    }
    if (a.type === 'installation') return -1;
    if (b.type === 'installation') return 1;
    return 0;
  });
};

export const getEventTypeColor = (type) => {
  switch (type) {
    case 'installation':
      return {
        background: '#e3f2fd',
        border: '#bbdefb'
      };
    case 'conge':
      return {
        background: '#e8f5e9',
        border: '#c8e6c9'
      };
    case 'maladie':
      return {
        background: '#ffebee',
        border: '#ffcdd2'
      };
    case 'formation':
      return {
        background: '#fff3e0',
        border: '#ffe0b2'
      };
    case 'vacances':
      return {
        background: '#ffd700',
        border: '#daa520',
        color: '#000000'
      };
    default:
      return {
        background: '#f5f5f5',
        border: '#e0e0e0'
      };
  }
};

export const getEventTypeLabel = (type) => {
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