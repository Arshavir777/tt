import axios from "axios";

class ApiService {

    constructor() {
        this.client = axios.create({ baseURL: '/api' });
    }

    getProperties(filters = {}) {
        return this.client.get('/properties', {params: filters})
    }
}

export default new ApiService();
