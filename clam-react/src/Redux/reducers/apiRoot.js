import actionTypes from '../actions/actionTypes';
import { updateObject } from './reducerUtilities';

export const apiRoot = (state = { baseUrl: '', apiStub: 'api'}, action) => {
    switch (action.type) {
        case actionTypes.SET_API_URL:
            return updateObject(state, { baseUrl: action.baseUrl })
        default:
            return state;
    }
}

export default apiRoot

export const getApiRoot = ( state ) => {
    return state.baseUrl + state.apiStub
}
