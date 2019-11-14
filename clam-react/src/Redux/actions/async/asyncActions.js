import moment from "moment";
import { normalize, schema } from "normalizr";
import { batchActions } from "redux-batched-actions";
import utils from "../../../Utility/utilities";
import * as actions from "../actionCreators";
import { push } from "connected-react-router";
import {
    getCoVisitParts,
    getNotCoVisitParts,
    getApiRoot,
    getCurrentPartList,
    getMeetingIdSortedByDate,
    getNonCoVisitParts,
    getAssignedId
} from "../../reducers/rootReducer";

const replaceTokenFn = (stringWithToken, replaceToken, replaceValue) => {
    return stringWithToken.replace(replaceToken, replaceValue);
};
const getPartIndexFromSortedPartList = (partToAdd, partList, partsByIds) => {
    let newParts = partList.concat(partToAdd);
    let sortedNewParts = newParts.sort((a, b) => {
        return partsByIds[a].sort_order - partsByIds[b].sort_order;
    });

    return sortedNewParts.indexOf(partToAdd);
};

export const updateMeetingToCake = (dispatch, meetingId, newObject, url) => {
    const postData = {
        id: meetingId,
        ...newObject
    };

    return utils
        .fetchFromCake(dispatch)(url, "PUT", postData)
        .then(data => {
            if (data.success) {
                dispatch(actions.fetchSuccess());
            }
        });
};

export const addCoPartThunk = (meetingId, checkBoxValue) => {
    return (dispatch, getState) => {
        const state = getState();
        const { meetings, partsObjectByIds, meetingPartsById } = state;
        const API_URL = getApiRoot(state);

        let coParts = getCoVisitParts(state);
        let currentNotCoParts = getNotCoVisitParts(meetingId, state);
        let nonCoVisitParts = getNonCoVisitParts(state);
        //console.warn(coParts, currentNotCoParts, nonCoVisitParts);

        let meeting = meetings[meetingId];
        let parts = meeting.parts.slice();

        let multiAction = [actions.clickCoVisit(meetingId, checkBoxValue)];

        if (utils.isEmptyObject(meetingPartsById)) {
            console.log("no meetings so returning from addCoPartThunk");
            return;
        }

        if (checkBoxValue) {
            // its a coVisit
            if (!parts.some(r => coParts.includes(r))) {
                coParts.forEach(coP => {
                    if (!meetingPartsById[meetingId][coP]) {
                        let newPart = Object.assign({}, partsObjectByIds[coP]);
                        multiAction = multiAction.concat(
                            actions.addCoPart(meetingId, coP, newPart)
                        );
                    }

                    multiAction = multiAction.concat(
                        actions.insertCoPart(
                            getPartIndexFromSortedPartList(
                                coP,
                                parts,
                                partsObjectByIds
                            ),
                            meetingId,
                            coP
                        )
                    );

                    multiAction = multiAction.concat(
                        addMeetingPartToCake(
                            formatInsertPart(
                                meetingId,
                                coP,
                                partsObjectByIds,
                                meetings
                            )
                        )
                    );
                });
                currentNotCoParts.forEach(x => {
                    multiAction = multiAction.concat(
                        actions.deleteCoParts(meetingId, x)
                    );
                    multiAction = multiAction.concat(
                        deletePartUpdateTimesThunk(meetingId, x, 0) // 0 not needed
                    );
                });
            }
        } else {
            // not a co visit
            coParts.forEach(x => {
                multiAction = multiAction.concat(
                    actions.deleteCoParts(meetingId, x)
                );
                multiAction = multiAction.concat(
                    deletePartUpdateTimesThunk(meetingId, x, 0) // 0 not needed
                );
            });

            nonCoVisitParts.forEach(x => {
                if (!meetingPartsById[meetingId][x]) {
                    let newPart = Object.assign({}, partsObjectByIds[x]);
                    multiAction = multiAction.concat(
                        actions.addCoPart(meetingId, x, newPart)
                    );
                    multiAction = multiAction.concat(
                        addMeetingPartToCake(
                            formatInsertPart(
                                meetingId,
                                x,
                                partsObjectByIds,
                                meetings
                            )
                        )
                    );
                }

                let index = getPartIndexFromSortedPartList(
                    x,
                    parts,
                    partsObjectByIds
                );

                multiAction = multiAction.concat(
                    actions.insertCoPart(index, meetingId, x)
                );
            });
        }
        dispatch(batchActions(multiAction));

        dispatch(updateAllStartTimesThunk(meetingId));
        updateMeetingToCake(
            dispatch,
            meeting.meeting_id,
            { co_visit: checkBoxValue },
            `${API_URL}/meetings/edit/${meeting.meeting_id}`
        );
    };
};

