/**
 * @export
 * @class  Section
 * @author Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
export default class Section {
    /**
     * Creates a new instance of Section.
     * @param props
     */
    constructor(props) {
        this.data = props.data;
        this.hash = props.hash;
        this.name = props.name;
        this.type = props.type;
    }

    /**
     * Returns the hash set for the component.
     *
     * @returns {string}
     */
    getComponentHash() {
        return this.getType() + "-" + this.getHash();
    }

    /**
     * Returns the data of the section.
     *
     * @returns {Object}
     */
    getData() {
        return this.data;
    }

    /**
     * Returns the hash set for the section.
     *
     * @returns {string}
     */
    getHash() {
        return this.hash;
    }

    /**
     * Returns the name of the section.
     *
     * @returns {string}
     */
    getName() {
        return this.name;
    }

    /**
     * Returns the type of the section.
     *
     * @returns {string}
     */
    getType() {
        return this.type;
    }
}