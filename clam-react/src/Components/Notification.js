import React from 'react';
import Row from 'reactstrap/lib/Row';
import Col from 'reactstrap/lib/Col';
const Notification = (props) => {
    return (
        <Row className="mb-3">
        <Col className='text-center'>
            {props.children}
        </Col>
        </Row>
    )
}

export default Notification
