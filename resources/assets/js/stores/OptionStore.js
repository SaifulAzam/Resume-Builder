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
        [SectionType.AFFILIATIONS]:
            "There are essentially two primary types of affiliations ‐ professional and civic. It is beneficial to highlight both either together or separately, depending on the number of your affiliations and your occupation.",
        [SectionType.AWARDS_AND_HONORS]:
            "Awards and Honors may include awards relating to your academic achievements (especially important for entry level job candidates), professional accomplishments, and community contributions.",
        [SectionType.CAREER_OBJECTIVE]:
            "Today's career objective is quite different from the vague and canned career objectives common to so many malformed CVs from the past. A well worded career objective focuses on the employer's needs. It should be no longer than 1‐2 sentences.",
        [SectionType.CREDENTIALS_AND_LICENSES]:
            "A variety of occupations require specific academic credentials and licenses. These are typically in addition to a traditional college education. The importance of credentials and licenses depends on your occupation.",
        [SectionType.ENDORSEMENTS]:
            "Endorsements are snippets from a letter of recommendation. They are an effective way to add credibility to your resume and are especially suitable for career changers or those re‐entering the workforce after an extended hiatus.",
        [SectionType.HOBBIES]:
            "Hobbies describes what and how the person is and what he's most passionate about.",
        [SectionType.PUBLICATIONS_AND_PRESENTATIONS]:
            "If you have produced any professional writings or spoken publically, you should consider including a publications and presentations section. Only include this if it adds to your qualifications as a thought leader and expert in your field.",
        [SectionType.QUALIFICATIONS_SUMMARY]:
            "The qualifications summary section is a concise synopsis of your qualifications and achievements. It is for experienced professionals with sufficient experience, typically five or more years in one particular field.",
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
