// es modules are recommended, if available, especially for typescript
import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja.js"


flatpickr("#event_date", {
  "locale": Japanese,
  minDate: "today",
  maxDate: new Date().fp_incr(30) // 30 days from now
});

const options = {
  "locale": Japanese,
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i",
  time_24hr: true,
  minTime: "10:00",
  maxTime: "17:00",
}
flatpickr("#start_time", options);
flatpickr("#end_time", options);
