import React from "react";
import { Link } from 'react-router-dom';
import { Button, Nav } from "react-bootstrap";
import Container from 'react-bootstrap/Container';
import Navbar from 'react-bootstrap/Navbar';
import { useNavigate } from "react-router-dom";
import logo from './img/headerlogo.png';
const PortalNavbar = () => {
    const imageUrl = process.env.PUBLIC_URL + '/headerlogo.png';
    const navigate = useNavigate();
    const logout = () => {
        localStorage.clear();
        navigate('/auth/login');
    }
    return (
        <React.Fragment>
            <Navbar bg="dark" expand="lg" className="navbar-dark">
                <Container>
                    <Navbar.Brand><img src={imageUrl} className='header-logo-img' /></Navbar.Brand>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="ms-auto">
                            <Nav.Link as={Link} to="/state">States</Nav.Link>
                            <Nav.Link as={Link} to="/account">
                                <Button variant="outline-light" size="">My Account</Button>
                            </Nav.Link>
                            <Nav.Link>
                                <Button className="btn-warning" onClick={logout}>Logout</Button>
                            </Nav.Link>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
        </React.Fragment>
    );
}
export default PortalNavbar;