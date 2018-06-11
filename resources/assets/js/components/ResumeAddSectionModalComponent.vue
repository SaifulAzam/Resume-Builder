<template>
    <div class="modal fade" id="add-section-modal" tabindex="-1" role="dialog" aria-labelledby="add-section-modal-title"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="add-section-modal-title">
                        <strong>Add Extra Information</strong>
                    </h6>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <div class="form">
                        <div class="form-group">
                            <label for="select-section-type">Select a section type:</label>

                            <select class="form-control custom-select my-2" id="select-section-type">
                                <option value="" selected>Work Experience</option>
                                <option>Career Objective</option>
                            </select>

                            <p class="text-muted">Add a copy of the professional experience section. This is helpful for
                                job candidates who want to have two professional experience sections, such as students
                                with internship and work experience.</p>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary shadow-sm text-uppercase"
                                    data-dismiss="modal"
                                    v-on:click="addSection()">Add Section
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../mixins/ComponentHashMixin.js";
    import Section from "./../classes/Section.js";
    import SectionType from "./../enums/SectionType.js";

    export default {
        methods: {
            addSection() {
                let section = new Section({
                    data: [],
                    hash: this.generateSecretHash(),
                    is_default: false,
                    name: "New Section",
                    type: SectionType.EDUCATION
                });

                this.$store.dispatch('addSection', section)
                    .then(() => {
                        // We need to wait for the section to be rendered
                        // on the screen. Once, the section is added we
                        // can safely switch to it so user can fill in
                        // their information on the newly added section.
                        this.$nextTick(() => {
                            let sectionHash = "#" + section.getComponentHash();
                            let navItem     = 'li.nav-item a[href="' + sectionHash + '"]';

                            $(navItem).tab('show');
                        });
                    });
            }
        },

        mixins: [ComponentHashMixin]
    };
</script>
