import React, { useRef } from 'react';
import { format } from 'date-fns';
import { fr } from 'date-fns/locale';
import styled from 'styled-components';

const WeekSection = styled.div`
  margin-bottom: 1rem;
  background: white;
  border-radius: 8px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
  overflow: hidden;

  &[data-is-current="true"] {
    background: #1976d2;
    color: white;
    
    .week-header {
      background: white;
      color: black;
      border-bottom: 1px solid #e9ecef;
    }
    
    .day-section {
      background: white;
      color: black;
      margin: 0.5rem;
      border-radius: 8px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);

      &[data-is-current="true"] {
        background: #ff8f00;
      }
    }
  }
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

const DayHeaderContainer = styled.div`
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.75rem;
`;

const DayTitle = styled.h3`
  margin: 0;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.9rem;
`;

const ListView = ({ 
  weeks, 
  events, 
  handleDateClick, 
  handleEventClick, 
  isCurrentWeek, 
  isCurrentDay,
  getEventsForDay 
}) => {
  const listViewRef = useRef(null);

  return (
    <div className="list-view" ref={listViewRef}>
      {weeks.map(({ start, end, weekDays }) => {
        const weekKey = format(start, 'yyyy-MM-dd');
        const isCurrent = isCurrentWeek(start);

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
            key={weekKey} 
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
            
            {weekDays.map((currentDate) => {
              const dateStr = format(currentDate, 'yyyy-MM-dd');
              const dayEvents = getEventsForDay(currentDate, events);

              return (
                <div 
                  key={dateStr} 
                  className="day-section"
                  data-is-current={isCurrentDay(currentDate)}
                >
                  <DayHeaderContainer>
                    <DayTitle>
                      {format(currentDate, 'EEEE dd MMMM', { locale: fr })}
                      <AddInlineButton onClick={() => handleDateClick(currentDate)}>+</AddInlineButton>
                    </DayTitle>
                  </DayHeaderContainer>
                  
                  {dayEvents.length > 0 && (
                    <table>
                      <thead>
                        <tr>
                          <th>Type</th>
                          <th>Détails</th>
                        </tr>
                      </thead>
                      <tbody>
                        {dayEvents.map((event, eventIndex) => (
                          <tr 
                            key={eventIndex}
                            onClick={() => handleEventClick(event)}
                            className="event-row"
                            data-type={event.type}
                          >
                            <td>
                              {event.type === 'conge' ? 'Congé' 
                                : event.type === 'maladie' ? 'Maladie' 
                                : event.type === 'formation' ? 'Formation'
                                : event.type === 'vacances' ? 'Vacances'
                                : 'Installation'}
                            </td>
                            <td>
                              {event.type === 'installation' ? (
                                <span>{event.first_name} {event.last_name} - {event.installation_number}</span>
                              ) : (
                                <span>{event.employee_name}</span>
                              )}
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  )}
                </div>
              );
            })}

            {saturdayEvents.length > 0 && (
              <div 
                className="day-section"
                data-is-current={isCurrentDay(saturday)}
              >
                <DayHeaderContainer>
                  <DayTitle>
                    {format(saturday, 'EEEE dd MMMM', { locale: fr })}
                    <AddInlineButton onClick={() => handleDateClick(saturday)}>+</AddInlineButton>
                  </DayTitle>
                </DayHeaderContainer>
                <table>
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Détails</th>
                    </tr>
                  </thead>
                  <tbody>
                    {saturdayEvents.map((event, eventIndex) => (
                      <tr 
                        key={eventIndex}
                        onClick={() => handleEventClick(event)}
                        className="event-row"
                        data-type={event.type}
                      >
                        <td>
                          {event.type === 'conge' ? 'Congé' 
                            : event.type === 'maladie' ? 'Maladie' 
                            : event.type === 'formation' ? 'Formation'
                            : event.type === 'vacances' ? 'Vacances'
                            : 'Installation'}
                        </td>
                        <td>
                          {event.type === 'installation' ? (
                            <span>{event.first_name} {event.last_name} - {event.installation_number}</span>
                          ) : (
                            <span>{event.employee_name}</span>
                          )}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            )}

            {sundayEvents.length > 0 && (
              <div 
                className="day-section"
                data-is-current={isCurrentDay(sunday)}
              >
                <DayHeaderContainer>
                  <DayTitle>
                    {format(sunday, 'EEEE dd MMMM', { locale: fr })}
                    <AddInlineButton onClick={() => handleDateClick(sunday)}>+</AddInlineButton>
                  </DayTitle>
                </DayHeaderContainer>
                <table>
                  <thead>
                    <tr>
                      <th>Type</th>
                      <th>Détails</th>
                    </tr>
                  </thead>
                  <tbody>
                    {sundayEvents.map((event, eventIndex) => (
                      <tr 
                        key={eventIndex}
                        onClick={() => handleEventClick(event)}
                        className="event-row"
                        data-type={event.type}
                      >
                        <td>
                          {event.type === 'conge' ? 'Congé' 
                            : event.type === 'maladie' ? 'Maladie' 
                            : event.type === 'formation' ? 'Formation'
                            : event.type === 'vacances' ? 'Vacances'
                            : 'Installation'}
                        </td>
                        <td>
                          {event.type === 'installation' ? (
                            <span>{event.first_name} {event.last_name} - {event.installation_number}</span>
                          ) : (
                            <span>{event.employee_name}</span>
                          )}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            )}
          </WeekSection>
        );
      })}
    </div>
  );
};

export default ListView; 