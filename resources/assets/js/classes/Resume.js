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
        this.setName(props.name);
        this.setSections(props.sections);
        this.setTemplate(props.template);

        this.setCreatedAt(props.created_at);
        this.setUpdatedAt(props.updated_at);
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

    /**
     * Sets the created_at timestamp of the resume.
     *
     * @param created_at
     */
    setCreatedAt(created_at) {
        this.created_at = created_at;
    }

    /**
     * Sets the name of the resume.
     *
     * @param name
     */
    setName(name) {
        this.name = name;
    }

    /**
     * Sets the sections of the resume.
     *
     * @param sections
     */
    setSections(sections) {
        this.sections = sections;
    }

    /**
     * Sets the template of the resume.
     *
     * @param template
     */
    setTemplate(template) {
        this.template = template;
    }

    /**
     * Sets the updated_at timestamp of the resume.
     *
     * @param updated_at
     */
    setUpdatedAt(updated_at) {
        this.updated_at = updated_at;
    }
};