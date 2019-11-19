import configureMockStore from "redux-mock-store";
import thunk from "redux-thunk";
import * as actions from "../Redux/actions/actionCreators";
import * as asyncActions from "../Redux/actions/async/asyncActions";
import types from "../Redux/actions/actionTypes";
import fetchMock from "fetch-mock";
import { mockStore as mockState } from "../__mockStore/loadMeetingPartsToCake";
import { mockResponse } from "../__mockStore/loadMeetingPartsToCake.js";

const middlewares = [thunk];
const mockStore = configureMockStore(middlewares);

describe("async actions", () => {
    afterEach(() => {
        fetchMock.restore();
    });

    it("loads MeetingPartsToCake", () => {
        fetchMock.postOnce(
            "http://clam-gh.tgn/api/assigned/addAssignedParts",
            {
                body: mockResponse,
                headers: { "content-type": "application/json" }
            },
            {
                headers: { Accept: "application/json" }
            }
        );

        const expectedActions = [
            { isFetching: true, type: "FETCH_START" },
            { isFetching: false, type: "FETCH_SUCCESS" },
            {
                meetingId: "5a4e23b0-e53c-4f42-ab9f-55ab0d4170d8",
                response: [
                    { assigned_id: 2962, part_id: 4 },
                    { assigned_id: 2963, part_id: 5 },
                    { assigned_id: 2964, part_id: 6 },
                    { assigned_id: 2965, part_id: 7 },
                    { assigned_id: 2966, part_id: 12 },
                    { assigned_id: 2967, part_id: 13 },
                    { assigned_id: 2968, part_id: 14 },
                    { assigned_id: 2969, part_id: 15 },
                    { assigned_id: 2970, part_id: 16 },
                    { assigned_id: 2971, part_id: 17 }
                ],
                type: "ADD_ASSIGNED_ID_TO_PARTS"
            }
        ];

        const store = mockStore(mockState);
        const meetingId = "312";
        const localMeetingId = "5a4e23b0-e53c-4f42-ab9f-55ab0d4170d8";
        return store
            .dispatch(
                asyncActions.loadMeetingPartsToCake(localMeetingId, meetingId)
            )
            .then(data => {
                // return of async actions
                //console.log("got data", data.result);
                expect(store.getActions()).toEqual(expectedActions);
            });
        // store.dispatch(asyncActions.deleteMeetingFromCake(meetingId))
        // expect(store.getActions()).toEqual(expectedActions)
    });
});
