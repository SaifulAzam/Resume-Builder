const state = {
    /**
     * The active resume.
     *
     * @type {Object}
     */
    resume: undefined
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
     * Deletes the section from the resume.
     *
     * @param state
     * @param index
     * @constructor
     */
    DELETE_SECTION: (state, index) => {
        let sections = state.resume.getSections();

        sections.splice(index, 1);
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
    },

    /**
     * Sets the supplied section as active for the resume.
     *
     * @param state
     * @param section
     */
    SET_ACTIVE_SECTION: (state, section) => {
        state.resume.setActiveSection(section);
    },

    /**
     * Updates the name of the resume.
     *
     * @param state
     * @param name
     */
    UPDATE_RESUME_NAME: (state, name) => {
        state.resume.setName(name);
    },

    /**
     * Updates the name of the section of the index.
     *
     * @param state
     * @param data
     * @constructor
     */
    UPDATE_SECTION_NAME: (state, data) => {
        let index = data.index;
        let name = data.name;

        let sections = state.resume.getSections();
        let section = sections[index];

        section.setName(name);
    }
};

const actions = {
    /**
     * Adds a new section to the resume.
     *
     * @param commit
     * @param section
     */
    addSection: ({ commit }, section) => {
        commit("ADD_SECTION", section);
    },

    /**
     * Deletes the section from the resume.
     *
     * @param commit
     * @param index
     */
    deleteSection: ({ commit }, index) => {
        commit("DELETE_SECTION", index);
    },

    /**
     * Sets the current displayed resume properties.
     *
     * @param commit
     * @param resume
     */
    setResume: ({ commit }, resume) => {
        commit("SET_RESUME", resume);
    },

    /**
     * Sets the supplied section as active for the resume.
     *
     * @param commit
     * @param section
     */
    setActiveSection: ({ commit }, section) => {
        commit("SET_ACTIVE_SECTION", section);
    },

    /**
     * Updates the name of the resume.
     *
     * @param commit
     * @param name
     */
    updateResumeName: ({ commit }, name) => {
        commit("UPDATE_RESUME_NAME", name);
    },

    /**
     * Updates the name of the section of the index.
     *
     * @param commit
     * @param data
     */
    updateSectionName: ({ commit }, data) => {
        commit("UPDATE_SECTION_NAME", data);
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
