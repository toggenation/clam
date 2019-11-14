import { actionTypes } from "../actions/actionTypes";
import { updateObject } from "./reducerUtilities";

export const addMeeting = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.CONFIGURE_MEETING_DATE: {
            return updateObject(state, { meetingDate: action.meetingDate });
        }
        default:
            return state;
    }
};

export default addMeeting;
