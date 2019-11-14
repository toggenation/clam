import actionTypes from "../actions/actionTypes";

export const partsObjectByIds = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.ADD_PARTS_OBJECT: {
            return action.partEntities;
        }
        default:
            return state;
    }
};
export default partsObjectByIds;

export const getCoVisitParts = state => {
    const coParts = Object.keys(state)
        .reduce((accum, current) => {
            if (state[current].co_visit) {
                return accum.concat(parseInt(current, 10));
            }
            return accum
        }, []);

    return coParts;
};

export const getNonCoVisitParts = state => {
    const nonCoParts = Object.keys(state)
        .reduce((accum, current) => {
            if(state[current].not_co_visit){
                return accum.concat(parseInt(current,10))
            }
            return accum
        }, [])

    return nonCoParts;
};
