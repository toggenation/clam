import React from "react";

const HelpBlock = (props) => {
    const { show, text } = props.error;
    let helpBlock  = null
    if(show) {
        helpBlock = (
            <small><p class="text-danger">{text}</p></small>
        )
    }
    return helpBlock;
};

export default HelpBlock

