import React, {useEffect, useRef} from 'react';
import Title from "../components/Title";
import {Row} from "react-bootstrap";
import axiosInstance from "../communication/axiosInstance";
import Arrangement from "../components/Arrangement";


const Arrangements = () => {

    const [arrangements, setArrangements] = React.useState([]);
    const token = window.sessionStorage.getItem('token');
    const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;

    useEffect(() => {
        axiosInstance.get('/arrangement').then(response => {
            console.log(response);
            setArrangements(response.data.arrangements);
        }).catch(error => {
            console.error("There was an error fetching the arrangements!", error);
            setArrangements([])
        })
    }, []);

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
            <Title title={"Arrangements"} subtitle="Explore our exclusive arrangements for your next adventure"/>

            <Row>
                {
                    arrangements.length > 0 ? (
                        arrangements.map((arrangement, index) => (
                            <div key={index} className="col-md-3 mb-4">
                                <Arrangement pictures={arrangement.destination.picture_link} arrangement_name={arrangement.name} destination_name={arrangement.destination.name} price={arrangement.price} description={arrangement.description} discount={arrangement.promotion.discount} id={arrangement.id} myReservations={myReservations} setMyReservations={setMyReservations}/>
                            </div>
                        ))
                    ) : (
                        <div className="col-12 text-center">
                            <p>No arrangements available at the moment.</p>
                        </div>
                    )
                }
            </Row>
            
        </>
    );
};

export default Arrangements;
