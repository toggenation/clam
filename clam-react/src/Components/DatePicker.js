import DatePicker from "react-datepicker";
import moment from "moment";
import { connect } from "react-redux";

const handleChange = e => {
    //console.log(e.format())
};

const ReactDatePicker = props => {
    const meeting_date = moment(props[1].date, "DD/MM/YYYY");
    return (
        <DatePicker
            dateFormat="DD/MM/YYYY"
            selected={meeting_date}
            onChange={handleChange}
        />
    );
};

export default connect(store => store.meetings)(ReactDatePicker);
