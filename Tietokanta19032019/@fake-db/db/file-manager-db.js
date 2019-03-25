import mock from './../mock';
import { bake_cookie, read_cookie, delete_cookie } from 'sfcookies';

var test = read_cookie('sitroLang'); 

if(test == "fi"){
    var language = "fi-FI";
}
    else{
       
if(language == "fi-FI"){
    var language = navigator.language;
}

    }

    if(language == "fi-FI"){

var fileManagerDB = {
    files: [
        {
            'id'       : '1',
            'name'     : 'Työtiedostot',
            'type'     : 'folder',
            'owner'    : 'me',
            'size'     : '',
            'modified' : 'July 8, 2017',
            'opened'   : 'July 8, 2017',
            'created'  : 'July 8, 2017',
            'extention': '',
            'location' : 'My Files > Documents',
            'offline'  : true
        },
        {
            'id'       : '2',
            'name'     : 'Public Documents',
            'type'     : 'folder',
            'owner'    : 'public',
            'size'     : '',
            'modified' : 'July 8, 2017',
            'opened'   : 'July 8, 2017',
            'created'  : 'July 8, 2017',
            'extention': '',
            'location' : 'My Files > Documents',
            'offline'  : true
        },
        {
            'id'       : '3',
            'name'     : 'Private Documents',
            'type'     : 'folder',
            'owner'    : 'me',
            'size'     : '',
            'modified' : 'July 8, 2017',
            'opened'   : 'July 8, 2017',
            'created'  : 'July 8, 2017',
            'extention': '',
            'location' : 'My Files > Documents',
            'offline'  : true
        },
        {
            'id'       : '4',
            'name'     : 'Ongoing projects',
            'type'     : 'document',
            'owner'    : 'Emily Bennett',
            'size'     : '1.2 Mb',
            'modified' : 'July 8, 2017',
            'opened'   : 'July 8, 2017',
            'created'  : 'July 8, 2017',
            'extention': '',
            'location' : 'My Files > Documents',
            'offline'  : true,
            'preview'  : 'assets/images/etc/sample-file-preview.jpg'
        }
    ]
};
    }

    else{
        var fileManagerDB = {
            files: [
                {
                    'id'       : '1',
                    'name'     : 'Work Documents',
                    'type'     : 'folder',
                    'owner'    : 'me',
                    'size'     : '',
                    'modified' : 'July 8, 2017',
                    'opened'   : 'July 8, 2017',
                    'created'  : 'July 8, 2017',
                    'extention': '',
                    'location' : 'My Files > Documents',
                    'offline'  : true
                },
                {
                    'id'       : '2',
                    'name'     : 'Public Documents',
                    'type'     : 'folder',
                    'owner'    : 'public',
                    'size'     : '',
                    'modified' : 'July 8, 2017',
                    'opened'   : 'July 8, 2017',
                    'created'  : 'July 8, 2017',
                    'extention': '',
                    'location' : 'My Files > Documents',
                    'offline'  : true
                },
                {
                    'id'       : '3',
                    'name'     : 'Private Documents',
                    'type'     : 'folder',
                    'owner'    : 'me',
                    'size'     : '',
                    'modified' : 'July 8, 2017',
                    'opened'   : 'July 8, 2017',
                    'created'  : 'July 8, 2017',
                    'extention': '',
                    'location' : 'My Files > Documents',
                    'offline'  : true
                },
                {
                    'id'       : '4',
                    'name'     : 'Ongoing projects',
                    'type'     : 'document',
                    'owner'    : 'Emily Bennett',
                    'size'     : '1.2 Mb',
                    'modified' : 'July 8, 2017',
                    'opened'   : 'July 8, 2017',
                    'created'  : 'July 8, 2017',
                    'extention': '',
                    'location' : 'My Files > Documents',
                    'offline'  : true,
                    'preview'  : 'assets/images/etc/sample-file-preview.jpg'
                }
            ]
        };
    }

mock.onGet('/api/file-manager-app/files').reply((config) => {
    return [200, fileManagerDB.files];
});
