import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

import React from "react";

const IconLink = props => {
    //console.log(props)
    const { display, icon, ...linkProps } = props;
    //console.log(linkProps)
    if (display) {
        return (
            <a
                {...linkProps}
                className="btn btn-sm btn-link"
                style={{ textDecoration: "none" }}
            >
                <FontAwesomeIcon icon={icon} /> {linkProps.title}
            </a>
        );
    } else {
        return null;
    }
};

export default IconLink;
