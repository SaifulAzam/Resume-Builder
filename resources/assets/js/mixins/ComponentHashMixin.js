export default {
    created() {
        this.componentHash = this.generateComponentHash();
    },

    data() {
        return {
            componentHash: undefined
        };
    },

    methods: {
        /**
         * Generates a unique hash for the component so it stays unique in the
         * DOM even when the component is repeated under multiple times.
         *
         * @returns {Number}
         */
        generateComponentHash() {
            let randomNumber = Math.ceil(Math.random() * 1000000000);
            return randomNumber * randomNumber;
        },

        /**
         * Returns the Hashed ID generated for the element name supplied.
         * 
         * @param   {String} element 
         * @returns {String}
         */
        getHashedComponentElementId(element) {
            return element + '-' + this.componentHash;
        }
    }
};