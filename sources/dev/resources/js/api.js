
const BASE_URL = `/api/`;
export default {
  getYoutubeApi() {
    return BASE_URL + 'generateDemo';
  },
  getFrameApi() {
    return BASE_URL + 'frame';
  },
  getFrameDetailApi(id) {
    return BASE_URL + 'frame/'+id;
  },
  
  requestApi(url, callback, data = null, method = 'get') {
    let self = this;
    self.errors = null;
    return axios({
      method: method,
      url: url,
      data: data,
    })
      .then(function(response) {
        if (response.data.success) {
          callback(response.data.data);
        } else {
          self.errors = response.data;
        }
      })
      .catch(error => {
        if (error && error.response && error.response.data) {
          self.errors = error.response.data;
        }
      })
      .finally(function() {
        console.log(self.errors);
      });
  },
};