export const addPartPickerThunk = meetingId => {
    return (dispatch, getState) => {
        const cpl = getCurrentPartList(meetingId, getState());

        const firstPart = cpl.shift();

        dispatch(actions.updateForm("", firstPart.id, firstPart.partname));
        dispatch(actions.addPartPicker(meetingId));
    };
};

export const setScheduleStartDateThunk = startDateMoment => {
    return (dispatch, getState) => {
        const state = getState();
        const { schedule } = state;
        const { scheduleId } = schedule;

        const dateFormatted = startDateMoment.format();

        dispatch(actions.setScheduleStartDate(dateFormatted));

        if (!scheduleId) {
            var futureMonthEnd = moment(startDateMoment).endOf("month");
            dispatch(actions.setScheduleEndDate(futureMonthEnd.format()));
        }

        dispatch(actions.setMeetingDate(dateFormatted));
    };
};
export const deletePartUpdateTimesThunk = (
    meeting_id,
    part_id,
    indexNumber
) => {
    return (dispatch, getState) => {
        const state = getState();
        const API_URL = getApiRoot(state);
        const assignedId = getAssignedId(meeting_id, part_id, state);
        dispatch(actions.deletePart(part_id, meeting_id, indexNumber));
        dispatch(updateAllStartTimesThunk(meeting_id));
        if (assignedId) {
            return utils
                .fetchFromCake(dispatch)(
                    `${API_URL}/assigned/delete/${assignedId}`,
                    "POST"
                )
                .then(data => {
                    console.log("deleted cake part", assignedId);
                    dispatch(actions.fetchSuccess());
                    return data;
                });
        }
    };
};

export const addPartsObjectForSingleMeetingThunk = meetingId => {
    return (dispatch, getState) => {
        const { partsAllIds, partsObjectByIds } = getState();

        // yah first working filter & map using reduce
        const filteredParts = partsAllIds.reduce(
            (accum, current) => {
                if (
                    !partsObjectByIds[current].school_part &&
                    !partsObjectByIds[current].co_visit
                ) {
                    return {
                        partIds: accum.partIds.concat(current),
                        partObjects: {
                            ...accum.partObjects,
                            [current]: partsObjectByIds[current]
                        }
                    };
                }
                return accum;
            },
            { partIds: [], partObjects: {} }
        );

        dispatch(
            batchActions([
                actions.addToMeetingPartsById(
                    meetingId,
                    filteredParts.partObjects,
                    filteredParts.partIds
                ),
                actions.addSinglePartsObject(meetingId, filteredParts.partIds),
                updateAllStartTimesThunk(meetingId)
            ])
        );
    };
};

const meetingExists = (meetings, meetingDate) => {
    //console.log(meetings);
    const meetingDateMoment = moment(meetingDate, "DD/MM/YYYY").format(
        "YYYY-MM-DD"
    );
    /* const meetingDateSeen = Object.keys(meetings)
        .map(x => {
            return moment(meetings[x].date, "DD/MM/YYYY").format("YYYY-MM-DD");
        })
        .includes(meetingDateMoment); */

    const meetingDateSeen = Object.keys(meetings).reduce((accum, current) => {
        if (
            moment(meetings[current].date, "DD/MM/YYYY").format(
                "YYYY-MM-DD"
            ) === meetingDateMoment
        ) {
            return true;
        } else {
            return accum;
        }
    }, false);
    return meetingDateSeen;
};

