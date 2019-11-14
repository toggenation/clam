import React from "react";
import Row from "reactstrap/lib/Row";
import Col from 'reactstrap/lib/Col';
import Button from "reactstrap/lib/Button";
import { connect } from "react-redux";
import FormGroup from "reactstrap/lib/FormGroup";
import LoadSchedule from "./LoadSchedule";
import ConfigureSchedule from "./ConfigureSchedule";
import SaveScheduleModal from "./SaveScheduleModal";
import { toggleScheduleSaveModal } from "../Redux/actions/actionCreators";
import { deleteScheduleThunk, saveScheduleThunk} from "../Redux/actions/async";

import { getIsScheduleSaveModalVisible } from "../Redux/reducers/rootReducer";
import ScheduleIsPublishedCB from "./ScheduleIsPublishedCB";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";
import styles from "./ScheduleRow.module.css";

const ScheduleRow = props => {
    const {
        toggleScheduleSaveModal,
        saveScheduleThunk,
        deleteScheduleThunk,
        isModalVisible,
        isPublished
    } = props;
    return (
        <Row>

            <Col lg="3">
            <FormGroup className={styles.SpaceBetween}>
                <LoadSchedule />
            </FormGroup>

            </Col>
            <Col lg="2">
            <FormGroup className={styles.SpaceBetween}>
                <Button
                    disabled={isPublished}
                    onClick={deleteScheduleThunk}
                    size="sm"
                >
                    <FontAwesomeIcon icon={faTrashAlt} /> Delete
                </Button>
            </FormGroup>
            </Col>
            <Col lg="7">
            <FormGroup className={styles.SpaceBetween}>
                <ConfigureSchedule />
            </FormGroup>

            <FormGroup>
                <ScheduleIsPublishedCB />
            </FormGroup>
            <SaveScheduleModal
                heading="Save Schedule"
                show={isModalVisible}
                ok={saveScheduleThunk}
                cancel={toggleScheduleSaveModal}
            />
            </Col>
        </Row>
    );
};

/*const mapDispatchToProps = {
    modalToggle: toggleScheduleSaveModal,
    saveSchedule: saveScheduleThunk,
    deleteSchedule: deleteScheduleThunk
};*/

const mapDispatchToProps = {
    toggleScheduleSaveModal,
    saveScheduleThunk,
    deleteScheduleThunk
};

const mapStateToProps = state => {
    return {
        isModalVisible: getIsScheduleSaveModalVisible(state),
        isPublished: state.schedule.isPublished
    };
};
export default connect(
    mapStateToProps,
    mapDispatchToProps
)(ScheduleRow);
