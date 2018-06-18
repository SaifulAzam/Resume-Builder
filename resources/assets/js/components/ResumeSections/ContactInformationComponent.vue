<template>
    <div>
        <div class="row align-items-center mb-3">
            <div class="col-sm text-muted">
                <resume-title-component
                        v-bind:isDeletable="section.getIsDefault() === false"
                        v-bind:isEditable="section.getHasNameEditable()"
                        v-bind:title="section.getName()"
                        v-on:handle-delete="handleDeleteSection"
                        v-on:title-updated="updateSectionName"></resume-title-component>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
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
        </div>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";
    import ResetSectionHashMixin from "./../../mixins/ResetSectionHashMixin.js";
    import HandleDeletableSectionMixin from "./../../mixins/HandleDeletableSectionMixin.js";
    import HandleSectionNameMixin from "./../../mixins/HandleSectionNameMixin.js";
    import ResumeTitleComponent from "./../ResumeTitleComponent.vue";
    import FormContactInformationComponent from "./../ResumeForms/ContactInformationComponent.vue";
    import FormUserRegistrationComponent from "./../ResumeForms/UserRegistrationComponent.vue";

    export default {
        components: {
            FormContactInformationComponent,
            FormUserRegistrationComponent,
            ResumeTitleComponent
        },

        mixins: [
            ComponentHashMixin,
            ResetSectionHashMixin,
            HandleDeletableSectionMixin,
            HandleSectionNameMixin
        ],

        props: {
            index: Number,
            section: Object
        }
    };
</script>
