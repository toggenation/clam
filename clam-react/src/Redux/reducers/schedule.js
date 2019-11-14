import actionTypes from "../actions/actionTypes";
import { updateObject } from "./reducerUtilities";

export const schedule = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.TOGGLE_SAVE_SCHEDULE_MODAL: {
            return updateObject(state, {
                isModalVisible: !state.isModalVisible
            });
        }
        case actionTypes.TOGGLE_SCHEDULE_MODAL: {
            return updateObject(state, {
                showScheduleModal: !state.showScheduleModal
            });
        }
        case actionTypes.SET_SCHEDULE_DATA: {
            return updateObject(state, {
                ...action.data
            });
        }
        case actionTypes.SET_SCHEDULE_ID: {
            const isPublished = !action.scheduleId ? false : state.isPublished;

            return updateObject(state, {
                scheduleId: action.scheduleId,
                isPublished: isPublished
            });
        }
        case actionTypes.SET_SCHEDULE_START_DATE: {
            return updateObject(state, {
                start_date: action.startDate
            });
        }
        case actionTypes.SET_SCHEDULE_END_DATE: {
            return updateObject(state, {
                end_date: action.endDate
            });
        }
        default:
            return state;
    }
};

export default schedule;

export const getScheduleDates = state => ({
    startDate: state.start_date,
    endDate: state.end_date
});
