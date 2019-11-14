import {
    meetings,

} from "../Redux/reducers/meetingsReducer";
import {
    getMeetings,
    getFormattedMeetingForSendingToApi
} from '../Redux/reducers/rootReducer'

import {
    getMeetingsOutputObject,
    dummyState
} from "../__mockStore/asyncActionsMockStore";
import { addMeetingIdMap } from "../Redux/actions/actionCreators";
import actionTypes from "../Redux/actions/actionTypes";

describe("format Meetings for send to Cake", () => {
    it("formats a meeting JSON to send to cake", () => {
        const dummyStore = {
            schedule: {
                start_date: "2018-01-01T00:00:00+00:00",
                end_date: "2018-02-04T00:00:00+00:00",
                scheduleId: "34"
            },
            meetings: {
                "116": {
                    date: "2/1/2018",
                    meeting_id: 116,
                    local_id: 116,
                    startTime: "7:30PM",
                    coVisit: false,
                    person_id: 36,
                    auxiliary_counselor_id: 79,
                    parts: [4, 5, 6, 7, 18, 20, 10, 11, 12, 13, 15, 16, 17]
                },
                "117": {
                    date: "9/1/2018",
                    meeting_id: 117,
                    local_id: 117,
                    startTime: "7:30PM",
                    coVisit: false,
                    person_id: 264,
                    auxiliary_counselor_id: 264,
                    parts: [4, 5, 6, 7, 18, 9, 21, 11, 12, 13, 14, 15, 16, 17]
                },
                "118": {
                    date: "16/1/2018",
                    meeting_id: 118,
                    local_id: 118,
                    startTime: "7:30PM",
                    coVisit: false,
                    person_id: 79,
                    auxiliary_counselor_id: 114,
                    parts: [4, 5, 6, 7, 18, 9, 10, 23, 12, 13, 15, 16, 17]
                },
                "119": {
                    date: "23/1/2018",
                    meeting_id: 119,
                    local_id: 119,
                    startTime: "7:30PM",
                    coVisit: true,
                    person_id: 49,
                    auxiliary_counselor_id: 264,
                    parts: [4, 5, 6, 7, 18, 22, 24, 11, 12, 13, 16, 19, 17]
                },
                "120": {
                    date: "31/1/2018",
                    meeting_id: 120,
                    local_id: 120,
                    startTime: "7:30PM",
                    coVisit: false,
                    person_id: 105,
                    auxiliary_counselor_id: null,
                    parts: [4, 5, 6, 7, 18, 22, 24, 11, 12, 13, 15, 16, 17]
                }
            }
        };
        const expectedOutput = [
            {
                auxiliary_counselor_id: 79,
                co_visit: false,
                date: "2018-01-02",
                id: 116,
                person_id: 36,
                schedule_id: "34"
            },
            {
                auxiliary_counselor_id: 264,
                co_visit: false,
                date: "2018-01-09",
                id: 117,
                person_id: 264,
                schedule_id: "34"
            },
            {
                auxiliary_counselor_id: 114,
                co_visit: false,
                date: "2018-01-16",
                id: 118,
                person_id: 79,
                schedule_id: "34"
            },
            {
                auxiliary_counselor_id: 264,
                co_visit: true,
                date: "2018-01-23",
                id: 119,
                person_id: 49,
                schedule_id: "34"
            },
            {
                auxiliary_counselor_id: null,
                co_visit: false,
                date: "2018-01-31",
                id: 120,
                person_id: 105,
                schedule_id: "34"
            }
        ];

        expect(getFormattedMeetingForSendingToApi(dummyStore)).toEqual(expectedOutput);
    });
});

const dummyMeetings = {
    "255": {
        date: "1/1/2019",
        meeting_id: 255,
        startTime: "7:30PM",
        coVisit: false,
        person_id: null,
        auxiliary_counselor_id: null,
        parts: [4, 5, 6, 7, 12, 13, 14, 15, 16, 17]
    },
    "256": {
        date: "2/1/2019",
        meeting_id: 256,
        startTime: "7:30PM",
        coVisit: false,
        person_id: null,
        auxiliary_counselor_id: null,
        parts: [4, 5, 6, 7, 12, 13, 14, 15, 16, 17]
    },
    "d3620dfc-c0c7-4788-9b2b-f18c986ac70e": {
        date: "03/01/2019",
        meeting_id: "d3620dfc-c0c7-4788-9b2b-f18c986ac70e",
        startTime: "7:30PM",
        coVisit: false,
        person_id: null,
        auxiliary_counselor_id: null,
        parts: [4, 5, 6, 7, 12, 13, 14, 15, 16, 17]
    }
};

describe("getMeetings should output correctly", () => {
    it("test getMeetings correct output", () => {
        expect(getMeetings(dummyState)).toEqual(getMeetingsOutputObject);
    });
    it("addMeetingIdMap actionCreatorWorks", () => {
        const meetingIdLocal = "z";
        const meetingIdCake = "12";
        const expectedAction = {
            type: actionTypes.ADD_MEETING_ID_MAP,
            meetingIdLocal: meetingIdLocal,
            meetingIdCake: meetingIdCake
        };
        expect(addMeetingIdMap(meetingIdLocal, meetingIdCake)).toEqual(
            expectedAction
        );
    });
    it("meeting reduceer ADD_MEETING_ID_MAP works", () => {
        const meetingIdLocal = "d3620dfc-c0c7-4788-9b2b-f18c986ac70e";
        const meetingIdCake = "999";
        const expectedDummyMeetings = {
            ...dummyMeetings,
            [meetingIdLocal]: {
                ...dummyMeetings[meetingIdLocal],
                meeting_id: meetingIdCake,
                parts: [...dummyMeetings[meetingIdLocal].parts]
            }
        };
        expect(
            meetings(
                dummyMeetings,
                addMeetingIdMap(meetingIdLocal, meetingIdCake)
            )
        ).toEqual(expectedDummyMeetings);
    });

    it("meeting reduceer ADD_MEETING_ID_MAP works without parts", () => {
        const dummyState = {
            "255": {
                date: "1/1/2019",
                meeting_id: 255,
                startTime: "7:30PM",
                coVisit: false,
                person_id: null,
                auxiliary_counselor_id: null
            }
        };
        const meetingIdLocal = "255";
        const meetingIdCake = "999";
        const expectedDummyMeetings = {
            ...dummyState,
            [meetingIdLocal]: {
                ...dummyState[meetingIdLocal],
                meeting_id: meetingIdCake
            }
        };
        expect(
            meetings(dummyState, addMeetingIdMap(meetingIdLocal, meetingIdCake))
        ).toEqual(expectedDummyMeetings);
    });

    it("meeting reducer returns same state", () => {
        expect(meetings(dummyMeetings, { type: null })).toEqual(dummyMeetings);
    });

    it("meeting Reducer ADD_MEETING_ID_MAP works as expected", () => {
        expect();
    });
});
