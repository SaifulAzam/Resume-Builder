<template>
    <div class="tab-content">
        <div
            class="tab-pane fade" role="tabpanel"
            v-for="(section, index) in resume.sections"
            v-bind:index="index"
            v-bind:key="index"
            v-bind:aria-labelledby="section.getComponentHash()"
            v-bind:id="section.getComponentHash()"
            v-bind:class="{'show': index === 0, 'active': index === 0}">

            <section-contact-information-component
                v-bind:section="section"
                v-if="section.getType() === SectionType.CONTACT_INFORMATION"></section-contact-information-component>

            <section-work-experience-component
                v-bind:section="section"
                v-else-if="section.getType() === SectionType.WORK_EXPERIENCE"></section-work-experience-component>

        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import SectionType from "./../enums/SectionType.js";

import SectionContactInformationComponent from "./ResumeSections/ContactInformationComponent.vue";
import SectionWorkExperienceComponent from "./ResumeSections/WorkExperienceComponent.vue";

export default {
  components: {
    SectionContactInformationComponent,
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
