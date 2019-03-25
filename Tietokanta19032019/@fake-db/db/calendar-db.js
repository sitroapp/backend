import mock from './../mock';
import {FuseUtils} from '@fuse';
import React from 'react';
var axios = require('axios');


var config = {
    headers: {'X-My-Custom-Header': 'Header-Value'}
  };
/*
const invocation = new XMLHttpRequest();

const url = 'http://aksiosprotest12.aksios.fi/apitest2/test.php';
/*
  app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});
*/
//  console.log(window.location.href);
 // <script crossorigin src="http://aksiosprotest12.aksios.fi/apitest2/"></script>

const calendarDB = {
    events: [
       
        {
            id   : 0,
            title: 'DTS STARTS',
            start: new Date(2019, 2, 13, 0, 0, 0),
            end  : new Date(2019, 2, 20, 0, 0, 0)
        },

        {
            id   : 1,
            title: 'DTS ENDS',
            start: new Date(2019, 10, 6, 0, 0, 0),
            end  : new Date(2019, 10, 13, 0, 0, 0)
        },

        {
            id   : 3,
            title: 'Some Event',
            start: new Date(2019, 3, 9, 0, 0, 0),
            end  : new Date(2019, 3, 9, 0, 0, 0)
        },
        {
            id   : 4,
            title: 'Conference',
            start: new Date(2019, 3, 11),
            end  : new Date(2019, 3, 13),
            desc : 'Big conference for important people'
        },
        {
            id   : 5,
            title: 'Meeting',
            start: new Date(2019, 3, 12, 10, 30, 0, 0),
            end  : new Date(2019, 3, 12, 12, 30, 0, 0),
            desc : 'Pre-meeting meeting, to prepare for the meeting'
        },
        {
            id   : 6,
            title: 'Lunch',
            start: new Date(2019, 3, 12, 12, 0, 0, 0),
            end  : new Date(2019, 3, 12, 13, 0, 0, 0),
            desc : 'Power lunch'
        }

    ]
};

mock.onGet('/api/calendar-app/events').reply((config) => {
    return [200, calendarDB.events];
});

mock.onPost('/api/calendar-app/add-event').reply((request) => {
    const rd = request.data;
    const data = JSON.parse(request.data);
    calendarDB.events = [
        ...calendarDB.events, {
            ...data.newEvent,
            id: FuseUtils.generateGUID()
        }
    ];
   // axios.post('http://aksiosprotest12.aksios.fi/apitest2/test.php', { firstName: 'Marlon' }, config);
   /*
   axios.post('https://cors.io/http://aksiosprotest12.aksios.fi/apitest2/test.php', { rd })
      .then(res => {
        console.log(res);
        console.log(res.data);
      });
*/
//axios({ method: 'POST', url: 'http://aksiosprotest12.aksios.fi/apitest2/test.php', data: { user: 'name' } })¨
axios({ method: 'POST', url: 'http://aksiosprotest12.aksios.fi/apitest2/test.php', data: { data } })

    return [200, calendarDB.events];
});

mock.onPost('/api/calendar-app/update-event').reply((request) => {
    const data = JSON.parse(request.data);

    calendarDB.events = calendarDB.events.map((event) => {
        if ( data.event.id === event.id )
        {
            return data.event
        }
        return event
    });

    return [200, calendarDB.events];
});

mock.onPost('/api/calendar-app/remove-event').reply((request) => {
    const data = JSON.parse(request.data);

    calendarDB.events = calendarDB.events.filter((event) => data.eventId !== event.id);

    return [200, calendarDB.events];
});

