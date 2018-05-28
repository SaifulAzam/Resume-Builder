<template>
    <div>
        <div class="row align-items-center mb-3">
            <div class="col-sm text-muted">
                <h6 class="font-weight-bold d-inline mr-2" style="border-bottom: 1px dashed;"
                    v-text="section.getName()"></h6>
                <i class="fa-pencil"></i>
            </div>
        </div>

        <form-contact-information-component></form-contact-information-component>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold">Register now?</label>

                <p class="text-muted card-text">Registered users enjoys the lifetime access to their resume.</p>
            </div>

            <div class="col-sm-8">
                <span class="custom-control custom-radio d-inline mr-3">
                    <input name="registration" class="custom-control-input" checked="" required="" type="radio"
                           v-bind:id="getHashedElementId('yes')">
                    <label class="custom-control-label"
                           v-bind:for="getHashedElementId('yes')">Yes</label>
                </span>

                <span class="custom-control custom-radio d-inline">
                    <input name="registration" class="custom-control-input" required="" type="radio"
                           v-bind:id="getHashedElementId('no')">
                    <label class="custom-control-label"
                           v-bind:for="getHashedElementId('no')">No</label>
                </span>
            </div>
        </div>

        <form-user-registration-component></form-user-registration-component>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";
    import FormContactInformationComponent from "./../ResumeForms/ContactInformationComponent.vue";
    import FormUserRegistrationComponent from "./../ResumeForms/UserRegistrationComponent.vue";

    export default {
        components: {
            FormContactInformationComponent,
            FormUserRegistrationComponent
        },

        created() {
            if (this.section.getHash() !== undefined) {
                this.setSecretHash(this.section.getHash());
            }
        },

        mixins: [ComponentHashMixin],

        props: {
            section: Object
        }
    };
</script>
