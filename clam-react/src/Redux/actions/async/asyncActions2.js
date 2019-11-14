import * as actions from "../actionCreators";
import moment from "moment";
import { parseTime } from "./asyncActions";
import utils from "../../../Utility/utilities";
import { getApiRoot } from "../../reducers/rootReducer";

export const formatSchedule = scheduleObject => {
    const { start_date, end_date, scheduleId } = scheduleObject;
    const startDate = moment(start_date).format("YYYY-MM-DD");
    const endDate = moment(end_date).format("YYYY-MM-DD");

    return {
        id: scheduleId,
        start_date: startDate,
        end_date: endDate
        // comment: comment
    };
};

export const formatMeetings = (meetingObject, scheduleId) => {
    return Object.keys(meetingObject).map(mo => {
        const {
            date,
            meeting_id,
            coVisit,
            person_id,
            auxiliary_counselor_id
        } = meetingObject[mo];
        const formattedDate = moment(date, "D/M/YYYY").format("YYYY-MM-DD");

        return {
            id: meeting_id,
            date: formattedDate,
            co_visit: coVisit,
            person_id: person_id,
            schedule_id: scheduleId,
            auxiliary_counselor_id: auxiliary_counselor_id
        };
    });
};
export const formatAssignedParts = (meetings, meetingPartsById) => {
    const meetingParts = Object.keys(meetings)
        .map(mo => {
            return meetings[mo].parts.map(mpm => {
                return meetingPartsById[mo][mpm];
            });
        })
        .reduce((accum, current, idx, src) => {
            return accum.concat(current);
        })
        .map(part => {
            const { id: partId, active, assigned_id, ...newObject } = part;
            const assignedExists = assigned_id ? { id: assigned_id } : null;
            return {
                ...newObject,
                ...assignedExists,
                part_id: partId,
                start_time: parseTime(newObject["start_time"]),
                part_title: newObject.partname
            };
        });

    /*

  const { id: partId, active, assigned_id, ...newObject }
 const assignedExists = assigned_id ? { id: assigned_id } : null;
        return {
            ...newObject,
            ...assignedExists,
            meeting_id: cakeMeetingId,
            part_id: partId,
            start_time: parseTime(newObject["start_time"]),
            part_title: newObject.partname
        };
        */

    return meetingParts;
    /*meetingParts.map(mp => {
        mp.parts.map( pid => {
            meetings[]
        })
    })*/
};

export const saveScheduleThunk = () => {
    return (dispatch, getState) => {
        const {
            schedule,
            meetings,
            meetingPartsById,
            meetingNote,
            meetingIdMap,
            ...state
        } = getState();

        const API_URL = getApiRoot(state);

        const formattedSchedule = formatSchedule(schedule);

        dispatch(
            saveToCake(
                formattedSchedule,
                `${API_URL}/schedules/edit/${formattedSchedule.id}`
            )
        );

        const formattedMeetings = formatMeetings(meetings, schedule.scheduleId);
        if (formattedMeetings.length === 0) {
            console.log("no meetings so dont continue");
            return;
        }
        dispatch(
            saveToCake(formattedMeetings, `${API_URL}/meetings/saveMeetings`)
        );

        const formattedAssignedParts = formatAssignedParts(
            meetings,
            meetingPartsById
        );
        dispatch(
            saveToCake(
                formattedAssignedParts,
                `${API_URL}/assigned/editAssignedParts`
            )
        );
        formatMeetingNotes(meetingNote, meetingIdMap).forEach(mn => {
            //console.log("Inss", mn);
            dispatch(saveMeetingNotesToCake(mn, `${API_URL}${mn.url}`));
        });
    };
};

export const saveToCake = (postData, endpoint, method = "POST") => {
    return (dispatch, getState) => {
        return utils
            .fetchFromCake(dispatch)(endpoint, method, postData)
            .then(data => {
                dispatch(actions.fetchSuccess());
            })
            .catch(e => console.log(e));
    };
};

export const saveMeetingNotesToCake = (postData, endpoint, method = "POST") => {
    return (dispatch, getState) => {
        return utils
            .fetchFromCake(dispatch)(endpoint, method, postData)
            .then(data => {
                dispatch(actions.fetchSuccess());
                if (postData.action === "add") {
                    dispatch(
                        actions.updateMeetingNoteId(
                            postData.meeting_id,
                            data.data.id
                        )
                    );
                }
                //console.log(data);
            });
    };
};

export const formatMeetingNotes = (
    meetingNotes,
    meetingIdMap,
    isDelete = false
) => {
    return Object.keys(meetingNotes).reduce((accum, current, index, arr) => {
        const meetingNote = meetingNotes[current];
        const {
            meeting_note_id,
            meeting_id,
            heading,
            note,
            active
        } = meetingNote;

        const theHeading = heading ? heading : ''
        const theNote = note ? note : ''

        let controller = '/MeetingNotes/';
        let url = ''
        let meetingNoteId = {};
        let action = '';
        const meetingId = meetingIdMap.hasOwnProperty(meeting_id)
            ? meetingIdMap[meeting_id]
            : meeting_id;

        if (meeting_note_id) {
            meetingNoteId = { id: meeting_note_id };
            action = "edit";
            url = controller + action + "/" + meeting_note_id;
        } else {
            action = "add";
            url = controller + action;
        }

        if (isDelete && meeting_note_id) {
            action = "delete";
            url = controller + action + "/" + meeting_note_id;
        }
        if ( ( theHeading !== '' && theNote !== '' )) {
            return accum.concat({
                ...meetingNoteId,
                meeting_id: meetingId,
                heading: theHeading,
                note: theNote,
                active,
                action,
                url
            });
        }
        return accum;
    }, [])
};

export const schedulePublishedCheck = isChecked => {
    return (dispatch, getState) => {
        const state = getState();
        const apiRoot = getApiRoot(state);
        const { schedule } = state;
        const { scheduleId } = schedule;

        dispatch(actions.hideAddPart());
        dispatch(actions.setScheduleData({ isPublished: isChecked }));
        dispatch(
            saveToCake(
                { id: scheduleId, published: isChecked },
                `${apiRoot}/schedules/edit/${scheduleId}`,
                "POST"
            )
        );
        if (isChecked) {
            dispatch(saveScheduleThunk());
        }
    };
};

export const handleAddRemoveMeetingNote = (meetingId, isAdd) => {
    return (dispatch, getState) => {
        const { meetingNote, meetingIdMap, ...state } = getState();
        const API_URL = getApiRoot(state);
        const mn = [meetingNote[meetingId]] || [{}];

        if (isAdd) {
            dispatch(actions.toggleMeetingNote(meetingId, isAdd));
        } else {
            if (mn[0].meeting_note_id)
                formatMeetingNotes(meetingNote, meetingIdMap, true).forEach(
                    mn => {
                        console.log("delete meeting note", mn);
                        dispatch(
                            saveMeetingNotesToCake(mn, `${API_URL}${mn.url}`)
                        );
                    }
                );
        }
        dispatch(actions.toggleMeetingNote(meetingId, isAdd));
    };
};


export const updateFirstMeetingPartStartTime = () => {

}
