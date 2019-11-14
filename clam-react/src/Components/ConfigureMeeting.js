import React from "react";
import { connect } from "react-redux";
import { isCoVisit, getMeeting } from "../Redux/reducers/meetingsReducer";
import Input from "reactstrap/lib/Input";
import Label from "reactstrap/lib/Label";

import { faSave, faTrashAlt } from "@fortawesome/free-solid-svg-icons";
import { Row } from "reactstrap";
import Col from "reactstrap/lib/Col";
import FormGroup from "reactstrap/lib/FormGroup";
import Button from "reactstrap/lib/Button";
import { Aux } from "../Components/Aux";
import { toggleScheduleSaveModal } from "../Redux/actions/actionCreators";
import { getDisplayPartPicker } from "../Redux/reducers/rootReducer";
import {
    chairmanChange,
    addPartPickerThunk,
    addCoPartThunk,
    auxCounselorChange,
    insertPartThunk,
    deleteMeetingThunk,
    saveScheduleThunk
} from "../Redux/actions/async";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { getCurrentPartList } from "../Redux/reducers/rootReducer";

import { showPartPicker } from "../Redux/reducers/addPartReducer";
import AddPart from "./AddPart";

import { updateForm, hideAddPart } from "../Redux/actions/actionCreators";

/*
import {
    CSSTransition,
    TransitionGroup,
} from 'react-transition-group';
*/

