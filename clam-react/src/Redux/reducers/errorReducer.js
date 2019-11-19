import actionTypes from "../actions/actionTypes";
import { updateObject } from "./reducerUtilities";

export const errorReducer = (
    state = {
        show: false,
        color: "primary",
        message: "Default alert message"
    },
    action
) => {
    switch (action.type) {
        case actionTypes.SHOW_ERROR: {
            return updateObject(state, {
                message: action.message,
                color: action.color
            });
        }
        case actionTypes.HIDE_ERROR: {
            return updateObject(state, {
                show: false
            });
        }
        default:
            return state;
    }
};
