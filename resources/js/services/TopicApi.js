import axios from "axios";
export default {
    getTopic(id) {
        return axios.get('/api/topic/' + id)
    },
    getTopics() {
        return axios.get('/api/topic')
    },
    getPaginatedTopics(page, perPage, orderByColumns) {
        return axios.get('/api/topics',
            {params: {perPage: perPage, page: page, orderByColumns: orderByColumns}}
        );
    }
}
