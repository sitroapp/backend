import mock from './../mock';

const searchDB = [
    {
        'id'     : '1',
        'title'  : 'Dynamically Procrastinate B2C',
        'url'    : 'ourwebaddress.com/articles/procrastinate',
        'excerpt': 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.'
    },
    {
        'id'     : '2',
        'title'  : 'Cross Media',
        'url'    : 'ourwebaddress.com/articles/cross-media',
        'excerpt': 'Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.'
    },
    {
        'id'     : '3',
        'title'  : 'Synergize',
        'url'    : 'ourwebaddress.com/articles/synergize',
        'excerpt': 'Completely synergize resource taxing relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.'
    },
    {
        'id'     : '4',
        'title'  : 'Parallel Platforms',
        'url'    : 'ourwebaddress.com/articles/parallel-paltforms',
        'excerpt': 'Objectively innovate empowered manufactured products whereas parallel platforms. Holisticly predominate extensible testing procedures for reliable supply chains.'
    }

];

mock.onGet('/api/search').reply((config) => {
    return [200, searchDB];
});