export const showHideAlertTimed = dispatch => (
    message,
    color = "danger",
    time = 4000
) => {
    dispatch(actions.addMessage(message, color));
    dispatch(actions.showAlert());
    setTimeout(() => {
        dispatch(actions.hideAlert());
    }, time);
};

export const addMeetingSortedThunk = (meetingDate, meetingID) => {
    return (dispatch, getState) => {
        const { schedule, meetings } = getState();

        if (schedule.scheduleId === "") {
            showHideAlertTimed(dispatch)(
                "Cannot add meetings until a schedule is created or selected!"
            );
            return;
        }

        if (schedule.isPublished) {
            showHideAlertTimed(dispatch)(
                "You cannot add a meeting to a published schedule. Please unpublish to add a meeting"
            );
            return;
        }
        if (meetingExists(meetings, meetingDate)) {
            showHideAlertTimed(dispatch)(
                `Meeting date ${meetingDate} already added!`,
                "danger"
            );
            return;
        }
        dispatch(actions.addMeeting(meetingDate, meetingID));

        dispatch(addMeetingToCakeThunk(meetingDate, meetingID));

        dispatch(addPartsObjectForSingleMeetingThunk(meetingID));

        const sortedByDateMeetingIDs = getMeetingIdSortedByDate(getState());

        dispatch(actions.sortedMeetings(sortedByDateMeetingIDs));
    };
};

export const deleteMeetingFromCake = meetingId => {
    return (dispatch, getState) => {
        const { meetingIdMap, ...state } = getState();

        const API_URL = getApiRoot(state);

        const cakeId = meetingIdMap[meetingId] || meetingId;

        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/meetings/delete/${cakeId}`,
                "POST"
            )
            .then(meeting => {
                dispatch(actions.removeMeetingIdMap(meetingId));
                dispatch(actions.fetchSuccess());

                if (meeting.success) {
                    // console.log("Success DeleteMeetingFromCake", meeting);
                }
                return meeting;
            })
            .catch(e => {
                dispatch(actions.fetchFail(e));
            });
    };
};

export const addMeetingToCakeThunk = (
    meetingDate,
    meetingIdLocal,
    coVisit = false,
    chairmanId = null,
    auxCounselorId = null
) => {
    return (dispatch, getState) => {
        const { schedule, ...state } = getState();
        const { scheduleId } = schedule;
        const API_URL = getApiRoot(state);

        let postObject = {
            date: moment(meetingDate, "DD/MM/YYYY").format("YYYY-MM-DD"),
            schedule_id: scheduleId,
            co_visit: coVisit,
            person_id: chairmanId,
            auxiliary_counselor_id: auxCounselorId
        };

        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/meetings/add`,
                "POST",
                postObject
            )
            .then(meeting => {
                dispatch(actions.fetchSuccess());
                //console.log('A2C', meeting)
                if (meeting.success) {
                    let meetingId = meeting.meeting.id;
                    dispatch(
                        actions.addMeetingIdMap(meetingIdLocal, meetingId)
                    );
                    dispatch(loadMeetingPartsToCake(meetingIdLocal, meetingId));
                } else {
                    showHideAlertTimed(dispatch)(
                        Object.values(utils.flattenObject(meeting.error)).join(
                            ", "
                        ),
                        "danger"
                    );
                }
                //dispatch(actions.loadSchedules(parts));
                return meeting;
            })
            .catch(e => {
                dispatch(actions.fetchFail(e));
            });
    };
};
export const updateAllStartTimesThunk = meetingId => {
    return (dispatch, getState) => {
        // meetings, meetingId, partIds, partEntities, partId
        const { meetings, meetingPartsById } = getState();

        let totalMinutes = 0;
        let updateObject = {};
        let updateObjectArray = [];
        const meetingStartTime = meetings[meetingId].startTime;
        const meetingStartMoment = moment(meetingStartTime, "h:mmA");
        const parts = meetings[meetingId].parts;

        parts.forEach((partId, partIndex) => {
            if (partIndex === 0) {
                totalMinutes = 0;
                updateObject = {
                    meetingId: meetingId,
                    partId: partId,
                    fieldName: "start_time",
                    fieldValue: meetingStartMoment.format()
                };

                updateObjectArray = updateObjectArray.concat(updateObject);
            }

            let part = meetingPartsById[meetingId][partId];

            let { minutes, counsel_mins } = part;

            if (partIndex !== 0) {
                let newMeetingStartMoment = meetingStartMoment.clone();
                newMeetingStartMoment.add(totalMinutes, "m");
                updateObject = {
                    meetingId: meetingId,
                    partId: partId,
                    fieldName: "start_time",
                    fieldValue: newMeetingStartMoment.format()
                };
                updateObjectArray = updateObjectArray.concat(updateObject);
            }

            totalMinutes +=
                parseInt(minutes || 0) + parseInt(counsel_mins || 0);
        });
        dispatch(actions.bulkUpdateMeetingParts(updateObjectArray));
    };
};

