/**
 * @export
 * @class  Resume
 * @author Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
export default class Resume {
    /**
     * Creates a new instance of Resume.
     *
     * @param props
     */
    constructor(props) {
        this.name = props.name;
        this.sections = props.sections;
        this.template = props.template;

        this.created_at = props.created_at;
        this.updated_at = props.updated_at;
    }

    /**
     * Adds a new section in the resume.
     *
     * @param section
     */
    addSection(section) {
        this.sections.push(section);
    }

    /**
     * Returns the name set for the resume.
     *
     * @returns {string}
     */
    getName() {
        return this.name;
    }

    /**
     * Returns the sections of the resume.
     *
     * @returns {Array}
     */
    getSections() {
        return this.sections;
    }

    /**
     * Returns the template of the resume.
     *
     * @returns {string}
     */
    getTemplate() {
        return this.template;
    }
};