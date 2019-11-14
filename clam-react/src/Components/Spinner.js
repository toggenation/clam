import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faSpinner } from "@fortawesome/free-solid-svg-icons";

import { Aux } from "../Components/Aux";
import React from "react";
export const Spinner = props => {
    return (
        <Aux>
            <FontAwesomeIcon icon={faSpinner} spin size="1x" /> Loading ...
        </Aux>
    );
};
