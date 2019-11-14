import React from "react";
import MultipleDatePicker from "../Components/MultipleDatePicker";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faCalendarAlt } from "@fortawesome/free-solid-svg-icons";
import { connect } from "react-redux";
import utils from "../Utility/utilities";
import { getScheduleDates } from "../Redux/reducers/rootReducer";
import Aux from "./Aux";

import * as asyncActions from "../Redux/actions/async";

const DatePickerInputGroup = props => {
    const { addMeetings, scheduleStartDate, meetingCount, isPublished } = props;

    const slug = ( meetingCount > 1 || meetingCount === 0) ? 's' : '';

    const meetingLabel = <Aux>{`${meetingCount} meeting${slug}`}</Aux>;

    const datePickerInputExtraProps = {
        disabled: isPublished,
        style: {
            //backgroundColor: "#fff",
            borderTopRightRadius: "0.2rem",
            borderBottomRightRadius: "0.2rem"
        },
        className: "btn btn-primary"
    };
    return (
        <div className="input-group input-group-sm ">
            <div className="input-group-prepend">
                <span className="input-group-text">
                    <FontAwesomeIcon icon={faCalendarAlt} />{" "}
                </span>
                <span className="input-group-text" id="basic-addon2">
                    {meetingLabel}
                </span>
            </div>
            <div className="input-group-append">
                <MultipleDatePicker
                    scheduleStartDate={scheduleStartDate}
                    extraInputProps={datePickerInputExtraProps}
                    onSubmit={dates => {
                        dates.forEach(date => {
                            addMeetings(
                                utils.formatDate(date, "DD/MM/YYYY"),
                                utils.getUUID()
                            );
                        });
                    }}
                />
            </div>
        </div>
    );
};

const mapDispatchToProps = {
    addMeetings: asyncActions.addMeetingSortedThunk
};

const mapStateToProps = state => {
    const { startDate } = getScheduleDates(state);
    return {
        scheduleStartDate: utils.stringDateToDate(startDate),
        isPublished: state.schedule.isPublished
    };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(DatePickerInputGroup);
