import React from "react";
import Title from "../components/Title";
import homeImage from "../images/homePage1.webp";

const Home = () => {
  return (
    <div className="hero-wrapper">
      <img src={homeImage} alt="Hero" className="hero-image" />
      <div className="hero-overlay"></div>
      <div className="hero-content">
        <Title
          title="Welcome to Agencija INA"
          subtitle="Your one-stop solution for all your agency needs"
        />
        <h2 className="pink mt-3">About agency</h2>
        <p>
          At Agencija INA, we are dedicated to providing exceptional services
          tailored to your needs.
        </p>
        <p>
          Explore our website to learn more about our offerings and how we can
          help you achieve your goals.
        </p>
      </div>
    </div>
  );
};

export default Home;
