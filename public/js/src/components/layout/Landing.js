import React, { useState, useEffect } from 'react';
import AvailableOptions from '../AvailableOptions';
import CaffeineService from '../../service/CaffeineService';

const Landing = () => {
  const [formData, setFormData] = useState({
    quantity: 0,
    items: [],
    favoriteValue: 1,
    submitted: false,
    availableOptions: [],
    alert: null,
    disabled: null,
  });

  //for populating dropdown with favorite drinks
  const [loading, setLoading] = useState(true);

  const {
    quantity,
    items,
    favoriteValue,
    submitted,
    availableOptions,
    alert,
    disabled,
  } = formData;

  useEffect(() => {
    async function parseFavoriteDrinks() {
      try {
        const response = await CaffeineService.getFavoriteDrinks();

        if (response.data.success) {
          setFormData({
            ...formData,
            items: response.data.data.map(({ name, id }) => ({
              label: name,
              value: id,
            })),
          });
        }
        setLoading(false);
      } catch (error) {
        setFormData({
          ...formData,
          alert: error.message,
          disabled: true,
        });
      }
    }
    parseFavoriteDrinks();
  }, []);

  const onChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const onSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await CaffeineService.getAvailableLimit(
        favoriteValue,
        quantity
      );

      if (response.data.success) {
        setFormData({
          ...formData,
          submitted: true,
          availableOptions: response.data.data,
          alert: null,
        });
      } else {
        setFormData({
          ...formData,
          alert: response.data.message,
        });
      }
    } catch (error) {
      setFormData({
        ...formData,
        alert: (error.response && error.response.data.message) || error.message,
        disabled: disabled,
      });
    }
  };

  return (
    <section className='container'>
      {alert && <div className={`alert alert-danger`}>{alert}</div>}
      <h1 className='large text-primary'>Check Available Limit</h1>
      <p className='lead'>
        <i className='fas fa-code-branch'></i> Choose any drink you have already
        taken, with quantity
      </p>
      <form className='form' onSubmit={(e) => onSubmit(e)}>
        <div className='form-group'>
          <label for='favoriteValue'>Drink</label>
          <select
            disabled={loading}
            onChange={(e) => onChange(e)}
            value={favoriteValue}
            name='favoriteValue'
            className='form-control'
          >
            {items.map((item) => (
              <option key={item.value} value={item.value}>
                {item.label}
              </option>
            ))}
          </select>
        </div>
        <div className='form-group'>
          <label for='quantity'>Quantity</label>
          <input
            type='number'
            placeholder='* Quantity'
            className='form-control'
            name='quantity'
            required
            min='0'
            max='20'
            value={quantity}
            onChange={(e) => onChange(e)}
          />
        </div>
        <input
          type='submit'
          className='btn btn-primary my-1'
          value='Submit'
          disabled={disabled}
        />
      </form>

      {submitted ? <AvailableOptions options={availableOptions} /> : null}
    </section>
  );
};

export default Landing;
