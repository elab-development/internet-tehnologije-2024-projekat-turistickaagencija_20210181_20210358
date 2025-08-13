import React, {useEffect} from 'react';
import Title from "../components/Title";
import {Row} from "react-bootstrap";
import axiosInstance from "../communication/axiosInstance";
import Arrangement from "../components/Arrangement";

const Arrangements = () => {

    const [arrangements, setArrangements] = React.useState([]);

    useEffect(() => {
        axiosInstance.get('/arrangement').then(response => {
            console.log(response);
            setArrangements(response.data.arrangements);
        }).catch(error => {
            console.error("There was an error fetching the arrangements!", error);
            setArrangements([])
        })
    }, []);


    return (
        <>
            <Title title={"Arrangements"} subtitle="Explore our exclusive arrangements for your next adventure"/>

            <Row>
                {
                    arrangements.length > 0 ? (
                        arrangements.map((arrangement, index) => (
                            <div key={index} className="col-md-3 mb-4">
                                <Arrangement pictures={arrangement.destination.picture_link} arrangement_name={arrangement.name} destination_name={arrangement.destination.name} price={arrangement.price} description={arrangement.description} discount={arrangement.promotion.discount} />
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
