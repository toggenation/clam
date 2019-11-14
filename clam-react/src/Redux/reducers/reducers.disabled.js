
import actionTypes from '../actions/actionTypes'

//import moment from 'moment';


export const message = (state = [], action) => {

    switch (action.type) {
        case actionTypes.ADD_MESSAGE:
            return state.concat([action.text]);
        case actionTypes.REMOVE_MESSAGE:
            return [
                ...state.slice(0, action.value),
                ...state.slice(action.value + 1)
            ];
        default:
            return state;

    }
}





export const clam = (state = [], action) => {

    switch (action.type) {
        case actionTypes.ADD_PARTS: {
            return { ...state, parts: action }
        }
        case actionTypes.ADD_PART_IDS: {
            const partsByMeeting = state.partsByMeetingIDs[action.meeting_id]
            const parts = partsByMeeting.concat(action.part_id)
            return {
                ...state,
                partsByMeetingIDs: parts
            }
        }
        default:
            return state
    }
}


export const formData = (state = {}, action) => {

    switch (action.type) {
        case actionTypes.UPDATE_FORMDATA: {
            return {
                ...state,
                [action.name]: action.value
            }
        }
        default:
            return state
    }
}










