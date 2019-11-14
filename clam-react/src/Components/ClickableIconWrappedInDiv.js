import React from "react";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

const ClickableIconWrappedInDiv = props => {
    const {
        style,
        clicked,
        icon,
        meetingId,
        partId,
        indexNumber,
        isPublished,
        title
    } = props;
    return (
        <div
            style={style}
            title={title}
            onClick={() =>
                !isPublished && clicked(meetingId, partId, indexNumber)
            }
        >
            <FontAwesomeIcon icon={icon} />
        </div>
    );
};

export default ClickableIconWrappedInDiv;
