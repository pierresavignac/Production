import React, { useState, useEffect, useRef } from 'react';
import { addWeeks, subWeeks } from 'date-fns';

// Import des composants
import AddEventModal from './modals/AddEventModal';
import EditEventModal from './modals/EditEventModal';
import EventDetailsModal from './modals/EventDetailsModal';
import ListView from './views/ListView';
import BlockView from './views/BlockView';

// Import des utilitaires
import { calculateWeeks, isCurrentDay, isCurrentWeek, formatDayHeader, formatDateForAPI } from '../utils/dateUtils';
import { getEventsForDay } from '../utils/eventUtils';
import { fetchEvents, fetchEmployees, createEvent, updateEvent, deleteEvent } from '../utils/apiUtils';

// Import des styles
import '../styles/ProductionCalendar.css';

const ProductionCalendar = () => {
  // États
  const [events, setEvents] = useState({});
  const [showAddEventModal, setShowAddEventModal] = useState(false);
  const [showEventDetailsModal, setShowEventDetailsModal] = useState(false);
  const [showEditEventModal, setShowEditEventModal] = useState(false);
  const [selectedDate, setSelectedDate] = useState(null);
  const [selectedEvent, setSelectedEvent] = useState(null);
  const [error, setError] = useState('');
  const [employees, setEmployees] = useState([]);
  const [viewMode, setViewMode] = useState('calendar');
  const [currentDate, setCurrentDate] = useState(new Date());
  
  // Refs
  const scrollRef = useRef(null);

  // Variables
  const weeks = calculateWeeks(currentDate);

  // Navigation des semaines
  const goToPreviousWeek = () => {
    setCurrentDate(prev => subWeeks(prev, 1));
  };

  const goToNextWeek = () => {
    setCurrentDate(prev => addWeeks(prev, 1));
  };

  const goToCurrentWeek = () => {
    setCurrentDate(new Date());
  };

  // Chargement initial des données
  useEffect(() => {
    const initializeApp = async () => {
      try {
        const [employeesData, eventsData] = await Promise.all([
          fetchEmployees(),
          fetchEvents()
        ]);

        setEmployees(employeesData);

        // Grouper les événements par date
        const groupedEvents = eventsData.reduce((acc, event) => {
          if (!acc[event.date]) {
            acc[event.date] = [];
          }
          acc[event.date].push(event);
          return acc;
        }, {});

        setEvents(groupedEvents);
      } catch (error) {
        console.error('Erreur lors de l\'initialisation:', error);
        setError('Erreur lors du chargement des données. Veuillez rafraîchir la page.');
      }
    };

    initializeApp();
  }, []);

  // Scroll automatique vers la semaine courante
  useEffect(() => {
    const scrollToCurrentWeek = () => {
      const container = viewMode === 'calendar' ? scrollRef.current : document.querySelector('.list-view');
      if (!container) return;

      const weekElements = container.querySelectorAll('.week-section');
      const weekArray = Array.from(weekElements);
      const currentWeekIndex = weekArray.findIndex(el => el.getAttribute('data-is-current') === 'true');
      
      if (currentWeekIndex !== -1) {
        const targetWeek = weekArray[currentWeekIndex];
        const headerHeight = 60;
        const padding = 20;
        const elementTop = targetWeek.offsetTop;
        
        container.scrollTo({
          top: Math.max(0, elementTop - headerHeight - padding),
          behavior: 'smooth'
        });
      }
    };

    requestAnimationFrame(scrollToCurrentWeek);
  }, [currentDate, viewMode]);

  // Gestionnaires d'événements
  const handleDateClick = (date) => {
    setSelectedDate(date);
    setShowAddEventModal(true);
  };

  const handleEventClick = (event) => {
    setSelectedEvent(event);
    setShowEventDetailsModal(true);
  };

  const handleAddEventSubmit = async (formData) => {
    try {
      const eventData = {
        type: formData.type,
        date: formatDateForAPI(selectedDate),
        first_name: formData.firstName,
        last_name: formData.lastName,
        installation_number: formData.installationNumber,
        installation_time: formData.installationTime,
        city: formData.city,
        equipment: formData.equipment,
        amount: formData.amount,
        technician1_id: formData.technician1_id || null,
        technician2_id: formData.technician2_id || null,
        technician3_id: formData.technician3_id || null,
        technician4_id: formData.technician4_id || null,
        employee_id: formData.type === 'installation' ? null : formData.employee_id,
        region_id: formData.region_id || null
      };

      await createEvent(eventData);
      setShowAddEventModal(false);
      setSelectedDate(null);
      
      const eventsData = await fetchEvents();
      const groupedEvents = eventsData.reduce((acc, event) => {
        if (!acc[event.date]) {
          acc[event.date] = [];
        }
        acc[event.date].push(event);
        return acc;
      }, {});

      setEvents(groupedEvents);
    } catch (error) {
      console.error('Erreur lors de l\'ajout:', error);
      setError(`Erreur lors de l'ajout : ${error.message}`);
    }
  };

  const handleEditEventSubmit = async (formData) => {
    try {
      const eventData = {
        id: selectedEvent?.id,
        type: formData.type || 'installation',
        date: formData.date,
        first_name: formData.firstName,
        last_name: formData.lastName,
        installation_number: formData.installationNumber,
        installation_time: formData.installationTime,
        city: formData.city,
        equipment: formData.equipment,
        amount: formData.amount,
        technician1_id: formData.technician1_id || null,
        technician2_id: formData.technician2_id || null,
        technician3_id: formData.technician3_id || null,
        technician4_id: formData.technician4_id || null,
        employee_id: formData.type === 'installation' ? null : formData.employee_id,
        region_id: formData.region_id
      };

      await updateEvent(eventData);
      setShowEditEventModal(false);
      setSelectedEvent(null);
      
      const eventsData = await fetchEvents();
      const groupedEvents = eventsData.reduce((acc, event) => {
        if (!acc[event.date]) {
          acc[event.date] = [];
        }
        acc[event.date].push(event);
        return acc;
      }, {});

      setEvents(groupedEvents);
    } catch (error) {
      console.error('Erreur lors de la modification:', error);
      setError(error.message);
    }
  };

  const handleDeleteEvent = async (eventId) => {
    try {
      await deleteEvent(eventId);
      setShowEventDetailsModal(false);
      setSelectedEvent(null);
      
      const eventsData = await fetchEvents();
      const groupedEvents = eventsData.reduce((acc, event) => {
        if (!acc[event.date]) {
          acc[event.date] = [];
        }
        acc[event.date].push(event);
        return acc;
      }, {});

      setEvents(groupedEvents);
    } catch (error) {
      console.error('Erreur lors de la suppression:', error);
      setError(`Erreur lors de la suppression : ${error.message}`);
    }
  };

  // Rendu
  return (
    <div>
      <div className="navigation-bar">
        <h1 className="app-title">
          Calendrier de production {new Date().getFullYear()}
        </h1>
        <div className="navigation-controls">
          <button
            className="view-toggle-button"
            onClick={() => setViewMode(viewMode === 'calendar' ? 'list' : 'calendar')}
          >
            {viewMode === 'calendar' ? 'Vue Liste' : 'Vue Bloc'}
          </button>
          <div className="navigation-buttons">
            <button 
              className="navigation-button previous" 
              onClick={goToPreviousWeek}
            >
              Semaine précédente
            </button>
            <button 
              className="navigation-button current" 
              onClick={goToCurrentWeek}
            >
              Semaine courante
            </button>
            <button 
              className="navigation-button next" 
              onClick={goToNextWeek}
            >
              Semaine suivante
            </button>
          </div>
        </div>
      </div>

      {error && (
        <div className="error-message">
          {error}
          <button onClick={() => setError('')}>&times;</button>
        </div>
      )}

      <div className="calendar-container" ref={scrollRef}>
        {viewMode === 'calendar' ? (
          <BlockView
            weeks={weeks}
            events={events}
            handleDateClick={handleDateClick}
            handleEventClick={handleEventClick}
            isCurrentWeek={isCurrentWeek}
            isCurrentDay={isCurrentDay}
            getEventsForDay={getEventsForDay}
            formatDayHeader={formatDayHeader}
          />
        ) : (
          <ListView
            weeks={weeks}
            events={events}
            handleDateClick={handleDateClick}
            handleEventClick={handleEventClick}
            isCurrentWeek={isCurrentWeek}
            isCurrentDay={isCurrentDay}
            getEventsForDay={getEventsForDay}
          />
        )}
      </div>

      {showAddEventModal && (
        <AddEventModal
          onClose={() => {
            setShowAddEventModal(false);
            setSelectedDate(null);
          }}
          onSubmit={handleAddEventSubmit}
          selectedDate={selectedDate}
          employees={employees}
        />
      )}

      {showEventDetailsModal && selectedEvent && (
        <EventDetailsModal
          event={selectedEvent}
          onClose={() => {
            setShowEventDetailsModal(false);
            setSelectedEvent(null);
          }}
          onEdit={(event) => {
            setShowEventDetailsModal(false);
            setShowEditEventModal(true);
          }}
          onDelete={handleDeleteEvent}
        />
      )}

      {showEditEventModal && selectedEvent && (
        <EditEventModal
          event={selectedEvent}
          onClose={() => {
            setShowEditEventModal(false);
            setSelectedEvent(null);
          }}
          onSubmit={handleEditEventSubmit}
          employees={employees}
        />
      )}
    </div>
  );
};

export default ProductionCalendar; 