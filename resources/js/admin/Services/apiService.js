import axios from "axios";

let headers = {};

const apiService = {
    POST: (url, param, callback) => {
        headers = {
            'Content-Type': 'application/json; charset=utf-8',
        }
        axios.post(url, param, {headers: headers}).then((response) => {
            if (response.status === 200) {
                callback(response.data);
            }
        }).catch(err => {
            const error_code = parseInt(err.toLocaleString().replace(/\D/g, ""));
            if (error_code === 401) {
            }
            if (error_code === 403) {
            }
        })
    },

}



export default apiService;
