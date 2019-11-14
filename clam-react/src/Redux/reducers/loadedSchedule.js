import actionTypes from "../actions/actionTypes";

export const loadedSchedule = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.LOAD_SCHEDULE: {
            return action.data;
        }
        case actionTypes.CLEAR_MEETINGS: {
            return {};
        }
        default:
            return state;
    }
};
