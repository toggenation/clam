import DatePicker from "react-datepicker";
import React from "react";
import moment from "moment";
import "react-datepicker/dist/react-datepicker.css";
import "../Styles/tgnInput.css";
//import Col from "reactstrap/lib/Col";
import Button from "reactstrap/lib/Button";
import { connect } from "react-redux";
import { Aux } from "./Aux";
import {
    setScheduleEndDate,
    toggleScheduleModal
} from "../Redux/actions/actionCreators";
import {
    setScheduleStartDateThunk,
    addScheduleThunk,
    saveScheduleThunk
} from "../Redux/actions/async";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
    faCalendarAlt,
    faPlusCircle,
    faSave
} from "@fortawesome/free-solid-svg-icons";


const ConfigureSchedule = props => {
    const {
        start_date,
        end_date,
        updateScheduleEndDate,
        updateScheduleStartDate,
        addClick,
        scheduleId,
        saveClick,
        isPublished
    } = props;

    const buttonConfig = scheduleId
        ? {
              icon: faSave,
              buttonText: "Save Schedule",
              clickFunction: saveClick
          }
        : {
              icon: faPlusCircle,
              buttonText: "Create Schedule",
              clickFunction: addClick
          };
    const startDate = moment(start_date);
    const endDate = moment(end_date);

    return (
        <Aux>
            <div className="input-group input-group-sm mb-3">
                <div className="input-group-prepend">
                    <span className="input-group-text">
                        <FontAwesomeIcon icon={faCalendarAlt} />{" "}
                    </span>
                </div>
                <DatePicker
                    className="form-control form-control-sm tgn-input meetingDatePicker"
                    dateFormat="DD/MM/YYYY"
                    selected={startDate}
                    selectsStart
                    autocomplete="false"
                    startDate={startDate}
                    endDate={endDate}
                    onChange={m => {
                        updateScheduleStartDate(m);
                    }}
                />
                <div className="input-group-append">
                    <span
                        className="input-group-text"
                        style={{ borderLeft: 0, borderRight: 0 }}
                    >
                        to
                    </span>
                </div>

                <DatePicker
                    className="form-control form-control-sm tgn-input meetingDatePicker"
                    dateFormat="DD/MM/YYYY"
                    selected={endDate}
                    selectsEnd
                    autocomplete="false"
                    startDate={startDate}
                    endDate={endDate}
                    onChange={m => {
                        updateScheduleEndDate(m.format());
                    }}
                />
                <div className="input-group-append">
                    <Button
                        color="primary"
                        onClick={buttonConfig.clickFunction}
                        size="sm"
                        disabled={isPublished}
                    >
                      <FontAwesomeIcon icon={buttonConfig.icon} /> {buttonConfig.buttonText}
                    </Button>
                </div>
            </div>
        </Aux>
    );
};
const mapDispatchToProps = {
    updateScheduleStartDate: setScheduleStartDateThunk,
    updateScheduleEndDate: setScheduleEndDate,
    addClick: addScheduleThunk,
    cancelClick: toggleScheduleModal,
    saveClick: saveScheduleThunk
};

const mapStateToProps = (state, ownProps) => {
    return { ...state.schedule, isPublished: state.schedule.isPublished };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(ConfigureSchedule);
