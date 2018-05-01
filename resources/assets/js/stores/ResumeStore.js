const state = {
  /**
   * The active resume.
   *
   * @type {Object}
   */
  resume: undefined,

  /**
   * Determines which template is active for the resume.
   *
   * @type {String}
   */
  template: undefined
};

const mutations = {
  /**
   * Sets the current displayed resume properties.
   *
   * @param state
   * @param resume
   * @constructor
   */
  SET_RESUME: (state, resume) => {
    state.resume = resume;
  }
};

const actions = {
  /**
   * Sets the current displayed resume properties.
   *
   * @param commit
   * @param resume
   */
  setResume: ({commit}, resume) => {
    commit('SET_RESUME', resume);
  }
};

const getters = {
  resume: state => state.resume
};

export default {
  state,
  mutations,
  actions,
  getters
};
