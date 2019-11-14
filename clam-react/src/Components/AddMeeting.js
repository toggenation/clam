
import React from "react";

import moment from "moment";
import { Spinner } from "../Components/Spinner";
import IconLink from "../Components/IconLink";
import DatePickerInputGroup from './DatePickerInputGroup'
import Aux from '../Components/Aux'
import {
    faFilePdf,
    faUsers
} from "@fortawesome/free-solid-svg-icons";

import { connect } from "react-redux";
import { Col } from "reactstrap";
import { setMeetingDate } from "../Redux/actions/actionCreators";
import { addMeetingSortedThunk } from "../Redux/actions/async";

const AddMeeting = props => {
    const {
        meetingCount,
        apiRoot,
        scheduleId,
        isFetching
    } = props;

    const spinner = isFetching ? <Spinner /> : null;
    let addMeeting = null;

    if(scheduleId) {
        addMeeting = (
            <Aux>
            <Col>{spinner}</Col>
            <Col lg={{ size: 3 }}>
                   <DatePickerInputGroup meetingCount={meetingCount}/>
            </Col>
            <Col>
                <IconLink
                    display={scheduleId}
                    icon={faFilePdf}
                    href={apiRoot + "schedules/pdf-view/" + scheduleId}
                    title="View PDF"
                    target="_blank"
                />

                <IconLink
                    display={scheduleId}
                    icon={faUsers}
                    href={apiRoot + "people/view-who/" + scheduleId}
                    title="Assignments"
                    target="_blank"
                />
            </Col>
            </Aux>
        )
    }
    return addMeeting;

};

const mapDispatchToProps = {
    meetingDateSelected: setMeetingDate,
    clickMeetingAddButton: addMeetingSortedThunk
};
const mapStateToProps = state => {
    const meetingCount = state.meetingsById.length || 0;
    const { apiRoot, schedule, fetchReducer, addMeeting } = state;
    const { start_date, end_date } = schedule;
    const { isFetching } = fetchReducer;
    const { meetingDate } = addMeeting;
    const scheduleId = schedule.scheduleId;
    return {
        scheduleId,
        apiRoot: apiRoot.baseUrl,
        isFetching,
        meetingDate,
        meetingCount: meetingCount,
        startDate: moment(start_date),
        endDate: moment(end_date),
        isPublished: state.schedule.isPublished
    };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(AddMeeting);
