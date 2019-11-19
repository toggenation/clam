import actionTypes from "../actions/actionTypes";
import moment from "moment";
import utils from '../../Utility/utilities'

export const meetings = ( state = {}, action ) => {
    switch (action.type) {
        case actionTypes.SET_MEETING_VALUE: {
            const { meetingId, valueName, value } = action;
            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    [valueName]: value
                }
            };
        }
        case actionTypes.DELETE_CO_PART: {
            const { partId, meetingId } = action;
            let parts = state[meetingId].parts.slice();
            let newParts = parts.filter(x => x !== partId);
            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    parts: newParts
                }
            };
        }
        case actionTypes.INSERT_CO_PART: {
            const { indexNumber, partId, meetingId } = action;
            let parts = state[meetingId].parts.slice();
            parts.splice(indexNumber, 0, partId);

            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    parts: parts
                }
            };
        }
        case actionTypes.CO_VISIT: {
            //console.log(actionTypes.CO_VISIT, action);
            return {
                ...state,
                [action.meetingId]: {
                    ...state[action.meetingId],
                    coVisit: action.coVisit
                }
            };
        }

        case actionTypes.UPDATE_START_TIME: {
            return {
                ...state,
                [action.meetingId]: {
                    ...state[action.meetingId],
                    startTime: action.fieldValue
                }
            };
        }
        case actionTypes.INSERT_PART: {
            let partIdArray = [].concat(state[action.meeting_id].parts);

            partIdArray.splice(action.indexNumber, 0, parseInt(action.part_id));

            return {
                ...state,
                [action.meeting_id]: {
                    ...state[action.meeting_id],
                    parts: partIdArray
                }
            };
        }
        case actionTypes.DELETE_PART: {
            let partIdArray = [...state[action.meeting_id].parts];

            let partIdRemoved = partIdArray.filter(
                value => action.part_id !== value
            );

            return {
                ...state,
                [action.meeting_id]: {
                    ...state[action.meeting_id],
                    parts: partIdRemoved
                }
            };
        }

        case actionTypes.ADD_SINGLE_PARTS_OBJECT: {
            const { partsByIdArray, meetingId } = action;

            return {
                ...state,
                [meetingId]: {
                    ...state[meetingId],
                    parts: partsByIdArray
                }
            };
        }
        case actionTypes.CLEAR_MEETINGS: {
            return {};
        }
        /*
        return {
         type: actionTypes.ADD_MEETING_ID_MAP,
         meetingIdLocal: meetingIdLocal,
         meetingIdCake: meetingIdCake
     }*/
        case actionTypes.ADD_MEETING_ID_MAP: {


            if ( state[action.meetingIdLocal].hasOwnProperty('parts') ){
               return {
                    ...state,
                    [action.meetingIdLocal]: {
                        ...state[action.meetingIdLocal],
                        meeting_id: action.meetingIdCake,
                        parts: [...state[action.meetingIdLocal].parts]
                    }
                }
            } else {
                return {
                    ...state,
                    [action.meetingIdLocal]: {
                        ...state[action.meetingIdLocal],
                        meeting_id: action.meetingIdCake
                    }
                }
            }

        }
        case actionTypes.ADD_MEETING: {
            return {
                ...state,
                [action.id]: {
                    date: action.meetingDate,
                    meeting_id: action.id,
                    local_id: action.id,
                    startTime: action.startTime,
                    coVisit: action.coVisit,
                    person_id: action.chairmanId,
                    auxiliary_counselor_id: action.auxCounselorId,
                    parts: []
                }
            };
        }
        case actionTypes.DELETE_MEETING_OBJECT: {
            // yay immuteable
            return Object.keys(state)
            .reduce((accum, current) => {
                if( String(current) !== String(action.meetingId)) {
                    const oldParts =  state[current]['parts'].slice() || []
                    accum[current] = {
                        ...state[current],
                        parts: oldParts
                    }
                }
                return accum
            }, {});
        }
        case actionTypes.SET_MEETING_DATE_BY_MEETING_ID: {
            const meetingObject = {
                ...state[action.meetingId],
                date: action.meetingDate
             };

            return {
                ...state,
                [action.meetingId]: { ...meetingObject }
            };
        }
        default:
            return state;
    }
};

export default meetings;

export const getMeeting = (meetingId, state) => {
    const meeting = state.meetings[meetingId] || {};
    return meeting;
};

export const getMeetingValue = (meetingId, state, value) => {
    return getMeeting(meetingId, state)[value] || "";
};

export const getMeetings = ( meetings, meetingsById ) => {
    const meetingsArrayObject = meetingsById.map(id => {
        return meetings[id];
    });

    return meetingsArrayObject;
};

export const isCoVisit = (meetingId, state) => {
    const { meetings } = state;
    let coVisit = false;

    if (meetings.hasOwnProperty(meetingId)) {
        coVisit = meetings[meetingId].coVisit;

    }

    return coVisit;
};

export const getMeetingParts = (meetingId, meetings, meetingPartsById) => {
    const meeting = meetings[meetingId] || { parts:[] };
    let meetingPartsArrayObject = meeting.parts.map(partId => {
        return meetingPartsById[meetingId][partId];
    });

    return meetingPartsArrayObject;
};

export const getMeetingIdSortedByDate = (meetings) => {
    const sortedByDateMeetingIDs = Object.keys(meetings)
        .map(x => {
            return {
                date: moment(meetings[x].date, "YYYY-MM-DD"),
                meetingId: x
            };
        })
        .sort((a, b) => {
            return a.date - b.date;
        })
        .map(x => {
            return x.meetingId;
        });

    return sortedByDateMeetingIDs;
};

export const getFormattedMeetingForSendingToApi = (meetings, schedule) => {

    const { scheduleId } = schedule

    const formattedObject = Object.keys(meetings).map(k => {
        const meeting = meetings[k];
        const { coVisit, person_id, meeting_id, auxiliary_counselor_id, date } = meeting;
        const formattedDate = utils.formatDate(date, 'YYYY-MM-DD');
        return {
            co_visit: coVisit,
            person_id: person_id,
            auxiliary_counselor_id: auxiliary_counselor_id,
            id: meeting_id,
            date: formattedDate,
            schedule_id: scheduleId
        }
    })

    return formattedObject
}
