const moment = require('moment');

const dt = [
    '2019-01-23T19:48:00+00:00',
    '2019-01-23T19:48:00+11:00'
]

const parseTime = (dateString) => {
    const match = dateString.match(/\d{2}:\d{2}:\d{2}/)[0];
    const converted = moment(match, 'HH:mm:ss');
    return converted.isValid() ? converted.format('h:mm A'): null
}

dt.map(dt => console.log(dt, parseTime(dt)))