export const updateMeetingPartThunk = (
    meetingId,
    partId,
    fieldName,
    fieldValue,
    isSong = false
) => {
    return (dispatch, getState) => {
        const { partsObjectByIds } = getState();

        if (isSong) {
            const partObject = partsObjectByIds[partId];
            const partName = partObject["partname"];
            const replaceToken = partObject["replace_token"];

            const newPartName = replaceTokenFn(
                partName,
                replaceToken,
                fieldValue
            );

            dispatch(
                batchActions([
                    actions.updateMeetingPart({
                        meetingId,
                        partId,
                        fieldName,
                        fieldValue
                    }),
                    actions.updateMeetingPart({
                        meetingId,
                        partId,
                        fieldName: "partname",
                        fieldValue: newPartName
                    })
                ])
            );
        } else {
            dispatch(
                actions.updateMeetingPart({
                    meetingId,
                    partId,
                    fieldName,
                    fieldValue
                })
            );
        }

        if (fieldName === "minutes" || fieldName === "counsel_mins") {
            dispatch(updateAllStartTimesThunk(meetingId));
        }
    };
};

export const resetValuesThunk = (meetingId, partId, indexNumber) => {
    return (dispatch, getState) => {
        const { partsObjectByIds } = getState();
        dispatch(
            actions.resetValues(
                meetingId,
                partId,
                indexNumber,
                partsObjectByIds[partId]
            )
        );
        dispatch(updateAllStartTimesThunk(meetingId));
    };
};

export const insertPartThunk = meetingId => {
    return (dispatch, getState) => {
        const { meetings, partsObjectByIds, addParts } = getState();

        const { fieldValue: partId } = addParts;

        const parts = meetings[meetingId].parts;

        const indexNumber = getPartIndexFromSortedPartList(
            partId,
            parts,
            partsObjectByIds
        );
        dispatch(
            batchActions([
                actions.insertPart(
                    indexNumber,
                    meetingId,
                    partId,
                    partsObjectByIds
                ),
                updateAllStartTimesThunk(addParts.insertInMeetingId)
            ])
        );
        dispatch(
            addMeetingPartToCake(
                formatInsertPart(meetingId, partId, partsObjectByIds, meetings)
            )
        );
    };
};

export const formatInsertPart = (
    localMeetingId,
    partId,
    partsObjectByIds,
    meetings
) => {
    const meetingId = meetings[localMeetingId].meeting_id;
    const meetingPart = [partsObjectByIds[partId]];

    const formattedPart = formatAssignmentsForPostToCake(
        meetingPart,
        meetingId
    );

    return formattedPart;
};

export const deleteMeetingThunk = meetingId => {
    return dispatch => {
        dispatch(
            batchActions([
                actions.deleteMeeting(meetingId),
                actions.removeMeetingParts(meetingId),
                deleteMeetingFromCake(meetingId),
                actions.deleteMeetingObject(meetingId)
            ])
        );
    };
};

