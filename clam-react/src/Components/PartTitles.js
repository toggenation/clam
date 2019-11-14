import React from "react";
import { Row, Col } from 'reactstrap';

const PartTitle = () => {
    const style = {
        fontSize: "small",
        fontWeight: "bold"
    };

    return (
        <Row form className="d-none d-lg-flex">
            <Col style={style}>
                Start Time
            </Col>
            <Col lg="3" style={style}>
                Part Name
            </Col>
            <Col style={style}>
                Minutes
            </Col>
            <Col style={style}>
                Min Suffix
            </Col>
            <Col style={style}>
                Counsel Mins
            </Col>
            <Col lg="2" style={style}>
                Aux School
            </Col>
            <Col lg="2" style={style}>
                Main Hall
            </Col>
            <Col style={style}>
                Actions
            </Col>
        </Row>
    );
};

export default PartTitle;
