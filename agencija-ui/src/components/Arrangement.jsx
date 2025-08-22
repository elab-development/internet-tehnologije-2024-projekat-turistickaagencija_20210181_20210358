import React, {useEffect} from 'react';
import PropTypes from 'prop-types';
import {Card} from "react-bootstrap";
import axiosInstance from "../communication/axiosInstance";
import {toast, ToastContainer} from "react-toastify";

const Arrangement = props => {
    const {pictures, arrangement_name, destination_name, price, description, discount, id, myReservations, setMyReservations} = props;

    const discountedPrice = discount ? (price - (price * (discount / 100))).toFixed(2) : price.toFixed(2);

    const token = window.sessionStorage.getItem('token');
    const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;

    const isButtonVisible = token && user && user.role === 'user';

    const reserveArrangement = (id) => {

        if (myReservations.some(reservation => reservation.arrangement.id === id)) {
            toast.info("You have already reserved this arrangement.");
            return;
        }

        axiosInstance.post('/user/reservation/store', {
            'arrangement_id': id,
            'client_id': user.id
        }).then(response => {
            console.log(response);
            toast.success("Arrangement reserved successfully!");
            setMyReservations([...myReservations, { arrangement: { id } }]);
        }).catch(
            error => {
                console.error("There was an error reserving the arrangement!", error);
                toast.error("Failed to reserve arrangement. Please try again later.");
            }
        )
    }

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
                    {isButtonVisible && (
                        <div className="text-center">
                            <button className="button-pink" onClick={
                                () => reserveArrangement(id)
                            }>
                                Reserve
                            </button>
                        </div>
                    )}
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
    id: PropTypes.number.isRequired,
    myReservations: PropTypes.array.isRequired,
    setMyReservations: PropTypes.func.isRequired
};

export default Arrangement;