export const updateTimeThunk = (meetingId, fieldValue) => {
    return dispatch => {
        dispatch(actions.updateTime(meetingId, fieldValue));
        dispatch(updateAllStartTimesThunk(meetingId));
    };
};

export const getPartsThunk = () => {
    return (dispatch, getState) => {
        const API_URL = getApiRoot(getState());

        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/parts/getParts?sort=sort_order&direction=asc&limit=100`
            )
            .then(parts => {
                const part = new schema.Entity("parts");
                const mySchema = { parts: [part] };
                const normalizedData = normalize(parts, mySchema);
                dispatch(actions.fetchSuccess());
                dispatch(actions.addPartsObject(normalizedData));
            })
            .catch(e => {
                dispatch(actions.fetchFail(e));
            });
    };
};

const formatAssigned = (assignedArray, meetingId) => {
    let formattedAssigned = {};
    let orderOfAssigned = [];
    orderOfAssigned = assignedArray.map(obj => {
        let objectCopied = JSON.parse(JSON.stringify(obj));
        const part = { ...objectCopied.part };
        const {
            partname: storedPartname,
            minutes: storedMinutes,
            ...newObject
        } = part;

        objectCopied.assigned_id = objectCopied.id;
        delete objectCopied.part;
        delete newObject.section;
        let songNumber = null;
        const partTitle = objectCopied.part_title;
        const digitRegEx = /\d+/;
        const matches = partTitle.match(digitRegEx);

        if (matches !== null) {
            songNumber = matches[0];
        }

        let combinedObject = {
            ...objectCopied,
            ...newObject,
            partname: objectCopied.part_title,
            minutes: objectCopied.minutes,
            songNumber: songNumber
        };

        formattedAssigned[obj.part_id] = combinedObject;
        return obj.part_id;
    });
    const returnValue = {
        assignedObjectById: { [meetingId]: formattedAssigned },
        assignedArrayById: orderOfAssigned
    };

    return returnValue;
};

export const getScheduleThunk = scheduleId => {
    return (dispatch, getState) => {
        dispatch(actions.clearMeetings());
        const { router, ...state } = getState();
        const API_URL = getApiRoot(state);
        const pathname = router.location.pathname;
        if (!scheduleId) {
            dispatch(actions.setScheduleId(""));
            dispatch(push(pathname));
            return;
        }
        dispatch(push(pathname + `?id=${scheduleId}`));
        dispatch(actions.updateStop());

        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/assigned/loadSchedule/${scheduleId}`
            )
            .then(schedule => {
                const {
                    start_date,
                    end_date,
                    published: isPublished
                } = schedule.schedule;

                let multiActions = [
                    actions.setScheduleData({
                        start_date,
                        end_date,
                        scheduleId,
                        isPublished
                    }),
                    actions.setMeetingDate(start_date)
                ];
                let assigned = {};
                const meetingsArray = schedule.meetings.map((meeting, idx) => {
                    //console.log(meeting);
                    const formattedDate = moment(meeting.date).format(
                        "D/M/YYYY"
                    );
                    const {
                        id: meetingId,
                        assigned: meetingAssigned,
                        auxiliary_counselor_id: auxCounselorId,
                        person_id: chairmanId,
                        co_visit: coVisit
                    } = meeting;
                    let startTime = null;
                    // console.log("MEETING", meeting);
                    if (meetingAssigned.length > 0) {
                        startTime = moment
                            .utc(meetingAssigned[0].start_time)
                            .format("h:mm A");
                    }

                    multiActions = multiActions.concat(
                        actions.addMeeting(
                            formattedDate,
                            meetingId,
                            chairmanId,
                            auxCounselorId,
                            coVisit,
                            startTime
                        )
                    );

                    if (meetingAssigned.length > 0) {
                        assigned = formatAssigned(meetingAssigned, meetingId);

                        //console.log(assigned);
                        multiActions = multiActions.concat(
                            actions.populateMeetingPartsByIdFromCake({
                                ...assigned.assignedObjectById
                            })
                        );
                        multiActions = multiActions.concat(
                            actions.addSinglePartsObject(meetingId, [
                                ...assigned.assignedArrayById
                            ])
                        );
                    }
                    if (meeting.meeting_note !== null) {
                        const { meeting_note: meetingNote } = meeting;
                        const {
                            heading,
                            note,
                            id: meetingNoteId
                        } = meetingNote;
                        multiActions = multiActions.concat(
                            actions.addMeetingNoteFromCake(
                                meetingId,
                                meetingNoteId,
                                heading,
                                note
                            )
                        );
                    }

                    assigned = {};
                    return meetingId;
                });

                multiActions = multiActions.concat(
                    actions.loadMeetingsById(meetingsArray)
                );

                let updateTimes = meetingsArray.map(meetingId => {
                    return updateAllStartTimesThunk(meetingId);
                });

                multiActions = multiActions.concat(updateTimes);
                multiActions = multiActions.concat(
                    actions.loadSchedule(schedule)
                );
                multiActions = multiActions.concat(actions.fetchSuccess());
                multiActions = multiActions.concat(actions.updateAllow());

                dispatch(batchActions(multiActions));
            })
            .catch(e => {
                console.log("fetchFail", e);
                dispatch(actions.fetchFail(e));
            });
    };
};

