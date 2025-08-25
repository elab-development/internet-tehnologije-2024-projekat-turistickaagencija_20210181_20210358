import React from "react";
import { Row, Col, Nav } from "react-bootstrap";
import Title from "../components/Title";
import ContactDetails from "../components/ContactDetails";

const About = () => {
  const [city, setCity] = React.useState("beograd");

  const locations = {
    beograd: {
      email: "beograd@ina.com",
      phone: "011/2345-234",
      address: "Balkanska 24",
      cityName: "Beograd",
      map: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2812.133095286434!2d20.457788190866534!3d44.81012995084928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aaebc6241bd%3A0x33aad42c1266e277!2sBalkanska%2024%2C%20Beograd!5e0!3m2!1sen!2srs!4v1699999999999!5m2!1sen!2srs&layer=c"
    },
    novisad: {
      email: "novi-sad@ina.com",
      phone: "021/2345-234",
      address: "Dunavska 63",
      cityName: "Novi Sad",
      map: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2802.142263148147!2d19.8409719156134!3d45.25305327909826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475b1cd67f0d123b%3A0x123456789abcdef!2sDunavska%2063%2C%20Novi%20Sad!5e0!3m2!1sen!2srs!4v1699999999999!5m2!1sen!2srs&layer=c"
    }
  };

  const selected = locations[city];

  return (
    <div>
      <Title title="Something about us" subtitle="Details where to find us" />

      <Row>
        <Col md={6} className="text-center">
          <iframe
            src={selected.map}
            width="100%"
            height="450"
            style={{ border: 0 }}
            allowFullScreen=""
            loading="lazy"
            referrerPolicy="no-referrer-when-downgrade"
            title={selected.cityName}
          ></iframe>
        </Col>

        <Col md={6}>
          <Nav variant="underline" defaultActiveKey="beograd" className="about-nav">
            <Nav.Item>
              <Nav.Link
                eventKey="beograd"
                onClick={(e) => { e.preventDefault(); setCity("beograd"); }}
              >
                Beograd
              </Nav.Link>
            </Nav.Item>
            <Nav.Item>
              <Nav.Link
                eventKey="novisad"
                onClick={(e) => { e.preventDefault(); setCity("novisad"); }}
              >
                Novi Sad
              </Nav.Link>
            </Nav.Item>
          </Nav>

          <hr />

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
              <ContactDetails
                email={selected.email}
                phone={selected.phone}
                address={selected.address}
                city={selected.cityName}
              />
            </Col>
          </Row>
        </Col>
      </Row>
    </div>
  );
};

export default About;



