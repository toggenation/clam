import * as actions from '../Redux/actions/actionCreators'
import actionTypes from '../Redux/actions/actionTypes'

/*
export const deleteCoParts = (meetingId, partId) => {
    return {
        type: actionTypes.DELETE_CO_PART,
        meetingId: meetingId,
        partId: partId
    };
};
*/
describe('actions', () => {
  it('should create an action deleteCoPart', () => {
    const meetingId = '12345'
    const partId = '5'
    const expectedAction = {
      type: actionTypes.DELETE_CO_PART,
      meetingId: meetingId,
      partId: partId
    }
    expect(actions.deleteCoParts(meetingId, partId)).toEqual(expectedAction)
  })
  it('should create an action add API Url', () => {
      /*
      export const setApiUrl = baseUrl => {
    console.log("Setting API", baseUrl);
    return {
        type: actionTypes.SET_API_URL,
        baseUrl: baseUrl
    };
};*/
    const baseUrl = 'http://clam.tgn'

    const expectedAction = {
      type: actionTypes.SET_API_URL,
      baseUrl: baseUrl
    }
    expect(actions.setApiUrl(baseUrl)).toEqual(expectedAction)
  })
})
