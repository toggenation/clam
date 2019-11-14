
import actionTypes from '../actions/actionTypes'

export const shouldUpdate = (state = true , action) => {

    switch (action.type) {
        case actionTypes.UPDATE_STOP: {
            return false
        }
        case actionTypes.UPDATE_ALLOW: {
            return true
        }

        default:
            return state
    }
}


