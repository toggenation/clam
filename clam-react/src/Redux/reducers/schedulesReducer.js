import actionTypes from "../actions/actionTypes";
import moment from "moment";

export const schedules = (state = [], action) => {
    switch (action.type) {
        case actionTypes.LOAD_SCHEDULES: {
            return action.data;
        }
        default:
            return state;
    }
};
export default schedules

export const getSchedulesList = state => {
    if (!state.schedules) return;
    let formattedList = state.schedules.map(x => {
        return {
            id: x.id,
            month_year: moment(x.start_date).format("MMMM YYYY")
        };
    });
    return formattedList;
};

export const getIsScheduleSaveModalVisible = (state) => state.isModalVisible
