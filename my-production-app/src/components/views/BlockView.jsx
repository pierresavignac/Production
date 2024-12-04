import React from 'react';
import { format } from 'date-fns';
import { fr } from 'date-fns/locale';
import styled from 'styled-components';

const DayBlock = styled.div`
  background: ${props => props.hasEvents ? '#fff' : '#f5f5f5'};
  border-radius: 8px;
  padding: 1rem;
  min-height: 100px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);

  &[data-is-current="true"] {
    background: #ff8f00;
  }

  h3 {
    margin: 0 0 1rem 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
`;

const WeekSection = styled.div`
  margin-bottom: 1rem;
  border-radius: 8px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
  overflow: hidden;

  &[data-is-current="true"] {
    & > .week-container {
      background: #1976d2;
      color: white;
    }
    
    ${DayBlock} {
      background: white;
      color: black;
      
      &[data-is-current="true"] {
        background: #ff8f00;
      }
    }
  }
`;

const WeekContainer = styled.div`
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 1rem;
  padding: 1rem;
  background: white;
  border-radius: 8px;
`;

const WeekendContainer = styled.div`
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
  padding: 1rem;
  background: white;
  border-radius: 8px;
  margin-top: 1rem;
`;

const AddInlineButton = styled.button`
  margin-left: 10px;
  padding: 2px 8px;
  background: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;

  &:hover {
    background: #45a049;
  }
`;

const formatTechnicians = (event) => {
  const technicians = [];
  if (event.technician1_name) technicians.push(event.technician1_full_name);
  if (event.technician2_name) technicians.push(event.technician2_full_name);
  if (event.technician3_name) technicians.push(event.technician3_full_name);
  if (event.technician4_name) technicians.push(event.technician4_full_name);
  return technicians.join(', ');
};

