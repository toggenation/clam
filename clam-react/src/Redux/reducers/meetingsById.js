import { actionTypes } from '../actions/actionTypes'

const meetingsById = (state = [], action) => {
    switch (action.type) {
        case actionTypes.SORTED_MEETINGS: {
            return action.sortedArray
        }
        case actionTypes.CLEAR_MEETINGS: {
            return []
        }
        case actionTypes.LOAD_MEETINGS_BY_ID: {
            return  action.meetingsArray
        }
        case actionTypes.DELETE_MEETING: {

            return state.filter( meetingId => ( String(meetingId) !== String(action.meetingId) ))

        }
        default:
            return state
    }
}

export default meetingsById

export const getMeetingCount = (state) => {
   return state.length || 0;
}
