import React, {useEffect} from 'react';
import Title from "../components/Title";
import axiosInstance from "../communication/axiosInstance";
import {Table} from "react-bootstrap";

const MyReservations = () => {

    const token = window.sessionStorage.getItem('token');
    const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;
    const [myReservations, setMyReservations] = React.useState([]);

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
        </>
    );
};

export default MyReservations;