export const getPrivsThunk = () => {
    return (dispatch, getState) => {
        const API_URL = getApiRoot(getState());

        return utils
            .fetchFromCake(dispatch)(`${API_URL}/assigned/getPrivs`)
            .then(parts => {
                //const part = new schema.Entity("parts");
                //const mySchema = { parts: [part] };
                //const normalizedData = normalize(parts, mySchema);

                dispatch(actions.fetchSuccess());
                dispatch(actions.loadPrivs(parts));
            })
            .catch(e => {
                dispatch(actions.fetchFail(e));
            });
    };
};

export const getSchedulesThunk = () => {
    return (dispatch, getState) => {
        const API_URL = getApiRoot(getState());

        return utils
            .fetchFromCake(dispatch)(`${API_URL}/schedules/list`)
            .then(parts => {
                dispatch(actions.fetchSuccess());
                dispatch(actions.loadSchedules(parts));
            })
            .catch(e => {
                dispatch(actions.fetchFail(e));
            });
    };
};

const dateRangesOverlap = (schedule, schedules) => {
    const startDateMoment = moment(schedule.start_date).valueOf();
    const endDateMoment = moment(schedule.end_date).valueOf();
    //(StartDate1 <= EndDate2) and (StartDate2 <= EndDate1)
    const scheduleOverlaps = schedules.some((sch, idx, schedules) => {
        const startDate2Moment = moment(sch.start_date).valueOf();
        const endDate2Moment = moment(sch.end_date).valueOf();

        return (
            startDateMoment <= endDate2Moment &&
            startDate2Moment <= endDateMoment
        );
    });
    //console.log("so", scheduleOverlaps);
    return scheduleOverlaps;
};

