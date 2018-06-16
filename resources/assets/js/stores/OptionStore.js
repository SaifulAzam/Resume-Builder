import SectionType from "./../enums/SectionType.js";

const state = {
    /**
     * A list of section types to exclude from the add new section list.
     *
     * @type {Array}
     */
    exclude_section_types: [
        SectionType.ADDITIONAL_SKILLS,
        SectionType.CONTACT_INFORMATION,
        SectionType.EDUCATION
    ],

    /**
     * A list of custom messages for the sections.
     *
     * @type {Object}
     */
    section_types_introduction_messages: {
        [SectionType.CUSTOM_INFORMATION]: "",
        [SectionType.WORK_EXPERIENCE]:
            "Add a copy of the professional experience section. This is helpful for job candidates who want to have two professional experience sections, such as students with internship and work experience."
    }
};

const getters = {
    exclude_section_types: state => state.exclude_section_types,

    section_types_introduction_messages: state =>
        state.section_types_introduction_messages
};

export default {
    state,
    getters
};
