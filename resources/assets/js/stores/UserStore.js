const state = {
    registration_info: {
        email: "",
        name: "",
        password: ""
    },

    user: undefined,
};

const mutations = {
    UPDATE_REGISTRATION_EMAIL: (state, email) => {
        state.registration_info.email = email;
    },

    UPDATE_REGISTRATION_NAME: (state, name) => {
        state.registration_info.name = name;
    },

    UPDATE_REGISTRATION_PASSWORD: (state, password) => {
        state.registration_info.password = password;
    },
};

const actions = {
    updateRegistrationEmail: ({ commit }, email) => {
        commit("UPDATE_REGISTRATION_EMAIL", email);
    },

    updateRegistrationName: ({ commit }, name) => {
        commit("UPDATE_REGISTRATION_NAME", name);
    },

    updateRegistrationPassword: ({ commit }, password) => {
        commit("UPDATE_REGISTRATION_PASSWORD", password);
    },
};

const getters = {
    registration_info: state => state.registration_info
};

export default {
    state,
    mutations,
    actions,
    getters
};