const BlockView = ({ 
  weeks, 
  events, 
  handleDateClick, 
  handleEventClick, 
  isCurrentWeek, 
  isCurrentDay,
  getEventsForDay,
  formatDayHeader 
}) => {
  const dayStyle = {
    flex: '1',
    margin: '4px',
    padding: '8px',
    border: '1px solid #ddd',
    backgroundColor: '#fff',
    minHeight: '120px',
    boxShadow: '0 4px 8px rgba(0, 0, 0, 0.2)'
  };

  return (
    <div className="block-view">
      {weeks.map(({ start, end, weekDays }) => {
        const isCurrent = isCurrentWeek(weekDays[0]);

        // Calculer les dates du weekend
        const saturday = new Date(weekDays[weekDays.length - 1]);
        saturday.setDate(saturday.getDate() + 1);
        const sunday = new Date(saturday);
        sunday.setDate(sunday.getDate() + 1);

        // Vérifier s'il y a des événements pour le weekend
        const saturdayEvents = getEventsForDay(saturday, events);
        const sundayEvents = getEventsForDay(sunday, events);
        
        return (
          <WeekSection 
            key={weekDays[0].getTime()}
            data-is-current={isCurrent}
          >
            <div className="week-header">
              <h2>
                Semaine du {format(start, 'dd MMMM', { locale: fr })} au {format(end, 'dd MMMM yyyy', { locale: fr })}
                <button 
                  className="weekend-button-small"
                  onClick={() => handleDateClick(saturday)}
                >
                  S
                </button>
                <button 
                  className="weekend-button-small"
                  onClick={() => handleDateClick(sunday)}
                >
                  D
                </button>
              </h2>
            </div>

            <WeekContainer className="week-container">
              {weekDays.map((day, dayIndex) => {
                const dayEvents = getEventsForDay(day, events);
                return (
                  <DayBlock 
                    key={dayIndex}
                    className={`day-block ${dayEvents.length > 0 ? 'has-events' : ''}`}
                    data-is-current={isCurrentDay(day)}
                  >
                    <h3>
                      <span>
                        {formatDayHeader(day)}
                        <AddInlineButton onClick={() => handleDateClick(day)}>+</AddInlineButton>
                      </span>
                    </h3>
                    {dayEvents.map((event, eventIndex) => (
                      <div
                        key={eventIndex}
                        className={`event-block ${event.type}`}
                        onClick={(e) => {
                          e.stopPropagation();
                          handleEventClick(event);
                        }}
                      >
                        {event.type === 'installation' ? (
                          <div className="installation-details">
                            <strong>Installation</strong>
                            <div>{event.first_name} {event.last_name}</div>
                            <div>{event.installation_number}</div>
                            <div>{event.city}</div>
                            <div>
                              <small>
                                {formatTechnicians(event)}
                              </small>
                            </div>
                          </div>
                        ) : (
                          <>
                            <strong>
                              {event.type === 'conge' ? 'Congé' : 
                               event.type === 'maladie' ? 'Maladie' : 
                               event.type === 'vacances' ? 'Vacances' :
                               'Formation'}
                            </strong>
                            <div>{event.employee_name}</div>
                          </>
                        )}
                      </div>
                    ))}
                  </DayBlock>
                );
              })}
            </WeekContainer>

            {(saturdayEvents.length > 0 || sundayEvents.length > 0) && (
              <WeekendContainer className="week-container">
                {saturdayEvents.length > 0 && (
                  <DayBlock 
                    key="saturday"
                    className={`day-block has-events weekend`}
                    data-is-current={isCurrentDay(saturday)}
                  >
                    <h3>
                      <span>
                        {format(saturday, 'EEEE dd', { locale: fr })}
                        <AddInlineButton onClick={() => handleDateClick(saturday)}>+</AddInlineButton>
                      </span>
                    </h3>
                    {saturdayEvents.map((event, eventIndex) => (
                      <div
                        key={eventIndex}
                        className={`event-block ${event.type}`}
                        onClick={(e) => {
                          e.stopPropagation();
                          handleEventClick(event);
                        }}
                      >
                        {event.type === 'installation' ? (
                          <div className="installation-details">
                            <strong>Installation</strong>
                            <div>{event.first_name} {event.last_name}</div>
                            <div>{event.installation_number}</div>
                            <div>{event.city}</div>
                            <div>
                              <small>
                                {formatTechnicians(event)}
                              </small>
                            </div>
                          </div>
                        ) : (
                          <>
                            <strong>
                              {event.type === 'conge' ? 'Congé' : 
                               event.type === 'maladie' ? 'Maladie' : 
                               event.type === 'vacances' ? 'Vacances' :
                               'Formation'}
                            </strong>
                            <div>{event.employee_name}</div>
                          </>
                        )}
                      </div>
                    ))}
                  </DayBlock>
                )}

                {sundayEvents.length > 0 && (
                  <DayBlock 
                    key="sunday"
                    className={`day-block has-events weekend`}
                    data-is-current={isCurrentDay(sunday)}
                  >
                    <h3>
                      <span>
                        {format(sunday, 'EEEE dd', { locale: fr })}
                        <AddInlineButton onClick={() => handleDateClick(sunday)}>+</AddInlineButton>
                      </span>
                    </h3>
                    {sundayEvents.map((event, eventIndex) => (
                      <div
                        key={eventIndex}
                        className={`event-block ${event.type}`}
                        onClick={(e) => {
                          e.stopPropagation();
                          handleEventClick(event);
                        }}
                      >
                        {event.type === 'installation' ? (
                          <div className="installation-details">
                            <strong>Installation</strong>
                            <div>{event.first_name} {event.last_name}</div>
                            <div>{event.installation_number}</div>
                            <div>{event.city}</div>
                            <div>
                              <small>
                                {formatTechnicians(event)}
                              </small>
                            </div>
                          </div>
                        ) : (
                          <>
                            <strong>
                              {event.type === 'conge' ? 'Congé' : 
                               event.type === 'maladie' ? 'Maladie' : 
                               event.type === 'vacances' ? 'Vacances' :
                               'Formation'}
                            </strong>
                            <div>{event.employee_name}</div>
                          </>
                        )}
                      </div>
                    ))}
                  </DayBlock>
                )}
              </WeekendContainer>
            )}
          </WeekSection>
        );
      })}
    </div>
  );
};

export default BlockView; 