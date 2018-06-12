<template>
    <div class="tab-content">
        <div
                class="tab-pane fade" role="tabpanel"
                v-for="(section, index) in resume.getSections()"
                v-bind:index="index"
                v-bind:key="index"
                v-bind:aria-labelledby="section.getComponentHash()"
                v-bind:id="section.getComponentHash()"
                v-bind:class="{'show': index === 0, 'active': index === 0}">

            <section-additional-skills-component
                    v-bind:index="index"
                    v-bind:section="section"
                    v-if="section.getType() === SectionType.ADDITIONAL_SKILLS"></section-additional-skills-component>

            <section-contact-information-component
                    v-bind:index="index"
                    v-bind:section="section"
                    v-else-if="section.getType() === SectionType.CONTACT_INFORMATION"></section-contact-information-component>

            <section-custom-information-component
                    v-bind:index="index"
                    v-bind:section="section"
                    v-else-if="section.getType() === SectionType.CUSTOM_INFORMATION"></section-custom-information-component>

            <section-education-component
                    v-bind:index="index"
                    v-bind:section="section"
                    v-else-if="section.getType() === SectionType.EDUCATION"></section-education-component>

            <section-work-experience-component
                    v-bind:index="index"
                    v-bind:section="section"
                    v-else-if="section.getType() === SectionType.WORK_EXPERIENCE"></section-work-experience-component>

        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    import SectionType from "./../enums/SectionType.js";

    import SectionAdditionalSkillsComponent from "./ResumeSections/AdditionalSkillsComponent.vue";
    import SectionContactInformationComponent from "./ResumeSections/ContactInformationComponent.vue";
    import SectionCustomInformationComponent from "./ResumeSections/CustomInformationComponent.vue";
    import SectionEducationComponent from "./ResumeSections/EducationComponent.vue";
    import SectionWorkExperienceComponent from "./ResumeSections/WorkExperienceComponent.vue";

    export default {
        components: {
            SectionAdditionalSkillsComponent,
            SectionContactInformationComponent,
            SectionCustomInformationComponent,
            SectionEducationComponent,
            SectionWorkExperienceComponent
        },

        computed: {
            ...mapGetters(["resume"])
        },

        data() {
            return {
                SectionType: SectionType
            };
        }
    };
</script>
