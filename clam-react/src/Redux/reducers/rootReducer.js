import { combineReducers } from 'redux'
import { loadedSchedule } from "./loadedSchedule";
import meetings, * as fromMeetingsReducer from "./meetingsReducer";
import fetchReducer, * as fromFetchReducer from "./fetchReducer";
import partsObjectByIds, * as fromPartsObjectByIds from "./partsObjectByIds";
import meetingPartsById, * as fromMeetingPartsById from "./meetingPartsById";
import schedule,  * as fromScheduleReducer from "./schedule";
import { partsAllIds } from "./partsAllIds";
import  meetingsById, * as fromMeetingsById from "./meetingsById";
import addMeeting from "./addMeeting";
import  privs, * as fromPrivsReducer from "./privsReducer";
import apiRoot, * as fromApiRoot from "./apiRoot";
import addParts, * as fromAddPartReducer from "./addPartReducer";
import { meetingNote } from "./meetingNote";
import { shouldUpdate } from "./shouldUpdateReducer";
import  schedules, * as fromSchedulesReducer from "./schedulesReducer";
import { alertMessage } from "./alertReducer";
import { meetingIdMap } from "./meetingIdMapReducer";
import { connectRouter } from 'connected-react-router';

export const createRouteReducer = history =>
    combineReducers({
        router: connectRouter(history),
        addMeeting,
        addParts,
        alertMessage,
        apiRoot,
        fetchReducer,
        loadedSchedule,
        meetingIdMap,
        meetingNote,
        meetingPartsById,
        meetings,
        meetingsById,
        partsAllIds,
        partsObjectByIds,
        privs,
        schedule,
        schedules,
        shouldUpdate
 });



export const getApiRoot = state => fromApiRoot.getApiRoot(state.apiRoot);

export const getCurrentPartList = (meetingId, state) => {
    const { meetings, partsAllIds, partsObjectByIds } = state;
    return fromAddPartReducer.getCurrentPartList(
        meetingId,
        meetings,
        partsAllIds,
        partsObjectByIds
    );
};

export const getMeetingIdSortedByDate = state =>
    fromMeetingsReducer.getMeetingIdSortedByDate(state.meetings);

export const getCoVisitParts = state =>
    fromPartsObjectByIds.getCoVisitParts(state.partsObjectByIds);

export const getNotCoVisitParts = (meetingId, state) => {
    const { meetingPartsById } = state;
    return fromMeetingPartsById.getNotCoVisitParts(meetingId, meetingPartsById);
};

export const getNonCoVisitParts = state => {
    return fromPartsObjectByIds.getNonCoVisitParts(state.partsObjectByIds);
};

export const getAssignedId = (meetingId, partId, state) =>
    fromMeetingPartsById.getAssignedId(
        meetingId,
        partId,
        state.meetingPartsById
    );

export const getMeetingPart = (meetingId, partId, state) =>
    fromMeetingPartsById.getMeetingPart(
        meetingId,
        partId,
        state.meetingPartsById
    );
export const getIsFetching = state =>
    fromFetchReducer.getIsFetching(state.fetchReducer);

export const getMeetingParts = (meetingId, state) => {
    const { meetings, meetingPartsById } = state;
    return fromMeetingsReducer.getMeetingParts(
        meetingId,
        meetings,
        meetingPartsById
    );
};

export const getMeetings = (state) => {
    const { meetings, meetingsById } = state;
    return fromMeetingsReducer.getMeetings(meetings, meetingsById)
}

export const getFormattedMeetingForSendingToApi = (state) => {
    const { meetings, schedule } = state;
    return fromMeetingsReducer.getFormattedMeetingForSendingToApi(meetings, schedule)
}

export const getIsScheduleSaveModalVisible = (state) =>
    fromSchedulesReducer.getIsScheduleSaveModalVisible(state.schedule)


export const getDisplayPartPicker = (meetingId, state ) => {
    const { addParts, schedule } = state;
    return fromAddPartReducer.getDisplayPartPicker(meetingId, addParts, schedule)
}

export const getScheduleDates = (state) =>
    fromScheduleReducer.getScheduleDates(state.schedule)

export const getMeetingCount = (state) =>
    fromMeetingsById.getMeetingCount(state.meetingsById)

export const getPrivs = (state, partId,  isAssistant) => {
    const stateSlice = state.privs || {}
    return fromPrivsReducer.getPrivs(stateSlice, partId,  isAssistant)
}

