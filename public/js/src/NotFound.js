import React from 'react';
import { Link } from 'react-router-dom';

const NotFound = () => (
  <section className='container'>
    <h1>404 - Not Found!</h1>
    <Link to='/'>Go Home</Link>
  </section>
);

export default NotFound;
