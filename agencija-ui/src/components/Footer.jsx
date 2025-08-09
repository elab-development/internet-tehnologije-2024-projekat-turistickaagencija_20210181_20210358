import React from 'react';
import {Col, Row} from "react-bootstrap";
import {IoLogoFacebook, IoLogoInstagram, IoLogoLinkedin, IoLogoYoutube} from "react-icons/io";

const Footer = () => {
    return (
        <>
            <footer>
                <Row>
                    <Col md={4} className="text-center mt-4">
                        <ul className="footer-menu">
                            <li>
                                <a href="/promotions"> Promotions</a>
                            </li>
                            <li>
                                <a href="/destinations"> Destinations</a>
                            </li>
                            <li>
                                <a href="/arrangements"> Arangements</a>
                            </li>
                        </ul>
                    </Col>
                    <Col md={4} className="text-center mt-4">
                        <div className="copyright" >
                            &copy; 2025 Agencija INA. All rights reserved.
                        </div>
                    </Col>
                    <Col md={4} className="text-center mt-4">
                        <ul className="social-icons">
                            <li>
                                <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                                    <IoLogoFacebook />
                                </a>
                            </li>

                            <li>
                                <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                                    <IoLogoInstagram />
                                </a>
                            </li>

                            <li>
                                <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer">
                                    <IoLogoLinkedin />
                                </a>
                            </li>

                            <li>
                                <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer">
                                    <IoLogoYoutube />
                                </a>
                            </li>
                        </ul>
                    </Col>
                </Row>

            </footer>
        </>
    );
};

export default Footer;
