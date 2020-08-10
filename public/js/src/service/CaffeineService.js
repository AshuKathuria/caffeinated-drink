import axios from 'axios';

class CaffeineService {
  async getFavoriteDrinks() {
    return await axios.get(
      `${process.env.REACT_APP_BACKEND_URL}/api/v1/favorite`,
      {
        headers: {
          Authorization: process.env.REACT_APP_AUTH,
        },
      }
    );
  }

  async getAvailableLimit(favoriteValue, quantity) {
    return await axios.get(
      `${process.env.REACT_APP_BACKEND_URL}/api/v1/availableoptions/${favoriteValue}/${quantity}`,
      {
        headers: {
          Authorization: process.env.REACT_APP_AUTH,
        },
      }
    );
  }
}

export default new CaffeineService();
