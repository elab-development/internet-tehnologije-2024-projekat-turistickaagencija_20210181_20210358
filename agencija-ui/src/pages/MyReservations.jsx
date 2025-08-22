import React, {useEffect} from 'react';
import Title from "../components/Title";
import axiosInstance from "../communication/axiosInstance";
import {Col, Form, Row, Table} from "react-bootstrap";

const MyReservations = () => {

    const token = window.sessionStorage.getItem('token');
    const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;
    const [myReservations, setMyReservations] = React.useState([]);
    const [search, setSearch] = React.useState("");
    const [images, setImages] = React.useState([]);
    const [events, setEvents] = React.useState([]);

    useEffect(() => {
        if (user) {
            axiosInstance.get('/clients/' + user.id +'/reservations').then(response => {
                console.log(response);
                setMyReservations(response.data);
            }).catch(error => {
                console.error("There was an error fetching the reservations!", error);
                setMyReservations([]);
            });
        }
    }, []);

    const searchAPI = () => {
        axiosInstance.get('http://127.0.0.1:8000/api/images?q=' + search).then(response => {
            setImages(response.data);
        }).catch(error => {
            console.error("There was an error searching for images!", error);
            setImages([]);
        })


        axiosInstance.get('http://127.0.0.1:8000/api/events?q=' + search).then(response => {
            setEvents(response.data);
        }).catch(error => {
            console.error("There was an error searching for events!", error);
            setEvents([]);
        })
    }

    return (
        <>
            <Title title="My reservations" subtitle="Check your reservations on time"/>
            {
                myReservations.length > 0 ? (
                    <>
                        <Table hover responsive>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Arrangement</th>
                                    <th>Price (&euro;)</th>
                                    <th>Reservation Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    myReservations.map((reservation, index) => (
                                        <tr key={index}>
                                            <td>{index + 1}</td>
                                            <td>{reservation.arrangement.name}</td>
                                            <td>{reservation.arrangement.price} &euro;</td>
                                            <td>{new Date(reservation.arrangement.date).toLocaleDateString('en-GB')}</td>
                                        </tr>
                                    ))
                                }
                            </tbody>
                        </Table>
                    </>
                ) : (
                    <>
                        <p>No Reservations to date!</p>
                    </>
                )
            }

            <Row>
                <Col md={10} className="mb-4">
                    <Form.Group className="mb-3" controlId="formSearch">
                        <Form.Control type="text" onChange={(event) => {
                            setSearch(event.target.value)
                        }} name="name" placeholder="Enter name of the city" />
                    </Form.Group>
                </Col>

                <Col md={2} className="mb-4">
                    <button className="button-pink" onClick={searchAPI}>
                        Search
                    </button>
                </Col>
            </Row>

            <Row>
                <Col md={6}>
                    {images.length > 0 && (
                        <>
                            {
                                images.map((image, index) => (
                                    <div key={index} className="mb-4">
                                        <img src={image.original} alt={image.title} className="img-fluid" width={image.original_width} height={image.original_height}/>
                                        <p><a href={image.link} target="_blank" rel="noopener noreferrer">{image.title}</a></p>
                                    </div>
                                ))
                            }
                        </>
                    )}
                </Col>

                <Col md={6}>
                    {
                        events.length > 0 && (
                            <>
                                {
                                    events.map((event, index) => (
                                        <div key={index} className="mb-4">
                                            <a href={event.link} target="_blank" rel="noopener noreferrer">{event.title}</a>
                                            <p>{event.snippet}</p>
                                            <p><strong>Source:</strong> {event.source}</p>
                                        </div>
                                    ))
                                }

                            </>
                        )
                    }
                </Col>
            </Row>
        </>
    );
};

export default MyReservations;
