import React, { Component } from "react";
import moment from "moment";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import Col from 'reactstrap/lib/Col'
import Row from 'reactstrap/lib/Row';
import {
    faUndoAlt,
    faTrashAlt,
    faPlusCircle,
    faMusic,
    faUser


} from "@fortawesome/free-solid-svg-icons";

import { connect } from "react-redux";
import { fab } from "@fortawesome/free-brands-svg-icons";
import ClickableIconWrappedInDiv from "./ClickableIconWrappedInDiv";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    resetValuesThunk,
    updateMeetingPartThunk
} from "../Redux/actions/async";
import { getPrivs } from "../Redux/reducers/rootReducer";
import utils from "../Utility/utilities";

library.add(fab, faTrashAlt, faUndoAlt, faPlusCircle, faMusic);

class Part extends Component {
    render() {
        const {
            getSelectList,
            resetPartValues,
            assistant_prefix,
            aux_assistant_id,
            aux_person_id,
            assistant,
            assistant_id,
            no_assign,
            counsel_mins,
            deletePart,
            person_id,
            getElements,
            has_auxiliary,
            id: partId,
            updateTime,
            indexNumber,
            meetingId,
            meetingPartsById,
            min_suffix,
            minutes,
            partname,
            startTime,
            meetingStartTime,
            replace_token,
            school_part,
            updateMeetingPart,
            isPublished
        } = this.props;

        let songNumber = this.props.songNumber || "";

        const pointer = isPublished ? "not-allowed" : "pointer";

        //2018-07-04T19:30:00+00:00 format = 'YYYY-MM-DDTHH:mm:ssZ'
        let mainHallAssigned = null;
        let mainHallAssistant = null;
        let auxAssigned = null;
        let auxAssistant = null;
        if (!no_assign) {
            mainHallAssigned = getSelectList(partId, false);
        }
        if (assistant) {
            mainHallAssistant = getSelectList(partId, true);
        }

        if (has_auxiliary) {
            auxAssigned = getSelectList(partId, false);
        }

        if (has_auxiliary && assistant) {
            auxAssistant = getSelectList(partId, false);
        }

        let style = {
            fontSize: "14px",
            marginTop: "5px",
            display: "inline-flex "
        };

        let defaultClasses = ["form-control", "form-control-sm"];

        let assistantWithNoAssign =
            no_assign && assistant
                ? defaultClasses
                : defaultClasses.concat("mt-1");
        let assistant2ndSchool =
            has_auxiliary && assistant
                ? defaultClasses.concat("mt-1")
                : defaultClasses;

        if (utils.isEmptyObject(meetingPartsById)) {
            return null;
        }


        const savedStartTimeFormatted = moment(startTime).format("h:mm A");

        return (
            <Row form className='mt-1'>
                <Col lg="1" xs="4" className="mb-1">
                    {indexNumber === 0 ? (
                        <input
                            className={defaultClasses.join(" ")}
                            type="text"
                            name="meetingStartTime"
                            disabled={isPublished}
                            onChange={e => {
                                updateTime(meetingId, e.target.value);
                            }}
                            value={meetingStartTime}
                        />
                    ) : (
                        <div style={{ ...style, marginLeft: "8px" }}>
                            {savedStartTimeFormatted}
                        </div>
                    )}
                </Col>
                <Col lg="3" sm="6" xs="12" md="4" className="mb-1">
                    {replace_token ? (
                        <div className="input-group">
                            <input
                                disabled={isPublished}
                                style={{ width: "8em" }}
                                className={defaultClasses.join(" ")}
                                type="text"
                                readOnly
                                name="displayPartname"
                                value={partname}
                            />
                            <input
                                type="text"
                                className={defaultClasses.join(" ")}
                                maxLength="3"
                                disabled={isPublished}
                                style={{ textAlign: "center" }}
                                value={songNumber}
                                onChange={e => {
                                    updateMeetingPart(
                                        meetingId,
                                        partId,
                                        "songNumber",
                                        e.target.value,
                                        Boolean(replace_token)
                                    );
                                }}
                            />
                            <div className="input-group-append">
                                <span className="input-group-text input-group-text-sm">
                                    <FontAwesomeIcon icon="music" />
                                </span>
                            </div>
                        </div>
                    ) : (
                        <input
                            className={defaultClasses.join(" ")}
                            type="text"
                            disabled={isPublished}
                            name="partname"
                            onChange={e => {
                                // //meetingId, partId, fieldName, txt, isSong, partName
                                updateMeetingPart(
                                    meetingId,
                                    partId,
                                    "partname",
                                    e.target.value,
                                    Boolean(replace_token)
                                );
                            }}
                            value={partname}
                        />
                    )}
                </Col>
                <Col xs="3" lg="1">
                    <input
                        className={defaultClasses.join(" ")}
                        type="text"
                        disabled={isPublished}
                        onChange={e => {
                            updateMeetingPart(
                                meetingId,
                                partId,
                                "minutes",
                                e.target.value
                            );
                        }}
                        field_name="minutes"
                        value={minutes}
                    />
                </Col>
                <Col lg="1" style={{ ...style }}>
                    {min_suffix}
                </Col>
                <Col xs="3" lg="1" className="mb-1">
                    {school_part && (
                        <input
                            disabled={isPublished}
                            onChange={e => {
                                updateMeetingPart(
                                    meetingId,
                                    partId,
                                    "counsel_mins",
                                    e.target.value
                                );
                            }}
                            className={defaultClasses.join(" ")}
                            type="text"
                            readOnly={!school_part}
                            field_name="counsel_mins"
                            value={counsel_mins}
                        />
                    )}
                </Col>
                <Col lg="2" className="mb-1">
                    {has_auxiliary && (
                        <select
                            disabled={isPublished}
                            className={defaultClasses.join(" ")}
                            onClick={getElements}
                            is_assistant="false"
                            name="aux_person_id"
                            value={aux_person_id || ""}
                            onChange={e => {
                                updateMeetingPart(
                                    meetingId,
                                    partId,
                                    e.target.name,
                                    e.target.value
                                );
                            }}
                        >
                            <option value={0}>(please select)</option>
                            {auxAssigned &&
                                auxAssigned.map(selectItems => (
                                    <option
                                        key={selectItems.id}
                                        value={selectItems.id}
                                    >
                                        {selectItems.name}
                                    </option>
                                ))}
                        </select>
                    )}
                    {has_auxiliary && assistant && (
                        <select
                            disabled={isPublished}
                            className={assistant2ndSchool.join(" ")}
                            onChange={e => {
                                //fieldValue: any, meetingId: any, partId: any, fieldName: any)
                                updateMeetingPart(
                                    meetingId,
                                    partId,
                                    e.target.name,
                                    e.target.value
                                );
                            }}
                            name="aux_assistant_id"
                            value={aux_assistant_id || ""}
                        >
                            <option value={0}>(please select)</option>
                            {auxAssistant &&
                                auxAssistant.map(selectItems => (
                                    <option
                                        key={selectItems.id}
                                        value={selectItems.id}
                                    >
                                        {selectItems.name}
                                    </option>
                                ))}
                        </select>
                    )}
                </Col>
                <Col lg="2">
                    {!no_assign && (
                        <select
                            disabled={isPublished}
                            className={defaultClasses.join(" ")}
                            name="person_id"
                            onChange={e => {
                                updateMeetingPart(
                                    meetingId,
                                    partId,
                                    e.target.name,
                                    e.target.value
                                );
                            }}
                            value={person_id || ""}
                        >
                            <option value={1}>(please select)</option>
                            {mainHallAssigned &&
                                mainHallAssigned.map(selectItems => (
                                    <option
                                        key={selectItems.id}
                                        value={selectItems.id}
                                    >
                                        {selectItems.name}
                                    </option>
                                ))}
                        </select>
                    )}

                    {assistant && (
                        <select
                            disabled={isPublished}
                            className={assistantWithNoAssign.join(" ")}
                            onClick={getElements}
                            name="assistant_id"
                            type="text"
                            value={assistant_id || ""}
                            onChange={e => {
                                updateMeetingPart(
                                    meetingId,
                                    partId,
                                    e.target.name,
                                    e.target.value
                                );
                            }}
                            is_assistant="true"
                            placeholder={assistant_prefix && assistant_prefix}
                        >
                            <option key={0} value="">
                                (please select)
                            </option>
                            {mainHallAssistant &&
                                mainHallAssistant.map(selectItems => (
                                    <option
                                        key={selectItems.id}
                                        value={selectItems.id}
                                    >
                                        {selectItems.name}
                                    </option>
                                ))}
                        </select>
                    )}
                </Col>
                <Col lg="1" style={{ ...style }}>
                    <ClickableIconWrappedInDiv
                        style={{ marginRight: "12px", cursor: pointer }}
                        clicked={deletePart}
                        isPublished={isPublished}
                        icon={faTrashAlt}
                        title="Delete this part"
                        partId={partId}
                        meetingId={meetingId}
                        indexNumber={indexNumber}
                    />
                    <ClickableIconWrappedInDiv
                        style={{ marginRight: "12px", cursor: pointer }}
                        clicked={resetPartValues}
                        isPublished={isPublished}
                        icon={faUndoAlt}
                        title="Reset fields to default values"
                        partId={partId}
                        meetingId={meetingId}
                        indexNumber={indexNumber}
                    />
                     {/*<ClickableIconWrappedInDiv
                        style={{ cursor: pointer }}
                        clicked={() => console.log('list history' , isPublished, partId, meetingId, indexNumber)}
                        isPublished={isPublished}
                        icon={faUser}
                        title="Reset fields to default values"
                        partId={partId}
                        meetingId={meetingId}
                        indexNumber={indexNumber}
                     />*/}
                </Col>
            </Row>
        );
    }
}

const mapDispatchToProps = {
    resetPartValues: resetValuesThunk,
    updateMeetingPart: updateMeetingPartThunk
};

const mapStateToProps = state => {
    return {
        getSelectList: (partId, isAssistant) => getPrivs(state, partId, isAssistant),
        isPublished: state.schedule.isPublished
    };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(Part);
