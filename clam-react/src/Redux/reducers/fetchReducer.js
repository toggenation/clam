import actionTypes from "../actions/actionTypes";
import { updateObject } from "./reducerUtilities";
export const fetchReducer = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.FETCH_START: {
            return updateObject(state, { isFetching: true });
        }
        case actionTypes.FETCH_SUCCESS: {
            return updateObject(state, { isFetching: false });
        }
        case actionTypes.FETCH_FAIL: {
            return updateObject(state, {
                isFetching: false,
                fetchError: action.statusText
            });
        }
        default:
            return state;
    }
};

export default fetchReducer;

export const getIsFetching = state => state.isFetching;