export const addScheduleThunk = () => {
    return (dispatch, getState) => {
        dispatch(actions.hideAlert());
        const { schedules, schedule, ...state } = getState();
        const API_URL = getApiRoot(state);

        if (dateRangesOverlap(schedule, schedules)) {
            showHideAlertTimed(dispatch)(
                "Dates cannot overlap with other schedules",
                "danger"
            );
            return;
        }
        const month = moment(schedule.start_date).format("MMMM");
        const format = "DD/MM/YYYY";
        const startDate = moment(schedule.start_date).format(format);
        const endDate = moment(schedule.end_date).format(format);
        let postObject = {
            comment: `Schedule for month of ${month}`,
            start_date: startDate,
            end_date: endDate,
            month: month
        };

        dispatch(actions.clearMeetings());

        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/schedules/add`,
                "POST",
                postObject
            )
            .then(schedule => {
                dispatch(actions.fetchSuccess());
                // console.log(schedule);
                if (schedule.success) {
                    dispatch(getSchedulesThunk());
                    dispatch(actions.setScheduleId(schedule.schedule.id));
                }
                //dispatch(actions.loadSchedules(parts));
            })
            .catch(e => {
                dispatch(actions.fetchFail(e));
            });
    };
};

export const deleteScheduleThunk = () => {
    return (dispatch, getState) => {
        dispatch(actions.hideAlert());
        const { schedule, ...state } = getState();
        const API_URL = getApiRoot(state);
        if (!(schedule && schedule.scheduleId !== "")) {
            console.log("no schedule to delete");
            showHideAlertTimed(dispatch)("Please select a schedule to delete");
            return;
        }
        const scheduleId = schedule.scheduleId;

        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/schedules/delete/${scheduleId}`,
                "POST"
            )
            .then(schedule => {
                dispatch(actions.fetchSuccess());

                if (schedule.success) {
                    dispatch(getSchedulesThunk());
                    dispatch(actions.clearMeetings());
                    dispatch(actions.setScheduleId(""));
                }
                //dispatch(actions.loadSchedules(parts));
            })
            .catch(e => {
                dispatch(actions.fetchFail(e));
            });
    };
};

export const resortMeetingsAfterDateChange = (meetingId, meetingDate) => {
    return (dispatch, getState) => {
        const { meetings, schedule, ...state } = getState();
        const API_URL = getApiRoot(state);
        const cakeMeetingId = meetings[meetingId].meeting_id;
        const meetingDates = Object.keys(meetings).map(mkey => {
            return moment(meetings[mkey].date, "D/M/YYYY").format("DD/MM/YYYY");
        });
        if (meetingDates.includes(meetingDate)) {
            showHideAlertTimed(dispatch)(
                "Meeting date already exists please choose another"
            );
            return;
        }
        dispatch(actions.setMeetingDateByMeetingId(meetingId, meetingDate));
        const { scheduleId } = schedule;
        const postData = {
            schedule_id: scheduleId,
            date: moment(meetingDate, "DD/MM/YYYY").format("YYYY-MM-DD")
        };
        const url = `${API_URL}/meetings/edit/${cakeMeetingId}`;

        updateMeetingToCake(dispatch, cakeMeetingId, postData, url);
        const sortedByDateMeetingIDs = getMeetingIdSortedByDate(getState());
        dispatch(actions.sortedMeetings(sortedByDateMeetingIDs));
    };
};

export const auxCounselorChange = (meetingId, valueName, value) => {
    return (dispatch, getState) => {
        const { meetings, ...state } = getState();
        const API_URL = getApiRoot(state);
        dispatch(actions.setMeetingValue(meetingId, valueName, value));
        const cakeMeetingId = meetings[meetingId].meeting_id;
        const newObject = {
            [valueName]: value
        };
        const url = `${API_URL}/meetings/edit/${cakeMeetingId}`;
        updateMeetingToCake(dispatch, cakeMeetingId, newObject, url);
    };
};
export const chairmanChange = (meetingId, fieldName, chairmanId) => {
    return (dispatch, getState) => {
        const { meetingPartsById, meetings, ...state } = getState();
        const API_URL = getApiRoot(state);
        const meeting = meetingPartsById[meetingId];

        const meetingPartsToAddChairmanTo = Object.keys(meeting).reduce(
            (accum, current) => {
                if (meeting[current].chairman_part === true) {
                    return accum.concat(
                        actions.updateMeetingPart({
                            meetingId,
                            partId: current,
                            fieldName,
                            fieldValue: chairmanId
                        })
                    );
                }
                return accum;
            },
            []
        );

        const batchAction = [
            actions.setMeetingValue(meetingId, fieldName, chairmanId)
        ].concat(meetingPartsToAddChairmanTo);

        dispatch(batchActions(batchAction));
        const cakeMeetingId = meetings[meetingId].meeting_id;
        updateMeetingToCake(
            dispatch,
            cakeMeetingId,
            { person_id: chairmanId },
            `${API_URL}/meetings/edit/${cakeMeetingId}`
        );
    };
};

