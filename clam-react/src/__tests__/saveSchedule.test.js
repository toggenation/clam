import configureMockStore from "redux-mock-store";
import thunk from "redux-thunk";
import * as actions from "../Redux/actions/actionCreators";
import * as asyncActions from "../Redux/actions/asyncActions";
import types from "../Redux/actions/actionTypes";

import mockState from "../__mockStore/stateWithMeetingNotes";
import { saveScheduleThunk } from "../Redux/actions/asyncActions2";
//import expect from 'expect' // You can use any testing library

const middlewares = [thunk];
const mockStore = configureMockStore(middlewares);


describe("async actions", () => {


    it("deleteMeetingFromCake", () => {

        const store = mockStore(mockState);

        store.dispatch(saveScheduleThunk())
        /*return store
            .dispatch(asyncActions.deleteMeetingFromCake(meetingId))
            .then(data => {
                expect(store.getActions()).toEqual(expectedActions);
            }); */
    });
});
