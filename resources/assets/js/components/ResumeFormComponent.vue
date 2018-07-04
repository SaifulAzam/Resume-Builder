<template>
    <form name="resume-new" :action="form_action_url" method="POST">
        <input name="_token" type="hidden" :value="$CSRF_TOKEN"/>
        <input name="_method" type="hidden" :value="form_method"/>
        <input name="author_id" type="hidden" :value="getAuthor.id" v-if="getAuthor !== undefined">
        <input name="data" type="hidden" :value="JSON.stringify(resume.getSections())"/>
        <input name="template" type="hidden" :value="resume.getTemplate()"/>
        <input name="title" type="hidden" :value="resume.getName()"/>

        <div v-if="getAuthor === undefined">
            <input name="registration_email" type="hidden" :value="registration_info.email"/>
            <input name="registration_name" type="hidden" value="Abhishek Prakash"/>
            <input name="registration_pass" type="hidden" :value="registration_info.password"/>
        </div>

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
                                <div id="resume-completion-progress" class="progress" style="height: 10px;">
                                    <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width: 0%;"></div>
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="buttons text-right">
                                    <button type="button" class="btn btn-secondary shadow-sm" aria-pressed="false">Preview</button>

                                    <button type="submit" class="btn btn-primary shadow-sm" aria-pressed="false" v-text="getSubmitButtonText"></button>
                                </div>
                            </div>
                        </div>

                        <resume-navigation-tabs-component></resume-navigation-tabs-component>

                        <div class="py-4">
                            <resume-section-elements-component></resume-section-elements-component>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-secondary shadow-sm" aria-pressed="false"
                                v-on:click="handlePreviousSectionButton"
                                v-bind:disabled="isBackButtonDisabled"><i class="fa-angle-left mr-1"></i> Back</button>

                            <button type="button" class="btn btn-outline-secondary shadow-sm" aria-pressed="false"
                                v-on:click="handleNextSectionButton"
                                v-bind:disabled="isNextButtonDisabled">Next <i class="fa-angle-right ml-1"></i></button>
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
    import HandleBootstrapElementsMixin from "./../mixins/HandleBootstrapElementsMixin.js";
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
            ...mapGetters({
                getAuthor: "author",
                registration_info: "registration_info",
                resume: "resume"
            }),

            getSubmitButtonText() {
                return this.getAuthor !== undefined ? "Save" : "Download";
            }
        },

        mixins: [
            ComponentHashMixin,
            HandleBootstrapElementsMixin,
            HandleResumeNameMixin
        ],

        created() {
            let author     = undefined;
            let created_at = undefined;
            let data       = undefined;
            let updated_at = undefined;
            let sections   = [];

            if (this.author.length > 0) {
                author = JSON.parse(this.author);
            }

            if (this.data !== undefined) {
                created_at = this.created_at;
                data       = JSON.parse(this.data);
                updated_at = this.updated_at;

                data.forEach((section, index) => {
                    sections[index] = new Section(section);
                });
            } else {
                const section1 = new Section({
                    data: [],
                    has_name_editable: false,
                    hash: this.generateSecretHash(),
                    is_default: true,
                    name: "Contact Info",
                    type: SectionType.CONTACT_INFORMATION
                });

                const section2 = new Section({
                    data: [],
                    hash: this.generateSecretHash(),
                    is_default: true,
                    name: "Work Experience",
                    type: SectionType.WORK_EXPERIENCE
                });

                const section3 = new Section({
                    data: [],
                    hash: this.generateSecretHash(),
                    is_default: true,
                    name: "Education",
                    type: SectionType.EDUCATION
                });

                const section4 = new Section({
                    data: [],
                    hash: this.generateSecretHash(),
                    is_default: true,
                    name: "Additional Skills",
                    type: SectionType.ADDITIONAL_SKILLS
                });

                sections = [section1, section2, section3, section4];
            }

            const resume = new Resume({
                name: this.name,
                sections: sections,
                template: this.template,
                created_at: created_at,
                updated_at: updated_at
            });

            this.$store.dispatch("updateAuthor", author);
            this.$store.dispatch("setResume", resume);

            // We can mark the first section as active for the resume
            // after it has been successfully rendered on the screen.
            this.$nextTick(() => {
                this.$store.dispatch("setActiveSection", sections[0]);
            });
        },

        props: {
            author: {
                default: undefined
            },
            created_at: {
                default: undefined
            },
            data: {
                default: undefined
            },
            form_action_url: String,
            form_method: {
                default: undefined
            },
            name: String,
            template: String,
            updated_at: {
                default: undefined
            }
        }
    };
</script>
