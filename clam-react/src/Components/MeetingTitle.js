import moment from "moment";
import React from "react";
import Calendar from '@material-ui/icons/CalendarTodayTwoTone'
// import DatePicker from 'react-datepicker'
import classes from './MeetingTitle.module.css';
import DatePicker from 'react-datepicker';
import {connect} from 'react-redux';
import AddMeeting from '../Components/AddMeeting';
import HelpBlock from './HelpBlock';

import { resortMeetingsAfterDateChange } from '../Redux/actions/async';
import {
    Row,
    Col
} from 'reactstrap';

class MeetingDateTitle extends React.Component {
    render(){
        let style = {cursor:'pointer', width: '300px',}
        if(this.props.error.show) {
            style.marginBottom = '0px'
        }
    return (
        <div><h5
            style={style}
            className={classes.MeetingTitle}
            onClick={this.props.onClick}
        ><Calendar style={{marginBottom: '6px'}}/>{' '}{this.props.value}</h5>
                <HelpBlock error={this.props.error} />
        </div>
    )}
}

const MeetingTitle = ({ meetingDate, handleChange, meetingId, deleteMeeting, isPublished })  => {
    const md = moment(meetingDate, "YYYY-MM-DD")
    const error = {
        blockId: 12,
        show: false ,
        text: 'Hi there'};
    return (
        <Row>
            <Col>
            <DatePicker
                customInput={<MeetingDateTitle error={error} />}
                selected={md}
                disabled={isPublished}
                dateFormat={"ddd Do MMMM YYYY"}
                onChange={(m) => {
                    handleChange(meetingId, m.format('YYYY-MM-DD'))
                }} />
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
