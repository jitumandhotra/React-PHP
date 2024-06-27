import React from 'react';
import { Container } from 'react-bootstrap';

const UserAccount = () => {
  const userData = JSON.parse(localStorage.getItem('user'));
  console.log(userData);

  return (
    <React.Fragment>
      <Container className="py-5">
        <h3 className="fw-normal">Profile Page</h3>
        {userData && (
          <div>
            <p>Name: {userData.firstname+'   '+userData.lastname}</p>
            <p>Email: {userData.email}</p>
			      <p>Contact: {userData.telephone}</p>
          </div>
        )}
      </Container>
    </React.Fragment>
  );
};

export default UserAccount;
