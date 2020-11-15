import Vuex from 'vuex';
import Vue from 'vue';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        loadding: false,
        libraries: {},
        imagesChoosed: [] 
    },

    getters: {
        loadding: state => state.loadding,
        libraries: state => state.libraries,
        imagesChoosed: state => state.imagesChoosed
    },

    mutations: {
        setLoadding: state => state.loadding = !state.loadding,

        setLibraries: (state, payload) => {
            state.libraries = payload;
        },

        setImagesChoosed: (state, payload) => {
            state.imagesChoosed = payload;
        }
    },

    actions: {
        getLibraries({commit}) {
            axios.get('/admin/uploadFile')
            .then(res => {
                commit('setLibraries', res.data);
            })
        }
    }
});