export const parseTime = dateString => {
    const match = dateString.match(/\d{2}:\d{2}:\d{2}/)[0];
    const converted = moment(match, "HH:mm:ss");
    return converted.isValid() ? converted.format("h:mm A") : null;
};

export const formatAssignmentsForPostToCake = (meetingParts, cakeMeetingId) => {
    const copiedParts = JSON.parse(JSON.stringify(meetingParts));

    const assignedParts = Object.keys(copiedParts).map(obj => {
        const { id: partId, active, assigned_id, ...newObject } = copiedParts[
            obj
        ];
        //console.log('formatAssignmentsForPostToCake', newObject["start_time"])
        const assignedExists = assigned_id ? { id: assigned_id } : null;
        return {
            ...newObject,
            ...assignedExists,
            meeting_id: cakeMeetingId,
            part_id: partId,
            start_time: parseTime(newObject["start_time"]),
            part_title: newObject.partname
        };
    });
    //console.log(assignedParts)
    return assignedParts;
};
/**
 *
 * @param {*} meetingId
 * @param {*} meetings
 * @param {*} meetingPartsById
 */
export const getActiveMeetingParts = (
    meetingId,
    meetings,
    meetingPartsById
) => {
    const meetingPartIds = meetings[meetingId].parts;
    const meetingParts = meetingPartsById[meetingId];
    let meetingPartObject = {};

    meetingPartIds.forEach(id => {
        meetingPartObject[id] = { ...meetingParts[id] };
    });
    return meetingPartObject;
};
export const loadMeetingPartsToCake = (meetingId, cakeMeetingId) => {
    return (dispatch, getState) => {
        const { meetingPartsById, meetings, ...state } = getState();
        const API_URL = getApiRoot(state);
        const meetingParts = getActiveMeetingParts(
            meetingId,
            meetings,
            meetingPartsById
        );

        const postData = formatAssignmentsForPostToCake(
            meetingParts,
            cakeMeetingId
        );

        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/assigned/addAssignedParts`,
                "POST",
                postData
            )
            .then(data => {
                dispatch(actions.fetchSuccess());
                const responseData = data.result.map(x => {
                    return {
                        assigned_id: x.id,
                        part_id: x.part_id
                    };
                });
                dispatch(
                    actions.updateMeetingPartAssignedID(meetingId, responseData)
                );
                return data;
            })
            .catch(e => {
                console.log(e);
            });
    };
};

/**
 * resolveMeetingId
 * takes cakeMeetingId and resolves the current meetingId
 * @param {*} apiMeetingId
 * @param {*} meetingIdMap
 */
export const resolveMeetingId = (apiMeetingId, meetingIdMap) => {
    const rid = Object.keys(meetingIdMap).filter(ridKey => {
        return meetingIdMap[ridKey] === apiMeetingId;
    });

    return rid.length === 0 ? apiMeetingId : rid;
};

export const addMeetingPartToCake = postData => {
    return (dispatch, getState) => {
        const { meetingIdMap, ...state } = getState();
        const API_URL = getApiRoot(state);
        return utils
            .fetchFromCake(dispatch)(
                `${API_URL}/assigned/addAssignedParts`,
                "POST",
                postData
            )
            .then(data => {
                dispatch(actions.fetchSuccess());
                console.log(postData, data);
                if (data.success) {
                    //dispatch(actions)
                    const resolvedMeetingId = resolveMeetingId(
                        postData[0].meeting_id,
                        meetingIdMap
                    );
                    const assignedId = data.result[0].id;
                    const { part_id: partId } = postData[0];
                    // console.log(resolvedMeetingId,partId, assignedId , postData[0])
                    dispatch(
                        actions.insertPartUpdateIDFromCake(
                            resolvedMeetingId,
                            partId,
                            assignedId
                        )
                    );
                }
                return data;
            })
            .catch(e => {
                console.log(e);
            });
    };
};
