import React from "react";
import CreateModal from "./CreateModal";
import Button from "reactstrap/lib/Button";
import { Aux } from "./Aux";

const SaveScheduleModal = props => {
    const buttons = (
        <Aux>
            <Button
                color="primary"
                onClick={props.ok}
            >
                OK
            </Button>
            <Button
                color="danger"
                onClick={props.cancel}
            >
                Cancel
            </Button>
        </Aux>
    );
    return (
        <CreateModal
            heading={props.heading}
            click={props.cancel}
            buttons={buttons}
            showModal={props.show}
        >
            <p>Yeah boi!</p>
        </CreateModal>
    );
};

export default SaveScheduleModal;
