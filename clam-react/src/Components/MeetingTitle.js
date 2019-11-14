import moment from "moment";
import React from "react";
import Calendar from '@material-ui/icons/CalendarTodayTwoTone'
// import DatePicker from 'react-datepicker'
import classes from './MeetingTitle.module.css';
import DatePicker from 'react-datepicker';
import {connect} from 'react-redux';
import AddMeeting from '../Components/AddMeeting';

import { resortMeetingsAfterDateChange } from '../Redux/actions/async';
import {
    Row,
    Col
} from 'reactstrap';

class MeetingDateTitle extends React.Component {
    render(){
    return (
        <h5
            style={{cursor:'pointer'}}
            className={classes.MeetingTitle}
            onClick={this.props.onClick}
        ><Calendar style={{marginBottom: '6px'}}/>{' '}{this.props.value}</h5>
    )}
}

const MeetingTitle = ({ meetingDate, handleChange, meetingId, deleteMeeting, isPublished })  => {
    const md = moment(meetingDate, "DD/MM/YYYY")
    return (
        <Row>
            <Col>
            <DatePicker
                customInput={<MeetingDateTitle />}
                selected={md}
                disabled={isPublished}
                dateFormat={"ddd Do MMMM YYYY"}
                onChange={(m) => { handleChange(meetingId, m.format('DD/MM/YYYY'))}} />
            </Col>

             <AddMeeting />

        </Row>
    );
};

const mapStateToProps = (state, ownProps) => {
    const { meetingId } = ownProps;
    //console.log(state,ownProps);
    return {
        meeting: state.meetings[meetingId],
        isPublished: state.schedule.isPublished
    }
}
const mapDispatchToProps = {
    handleChange: resortMeetingsAfterDateChange
}
export default connect(mapStateToProps, mapDispatchToProps)(MeetingTitle);
