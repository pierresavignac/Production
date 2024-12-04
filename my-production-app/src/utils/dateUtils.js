import { format, startOfWeek, endOfWeek, addWeeks, isSameDay, isSameWeek, addDays } from 'date-fns';
import { fr } from 'date-fns/locale';

export const formatDateForAPI = (date) => {
  return format(date, 'yyyy-MM-dd');
};

export const isCurrentDay = (date) => {
  return isSameDay(date, new Date());
};

export const isCurrentWeek = (date) => {
  return isSameWeek(date, new Date(), { weekStartsOn: 1 });
};

export const calculateWeeks = (currentDate) => {
  const weeks = [];
  let startDate = startOfWeek(currentDate, { weekStartsOn: 1 });

  // Générer 6 semaines (semaine courante + 5 suivantes)
  for (let i = 0; i < 6; i++) {
    const endDate = endOfWeek(startDate, { weekStartsOn: 1 });
    const weekDays = [];

    // Générer les jours de la semaine (lundi à vendredi)
    for (let j = 0; j < 5; j++) {
      weekDays.push(addDays(startDate, j));
    }

    weeks.push({
      start: startDate,
      end: endDate,
      weekDays
    });

    startDate = addWeeks(startDate, 1);
  }

  return weeks;
};

export const formatWeekHeader = (date) => {
  const start = startOfWeek(date, { weekStartsOn: 1 });
  const end = endOfWeek(date, { weekStartsOn: 1 });
  
  const startStr = format(start, 'dd MMMM', { locale: fr });
  const endStr = format(end, 'dd MMMM yyyy', { locale: fr });
  
  return `Semaine du ${startStr} au ${endStr}`;
};

export const formatDayHeader = (date) => {
  return format(date, 'EEEE dd', { locale: fr });
}; 