import React, { Fragment } from 'react';
import PropTypes from 'prop-types';

const AvailableOptions = ({ options }) => {
  return (
    <Fragment>
      <p className='lead'>
        <h4 className='medium text-primary'>Available Options</h4>
      </p>

      <ul class='list-group'>
        {options.map((option, i) => {
          var display = '';
          option.map(
            (drink, i) => (display = display.concat(', ', drink.name))
          );
          return (
            <li class='list-group-item' key={i}>
              {display.substring(2)}
            </li>
          );
        })}
      </ul>
    </Fragment>
  );
};

AvailableOptions.propTypes = {
  options: PropTypes.array.isRequired,
};

export default AvailableOptions;
