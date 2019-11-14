import actionTypes from "../actions/actionTypes";
import { updateObject } from "./reducerUtilities";

export const alertMessage = (
    state = {
        show: false,
        color: "primary",
        message: "Default alert message"
    },
    action
) => {
    switch (action.type) {
        case actionTypes.ADD_MESSAGE: {
            return updateObject(state, {
                message: action.message,
                color: action.color
            });
        }
        case actionTypes.HIDE_ALERT: {
            return updateObject(state, {
                show: false
            });
        }
        case actionTypes.SHOW_ALERT: {
            return updateObject(state, {
                show: true
            });
        }
        default:
            return state;
    }
};
