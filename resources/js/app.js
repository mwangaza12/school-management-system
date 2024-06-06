import './bootstrap';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        var calendar = new Calendar(calendarEl, {
            plugins: [ dayGridPlugin, timeGridPlugin ],
            events: '/api/assignments', // Fetch assignments with unit names
            eventContent: function(arg) {
                // Customize event content to show title and unit name
                return {
                    html: '<div class="event-title">' + arg.event.title + '</div>'
                };
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridWeek',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            eventRender: function(info) {
                // Convert due date string to Date object
                var dueDate = new Date(info.event.start);
                
                // Get current date and format it to match due date format
                var currentDate = new Date();
                var currentDateString = currentDate.toISOString().split('T')[0];
            
                // Compare due date with current date
                if (dueDate.toISOString().split('T')[0] === currentDateString) {
                    info.el.style.backgroundColor = '#ff6666'; // Highlight today's date
                } else if (dueDate < currentDate) {
                    info.el.style.backgroundColor = '#ff0923'; // Highlight overdue dates
                }
            }
        });
        calendar.render();
    }
});


