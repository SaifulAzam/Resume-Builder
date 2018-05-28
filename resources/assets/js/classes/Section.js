/**
 * @export
 * @class  Section
 * @author Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
export default class Section {
    /**
     * Creates an instance of Section.
     *
     * @param    {Object} props
     * @memberof Section
     */
    constructor(props) {
        this.data = props.data;
        this.hash = props.hash;
        this.name = props.name;
        this.type = props.type;
    }

    /**
     * Returns the hash generated for the section.
     *
     * @returns  {String}
     * @memberof Section
     */
    getComponentHash() {
        return this.getType() + "-" + this.getHash();
    }

    /**
     * Returns the data stored by the section.
     *
     * @returns  {Object}
     * @memberof Section
     */
    getData() {
        return this.data;
    }

    /**
     * Returns the secret hash generated for the section.
     *
     * @returns  {String}
     * @memberof Section
     */
    getHash() {
        return this.hash;
    }

    /**
     * Returns the name of the section.
     *
     * @returns  {String}
     * @memberof Section
     */
    getName() {
        return this.name;
    }

    /**
     * Returns the type of section.
     *
     * @returns  {String}
     * @memberof Section
     */
    getType() {
        return this.type;
    }
}