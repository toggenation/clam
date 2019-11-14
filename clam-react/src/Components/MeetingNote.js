import React from "react";
import { connect } from "react-redux";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faStickyNote } from "@fortawesome/free-solid-svg-icons/faStickyNote";
import { faMinusCircle } from "@fortawesome/free-solid-svg-icons/faMinusCircle";
import { faSave } from "@fortawesome/free-solid-svg-icons/faSave"
import {
    Card,
    CardHeader,
    CardBody,
    Button,
    Input,
    FormGroup,
    Label
} from "reactstrap";

import {
    handleAddRemoveMeetingNote, saveScheduleThunk
} from '../Redux/actions/async'
import {
    updateMeetingNote,
    cancelMeetingNote
} from "../Redux/actions/actionCreators";

export const CheckBoxWrapper = (props) => {
    let classes = ['form-row']
    if(props.extraClasses) {
        classes.push(props.extraClasses)
    }
    return (
        <div className={classes.join(' ')}>
            <div className="col">
                {props.children}
            </div>
            </div>
    )
}

const MeetingNoteCheckbox = ({
    handleAddRemoveMeetingNote,
    meetingId,
    active,
    isPublished
}) => {
    const meetingNoteLabel = active ? "Remove " : "Add a";
    const color = active ? "danger" : "primary";

    const icon = active ? (
        <FontAwesomeIcon icon={faMinusCircle} />
    ) : (
        <FontAwesomeIcon icon={faStickyNote} />
    );
    //<NoteAdd />;
    const checkBoxId = `meetingNoteCheckbox-${meetingId}`;
    return (

            <Button
                disabled={isPublished}
                color={color}
                size="sm"
                onClick={e => {
                    handleAddRemoveMeetingNote(meetingId, !active);
                }}
                id={checkBoxId}
            >
                {icon} {meetingNoteLabel} meeting note
            </Button>

    );
};

const MeetingNote = ({
    meetingId,
    updateMeetingNote,
    heading,
    note,
    active = false,
    handleAddRemoveMeetingNote,
    saveScheduleThunk,
    isPublished
}) => {
    let meetingNote = null;
    let meetingNoteCheckbox = (
        <MeetingNoteCheckbox
            isPublished={isPublished}
            active={active}
            meetingId={meetingId}
            handleAddRemoveMeetingNote={handleAddRemoveMeetingNote}
        />
    );

    if (active) {
        meetingNote = (
            <Card className="mt-2">
                <CardHeader tag="h5">Meeting Note</CardHeader>
                <CardBody>
                    <FormGroup>
                        <Label for={`heading-${meetingId}`}>Heading</Label>
                        <Input
                            disabled={isPublished}
                            name="heading"
                            id={`heading-${meetingId}`}
                            bsSize="sm"
                            onChange={e =>
                                updateMeetingNote(
                                    meetingId,
                                    e.target.name,
                                    e.target.value
                                )
                            }
                            type="text"
                            value={heading}
                        />
                    </FormGroup>
                    <FormGroup>
                        <Label for={`note-${meetingId}`}>Note</Label>
                        <Input
                            disabled={isPublished}
                            bsSize="sm"
                            value={note}
                            id={`note-${meetingId}`}
                            name="note"
                            onChange={e =>
                                updateMeetingNote(
                                    meetingId,
                                    e.target.name,
                                    e.target.value
                                )
                            }
                            rows="4"
                            type="textarea"
                        />
                    </FormGroup>
                    {/*<Button>Cancel</Button>*/}
                        <CheckBoxWrapper>
                            {meetingNoteCheckbox}

                        <Button
                            disabled={isPublished}
                            className="align-bottom ml-3"
                            size="sm"
                            onClick={saveScheduleThunk}
                        >
                            <FontAwesomeIcon icon={faSave} /> Save
                        </Button>

                        </CheckBoxWrapper>
                </CardBody>
            </Card>
        );
    } else {
        meetingNote = (<CheckBoxWrapper extraClasses="mt-3">
                {meetingNoteCheckbox}
                </CheckBoxWrapper> ) ;
    }
    return meetingNote;
};

const isActive = meetingNote => {
    let ret = meetingNote && meetingNote.active;
    return ret !== "undefined" && meetingNote.active === true;
};

const getFieldValue = (meetingNoteState, fieldName) => {
    return meetingNoteState.hasOwnProperty(fieldName)
        ? meetingNoteState[fieldName]
        : "";
};

const mapStateToProps = (state, ownProps) => {
    const meetingNote = state.meetingNote[ownProps.meetingId] || {};
    const { schedule } = state;
    const { isPublished } = schedule;
    return {
        active: isActive(meetingNote),
        meetingNote: meetingNote,
        heading: getFieldValue(meetingNote, "heading"),
        note: getFieldValue(meetingNote, "note"),
        meetingNotes: state.meetingNote,
        isPublished,
        disabled: isPublished
    };
};
const mapDispatchToProps = {
    handleAddRemoveMeetingNote,
    cancelMeetingNote,
    updateMeetingNote,
    saveScheduleThunk
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(MeetingNote);
