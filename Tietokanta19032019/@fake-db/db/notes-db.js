import mock from './../mock';
import {FuseUtils} from '@fuse';

const notesDB = {
    notes : [
        {
            "id"         : "5725a680606588342058356d",
            "title"      : "",
            "description": "Find new company name!",
            "archive"    : false,
            "image"      : "",
            "time"       : "2018-02-25T04:01:06.587Z",
            "reminder"   : null,
            "checklist"  : [],
            "labels"     : [
                "5725a6809fdd915739187ed5"
            ]
        },
        {
            "id"         : "5725a68009e20d0a9e9acf2a",
            "title"      : "Send photos from the beach to John",
            "description": "",
            "archive"    : false,
            "image"      : "assets/images/notes/beach.jpeg",
            "time"       : "2018-05-10T04:01:06.587Z",
            "reminder"   : null,
            "checklist"  : [],
            "labels"     : [
                "5725a6806acf030f9341e932",
                "5725a6806acf030f9341e925"
            ]
        },
        {
            "id"         : "5725a6802d10e277a0f35724",
            "title"      : "",
            "description": "Lets think about for the new theme",
            "archive"    : false,
            "image"      : "",
            "time"       : "2018-04-12T15:14:56.587Z",
            "reminder"   : "2018-03-03T18:08:32.587Z",
            "checklist"  : [],
            "labels"     : [
                "5725a680606588342058356d"
            ]
        },
        {
            "id"         : "5725a68009e20d0a9e9acf2a",
            "title"      : "",
            "description": "Theming support for Chat app",
            "archive"    : false,
            "image"      : "",
            "time"       : "2018-03-21T23:23:53.587Z",
            "reminder"   : null,
            "checklist"  : [],
            "labels"     : [
                "5725a6809fdd915739187ed5"
            ]
        },
        {
            "id"         : "5725a680606588342058356d",
            "title"      : "Gift Ideas",
            "description": "Young sister's birthday is coming",
            "archive"    : false,
            "image"      : "",
            "time"       : "2018-04-21T02:33:11.587Z",
            "reminder"   : null,
            "checklist"  : [
                {
                    "id"     : "1",
                    "checked": false,
                    "text"   : "scarf"
                },
                {
                    "id"     : "2",
                    "checked": false,
                    "text"   : "new bike helmet"
                },
                {
                    "id"     : "3",
                    "checked": true,
                    "text"   : "necklease"
                },
                {
                    "id"     : "4",
                    "checked": false,
                    "text"   : "flowers"
                }
            ],
            "labels"     : [
                "5725a6802d10e277a0f35739"
            ]
        },
        {
            "id"         : "5725a680606588342058356d",
            "title"      : "Shoping List",
            "description": "",
            "archive"    : false,
            "image"      : "",
            "time"       : "2018-04-10T22:18:14.587Z",
            "reminder"   : "2018-01-13T11:09:00.587Z",
            "checklist"  : [
                {
                    "id"     : "1",
                    "checked": true,
                    "text"   : "Shortening"
                },
                {
                    "id"     : "2",
                    "checked": true,
                    "text"   : "Margarine"
                },
                {
                    "id"     : "3",
                    "checked": false,
                    "text"   : "Canned Stewed Tomatoes"
                },
                {
                    "id"     : "4",
                    "checked": true,
                    "text"   : "Onions"
                },
                {
                    "id"     : "5",
                    "checked": true,
                    "text"   : "Garlic"
                }
            ],
            "labels"     : [
                "5725a68031fdbb1db2c1af47"
            ]
        },
        {
            "id"         : "5725a680606588342058356d",
            "title"      : "Ng Conference Schedule",
            "description": "",
            "archive"    : false,
            "image"      : "",
            "time"       : "2018-01-21T22:46:48.587Z",
            "reminder"   : "2018-05-14T06:47:19.587Z",
            "checklist"  : [
                {
                    "id"     : "1",
                    "checked": true,
                    "text"   : "breakfast"
                },
                {
                    "id"     : "2",
                    "checked": true,
                    "text"   : "Welcome"
                },
                {
                    "id"     : "3",
                    "checked": true,
                    "text"   : "Keynote 1 - Brad Green  Jules Kremer"
                },
                {
                    "id"     : "4",
                    "checked": false,
                    "text"   : "An Angular 2 Force Awakens John Papa"
                },
                {
                    "id"     : "5",
                    "checked": false,
                    "text"   : "Lunch"
                }
            ],
            "labels"     : [
                "5725a6809fdd915739187ed5",
                "5725a68031fdbb1db2c1af47"
            ]
        },
        {
            "id"         : "5725a68009e20d0a9e9acf2a",
            "title"      : "",
            "description": "Organize the surprise party",
            "archive"    : false,
            "image"      : "",
            "time"       : "2018-03-11T06:55:30.587Z",
            "reminder"   : "2018-04-01T07:35:05.587Z",
            "checklist"  : [],
            "labels"     : [
                "5725a6802d10e277a0f35739"
            ]
         }
    ],
    labels: [
        {
            "id"    : "5725a6802d10e277a0f35739",
            "name"  : "Family",
            "handle": "family"
        },
        {
            "id"    : "5725a6809fdd915739187ed5",
            "name"  : "Work",
            "handle": "work"
        },
        {
            "id"    : "5725a68031fdbb1db2c1af47",
            "name"  : "Todos",
            "handle": "todos"
        },
        {
            "id"    : "5725a680606588342058356d",
            "name"  : "Prior",
            "handle": "prior"
        },
        {
            "id"    : "5725a6806acf030f9341e925",
            "name"  : "Personal",
            "handle": "personal"
        },
        {
            "id"    : "5725a6806acf030f9341e932",
            "name"  : "Friends",
            "handle": "friends"
        }
    ]
};

mock.onGet('/api/notes-app/notes').reply((config) => {
    return [200, notesDB.notes];
});

mock.onGet('/api/notes-app/labels').reply((config) => {
    return [200, notesDB.labels];
});

mock.onPost('/api/notes-app/create-note').reply((request) => {
    const data = JSON.parse(request.data);
    const newNote =
        {
            ...data.note,
            id: FuseUtils.generateGUID()
        };
    notesDB.notes = [
        newNote,
        ...notesDB.notes
    ];
    return [200, newNote];
});

mock.onPost('/api/notes-app/update-note').reply((request) => {
    const data = JSON.parse(request.data);

    notesDB.notes = notesDB.notes.map((note) => {
        if ( data.note.id === note.id )
        {
            return data.note
        }
        return note
    });

    return [200, data.note];
});

mock.onPost('/api/notes-app/update-labels').reply((request) => {
    const data = JSON.parse(request.data);

    notesDB.labels = data.labels;

    return [200, notesDB.labels];
});

mock.onPost('/api/notes-app/remove-note').reply((request) => {
    const data = JSON.parse(request.data);

    notesDB.notes = notesDB.notes.filter((note) => data.noteId !== note.id);

    return [200, notesDB.notes];
});

