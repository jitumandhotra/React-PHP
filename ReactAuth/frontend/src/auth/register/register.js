import React from 'react';
import axios from 'axios';
import { Button, Col, Container, Form, FormGroup, FormLabel, Row } from 'react-bootstrap';
import { useNavigate } from 'react-router-dom';

const RegisterForm = () => {
  const registerAPI = 'http://localhost:8000/api/signup';
  const navigate = useNavigate();

  const submitRegisterForm = (event) => {
    event.preventDefault();
    const formElement = document.querySelector('#registerForm');
    const formData = new FormData(formElement);

    axios.post(registerAPI, formData)
      .then((response) => {
        const data = response.data;
        if (data.success === true) {
          alert('Registration successful');
          navigate('/auth/login');
        } else {
          alert('Registration failed');
        }
      })
      .catch((error) => {
        console.error('Error in registration:', error);
        alert('Registration failed');
      });
  };

  return (
    <React.Fragment>
      <Container className="my-5">
        <h2 className="fw-normal mb-5">Register</h2>
        <Row>
          <Col md={{ span: 6 }}>
            <Form id="registerForm" onSubmit={submitRegisterForm}>
              <FormGroup className="mb-3">
                <FormLabel htmlFor="register-name">First Name</FormLabel>
                <input type="text" className="form-control" id="register-name" name="name" required />
              </FormGroup>
              <FormGroup className="mb-3">
                <FormLabel htmlFor="register-lastname">Last Name</FormLabel>
                <input type="text" className="form-control" id="register-lastname" name="lastname" required />
              </FormGroup>
              <FormGroup className="mb-3">
                <FormLabel htmlFor="register-email">Email</FormLabel>
                <input type="email" className="form-control" id="register-email" name="email" required />
              </FormGroup>
              <FormGroup className="mb-3">
                <FormLabel htmlFor="register-password">Password</FormLabel>
                <input type="password" className="form-control" id="register-password" name="password" required />
              </FormGroup>
              <FormGroup className="mb-3">
                <FormLabel htmlFor="register-telephone">Telephone</FormLabel>
                <input type="tel" className="form-control" id="register-telephone" name="telephone" required />
              </FormGroup>
              <Button type="submit" className="btn-success mt-2">Register</Button>
            </Form>
            <div className="mt-3">
              <p>Already have an account? <a href="/auth/login">Login</a></p>
            </div>
          </Col>
        </Row>
      </Container>
    </React.Fragment>
  );
};

export default RegisterForm;
