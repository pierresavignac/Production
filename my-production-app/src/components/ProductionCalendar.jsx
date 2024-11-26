import React, { useState, useEffect, useRef } from 'react';
import styled from 'styled-components';

// Liste des employés triée par nom de famille puis prénom
const EMPLOYEES = [
  { firstName: 'Luis', lastName: 'Becerra' },
  { firstName: 'Gérard', lastName: 'Chartrand' },
  { firstName: 'Jonathan', lastName: 'Diaz' },
  { firstName: 'Thierry', lastName: 'Diaz' },
  { firstName: 'Stefan', lastName: 'Hebert' },
  { firstName: 'Yvon-Pierre', lastName: 'Ménard' },
  { firstName: 'Pascal', lastName: 'Pascal' },
  { firstName: 'Isabelle', lastName: 'Raby' },
  { firstName: 'Pierre', lastName: 'Savignac' },
  { firstName: 'Jean-François', lastName: 'Sauvé' },
  { firstName: 'Benoit', lastName: 'Tremblay' },
  { firstName: 'Patrice', lastName: 'Tremblay' },
  { firstName: 'André', lastName: 'Villeneuve' },
].sort((a, b) => {
  // Trier d'abord par nom de famille
  const lastNameCompare = a.lastName.localeCompare(b.lastName);
  // Si même nom de famille, trier par prénom
  if (lastNameCompare === 0) {
    return a.firstName.localeCompare(b.firstName);
  }
  return lastNameCompare;
});

// Styled Components
const TopBar = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 60px;
  background: white;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px;
  z-index: 1000;
`;

const TopBarTitle = styled.h1`
  color: #2c3e50;
  font-size: 1.8rem;
  font-weight: 600;
`;

const TopBarButtons = styled.div`
  display: flex;
  align-items: center;
  gap: 15px;
`;

const ViewToggleButton = styled.button`
  background: #3498db;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.3s ease;
  margin-right: 15px;

  &:hover {
    background: #2980b9;
  }
`;

const CurrentWeekButton = styled.button`
  background: #2ecc71;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1rem;
  transition: background 0.3s ease;

  &:hover {
    background: #27ae60;
  }
`;

const CalendarContainer = styled.div`
  padding-top: 60px;
  height: 100vh;
  width: 100%;
  margin: 0;
  background: #fff;
  display: flex;
  flex-direction: column;
  overflow: hidden;
`;

const ScrollContainer = styled.div`
  flex: 1;
  overflow-y: auto;
  background: #f0f2f5;
  scroll-behavior: smooth;
  padding: 20px 0;
`;

const WeekSection = styled.div`
  margin: 0 0 20px 0;
  background: white;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  
  &:last-child {
    margin-bottom: 0;
  }

  ${props => props.$isCurrent && `
    border-left: 4px solid #2ecc71;
    background: #f8fff9;
  `}
`;

const WeekContainer = styled.div`
  display: grid;
  grid-template-columns: repeat(5, 1fr) auto;
  gap: 20px;
  padding: 0 20px;
  min-height: 200px;
  max-width: 1800px;
  margin: 0 auto;
`;

const DayBlock = styled.div`
  background: #f8f9fa;
  border-radius: 10px;
  padding: 15px;
  min-height: 100px;
  height: fit-content;
  border: 1px solid #e9ecef;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  gap: 10px;

  &:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }

  h3 {
    color: #2c3e50;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
    font-size: 1.1rem;
  }
`;

const AddButton = styled.button`
  width: 100%;
  padding: 8px;
  background: #ffffff;
  border: 2px dashed #bdc3c7;
  border-radius: 8px;
  cursor: pointer;
  color: #7f8c8d;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  margin-top: auto;
  
  &:hover {
    background: #f7f9fc;
    border-color: #3498db;
    color: #3498db;
  }
`;

// Modal Styled Components
const Modal = styled.div`
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1100;
`;

// Ajoutez ces nouveaux styled components pour la vue liste
const ListContainer = styled.div`
  padding: 20px;
  max-width: 1800px;
  margin: 0 auto;
`;

const ListItem = styled.div`
  background: white;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  display: flex;
  justify-content: space-between;
  align-items: center;

  ${props => props.$isCurrent && `
    border-left: 4px solid #2ecc71;
    background: #f8fff9;
  `}
`;

// Ajoutez ces styled components
const WeekendContainer = styled.div`
  display: flex;
  flex-direction: column;
  gap: 10px;
  justify-content: flex-start;
