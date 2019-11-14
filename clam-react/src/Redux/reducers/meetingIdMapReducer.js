
import actionTypes from '../actions/actionTypes'
import { updateObject } from "./reducerUtilities";

export const meetingIdMap = (state = {}, action) => {
    switch(action.type){
        case actionTypes.ADD_MEETING_ID_MAP: {
            return updateObject(state, {[action.meetingIdLocal]: action.meetingIdCake})
        }
        case actionTypes.CLEAR_MEETINGS: {
            return {}
        }
        case actionTypes.REMOVE_MEETING_ID_MAP: {
            const { [action.meetingIdLocal]: _, ...copyOfState } = state
            return copyOfState;
        }
        default:
            return state
    }

}

