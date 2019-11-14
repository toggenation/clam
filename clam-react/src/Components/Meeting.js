import React from "react";
//import { fab } from '@fortawesome/free-brands-svg-icons'
//import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
//import { library } from '@fortawesome/fontawesome-svg-core'
import MeetingTitle from "./MeetingTitle";
import ConfigureMeeting from "./ConfigureMeeting";
import PartTitles from "./PartTitles";
import Card from 'reactstrap/lib/Card';
import CardBody from 'reactstrap/lib/CardBody'

const Meeting = props => {
    const { meetingId, meetingDate, children, deleteMeeting } = props;

    return (

        <Card className="bg-light mb-3">
            <CardBody>
            <MeetingTitle
                meetingDate={meetingDate}
                meetingId={meetingId}
                deleteMeeting={deleteMeeting} />
            <ConfigureMeeting
                meetingId={meetingId}
                deleteMeeting={deleteMeeting}
            />
            <PartTitles />
            {children}
            </CardBody>
        </Card>

    );
};

export default Meeting;
