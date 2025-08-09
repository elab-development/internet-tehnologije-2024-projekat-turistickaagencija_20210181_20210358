import React from 'react';
import Title from "../components/Title";
import {Col, Image, Row} from "react-bootstrap";
import homeImage from "../images/home.jpeg";

const Home = () => {
    return (
        <>
            <Title title="Welcome to Agencija INA" subtitle="Your one-stop solution for all your agency needs"/>

            <Row>
                <Col md={6}>
                    <Image src={homeImage} thumbnail alt="home image"/>
                </Col>
                <Col md={6} className="text-center">
                    <h2 className="pink">About agency</h2>
                    <p>
                        At Agencija INA, we are dedicated to providing exceptional services tailored to your needs.
                        Whether you're looking for travel arrangements, event planning, or any other agency services,
                        our team is here to assist you every step of the way.
                    </p>
                    <p>
                        Explore our website to learn more about our offerings and how we can help you achieve your goals.
                    </p>
                    <p>
                        Contact us today to get started on your next project or adventure!
                    </p>
                </Col>
            </Row>
        </>
    );
};

export default Home;
