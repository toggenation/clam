import React from "react";
import Aux from './Aux'

const Heading = props => {
    const { scheduleMonth, scheduleYear, children, scheduleId } = props;
    const monthYear = scheduleId ? (
        <Aux>{" "}<small>
        {scheduleMonth} {scheduleYear}
        </small>
        </Aux>
    ): null;
    return (
        <div className="row">
        <div className="col-lg-12">
            <h2>
                Christian Life and Ministry Schedule{monthYear}
            </h2>
            <hr />
            {children}
        </div>
        </div>
    );
};

export default Heading;
