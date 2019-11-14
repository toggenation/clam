import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faTimesCircle, faPlusCircle } from "@fortawesome/free-solid-svg-icons";

const AddPart = props => {
    const {
        partArrayObject,
        hideAddPart,
        updateForm,
        addParts,
        insertPart,
        meetingId
    } = props;

    let partSelectOptions = null;
    if (partArrayObject) {
        partSelectOptions = partArrayObject.map((x, index) => {
            return (
                <option key={x.id} value={x.id}>
                    {`${x.partname} (${x.minutes} ${x.min_suffix.trim()})`}
                </option>
            );
        });
    }

    return (
        <form className="form-inline">
            <div className="form-group">
                <select
                    id="addPart"
                    value={addParts.fieldValue}
                    className="form-control form-control-sm"
                    onChange={e => {
                        updateForm(
                            e.target.id,
                            e.target.value,
                            e.target.options[e.target.selectedIndex].text
                        );
                    }}
                >{partSelectOptions}</select>
                <button
                    type="button"
                    className="ml-2 btn btn-primary btn-sm mt-1"
                    onClick={() => {
                        console.log('insertPart');
                        insertPart(meetingId);
                    }}
                >
                    <FontAwesomeIcon icon={faPlusCircle} /> Add
                </button>
                <button
                    type="button"
                    className="ml-2 btn btn-danger btn-sm mt-1"
                    onClick={() => {
                        hideAddPart();
                    }}
                >
                    <FontAwesomeIcon icon={faTimesCircle} /> Close
                </button>
            </div>
        </form>
    );
};

export default AddPart;
