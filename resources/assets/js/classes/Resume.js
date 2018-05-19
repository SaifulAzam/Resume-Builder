/**
 * @export
 * @class  Resume
 * @author Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
export default class Resume {
    /**
     * Creates an instance of Resume.
     * 
     * @param    {Object} props 
     * @memberof Resume
     */
    constructor(props) {
        this.name = props.name;
        this.sections = props.sections;
        this.template = props.template;

        this.created_at = props.created_at;
        this.updated_at = props.updated_at;
    }

    /**
     * Returns the name of the resume.
     * 
     * @returns  {String}
     * @memberof Resume
     */
    getName() {
        return this.name;
    }

    /**
     * Returns the sections being used in the resume.
     * 
     * @returns  {Array}
     * @memberof Resume
     */
    getSections() {
        return this.sections;
    }

    /**
     * Returns the template being used by the resume.
     * 
     * @returns  {String}
     * @memberof Resume
     */
    getTemplate() {
        return this.template;
    }
};