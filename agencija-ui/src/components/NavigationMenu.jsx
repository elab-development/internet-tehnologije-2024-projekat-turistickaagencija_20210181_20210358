import React from 'react';
import {Container, Nav, Navbar} from "react-bootstrap";
import {IoIosAirplane} from "react-icons/io";

const NavigationMenu = () => {

    const token = window.sessionStorage.getItem('token');
    const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;
    const role = user ? window.sessionStorage.getItem('role') : null;
    const isAdminOrAgent = role === 'admin' || role === 'agent';

    const logout = (event) => {
        event.preventDefault();
        window.sessionStorage.removeItem('token');
        window.sessionStorage.removeItem('user');
        window.sessionStorage.removeItem('role');
        window.location.href = '/login';
    }


    return (
        <>
            <Navbar bg="light" data-bs-theme="light" className="nav-menu">
                <Container>
                    <Navbar.Brand href="/">Agencija INA <IoIosAirplane /></Navbar.Brand>
                    <Nav className="me-auto">
                        <Nav.Link href="/">Home</Nav.Link>
                        <Nav.Link href="/about">Contact</Nav.Link>
                        <Nav.Link href="/arrangements">Arrangements</Nav.Link>
                        <Nav.Link href="/promotions">Promotions</Nav.Link>
                        {
                            token && (
                                <>
                                    <Nav.Link href="/reservations">Reserve</Nav.Link>
                                    <Nav.Link href="/my-reservations">My reservations</Nav.Link>
                                </>
                            )
                        }

                        {
                            isAdminOrAgent && (
                                <>
                                    <Nav.Link href="/administration">Administration</Nav.Link>
                                </>
                            )
                        }

                        {
                            token && (
                                <>
                                    <Nav.Link href="/profile">Profile</Nav.Link>
                                    <Nav.Link href="/logout" onClick={logout}>Logout</Nav.Link>
                                </>
                            )
                        }

                        {
                            !token && (
                                <>
                                    <Nav.Link href="/login">Login</Nav.Link>
                                </>
                            )
                        }

                    </Nav>
                </Container>
            </Navbar>
        </>
    );
};

export default NavigationMenu;
