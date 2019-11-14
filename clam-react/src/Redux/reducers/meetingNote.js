import actionTypes from "../actions/actionTypes";
import { updateObject } from "./reducerUtilities";

export const meetingNote = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.TOGGLE_MEETING_NOTE: {
            const { meetingId, add } = action;

            if (add) {
                return updateObject(state, {
                    [meetingId]: {
                        ...state[meetingId],
                        active: add
                    }
                });
            } else {
                return Object.keys(state).reduce((accum, current) => {
                    if (String(current) !== String(meetingId)) {
                        accum[current] = { ...state[current] };
                        return accum;
                    }
                    return accum;
                }, {});
            }
        }
        case actionTypes.CANCEL_MEETING_NOTE: {
            return {};
        }

        case actionTypes.UPDATE_MEETING_NOTE_ID: {
            return updateObject(state, {
                [action.meetingId]: {
                    ...state[action.meetingId],
                    meeting_note_id: action.meetingNoteId
                }
            });
        }

        case actionTypes.DELETE_MEETING: {

            const { [action.meetingId]: _, ...newObject } = state;
            return newObject;
        }

        case actionTypes.DELETE_MEETING_NOTE_ID: {
            const { meeting_note_id, ...meetingNote } = state[action.meetingId];

            return updateObject(state, {
                [action.meetingId]: {
                    ...meetingNote
                }
            });
        }
        case actionTypes.ADD_MEETING_NOTE_FROM_CAKE: {
            return updateObject(state, {
                [action.meetingId]: {
                    ...state[action.meetingId],
                    meeting_note_id: action.meetingNoteId,
                    meeting_id: action.meetingId,
                    heading: action.heading,
                    note: action.note,
                    active: action.active
                }
            });
        }
        case actionTypes.CLEAR_MEETINGS: {
            return {};
        }
        case actionTypes.UPDATE_MEETING_NOTE: {
            return updateObject(state, {
                [action.meetingId]: {
                    ...state[action.meetingId],
                    [action.fieldName]: action.fieldValue,
                    meeting_id: action.meetingId
                }
            });
        }
        default:
            return state;
    }
};
