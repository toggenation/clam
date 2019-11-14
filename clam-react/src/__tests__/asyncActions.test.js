import configureMockStore from "redux-mock-store";
import thunk from "redux-thunk";
import * as actions from "../Redux/actions/actionCreators";
import * as asyncActions from "../Redux/actions/asyncActions";
import types from "../Redux/actions/actionTypes";
import fetchMock from "fetch-mock";
import myMockStore from "../__mockStore/asyncActionsMockStore";
//import expect from 'expect' // You can use any testing library

const middlewares = [thunk];
const mockStore = configureMockStore(middlewares);

describe("async actions", () => {
    afterEach(() => {
        fetchMock.restore();
    });

    it("deleteMeetingFromCake", () => {
        fetchMock.postOnce(
            "http://clam.tgn/api/meetings/delete/214",
            {
                body: {
                    success: true,
                    data: [],
                    testReplyFromMock: "yay"
                },
                headers: { "content-type": "application/json" }
            },
            {
                headers: { Accept: "application/json" }
            }
        );

        const expectedActions = [
            { isFetching: true, type: types.FETCH_START },
            { meetingIdLocal: "214", type: types.REMOVE_MEETING_ID_MAP },
            { isFetching: false, type: types.FETCH_SUCCESS }
        ];

        const store = mockStore(myMockStore);
        const meetingId = "214";
        return store
            .dispatch(asyncActions.deleteMeetingFromCake(meetingId))
            .then(data => {
                expect(store.getActions()).toEqual(expectedActions);
            });
    });
});