const ConfigureMeeting = props => {
    const {
        addPart,
        addParts,
        auxCounselors,
        chairmen,
        checkCoVisit,
        hideAddPart,
        insertPart,
        isPublished,
        meeting,
        meetingId,
        partArrayObject,
        saveButtonPress,
        setChairmanChange,
        setMeetingValueOnChange,
        diplayPartPicker,
        toggleCoVisit,
        updateForm,
        deleteMeeting
    } = props;

    const checkBoxName = `checkBox-${meetingId}`;

    const { auxiliary_counselor_id, person_id } = meeting;
    const auxCounselorId = auxiliary_counselor_id || "";
    const chairmanId = person_id || "";

    const pleaseSelect = [{ id: 0, name: "(Please select)" }];

    const auxCounselorsWithPleaseSelect = pleaseSelect.concat(auxCounselors);
    const meetingChairmenWithPleaseSelect = pleaseSelect.concat(chairmen);

    //  console.log(withPleaseSelect);
    let coVisit = checkCoVisit(meetingId);

    //let style = { fontSize: "14px", marginTop: "5px" };

    let displayPicker = diplayPartPicker(meetingId);

    const partArrayAsObjects = partArrayObject(meetingId);

    let addPartButton = null;
    let addPartPicker = null;

    if (!displayPicker && !isPublished) {
        addPartButton = (
            <Button
                size="sm"
                color="primary"
                style={{ marginRight: "12px", cursor: "pointer" }}
                onClick={e => {
                    addPart(meetingId);
                }}
            >
                <FontAwesomeIcon icon="plus-circle" /> Add part
            </Button>
        );
    }
    if (displayPicker) {
        addPartPicker = (
            <AddPart
                key={"AddPartPickert" + meetingId}
                hideAddPart={hideAddPart}
                meetingId={meetingId}
                updateForm={updateForm}
                partArrayObject={partArrayAsObjects}
                addParts={addParts}
                insertPart={insertPart}
            />
        );
    }

    return (
        <Aux>
            <Row form>
                <Col lg={2}>
                    <FormGroup check inline>
                        <Input
                            disabled={isPublished}
                            key={meetingId}
                            checked={coVisit}
                            id={checkBoxName}
                            bsSize="sm"
                            onChange={e =>
                                toggleCoVisit(meetingId, e.target.checked)
                            }
                            type="checkbox"
                        />
                        <Label
                            size="sm"
                            check={true}
                            htmlFor={checkBoxName}
                            title="Circuit Overseers Visit"
                        >
                            C.O. Visit
                        </Label>
                    </FormGroup>
                </Col>

                <Col lg={4}>
                    <div className="form-inline">
                        <FormGroup inline>
                            <Label
                                size="sm"
                                for={`auxiliary_counselor_id-${meetingId}`}
                            >
                                Auxiliary Counselor&nbsp;&nbsp;
                            </Label>
                            <Input
                                disabled={isPublished}
                                id={`auxiliary_counselor_id-${meetingId}`}
                                bsSize="sm"
                                type="select"
                                value={auxCounselorId}
                                onChange={e => {
                                    setMeetingValueOnChange(
                                        meetingId,
                                        "auxiliary_counselor_id",
                                        e.target.value
                                    );
                                }}
                            >
                                {auxCounselorsWithPleaseSelect.map(obj => {
                                    return (
                                        <option key={obj.id} value={obj.id}>
                                            {obj.name}
                                        </option>
                                    );
                                })}
                            </Input>
                        </FormGroup>
                    </div>
                </Col>

                <Col lg={4} xs="12">
                    <div className="form-inline">
                        <FormGroup>
                            <Label size="sm" for="chairman_id">
                                Chairman&nbsp;&nbsp;
                            </Label>
                            <Input
                                disabled={isPublished}
                                value={chairmanId}
                                id={`person_id-${meetingId}`}
                                bsSize="sm"
                                onChange={e => {
                                    setChairmanChange(
                                        meetingId,
                                        "person_id",
                                        e.target.value
                                    );
                                }}
                                type="select"
                            >
                                {meetingChairmenWithPleaseSelect.map(obj => {
                                    return (
                                        <option key={obj.id} value={obj.id}>
                                            {obj.name}
                                        </option>
                                    );
                                })}
                            </Input>
                        </FormGroup>
                    </div>
                </Col>
                <Col>
                    <span className="float-right">
                        <Button
                            disabled={isPublished}
                            className="align-bottom"
                            size="sm"
                            onClick={saveButtonPress}
                        >
                            <FontAwesomeIcon icon={faSave} /> Save
                        </Button>

                        <Button
                            key={meetingId}
                            className="ml-4"
                            size="sm"
                            disabled={isPublished}
                            color="danger"
                            onClick={e => {
                                !isPublished && deleteMeeting(meetingId);
                            }}
                            //className="btn btn-sm btn-link mb-1"
                            title="Delete meeting"
                        >
                            <FontAwesomeIcon icon={faTrashAlt} /> Delete
                        </Button>
                    </span>
                </Col>
            </Row>
            <Row>
                    <Col className="mb-2 mt-2">
                    {addPartButton}
                    {addPartPicker}
                    </Col>

            </Row>
        </Aux>
    );
};

const mapDispatchToProps = {
    insertPart: insertPartThunk,
    toggleCoVisit: addCoPartThunk,
    addPart: addPartPickerThunk,
    hideAddPart: hideAddPart,
    updateForm: updateForm,
    setMeetingValueOnChange: auxCounselorChange,
    setChairmanChange: chairmanChange,
    toggleSaveModal: toggleScheduleSaveModal,
    saveButtonPress: saveScheduleThunk,
    deleteMeeting: deleteMeetingThunk
};

const mapStateToProps = (state, ownProps) => {
    return {
        meeting: getMeeting(ownProps.meetingId, state),
        isPublished: state.schedule.isPublished,
        addParts: state.addParts,
        diplayPartPicker: meetingId => getDisplayPartPicker(meetingId, state),
        chairmen: state.privs.meetingChairmen || [],
        auxCounselors: state.privs.auxCounselors || [],
        partArrayObject: meetingId => getCurrentPartList(meetingId, state),
        checkCoVisit: meetingId => isCoVisit(meetingId, state),
        showPartPicker: meetingId => showPartPicker(meetingId, state)
    };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(ConfigureMeeting);
