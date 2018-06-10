<template>
    <div>
        <div class="row align-items-center mb-3">
            <div class="col-sm text-muted">
                <resume-title-component
                        v-bind:title="section.getName()"
                        v-on:title-updated="updateSectionName"></resume-title-component>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form-school-information-component></form-school-information-component>
                <form-bullet-list-component></form-bullet-list-component>
            </div>
        </div>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";
    import ResetSectionHashMixin from "./../../mixins/ResetSectionHashMixin.js";
    import UpdateSectionNameMixin from "./../../mixins/UpdateSectionNameMixin.js";
    import ResumeTitleComponent from "./../ResumeTitleComponent.vue";
    import FormBulletListComponent from "./../ResumeForms/BulletListComponent.vue";
    import FormSchoolInformationComponent from "./../ResumeForms/SchoolInformationComponent.vue";

    export default {
        components: {
            FormBulletListComponent,
            FormSchoolInformationComponent,
            ResumeTitleComponent
        },

        mixins: [ComponentHashMixin, ResetSectionHashMixin, UpdateSectionNameMixin],

        props: {
            index: Number,
            section: Object
        }
    };
</script>