`;

const WeekendButton = styled.button`
  background: #f0f0f0;
  border: none;
  padding: 8px 15px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  width: 120px; // Largeur fixe pour les boutons
  
  &:hover {
    background: #e0e0e0;
  }
`;

// Ajoutez cette fonction de formatage de date
const formatDate = (date) => {
  return new Date(date).toLocaleDateString('fr-FR', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
};

// Composant Modal pour l'ajout d'événements
const AddEventModal = ({ date, onClose, onSubmit }) => {
  const [eventType, setEventType] = useState('');
  const [selectedEmployee, setSelectedEmployee] = useState('');
  const [installationData, setInstallationData] = useState({
    firstName: '',
    lastName: '',
    installationNumber: '',
    technicians: []
  });

  return (
    <Modal onClick={onClose}>
      <ModalContent onClick={e => e.stopPropagation()}>
        <h2>Ajouter un événement pour le {formatDate(date)}</h2>
        
        <SelectWrapper>
          <label>Type d'événement:</label>
          <select value={eventType} onChange={(e) => setEventType(e.target.value)}>
            <option value="">Sélectionner un type</option>
            <option value="conge">Congé</option>
            <option value="maladie">Maladie</option>
            <option value="installation">Installation</option>
          </select>
        </SelectWrapper>

        {/* Afficher la liste des employés pour Congé ou Maladie */}
        {(eventType === 'conge' || eventType === 'maladie') && (
          <SelectWrapper>
            <label>Employé:</label>
            <select 
              value={selectedEmployee} 
              onChange={(e) => setSelectedEmployee(e.target.value)}
            >
              <option value="">Sélectionner un employé</option>
              {EMPLOYEES.map((employee) => (
                <option 
                  key={`${employee.lastName}-${employee.firstName}`} 
                  value={`${employee.lastName}-${employee.firstName}`}
                >
                  {`${employee.lastName}, ${employee.firstName}`}
                </option>
              ))}
            </select>
          </SelectWrapper>
        )}

        {/* Formulaire pour Installation */}
        {eventType === 'installation' && (
          <InstallationForm>
            <InputGroup>
              <label>Nom:</label>
              <input
                type="text"
                value={installationData.lastName}
                onChange={(e) => setInstallationData({
                  ...installationData,
                  lastName: e.target.value
                })}
              />
            </InputGroup>

            <InputGroup>
              <label>Prénom:</label>
              <input
                type="text"
                value={installationData.firstName}
                onChange={(e) => setInstallationData({
                  ...installationData,
                  firstName: e.target.value
                })}
              />
            </InputGroup>

            <InputGroup>
              <label>Numéro d'installation:</label>
              <input
                type="text"
                placeholder="INS010145"
                value={installationData.installationNumber}
                onChange={(e) => setInstallationData({
                  ...installationData,
                  installationNumber: e.target.value
                })}
              />
            </InputGroup>

            <InputGroup>
              <label>Techniciens:</label>
              <select 
                multiple
                value={installationData.technicians}
                onChange={(e) => setInstallationData({
                  ...installationData,
                  technicians: Array.from(e.target.selectedOptions, option => option.value)
                })}
              >
                {EMPLOYEES.map((employee) => (
                  <option 
                    key={`${employee.lastName}-${employee.firstName}`} 
                    value={`${employee.lastName}-${employee.firstName}`}
                  >
                    {`${employee.lastName}, ${employee.firstName}`}
                  </option>
                ))}
              </select>
            </InputGroup>
          </InstallationForm>
        )}

        <ModalButtons>
          <button onClick={onClose}>Annuler</button>
          <button 
            onClick={() => onSubmit({ 
              type: eventType, 
              employee: selectedEmployee,
              installationData: eventType === 'installation' ? installationData : null
            })}
          >
            Confirmer
          </button>
        </ModalButtons>
      </ModalContent>
    </Modal>
  );
};

// Styles pour le modal
const ModalContent = styled.div`
  background: white;
  padding: 20px;
  border-radius: 8px;
  min-width: 400px;
  max-width: 600px;
`;

const SelectWrapper = styled.div`
  margin: 15px 0;
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  select {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
  }
`;

const InstallationForm = styled.div`
  margin: 15px 0;
`;

const InputGroup = styled.div`
  margin: 10px 0;
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input, select {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
  }
  
  select[multiple] {
    height: 120px;
  }
