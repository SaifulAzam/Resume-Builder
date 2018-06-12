import Vue from "vue";
import Vuex from "vuex";
import ResumeStore from "./stores/ResumeStore";

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
    modules: {
        ResumeStore
    },

    strict: debug
});
