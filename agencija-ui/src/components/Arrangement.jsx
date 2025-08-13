import React from 'react';
import PropTypes from 'prop-types';
import {Card} from "react-bootstrap";

const Arrangement = props => {
    const {pictures, arrangement_name, destination_name, price, description, discount} = props;

    const discountedPrice = discount ? (price - (price * (discount / 100))).toFixed(2) : price.toFixed(2);
    return (
        <>
            <Card style={{ width: '18rem' }}>
                <Card.Img variant="top" src={pictures} alt={arrangement_name}/>
                <Card.Body>
                    <Card.Title>{arrangement_name}</Card.Title>
                    <Card.Subtitle className="mb-2 text-muted">{destination_name}</Card.Subtitle>
                    <Card.Text>
                        {description}
                    </Card.Text>
                    <hr/>
                    <Card.Text>
                        <strong>Price:</strong> <del className="total-price">{price} &euro;</del> <span className="pink">{discountedPrice} &euro; </span>
                    </Card.Text>
                </Card.Body>
            </Card>
        </>
    );
};

Arrangement.propTypes = {
    pictures : PropTypes.string.isRequired,
    arrangement_name : PropTypes.string.isRequired,
    destination_name : PropTypes.string.isRequired,
    price : PropTypes.number.isRequired,
    description : PropTypes.string.isRequired,
    discount: PropTypes.number,
};

export default Arrangement;