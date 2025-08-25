import React from 'react';
import {Col, Row} from "react-bootstrap";
import {IoLogoFacebook, IoLogoInstagram, IoLogoLinkedin, IoLogoYoutube} from "react-icons/io";

const Footer = () => {
  return (
    <footer>
      {/* Socijalne ikonice u gornjem delu, desno */}
      <Row className="footer-top">
        <Col className="d-flex justify-content-end">
          <ul className="social-icons">
            <li>
              <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer"><IoLogoFacebook /></a>
            </li>
            <li>
              <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer"><IoLogoInstagram /></a>
            </li>
            <li>
              <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer"><IoLogoLinkedin /></a>
            </li>
            <li>
              <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer"><IoLogoYoutube /></a>
            </li>
          </ul>
        </Col>
      </Row>

      {/* Copyright dole, centrirano */}
      <Row className="footer-bottom">
        <Col className="text-center">
          <div className="copyright">
            &copy; 2025 Agencija INA. All rights reserved.
          </div>
        </Col>
      </Row>
    </footer>
  );
};

export default Footer;

