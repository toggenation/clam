
import {
    getMeetingPart,
    getAssignedId
} from '../Redux/reducers/rootReducer'

import dummyState from "../__mockStore/meetingPartsById";

describe("meetingPartsById", () => {

    it("should select a meeting part", () => {
        const meetingId = 116;
        const partId = 10;
        const expectedOutput = {
            id: 10,
            part_id: 10,
            start_time: "2019-01-22T20:05:00+11:00",
            minutes: 4,
            part_title: "First Return Visit",
            meeting_id: 116,
            person_id: 11,
            assistant_id: 124,
            aux_person_id: 80,
            aux_assistant_id: 278,
            assigned_id: 1839,
            active: true,
            chairman_part: false,
            co_visit: false,
            no_assign: false,
            assistant: true,
            replace_token: "",
            min_suffix: "min. or less",
            section_id: 2,
            sort_order: 70,
            counsel_mins: 1,
            link_to: null,
            has_auxiliary: true,
            assistant_prefix: "",
            school_part: true,
            not_co_visit: null,
            partname: "First Return Visit",
            songNumber: null
        };

        expect(getMeetingPart(meetingId, partId, dummyState)).toEqual(
            expectedOutput
        );
    });
    it("getMeeting returns null if passed nothing", () => {
        const meetingId = 300;
        const partId = 4;

        expect(
            getMeetingPart(meetingId, partId, dummyState)
        ).toBeNull();
    });
    it("assigned id is returned", () => {
        const meetingId = 116;
        const partId = 10;
        const expectedResult = 1839;
        expect(getAssignedId(meetingId, partId, dummyState)).toEqual(
            expectedResult
        );
    });
    it("assigned id is null if not exist", () => {
        const meetingId = 116;
        const partId = 6;
        expect(getAssignedId(meetingId, partId, dummyState)).toBeNull();
    });
});
