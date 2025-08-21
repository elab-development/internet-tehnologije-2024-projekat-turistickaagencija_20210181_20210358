import React from 'react';
import Title from "../components/Title";
import {Button, Form} from "react-bootstrap";
import axiosInstance from "../communication/axiosInstance";
import {FaRegistered, FaRegNewspaper} from "react-icons/fa";
import useFormData from "../hooks/useFormData";

const Login = () => {

    const [isLogin, setIsLogin] = React.useState(true);
    const [message, setMessage] = React.useState("");

    const title = isLogin ? "Login" : "Register";

    const {formData, handleInputChange} = useFormData(
        {
            email: "",
            password: "",
            role: "client",
            name: "",
            surname: ""
        }
    )

    const [errors, setErrors] = React.useState({
        email: "",
        password: "",
        name: "",
        surname: ""
    });

    const login = (event) => {
        event.preventDefault();

        if (formData.email === "") {
            setErrors(prevState => ({
                ...prevState,
                email: "Email is required"
            }));
            return;
        }

        if (formData.password === "") {
            setErrors(prevState => ({
                ...prevState,
                password: "Password is required"
            }));
            return;
        }

        const role = formData.role;
        const link =  role === "client" ? "/login" : role === "agent" ? "/login/agent" : "/login/admin";


        axiosInstance.post(link, {
            email: formData.email,
            password: formData.password
        }).then(response => {
            console.log(response);
            if (response.data.success) {
                window.sessionStorage.setItem('token', response.data.token);
                window.sessionStorage.setItem('user', JSON.stringify(response.data.user));
                window.sessionStorage.setItem('role', response.data.user.role);
                window.location.href = '/';
            } else {
                setMessage(response.data.message);
            }
        }).catch(error => {
            console.error("There was an error during login!", error);
            setMessage("Login failed. Please try again.");
        })

    }

    const register = (event) => {
        event.preventDefault();

        if (formData.name === "") {
            setErrors(prevState => ({
                ...prevState,
                name: "Name is required"
            }));
            return;
        }

        if (formData.surname === "") {
            setErrors(prevState => ({
                ...prevState,
                surname: "Surname is required"
            }));
            return;
        }

        if (formData.email === "") {
            setErrors(prevState => ({
                ...prevState,
                email: "Email is required"
            }));
            return;
        }

        if (formData.password === "") {
            setErrors(prevState => ({
                ...prevState,
                password: "Password is required"
            }));
            return;
        }

        axiosInstance.post('/register', {
            name: formData.name,
            surname: formData.surname,
            email: formData.email,
            password: formData.password
        }).then(response => {
            console.log(response);
            if (response.data.success) {
                setMessage("Registration successful. Please login.");
                setIsLogin(true);
            } else {
                setMessage("Registration failed. Try again.");
            }
        }).catch(error => {
            console.error("There was an error during registration!", error);
            setMessage("Registration failed. Please try again.");
        })
    }

    return (
        <div>
            <Title title={title} subtitle={message}/>

            {
                isLogin && (
                    <>
                        <Form>
                            <Form.Group className="mb-3" controlId="formBasicRole">
                                <Form.Label column={"lg"}>User type</Form.Label>
                                <Form.Select aria-label="Default select example" name="role" onChange={handleInputChange} value={formData.role}>
                                    <option value="client">Client</option>
                                    <option value="agent">Agent</option>
                                    <option value="admin">Admin</option>
                                </Form.Select>
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label column={"lg"}>Email address</Form.Label>
                                <Form.Control type="email" onChange={handleInputChange} name="email" placeholder="Enter email" />
                                {
                                    errors.email && (
                                        <Form.Text className="text-danger">
                                            {errors.email}
                                        </Form.Text>
                                    )
                                }
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label column="lg">Password</Form.Label>
                                <Form.Control type="password" name="password" onChange={handleInputChange} placeholder="Password" />
                                {
                                    errors.password && (
                                        <Form.Text className="text-danger">
                                            {errors.password}
                                        </Form.Text>
                                    )
                                }
                            </Form.Group>
                            <span>Don't have an account? <a href="/" onClick={
                                (event) => {
                                    event.preventDefault();
                                    setIsLogin(false);
                                    setMessage("");
                                    setErrors({
                                        email: "",
                                        password: ""
                                    });
                                }
                            }><FaRegNewspaper style={{
                                color: "pink",
                                fontSize: "2.5rem"
                            }} /></a></span>
                            <hr/>
                            <Button className="button-pink" type="submit" onClick={
                                login
                            }>
                                Login
                            </Button>
                        </Form>
                    </>
                )
            }

            {
                !isLogin && (
                    <>
                        <Form>

                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label column={"lg"}>Name</Form.Label>
                                <Form.Control type="text" onChange={handleInputChange} name="name" placeholder="Enter name" />
                                {
                                    errors.name && (
                                        <Form.Text className="text-danger">
                                            {errors.name}
                                        </Form.Text>
                                    )
                                }
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label column={"lg"}>Surname</Form.Label>
                                <Form.Control type="text" onChange={handleInputChange} name="surname" placeholder="Enter surname" />
                                {
                                    errors.surname && (
                                        <Form.Text className="text-danger">
                                            {errors.surname}
                                        </Form.Text>
                                    )
                                }
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label column={"lg"}>Email address</Form.Label>
                                <Form.Control type="email" onChange={handleInputChange} name="email" placeholder="Enter email" />
                                {
                                    errors.email && (
                                        <Form.Text className="text-danger">
                                            {errors.email}
                                        </Form.Text>
                                    )
                                }
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label column="lg">Password</Form.Label>
                                <Form.Control type="password" name="password" onChange={handleInputChange} placeholder="Password" />
                                {
                                    errors.password && (
                                        <Form.Text className="text-danger">
                                            {errors.password}
                                        </Form.Text>
                                    )
                                }
                            </Form.Group>
                            <span>Already have an account? Please login <a href="/" onClick={
                                (event) => {
                                    event.preventDefault();
                                    setIsLogin(true);
                                    setMessage("");
                                    setErrors({
                                        email: "",
                                        password: ""
                                    });
                                }
                            }><FaRegNewspaper style={{
                                color: "pink",
                                fontSize: "2.5rem"
                            }} /></a></span>
                            <hr/>
                            <Button className="button-pink" type="submit" onClick={
                                register
                            }>
                                Register
                            </Button>
                        </Form>
                    </>
                )
            }

        </div>
    );
};

export default Login;
