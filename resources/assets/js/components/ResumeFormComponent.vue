<template>
    <form name="resume-new" :action="form_action_url" method="POST">
        <input name="_token" type="hidden" :value="$CSRF_TOKEN"/>

        <div class="row">
            <div class="col-sm">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-sm">
                                <resume-title-component
                                        v-bind:isDeletable="false"
                                        v-bind:isHighlighted="true"
                                        v-bind:title="resume.getName()"
                                        v-on:title-updated="updateResumeName"></resume-title-component>
                            </div>

                            <div class="col-sm-4">
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 50%"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="buttons text-right">
                                    <button type="button" class="btn btn-secondary shadow-sm" data-toggle="button"
                                            aria-pressed="false">Preview
                                    </button>
                                    <button type="button" class="btn btn-primary shadow-sm" data-toggle="button"
                                            aria-pressed="false">Download
                                    </button>
                                </div>
                            </div>
                        </div>

                        <resume-navigation-tabs-component></resume-navigation-tabs-component>

                        <div class="py-4">
                            <resume-section-elements-component></resume-section-elements-component>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-outline-secondary shadow-sm" data-toggle="button"
                                    aria-pressed="false">Continue <i class="fa-angle-right ml-1"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import { mapGetters } from "vuex";

    import Resume from "./../classes/Resume.js";
    import Section from "./../classes/Section.js";
    import SectionType from "./../enums/SectionType.js";

    import ComponentHashMixin from "./../mixins/ComponentHashMixin.js";
    import HandleResumeNameMixin from "./../mixins/HandleResumeNameMixin.js";
    import ResumeNavigationTabsComponent from "./ResumeNavigationTabsComponent.vue";
    import ResumeSectionElementsComponent from "./ResumeSectionElementsComponent.vue";
    import ResumeTitleComponent from "./ResumeTitleComponent.vue";

    export default {
        components: {
            ResumeNavigationTabsComponent,
            ResumeSectionElementsComponent,
            ResumeTitleComponent
        },

        computed: {
            ...mapGetters(["resume"])
        },

        mixins: [ComponentHashMixin, HandleResumeNameMixin],

        created() {
            let section1 = new Section({
                data: [],
                hash: this.generateSecretHash(),
                is_default: true,
                name: "Contact Info",
                type: SectionType.CONTACT_INFORMATION
            });

            let section2 = new Section({
                data: [],
                hash: this.generateSecretHash(),
                is_default: true,
                name: "Work Experience",
                type: SectionType.WORK_EXPERIENCE
            });

            let section3 = new Section({
                data: [],
                hash: this.generateSecretHash(),
                is_default: true,
                name: "Education",
                type: SectionType.EDUCATION
            });

            let section4 = new Section({
                data: [],
                hash: this.generateSecretHash(),
                is_default: true,
                name: "Additional Skills",
                type: SectionType.ADDITIONAL_SKILLS
            });

            let resume = new Resume({
                name: "My Resume",
                sections: [section1, section2, section3, section4],
                template: "Oxford",
                created_at: "12-Nov-2017",
                updated_at: "13-Nov-2017"
            });

            this.$store.dispatch("setResume", resume);
        },

        props: {
            form_action_url: String
        }
    };
</script>
