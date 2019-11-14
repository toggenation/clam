import { connect } from "react-redux";
import Heading from "./Heading";
import Meeting from "./Meeting";
import Aux from "../Components/Aux";
import Row from "reactstrap/lib/Row";
import moment from "moment";
import Part from "./Part";
import React, { Component } from "react";
import MeetingNote from "./MeetingNote";
import ScheduleRow from "./ScheduleRow";
import AddMeeting from "./AddMeeting";
import { withRouter } from "react-router-dom";
import queryString from "query-string";
import "bootstrap/dist/css/bootstrap.min.css";
import "../Styles/styles.css";
import "../Styles/animate.css";
import {
    getMeetings,
    getMeetingParts,
    getIsFetching,
    getMeetingCount
} from "../Redux/reducers/rootReducer";
import { CSSTransition, TransitionGroup } from "react-transition-group";
import AlertMessage from "./AlertMessage";
import * as asyncActions from "../Redux/actions/async";

class clamEdit extends Component {
    componentDidMount() {
        const { getParts, getPrivs, getSchedule, search } = this.props;

        const params = queryString.parse(search);
        getParts();
        getPrivs();

        if (typeof params.id !== "undefined") {
            getSchedule(params.id);
        }
    }

    render() {
        const {
            meetingCount,
            addPart,
            schedule,
            deleteMeeting,
            deletePart,
            updateAllStartTimes,
            meetingsArrayObject,
            updateMeetingPart,
            updateTime,
            getMeetingParts,
            meetingPartsById,
            alertMessage,
            scheduleId
        } = this.props;

        const { start_date: startDate } = schedule;
        const scheduleMonth = moment(startDate).format("MMMM");
        const scheduleYear = moment(startDate).year();

        let addMeeting = null;
        // console.log(scheduleId, meetingCount);
        if (scheduleId && meetingCount === 0) {
            addMeeting = (
                <Row className="mb-3">
                    <AddMeeting />
                </Row>
            );
        }

        return (
            <Aux>
                <Heading
                    scheduleMonth={scheduleMonth}
                    scheduleYear={scheduleYear}
                    scheduleId={scheduleId}
                >
                    <AlertMessage
                        message={alertMessage.message}
                        color={alertMessage.color}
                        show={alertMessage.show}
                    />
                </Heading>

                <ScheduleRow />
                {addMeeting}
                <TransitionGroup>
                    {meetingsArrayObject &&
                        meetingsArrayObject.map(meeting => {
                            const meetingId = meeting.local_id;
                            const meetingParts = getMeetingParts(meetingId);

                            let partComponentList = null;

                            if (meetingParts) {
                                partComponentList = meetingParts.map(
                                    (partFields, index) => {
                                        const partId = partFields.id;

                                        return (
                                            <CSSTransition
                                                key={
                                                    "PartAnimation" +
                                                    meetingId +
                                                    "part" +
                                                    partId
                                                }
                                                timeout={300}
                                                classNames="meeting"
                                            >
                                                <Part
                                                    startTime={
                                                        partFields.start_time
                                                    }
                                                    meetingStartTime={
                                                        meeting.startTime
                                                    }
                                                    updateTime={updateTime}
                                                    updateMeetingPart={
                                                        updateMeetingPart
                                                    }
                                                    key={
                                                        "meeting" +
                                                        meetingId +
                                                        "partKey" +
                                                        partId
                                                    }
                                                    deletePart={deletePart}
                                                    indexNumber={index}
                                                    addPart={addPart}
                                                    meeting={meeting.date}
                                                    meetingPartsById={
                                                        meetingPartsById
                                                    }
                                                    meetingId={meetingId}
                                                    {...partFields}
                                                />
                                            </CSSTransition>
                                        );
                                    }
                                );
                            }

                            return (
                                <CSSTransition
                                    key={"meetingAnimation" + meetingId}
                                    timeout={500}
                                    classNames="fade"
                                >
                                    <Meeting
                                        updateAllStartTimes={
                                            updateAllStartTimes
                                        }
                                        deleteMeeting={deleteMeeting}
                                        key={"meeting" + meetingId}
                                        meetingDate={meeting.date}
                                        meetingId={meetingId}
                                    >
                                        <TransitionGroup className="partList">
                                            {partComponentList}
                                        </TransitionGroup>

                                        <MeetingNote meetingId={meetingId} />
                                    </Meeting>
                                </CSSTransition>
                            );
                        })}
                </TransitionGroup>
            </Aux>
        );
    }
}

const mapStateToProps = state => {
    const {
        alertMessage,
        shouldUpdate,
        meetingPartsById,
        schedule,
        router
    } = state;
    const { location } = router;
    const { search, pathname, hash } = location;
    const { scheduleId } = schedule;

    return {
        meetingCount: getMeetingCount(state),
        alertMessage,
        shouldUpdate,
        meetingPartsById,
        meetingsArrayObject: getMeetings(state),
        getMeetingParts: meetingId => getMeetingParts(meetingId, state),
        isFetching: getIsFetching(state),
        schedule,
        scheduleId,
        pathname,
        search,
        hash
    };
};

const mapDispatchToProps = {
    deleteMeeting: asyncActions.deleteMeetingThunk,
    getPrivs: asyncActions.getPrivsThunk,
    getParts: asyncActions.getPartsThunk,
    updateAllStartTimes: asyncActions.updateAllStartTimesThunk,
    updateTime: asyncActions.updateTimeThunk,
    deletePart: asyncActions.deletePartUpdateTimesThunk,
    getSchedule: asyncActions.getScheduleThunk
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(withRouter(clamEdit));
