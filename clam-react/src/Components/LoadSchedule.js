//import moment from 'moment'
import { connect } from "react-redux";
import React, { Component } from "react";
import { getSchedulesThunk, getScheduleThunk } from "../Redux/actions/async";
import { getSchedulesList } from "../Redux/reducers/schedulesReducer";

import { Input, Label, Col, FormGroup } from "reactstrap";
class LoadSchedule extends Component {
    componentDidMount() {
        const { getSchedulesList } = this.props;
        getSchedulesList();
    }

    render() {
        const { selectList, getSchedule, scheduleId } = this.props;
        return (
            <FormGroup row>
                <Label className="font-weight-bold" size="sm" sm={3}>
                    Schedule
                </Label>
                <Col sm={9}>
                    <Input
                        bsSize="sm"
                        onChange={e => getSchedule(e.target.value)}
                        type="select"
                        value={scheduleId}
                    >
                        <option value="">(Select a schedule)</option>
                        {selectList &&
                            selectList.map(obj => {
                                return (
                                    <option key={obj.id} value={obj.id}>
                                        {obj.month_year}
                                    </option>
                                );
                            })}
                    </Input>

                </Col>


            </FormGroup>

        );
    }
}

const mapDispatchToProps = {
    getSchedule: getScheduleThunk,
    getSchedulesList: getSchedulesThunk
}
/*
const mapDispatchToProps = dispatch => {
    return {
        getSchedule: id => {
            dispatch(getScheduleThunk(id));
        },
        getSchedulesList: () => {
            dispatch(getSchedulesThunk());
        }
    };
};
*/
const mapStateToProps = state => {
    const scheduleId = state.schedule.scheduleId || '';
    return {
        scheduleId: scheduleId,
        selectList: getSchedulesList(state)
    };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(LoadSchedule);
