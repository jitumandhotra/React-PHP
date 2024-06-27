import React from 'react';
import ReactDOM from 'react-dom/client';
import 'bootstrap/dist/css/bootstrap.min.css';
import './index.css';
import reportWebVitals from './reportWebVitals';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Login from './auth/login/Login';
import UserAccount from './auth/Account/userAcount';
import RegisterForm from './auth/register/register';
import Auth from './auth/Auth';
import App from './App';
import ProtectedRoute from './util/ProtectedRoute';
import Home from './portal/home/Home';
import MyComponent from './auth/Account/context';
import { AppProvider } from './portal/States/states';
import Quiz from './portal/States/quiz';
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
	
	<React.StrictMode>
		<AppProvider>
		<BrowserRouter basename={'/'}>
			<Routes>
				<Route path='/auth' element={<Auth />}>
					<Route path='login' element={<Login />} />
				</Route>
				<Route path="/register" element={<RegisterForm />} />
				<Route path="/state" element={<Quiz />} />
				<Route path="/" element={<App />}>
					<Route path='' element={
						<ProtectedRoute>
							<Home />
						</ProtectedRoute>
					} />
					<Route path='/account' element={
						<ProtectedRoute>
							<UserAccount />
						</ProtectedRoute>
					} />
				</Route>
			</Routes>
		</BrowserRouter>
		</AppProvider>
	</React.StrictMode>
);


reportWebVitals();