`;

const ModalButtons = styled.div`
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 20px;
  
  button {
    padding: 8px 16px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    
    &:first-child {
      background: #ddd;
    }
    
    &:last-child {
      background: #2ecc71;
      color: white;
    }
  }
`;

// Composant Principal
function ProductionCalendar() {
  const [viewMode, setViewMode] = useState('block');
  const [currentWeek, setCurrentWeek] = useState(new Date());
  const [installations, setInstallations] = useState({});
  const [visibleWeeks, setVisibleWeeks] = useState([]);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [selectedDate, setSelectedDate] = useState(null);
  const scrollRef = useRef(null);
  const [events, setEvents] = useState({});

  // Fonction pour générer les dates d'une semaine
  const getWeekDates = (baseDate) => {
    const start = new Date(baseDate);
    start.setDate(start.getDate() - start.getDay() + 1);
    return {
      start: new Date(start),
      dates: Array(7).fill().map((_, i) => {
        const date = new Date(start);
        date.setDate(date.getDate() + i);
        return date;
      })
    };
  };

  // Fonction pour vérifier si c'est la semaine courante
  const isCurrentWeek = (weekStart) => {
    const today = new Date();
    const currentWeekStart = new Date(today);
    currentWeekStart.setDate(today.getDate() - today.getDay() + 1);
    currentWeekStart.setHours(0, 0, 0, 0);
    
    const compareDate = new Date(weekStart);
    compareDate.setHours(0, 0, 0, 0);
    
    return compareDate.getTime() === currentWeekStart.getTime();
  };

  // Fonction pour générer plusieurs semaines
  const generateWeeks = (centerDate, numberOfWeeks = 9) => {
    const weeks = [];
    const middleIndex = Math.floor(numberOfWeeks / 2);
    
    for (let i = 0; i < numberOfWeeks; i++) {
      const weekOffset = i - middleIndex;
      const weekStartDate = new Date(centerDate);
      weekStartDate.setDate(weekStartDate.getDate() + (weekOffset * 7));
      weeks.push(getWeekDates(weekStartDate));
    }
    
    return weeks;
  };

  // Initialisation des semaines visibles
  useEffect(() => {
    const weeks = generateWeeks(currentWeek);
    setVisibleWeeks(weeks);
  }, [currentWeek]);

  const handleAddInstallation = (date) => {
    setSelectedDate(date);
    setIsModalOpen(true);
  };

  const handleModalSubmit = (eventData) => {
    const dateKey = formatDate(selectedDate);
    
    setEvents(prevEvents => ({
      ...prevEvents,
      [dateKey]: [
        ...(prevEvents[dateKey] || []),
        {
          id: Date.now(),
          type: eventData.type,
          employee: eventData.employee,
          installationData: eventData.installationData
        }
      ]
    }));

    setIsModalOpen(false);
  };

  const renderDayBlock = (date) => {
    const dateKey = formatDate(date);
    const dayEvents = events[dateKey] || [];
    
    return (
      <DayBlock key={dateKey}>
        <h3>{formatDate(date)}</h3>
        {dayEvents.map(event => (
          <EventItem key={event.id} $type={event.type}>
            {event.type === 'installation' ? (
              <>
                <strong>Installation</strong>
                <div>Client: {event.installationData.lastName}, {event.installationData.firstName}</div>
                <div>N°: {event.installationData.installationNumber}</div>
                <div>Techniciens: {event.installationData.technicians.join(', ')}</div>
              </>
            ) : (
              <>
                <strong>{event.type === 'conge' ? 'Congé' : 'Maladie'}</strong>
                <div>{event.employee.split('-').reverse().join(' ')}</div>
              </>
            )}
          </EventItem>
        ))}
        <AddButton onClick={() => handleAddInstallation(date)}>+</AddButton>
      </DayBlock>
    );
  };

  // Ajoutez cette fonction pour gérer le retour à la semaine courante
  const handleGoToCurrentWeek = () => {
    const today = new Date();
    setCurrentWeek(today);
    
    setTimeout(() => {
      const scrollContainer = scrollRef.current;
      
      if (viewMode === 'block') {
        // Logique pour la vue bloc
        const currentWeekElement = scrollContainer?.querySelector('[data-is-current="true"]');
        if (scrollContainer && currentWeekElement) {
          const topPos = currentWeekElement.offsetTop;
          scrollContainer.scrollTo({
            top: topPos - 80,
            behavior: 'smooth'
          });
        }
      } else {
        // Logique pour la vue liste
        const currentDayElement = scrollContainer?.querySelector(`[data-date="${formatDate(today)}"]`);
        if (scrollContainer && currentDayElement) {
          const topPos = currentDayElement.offsetTop;
          scrollContainer.scrollTo({
            top: topPos - 80,
            behavior: 'smooth'
          });
        }
      }
    }, 100);
  };

  // Modifiez le rendu des semaines
  const renderWeeks = () => {
    return visibleWeeks.map((week) => {
      const isCurrent = isCurrentWeek(week.start);
      const weekDates = week.dates;
      
      // Vérifier si il y a des installations le weekend
      const saturdayKey = formatDate(weekDates[5]);
      const sundayKey = formatDate(weekDates[6]);
      const hasSaturdayInstallations = installations[saturdayKey]?.length > 0;
      const hasSundayInstallations = installations[sundayKey]?.length > 0;
      
      return (
        <WeekSection 
          key={week.start.getTime()}
          data-is-current={isCurrent}
          $isCurrent={isCurrent}
        >
          <WeekContainer>
            {weekDates.slice(0, 5).map(date => renderDayBlock(date))}
            
            <WeekendContainer>
              {hasSaturdayInstallations ? (
                <div style={{ flex: 1 }}>
                  {renderDayBlock(weekDates[5])}
                </div>
              ) : (
                <WeekendButton 
                  onClick={() => handleAddInstallation(weekDates[5])}
                >
                  + Samedi
                </WeekendButton>
              )}
              
              {hasSundayInstallations ? (
                <div style={{ flex: 1 }}>
                  {renderDayBlock(weekDates[6])}
                </div>
              ) : (
                <WeekendButton 
                  onClick={() => handleAddInstallation(weekDates[6])}
                >
                  + Dimanche
                </WeekendButton>
              )}
            </WeekendContainer>
          </WeekContainer>
        </WeekSection>
      );
    });
  };

  // Modifiez le rendu de la vue liste
  const renderListView = () => (
    <ListContainer>
      {visibleWeeks.flatMap(week => 
        week.dates.slice(0, 5).map(date => {
          const dateKey = formatDate(date);
          const dayInstallations = installations[dateKey] || [];
          const isCurrentDay = new Date(date).toDateString() === new Date().toDateString();
          
          return (
            <ListItem 
              key={dateKey}
              data-date={dateKey}
              $isCurrent={isCurrentDay}
            >
              <div>
                <h3>{formatDate(date)}</h3>
                {dayInstallations.map(installation => (
                  <div key={installation.id}>{installation.title}</div>
                ))}
              </div>
              <AddButton 
                onClick={() => handleAddInstallation(date)}
                style={{ width: 'auto', padding: '5px 15px' }}
              >
                +
              </AddButton>
            </ListItem>
          );
        })
      )}
    </ListContainer>
  );

  return (
    <>
      <TopBar>
        <TopBarTitle>Gestion de la production</TopBarTitle>
        <TopBarButtons>
          <ViewToggleButton onClick={() => setViewMode(viewMode === 'block' ? 'list' : 'block')}>
            {viewMode === 'block' ? 'Vue Liste' : 'Vue Blocs'}
          </ViewToggleButton>
          <CurrentWeekButton onClick={handleGoToCurrentWeek}>
            Semaine courante
          </CurrentWeekButton>
        </TopBarButtons>
      </TopBar>

      <CalendarContainer>
        <ScrollContainer ref={scrollRef}>
          {viewMode === 'block' ? renderWeeks() : renderListView()}
        </ScrollContainer>
      </CalendarContainer>

      {isModalOpen && (
        <AddEventModal
          date={selectedDate}
          onClose={() => setIsModalOpen(false)}
          onSubmit={handleModalSubmit}
        />
      )}
    </>
  );
}

// Ajoutez ce styled component pour les événements
const EventItem = styled.div`
  margin: 5px 0;
  padding: 8px;
  border-radius: 4px;
  font-size: 0.9rem;
  
  ${props => {
    switch(props.$type) {
      case 'conge':
        return `
          background: #e8f5e9;
          border: 1px solid #c8e6c9;
        `;
      case 'maladie':
        return `
          background: #ffebee;
          border: 1px solid #ffcdd2;
        `;
      case 'installation':
        return `
          background: #e3f2fd;
          border: 1px solid #bbdefb;
        `;
      default:
        return '';
    }
  }}
  
  strong {
    display: block;
    margin-bottom: 4px;
  }
  
  div {
    margin: 2px 0;
  }
`;

export default ProductionCalendar; 