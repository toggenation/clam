import actionTypes from "./actionTypes";

export const hideAddPart = () => ({
    type: actionTypes.HIDE_PART_PICKER
});
export const deleteCoParts = (meetingId, partId) => {
    return {
        type: actionTypes.DELETE_CO_PART,
        meetingId: meetingId,
        partId: partId
    };
};

export const setApiUrl = baseUrl => {
   // console.log("Setting API", baseUrl);
    return {
        type: actionTypes.SET_API_URL,
        baseUrl: baseUrl
    };
};

export const insertCoPart = (indexNumber, meetingId, partId) => {
    return {
        type: actionTypes.INSERT_CO_PART,
        indexNumber: indexNumber,
        meetingId: meetingId,
        partId: partId
    };
};
export const addCoPart = (meetingId, partId, partObject) => {
    return {
        type: actionTypes.ADD_CO_PART,
        meetingId: meetingId,
        partId: partId,
        part: partObject
    };
};

export const clickCoVisit = (meetingId, checkBoxValue) => {
    return {
        type: actionTypes.CO_VISIT,
        meetingId: meetingId,
        coVisit: checkBoxValue
    };
};
export const loadMeetingsById = meetingsArray => {
    return {
        type: actionTypes.LOAD_MEETINGS_BY_ID,
        meetingsArray: meetingsArray
    };
};
export const clearMeetings = () => ({
    type: actionTypes.CLEAR_MEETINGS
});

export const addMeeting = (
    meetingDate,
    meetingUUID,
    chairmanId = null,
    auxCounselorId = null,
    coVisit = false,
    startTime = "7:30 PM" ) => {
    return {
        type: actionTypes.ADD_MEETING,
        meetingDate: meetingDate,
        id: meetingUUID,
        startTime, // fix this why hard coded?
        chairmanId: chairmanId,
        auxCounselorId: auxCounselorId,
        coVisit: coVisit
    };
};

export const updateForm = (name, value, optionText) => {
   // console.log('n', name, 'v', value, 'o', optionText)
    return {
        type: actionTypes.UPDATE_FORM,
        name: name,
        value: value,
        fieldText: optionText
    };
};

export const addSinglePartsObject = (meetingId, filteredParts) => ({
    type: actionTypes.ADD_SINGLE_PARTS_OBJECT,
    partsByIdArray: filteredParts,
    meetingId: meetingId
});
export const addToMeetingPartsById = (meetingId, newObject, filteredParts) => {
    return {
        type: actionTypes.ADD_TO_MEETING_PARTS_BY_ID,
        meetingId: meetingId,
        partsObject: newObject,
        partsByIdArray: filteredParts
    };
};
export const sortedMeetings = sortedIDArray => {
    return {
        type: actionTypes.SORTED_MEETINGS,
        sortedArray: sortedIDArray
    };
};

export const deleteMeetingObject = meetingId => ({
    type: actionTypes.DELETE_MEETING_OBJECT,
    meetingId: meetingId
});

export const deleteMeeting = meetingId => ({
    type: actionTypes.DELETE_MEETING,
    meetingId
});
export const insertPartUpdateIDFromCake = (meetingId, partId, assignedId) => {
    return {
        type: actionTypes.UPDATE_ASSIGNED_ID,
        meetingId: meetingId,
        partId: partId,
        assignedId: assignedId
    }
}
export const insertPart = (
    indexNumber,
    meetingId,
    partId,
    partsObjectByIds
) => ({
    type: actionTypes.INSERT_PART,
    indexNumber: indexNumber,
    meeting_id: meetingId,
    part_id: partId,
    showPicker: false,
    partsObjectByIds: partsObjectByIds
});

export const populateMeetingPartsById = (
    meetingsById,
    meetings,
    partsObjectByIds
) => ({
    type: actionTypes.POPULATE_MEETING_PARTS_BY_ID,
    meetingIds: meetingsById,
    meetings, // find out how to return partsByIds ????
    partEntities: partsObjectByIds
});

export const addPartsObject = normalizedData => {
    const partEntities = normalizedData.entities.parts;
    const partsByIdArray = normalizedData.result.parts;

    return {
        type: actionTypes.ADD_PARTS_OBJECT,
        partEntities,
        partsByIdArray
    };
};



export const updateTime = (meetingId, fieldValue) => ({
    type: actionTypes.UPDATE_START_TIME,
    fieldValue,
    meetingId
});

export const updateAllStartTimes = () => ({
    type: actionTypes.UPDATE_ALL_START_TIMES
});

export const updateMeetingPartAssignedID = (meetingId, response) => {
    return {
        type: actionTypes.ADD_ASSIGNED_ID_TO_PARTS,
        meetingId,
        response
     }
}

export const updateMeetingPart = action => {
    const { fieldValue: text, meetingId, partId, fieldName } = action
    return {
        type: actionTypes.UPDATE_MEETING_PART,
        text,
        meetingId,
        partId,
        fieldName
    };
};

export const resetValues = (meetingId, partId, indexNumber, partObject) => {
    return {
        type: actionTypes.RESET_PART_VALUES,
        meetingId,
        partId,
        indexNumber,
        partObject
    };
};

