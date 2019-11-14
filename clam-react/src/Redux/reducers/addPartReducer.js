import actionTypes from "../actions/actionTypes";
import { updateObject } from "./reducerUtilities";

export const addParts = (state = {}, action) => {
    switch (action.type) {
        case actionTypes.HIDE_PART_PICKER: {
            return updateObject(state, { showPicker: false });
        }
        case actionTypes.INSERT_PART: {
            return updateObject(state, { showPicker: action.showPicker });
        }
        case actionTypes.ADD_PART_PICKER: {
            let showPickerBool = true;

            if (state.indexNumber === action.indexNumber) {
                showPickerBool = !state.showPicker;
            }
            return updateObject(state, {
                indexNumber: action.indexNumber,
                showPicker: showPickerBool,
                insertInMeetingId: action.meetingId
            });
        }
        case actionTypes.ADD_PARTS_OBJECT: {
            const { partEntities, partsByIdArray } = action;
            return updateObject(state, {
                fieldValue: partEntities[partsByIdArray[0]].id,
                fieldText: partEntities[partsByIdArray[0]].partname
            });
        }
        case actionTypes.UPDATE_FORM: {
            return updateObject(state, {
                fieldValue: action.value,
                fieldText: action.fieldText
            });
        }
        default:
            return state;
    }
};
export default addParts;

export const showPartPicker = (meetingId, state) => {
    const { addParts } = state;
    return addParts.showPicker;
};

export const getDisplayPartPicker = (meetingId, addParts, schedule) => {
    const { showPicker, insertInMeetingId } = addParts;
    const { isPublished } = schedule;
    return showPicker && insertInMeetingId === meetingId && !isPublished;
};

export const compare = (a, b) => {
    if (a.sort_order < b.sort_order) return -1;
    if (a.sort_order > b.sort_order) return 1;
    return 0;
};

export const getCurrentPartList = (
    meetingId,
    meetings,
    partsAllIds,
    partsObjectByIds
) => {
    let notInCurrentParts = [];
    if (meetings.hasOwnProperty(meetingId)) {
        const currentParts = meetings[meetingId].parts;

        notInCurrentParts = partsAllIds.reduce((accum, current) => {
            if (!currentParts.includes(current)) {
                return accum.concat(partsObjectByIds[current]);
            }
            return accum;
        }, []);
    }
    //console.log('NICP', notInCurrentParts);
    return notInCurrentParts.sort(compare);
};
