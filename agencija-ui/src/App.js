import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import NavigationMenu from "./components/NavigationMenu";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import Home from "./pages/Home";
import Promotions from "./pages/Promotions";
import About from "./pages/About";
import Administration from "./pages/Administration";
import Arrangements from "./pages/Arrangements";
import Login from "./pages/Login";
import Reservations from "./pages/Reservations";
import MyReservations from "./pages/MyReservations";
import Profile from "./pages/Profile";
import Footer from "./components/Footer";
import {Container} from "react-bootstrap";

function App() {
  return (
    <>
        <BrowserRouter>
            <NavigationMenu />
            <Container className="main">
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/promotions" element={<Promotions />} />
                    <Route path="/about" element={<About/>} />
                    <Route path="/administration" element={<Administration/>} />
                    <Route path="/arrangements" element={<Arrangements />} />
                    <Route path="/login" element={<Login />} />
                    <Route path="/reservations" element={<Reservations/>} />
                    <Route path="/my-reservations" element={<MyReservations/>} />
                    <Route path="/profile" element={<Profile/>} />
                </Routes>
            </Container>
            <Footer />
        </BrowserRouter>

    </>
  );
}

export default App;