export const deletePart = (part_id, meeting_id, indexNumber) => ({
    type: actionTypes.DELETE_PART,
    meeting_id,
    part_id,
    indexNumber
});

export const addPartPicker = (meetingId, indexNumber) => ({
    type: actionTypes.ADD_PART_PICKER,
    meetingId,
    indexNumber
});

export const setScheduleStartDate = startDate => ({
    type: actionTypes.SET_SCHEDULE_START_DATE,
    startDate
});

export const setScheduleEndDate = endDate => ({
    type: actionTypes.SET_SCHEDULE_END_DATE,
    endDate
});

export const setMeetingDate = meetingDate => ({
    type: actionTypes.CONFIGURE_MEETING_DATE,
    meetingDate
});

export const fetchStart = () => ({
    type: actionTypes.FETCH_START,
    isFetching: true
});

export const fetchSuccess = () => ({
    type: actionTypes.FETCH_SUCCESS,
    isFetching: false
});

export const fetchFail = statusText => ({
    type: actionTypes.FETCH_FAIL,
    isFetching: false,
    statusText
});

export const loadPrivs = privs => ({
    type: actionTypes.LOAD_PRIVS,
    data: privs
});

export const loadSchedules = schedules => ({
    type: actionTypes.LOAD_SCHEDULES,
    data: schedules.schedules
});

export const loadSchedule = scheduleData => {
    return {
        type: actionTypes.LOAD_SCHEDULE,
        data: scheduleData
    };
};

export const updateMeetingNoteId = (meetingId, meetingNoteId) => {
    return {
        type: actionTypes.UPDATE_MEETING_NOTE_ID,
        meetingId,
        meetingNoteId
    }
}
export const deleteMeetingNoteId = (meetingId) => {
    return {
        type: actionTypes.DELETE_MEETING_NOTE_ID,
        meetingId
    }
}

export const updateMeetingNote = (meetingId, fieldName, fieldValue) => {
    return {
        type: actionTypes.UPDATE_MEETING_NOTE,
        meetingId,
        fieldName,
        fieldValue
    };
};

export const cancelMeetingNote = meetingId => {
    return {
        type: actionTypes.CANCEL_MEETING_NOTE,
        meetingId
    };
};

export const toggleMeetingNote = (meetingId, add) => {
    return {
        type: actionTypes.TOGGLE_MEETING_NOTE,
        add,
        meetingId
    };
};

export const populateMeetingPartsByIdFromCake = assignedObject => {
    return {
        type: actionTypes.POPULATE_MEETING_PARTS_FROM_CAKE,
        data: assignedObject
    };
};


export const addMeetingNoteFromCake = ( meetingId, meetingNoteId, heading, note, active = true) => {
    return {
        type: actionTypes.ADD_MEETING_NOTE_FROM_CAKE,
        meetingId,
        heading,
        note,
        active,
        meetingNoteId
    }
}

export const updateAllow = () => ({
    type: actionTypes.UPDATE_ALLOW
})

export const updateStop = () => ({
    type: actionTypes.UPDATE_STOP
})

export const toggleScheduleModal = () => ({
    type: actionTypes.TOGGLE_SCHEDULE_MODAL
})

export const addSchedule = () => {
    return {
         type: actionTypes.ADD_SCHEDULE_TO_CAKE
    }
}

export const setScheduleData = (data = {}) => {
    return {
        type: actionTypes.SET_SCHEDULE_DATA,
        data
    }

}
export const showAlert = () => ({ type: actionTypes.SHOW_ALERT })
export const hideAlert = () => ({ type: actionTypes.HIDE_ALERT })

export const addMessage = (message, color) => ({
    type: actionTypes.ADD_MESSAGE,
    message,
    color
})

export const setScheduleId = (id) => ( {
    type: actionTypes.SET_SCHEDULE_ID,
    scheduleId: id
 });

 export const setMeetingDateByMeetingId = (meetingId, meetingDate) => ({
    type: actionTypes.SET_MEETING_DATE_BY_MEETING_ID,
    meetingId,
    meetingDate
 })

 export const toggleScheduleSaveModal = () => ({
     type: actionTypes.TOGGLE_SAVE_SCHEDULE_MODAL
 })

 export const setMeetingValue = (meetingId, valueName, value) => {
     return {
         type: actionTypes.SET_MEETING_VALUE,
         meetingId,
         valueName,
         value
     }
 }

 export const bulkUpdateMeetingParts = (updateObject) => {
     return {
         type: actionTypes.BULK_UPDATE_MEETING_PARTS,
         updateObject
     }
 }

 export const addMeetingIdMap = (meetingIdLocal, meetingIdCake) => {
     return {
         type: actionTypes.ADD_MEETING_ID_MAP,
         meetingIdLocal,
         meetingIdCake
     }
 }

 export const removeMeetingIdMap = (meetingIdLocal) => {
    return {
        type: actionTypes.REMOVE_MEETING_ID_MAP,
        meetingIdLocal
    }
}

export const removeMeetingParts = (meetingId) => {
    return {
        type: actionTypes.REMOVE_MEETING_PARTS,
        meetingId
    }
}

