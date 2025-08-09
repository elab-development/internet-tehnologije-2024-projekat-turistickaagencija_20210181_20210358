import React from 'react';
import PropTypes from 'prop-types';
import {Col, Row} from "react-bootstrap";

const Title = props => {
    return (
        <>
            <Row>
                <Col md={12} className="text-center">
                    <div className="title-container">
                        <h1 className="title">{props.title}</h1>
                        {props.subtitle && <p className="text-muted">{props.subtitle}</p>}
                    </div>
                </Col>
            </Row>

        </>
    );
};

Title.propTypes = {
    title : PropTypes.string.isRequired,
    subtitle : PropTypes.string,
};

export default Title;
