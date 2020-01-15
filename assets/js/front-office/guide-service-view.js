/*
 * Welcome to your app's front-office main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (front-office.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
import '../../css/front-office/style.scss';
import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';

import $ from 'jquery';
import 'bootstrap';
import documentReady from "../site/core/documentReady";

import {Calendar} from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";

let guideService = function(global){

    let htmlBindings = {
        calendar: 'fo-month-calendar'
    };

    let init = function(){
        // import { Calendar } from '@fullcalendar/core';
        // import dayGridPlugin from '@fullcalendar/daygrid';
        let calendarElement = global.document.getElementsByClassName(htmlBindings.calendar)[0];
        global.console.log(calendarElement);
        //
        // $.ajax({
        //     method: 'POST',
        //     data:{
        //         start: '2019-12-1T00:00:00-03:00',
        //         end: '2020-01-11T00:00:00-03:00'
        //     },
        //     url: calendarElement.dataset.bookingSource,
        // }).done(function(data) {
        //     global.console.info('booking source',data);
        // });
        //
        // $.ajax({
        //     method: 'POST',
        //     data:{
        //         start: '2019-12-1T00:00:00-03:00',
        //         end: '2020-01-11T00:00:00-03:00'
        //     },
        //     url: calendarElement.dataset.paxCountPerDayOfPeriodSource,
        // }).done(function(data) {
        //     global.console.info('pax count source', calendarElement.dataset.paxCountPerDayOfPeriodSource, data);
        // });

        let calendar = new Calendar(calendarElement, {
            plugins: [ dayGridPlugin ],
            defaultView: 'dayGridMonth',
            locale: 'es',
            eventSources: [
                {
                    method: 'POST',
                    url: calendarElement.dataset.paxCountPerDayOfPeriodSource,
                    failure: function() {
                        global.console.error('there was an error while fetching events!');
                    },
                    // color: 'yellow',    // an option!
                    textColor: 'white',  // an option!

                },
                // your event source
                {
                    method: 'POST',
                    url: calendarElement.dataset.bookingSource,
                    failure: function() {
                        global.console.error('there was an error while fetching events!');
                    },
                    // color: 'yellow',    // an option!
                    textColor: 'black',  // an option!

                },
                // your event source


                // any other sources...

            ]
            // events: [
            //     {
            //         title: 'booking 1',
            //         start: '2020-01-10',
            //         end: '2020-01-17',
            //         rendering: 'background'
            //     },
            //     {
            //         title: '2',
            //         start: '2020-01-10',
            //         end: '2020-01-10',
            //
            //     }
            //
            // ]
        });

        calendar.render();

        let str = calendar.formatRange('2020-01-01', '2020-01-15', {
            month: 'long',
            year: 'numeric',
            day: 'numeric',
            separator: ' to '
        });

        global.console.log(str);

    };

    return {
        init: init
    };
}(window);


documentReady(()=> {
    window.console.log('Guide Service !!!');
    guideService.init();
});
