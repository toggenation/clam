import React from "react";
import Alert from "reactstrap/lib/Alert";
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { CSSTransition } from "react-transition-group";

import "../Styles/styles.css";

import {
    faExclamationCircle,
    faCheckCircle,
    faCheck,
    faThumbsUp,
    faQuestion,
    faQuestionCircle,
    faExclamationTriangle
} from "@fortawesome/free-solid-svg-icons";

library.add([
    faExclamationCircle,
    faCheckCircle,
    faCheck,
    faThumbsUp,
    faQuestion,
    faQuestionCircle,
    faExclamationTriangle
]);

const icons = color => {
    let icon = null;
    switch (color) {
        case "primary":
        case "secondary":
        case "success":
            icon = "thumbs-up";
            break;
        case "danger":
        case "warning":
            icon = "exclamation-triangle";
            break;
        case "info":
        case "light":
        case "dark":
        default:
            icon = "exclamation-circle";
    }
    return icon;
};
const AlertMessage = props => {
    let icon = icons(props.color);
    return (
        <CSSTransition
            in={props.show}
            timeout={300}
            classNames={{
                enter: "animated",
                enterActive: "fadeIn",
                exit: "animated",
                exitActive: "slideOutUp"

              }}
            unmountOnExit
        >
            <Alert
                transition={{ baseClassActive: "", timeout: 0 }}
                color={props.color}
                fade={false}
            >
                <FontAwesomeIcon icon={icon} /> {props.message}
            </Alert>
        </CSSTransition>
    );
};

export default AlertMessage;
