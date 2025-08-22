import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import NavigationMenu from "./components/NavigationMenu";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import About from "./pages/About";
import Administration from "./pages/Administration";
import Arrangements from "./pages/Arrangements";
import Login from "./pages/Login";
import MyReservations from "./pages/MyReservations";
import Profile from "./pages/Profile";
import Footer from "./components/Footer";
import {Container} from "react-bootstrap";
import {ToastContainer} from "react-toastify";

function App() {
  return (
    <>
        <BrowserRouter>
            <NavigationMenu />
            <Container className="main">
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/about" element={<About/>} />
                    <Route path="/administration" element={<Administration/>} />
                    <Route path="/arrangements" element={<Arrangements />} />
                    <Route path="/login" element={<Login />} />
                    <Route path="/my-reservations" element={<MyReservations/>} />
                    <Route path="/profile" element={<Profile/>} />
                </Routes>
                <ToastContainer
                    position="top-left"
                    autoClose={5000}
                    hideProgressBar={false}
                    newestOnTop={false}
                    closeOnClick
                    rtl={false}
                    pauseOnFocusLoss
                    draggable
                    pauseOnHover
                    theme="dark"
                />
            </Container>
            <Footer />
        </BrowserRouter>

    </>
  );
}

export default App;