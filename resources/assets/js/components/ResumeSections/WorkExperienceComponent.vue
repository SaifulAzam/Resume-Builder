<template>
    <div>
        <div class="row align-items-center mb-3">
            <div class="col-sm-12 text-muted">
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
                <form-employer-information-component
                        v-bind:form-index="getFormIndex()"
                        v-on:form-data-updated="updateSectionFormData"></form-employer-information-component>
                <form-position-information-component
                        v-bind:form-index="getFormIndex()"
                        v-on:form-data-updated="updateSectionFormData"></form-position-information-component>

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="col-form-label font-weight-bold"
                               v-bind:for="getHashedElementId('job-keyword')">Enter job keyword to add pre-written
                            responsibilities</label>
                    </div>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder='For example, "Manager", or "Sales"'
                               v-bind:id="getHashedElementId('job-keyword')">
                    </div>
                </div>

                <form-bullet-list-component
                        v-bind:form-index="getFormIndex()"
                        v-on:form-data-updated="updateSectionFormData"></form-bullet-list-component>
            </div>
        </div>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";
    import ResetSectionHashMixin from "./../../mixins/ResetSectionHashMixin.js";
    import HandleDeletableSectionMixin from "./../../mixins/HandleDeletableSectionMixin.js";
    import HandleSectionNameMixin from "./../../mixins/HandleSectionNameMixin.js";
    import HandleSectionFormMixin from "./../../mixins/HandleSectionFormMixin.js";
    import ResumeTitleComponent from "./../ResumeTitleComponent.vue";
    import FormBulletListComponent from "./../ResumeForms/BulletListComponent.vue";
    import FormEmployerInformationComponent from "./../ResumeForms/EmployerInformationComponent.vue";
    import FormPositionInformationComponent from "./../ResumeForms/PositionInformationComponent.vue";

    export default {
        components: {
            FormBulletListComponent,
            FormEmployerInformationComponent,
            FormPositionInformationComponent,
            ResumeTitleComponent
        },

        mixins: [
            ComponentHashMixin,
            ResetSectionHashMixin,
            HandleDeletableSectionMixin,
            HandleSectionNameMixin,
            HandleSectionFormMixin
        ],

        props: {
            index: Number,
            section: Object
        }
    };
</script>
