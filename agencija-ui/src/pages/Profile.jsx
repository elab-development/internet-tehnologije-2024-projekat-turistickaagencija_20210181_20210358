import React from 'react';
import Title from "../components/Title";
import {Button, Col, Form, Row} from "react-bootstrap";
import useFormData from "../hooks/useFormData";
import axiosInstance from "../communication/axiosInstance";
import {toast} from "react-toastify";

const Profile = () => {

    const token = window.sessionStorage.getItem('token');
    const user = token ? JSON.parse(window.sessionStorage.getItem('user')) : null;

    const {formData, handleInputChange} = useFormData(
        {
            password: "",
            password_confirmation: ""
        }
    )

    const [errors, setErrors] = React.useState({
        password: "",
        password_confirmation: ""
    });

    const changePassword = (e) => {
        e.preventDefault();
        let valid = true;
        let newErrors = {
            password: "",
            password_confirmation: ""
        };

        if (!formData.password || formData.password.length < 8) {
            newErrors.password = "Password must be at least 8 characters long.";
            valid = false;
        }

        if (formData.password !== formData.password_confirmation) {
            newErrors.password_confirmation = "Passwords do not match.";
            valid = false;
        }

        setErrors(newErrors);

        if (valid) {
            axiosInstance.post('http://127.0.0.1:8000/api/password/reset', {
                email: user.email,
                password: formData.password,
                password_confirmation: formData.password_confirmation,
            }).then(response => {
                console.log(response);
                toast.success("Password changed successfully!");
            }).catch(error => {
                console.error("There was an error changing the password!", error);
                toast.error("There was an error changing the password. Please try again.");
            })
        }
    }

    return (
        <>
            <Title title="Profile" subtitle="Manage your profile information"/>
            <Row>
                <Col md={6}>
                    <h2 className="pink">User Profile</h2>
                    {user ? (
                        <div>
                            <p><strong>Name:</strong> {user.name}</p>
                            <p><strong>Email:</strong> {user.email}</p>
                            <p><strong>Role:</strong> {window.sessionStorage.getItem('role')}</p>
                        </div>
                    ) : (
                        <p>No user information available. Please log in.</p>
                    )}
                </Col>
                <Col md={6}>
                    <h2 className="pink">Account Settings</h2>
                    <p>Here you can update your account settings and preferences.</p>
                    {
                        user && (
                            <>
                            <Form>
                                <Form.Group className="mb-3" controlId="formBasicPassword">
                                    <Form.Label column="lg">Change Password</Form.Label>
                                    <Form.Control type="password" name="password" onChange={handleInputChange} placeholder="Password" />
                                    {
                                        errors.password && (
                                            <Form.Text className="text-danger">
                                                {errors.password}
                                            </Form.Text>
                                        )
                                    }
                                </Form.Group>

                                <Form.Group className="mb-3" controlId="formBasicPasswordConfirmation">
                                    <Form.Label column="lg">Password Confirmation</Form.Label>
                                    <Form.Control type="password" name="password_confirmation" onChange={handleInputChange} placeholder="Password Confirmation" />
                                    {
                                        errors.password_confirmation && (
                                            <Form.Text className="text-danger">
                                                {errors.password_confirmation}
                                            </Form.Text>
                                        )
                                    }
                                </Form.Group>
                                <hr/>
                                <Button className="button-pink" type="submit" onClick={
                                    changePassword
                                }>
                                    Change password
                                </Button>
                            </Form>
                            </>
                        )
                    }
                </Col>
            </Row>
        </>
    );
};

export default Profile;
