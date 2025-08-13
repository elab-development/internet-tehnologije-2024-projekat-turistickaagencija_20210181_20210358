import React from 'react';
import Title from "../components/Title";
import {Col, Nav, Row} from "react-bootstrap";
import ContactDetails from "../components/ContactDetails";

const About = () => {

    const [showBeograd, setShowBelgrade] = React.useState(true);

    return (
        <div>
            <Title title="Something about us" subtitle="Details where to find us"/>
            <Row>
                <Col md={6} className="text-center">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2812.133095286434!2d20.457788190866534!3d44.81012995084928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aaebc6241bd%3A0x33aad42c1266e277!2sBalkanska%2024%2C%20Beograd!5e1!3m2!1sen!2srs!4v1755101668391!5m2!1sen!2srs"
                        width="600" height="450" style={
                        {
                            border:0
                        }
                    } allowFullScreen="" loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"></iframe>
                </Col>
                <Col md={6}>
                    <Nav variant="underline" defaultActiveKey="beograd">
                        <Nav.Item>
                            <Nav.Link eventKey="beograd" onClick={
                                (event) => {
                                    event.preventDefault();
                                    setShowBelgrade(true)
                                }
                            }>Beograd</Nav.Link>
                        </Nav.Item>
                        <Nav.Item>
                            <Nav.Link eventKey="novisad" onClick={
                                (event) => {
                                    event.preventDefault();
                                    setShowBelgrade(false)
                                }
                            }>Novi Sad</Nav.Link>
                        </Nav.Item>
                    </Nav>
                    <hr/>
                    <Row>
                        <Col md={6}>

                            <div className="working-times">
                                <h3 className="pink">Working hours</h3>
                                <ul>
                                    <li>Monday: 9:00 AM - 5:00 PM</li>
                                    <li>Tuesday: 9:00 AM - 5:00 PM</li>
                                    <li>Wednesday: 9:00 AM - 5:00 PM</li>
                                    <li>Thursday: 9:00 AM - 5:00 PM</li>
                                    <li>Friday: 9:00 AM - 5:00 PM</li>
                                    <li>Saturday: 10:00 AM - 2:00 PM</li>
                                    <li>Sunday: Closed</li>
                                </ul>
                            </div>
                        </Col>
                        <Col md={6}>
                            {
                                showBeograd ?
                                    <>
                                        <ContactDetails email="beograd@ina.com" phone="011/2345-234" address="Balkanska 24" city="Beograd"/>
                                    </>
                                    :
                                    <>
                                        <ContactDetails email="novi-sad@ina.com" phone="021/2345-234" address="Dunavska 63" city="Novi Sad"/>
                                    </>
                            }
                        </Col>

                    </Row>

                </Col>

            </Row>
        </div>
    );
};

export default About;
