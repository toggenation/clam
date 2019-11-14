import React from "react";
import { connect } from "react-redux";
import { FormGroup, Input, Label } from "reactstrap";
import { schedulePublishedCheck } from "../Redux/actions/async";
import { getApiRoot } from "../Redux/reducers/rootReducer";

const ScheduleIsPublishedCB = props => {
    const checkBoxName = "isSchedulePublishedCB";
    const { isPublished, scheduleId, schedulePublishedCheck } = props;

    return scheduleId ? (
        <FormGroup check inline>
            <Input
                checked={isPublished}
                id={checkBoxName}
                bsSize="sm"
                onChange={e => {
                    schedulePublishedCheck(e.target.checked);
                }}
                style={{ cursor: "pointer" }}
                type="checkbox"
            />
            <Label
                size="sm"
                check={true}
                htmlFor={checkBoxName}
                title="Protect from editing or mark as published"
                style={{ cursor: "pointer" }}
            >
                Schedule Published
            </Label>
        </FormGroup>
    ) : null;
};

const mapDispatchToProps = {
    schedulePublishedCheck
};
const mapStateToProps = state => {
    return {
        apiRoot: getApiRoot(state),
        isPublished: state.schedule.isPublished,
        scheduleId: state.schedule.scheduleId
    };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(ScheduleIsPublishedCB);
