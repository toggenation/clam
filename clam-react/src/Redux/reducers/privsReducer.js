import actionTypes from '../actions/actionTypes'

export const privs = (state = {}, action) => {
        switch (action.type) {
            case actionTypes.LOAD_PRIVS: {
                return action.data
            }
            default:
                return state
        }
}

export default privs

export const getPrivs = (state, partId, isAssistant = false) => {
     if( ! state.hasOwnProperty('privs') ) {
         console.log("Missing priv object")
         return []
     }
     if( ! state.privs.hasOwnProperty(partId)) {
        console.log("Missing priv[partId] object", partId, state.privs)
         return []
     }
     const priv = state.privs[partId]

     const what = isAssistant ? 'assistant' : 'assigned'
     const ids = isAssistant ? 'assistantsById': 'assignedById'

     let byId = priv[ids] || [];
     let byObject = priv[what]


     if ( priv.school_part && isAssistant ) {
        byId = priv['assignedById']
        byObject = priv['assigned']
     }

    const arrayOfObjects = byId.map((value) => ({ id: value, name: byObject[value]}))
    return arrayOfObjects
}
