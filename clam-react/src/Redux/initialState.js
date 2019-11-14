import moment from 'moment'

//const scheduleDate = moment().add(1, 'month')
/*
const initialState = {
    addParts: {
        showPicker: false,
        insertAfterPart: null,
        insertInMeetingId: null
    },
    meetingsById: ["1", "2", "3", "4", "5"],
    meetings: {
        "1": { date: '3/7/2018', startTime: '7:30PM', meeting_id: '1', parts: [] },
        "2": { date: '10/7/2018', startTime: '7:30PM', meeting_id: '2', parts: [] },
        "3": { date: '17/7/2018', startTime: '7:30PM', meeting_id: '3', parts: [] },
        "4": { date: '24/7/2018', startTime: '7:30PM', meeting_id: '4', parts: [] },
        "5": { date: '31/7/2018', startTime: '7:30PM', meeting_id: '5', parts: [] }
    },

    message: ['Use Redux'], formData: {}
}
*/
const initialStateDev = {
    addParts: {
        showPicker: false,
        insertAfterPart: null,
        insertInMeetingId: null
    },
    meetingsById: [],
    meetings: {},
    schedule: {
        start_date: moment().startOf('month').format(),
        end_date: moment().endOf('month').format(),
        scheduleId: ''
    },
    addMeeting: {
        meetingDate: moment().startOf('month').format()
    }
}

export default initialStateDev
