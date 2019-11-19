import { actionTypes } from "../actions/actionTypes";
import { calcPartStartTime } from "./reducerUtilities";
import { updateObject } from './reducerUtilities';

export const meetingPartsById = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.ADD_CO_PART: {
            const { meetingId, partId, part } = action;
            let newPart = Object.assign({}, part);

            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    [partId]: {
                        ...newPart
                    }
                }
            };
        }

        case actionTypes.ADD_TO_MEETING_PARTS_BY_ID: {
            const { meetingId, partsObject } = action;
            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    ...partsObject
                }
            };
        }
        case actionTypes.INSERT_PART: {
            const { meeting_id, part_id, partsObjectByIds } = action;

            return {
                ...state,
                [meeting_id]: {
                    ...state[meeting_id],
                    [part_id]: partsObjectByIds[part_id]
                }
            };
        }
        case actionTypes.RESET_PART_VALUES: {
            const { partId, meetingId, partObject } = action;

            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    [partId]: partObject
                }
            };
        }
        case actionTypes.REMOVE_MEETING_PARTS: {
            let copiedState = JSON.parse(JSON.stringify(state));
            delete copiedState[action.meetingId];
            return copiedState;
        }
        case actionTypes.UPDATE_ALL_START_TIMES: {
            const { startTime, meetingId, partId } = action;

            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    [partId]: {
                        ...state[meetingId][partId],
                        start_time: startTime
                    }
                }
            };
        }
        case actionTypes.CLEAR_MEETINGS: {
            return {};
        }

        case actionTypes.BULK_UPDATE_MEETING_PARTS: {
            //console.log('updateObject', action.updateObject)
            /**
             * state = { meetingId: { partId: { partObject }}}
             */

            const deepCopy = JSON.parse(JSON.stringify(state));
            //console.log('dc', deepCopy);

            action.updateObject.forEach(upObj => {
                deepCopy[upObj.meetingId][upObj.partId][upObj.fieldName] =
                    upObj.fieldValue;
            });
            // console.log('DC', deepCopy);
            return deepCopy;
        }
        case actionTypes.UPDATE_MEETING_PART: {
            const { meetingId, fieldName, partId, text } = action;

            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    meeting_id: meetingId,
                    [partId]: {
                        ...state[meetingId][partId],
                        [fieldName]: text
                    }
                }
            };
        }
        case actionTypes.POPULATE_MEETING_PARTS_FROM_CAKE: {
            return updateObject(state, {
                ...action.data
            });
        }

        case actionTypes.ADD_ASSIGNED_ID_TO_PARTS: {
            const { response, meetingId } = action;
            let copiedState = JSON.parse(JSON.stringify(state));

            response.forEach(x => {
                copiedState[meetingId][x.part_id].assigned_id = x.assigned_id;
            });

            return {
                ...copiedState
            };
        }
        case actionTypes.UPDATE_ASSIGNED_ID: {
            const { meetingId, partId, assignedId } = action;
            // let partObject = { ...state[meetingId][partId] }

            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    [partId]: {
                        ...state[meetingId][partId],
                        assigned_id: assignedId
                    }
                }
            };
        }
        case actionTypes.ADD_MEETING_ID_MAP: {
            const { meetingIdLocal, meetingIdCake } = action;
            let copiedState = JSON.parse(JSON.stringify(state));

            Object.keys(copiedState).forEach(meetingId => {
                if (meetingIdLocal === meetingId) {
                    Object.keys(copiedState[meetingId]).forEach(partKey => {
                        copiedState[meetingId][partKey][
                            "meeting_id"
                        ] = meetingIdCake;
                    });
                }
            });

            return copiedState;
        }
        case actionTypes.POPULATE_MEETING_PARTS_BY_ID: {
            const { meetings, meetingIds, partEntities } = action;

            let newMeetingPartsById = {};

            let newParts = {};

            meetingIds.forEach(x => {
                let partIds = meetings[x].parts;
                partIds.forEach((y, index) => {
                    newParts[y] = {
                        ...partEntities[y],
                        songNumber: "",
                        start_time: calcPartStartTime(
                            meetings,
                            x,
                            partIds,
                            partEntities,
                            y
                        )
                    };
                });
                newMeetingPartsById[x] = newParts;
            });

            return newMeetingPartsById;
        }
        default:
            return state;
    }
};

export default meetingPartsById;

export const getAssignedId = (meetingId, partId, state) => {
    return (
        (getMeetingPart(meetingId, partId, state) || {})["assigned_id"] || null
    );
};

export const getMeetingPart = (meetingId, partId, state) => {
    return ((state || {})[meetingId] || {})[partId] || null;
};

export const getNotCoVisitParts = (meetingId, state) => {
    const meetingParts = state[meetingId] || {};

    const notCoVisitParts = Object.keys(meetingParts).reduce(
        (accum, current) => {
            if (Boolean(meetingParts[current].not_co_visit)) {
                return accum.concat(parseInt(current));
            }
            return accum;
        },
        []
    );
    return notCoVisitParts;
};
