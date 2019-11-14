import actionTypes from '../actions/actionTypes'


export const partsAllIds = (state = [], action) => {
    switch (action.type) {
        case actionTypes.ADD_PARTS_OBJECT: {
            return action.partsByIdArray
        }
        default:
            return state
    }
}
