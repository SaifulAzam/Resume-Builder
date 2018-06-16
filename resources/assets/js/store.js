import Vue from "vue";
import Vuex from "vuex";
import OptionStore from "./stores/OptionStore";
import ResumeStore from "./stores/ResumeStore";

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

export default new Vuex.Store({
    modules: {
        OptionStore,
        ResumeStore
    },

    strict: debug
});
