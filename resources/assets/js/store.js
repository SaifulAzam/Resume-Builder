import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== "production";

import ResumeStore from "./stores/ResumeStore";

export default new Vuex.Store({
  modules: {
    ResumeStore
  },

  strict: debug
});
