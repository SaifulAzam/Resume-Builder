export default {
    props: {
        formIndex: {
            default: 0,
            type: Number
        }
    },

    watch: {
        formData: {
            deep: true,
            immediate: true,
            handler: function (formData) {
                this.$emit("form-data-updated", [formData, this.formIndex]);
            }
        }
    }
};