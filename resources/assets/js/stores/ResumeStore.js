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
     * Adds a new section to the resume.
     *
     * @param state
     * @param section
     * @constructor
     */
    ADD_SECTION: (state, section) => {
        state.resume.addSection(section);
    },

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
     * Adds a new section to the resume.
     *
     * @param commit
     * @param section
     */
    addSection: ({commit}, section) => {
        commit('ADD_SECTION', section);
    },

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
