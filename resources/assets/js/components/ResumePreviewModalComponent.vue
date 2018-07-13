<template>
    <div class="modal fade" id="resume-preview-modal" tabindex="-1" role="dialog" aria-labelledby="resume-preview-modal-title"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-6">
                        <h6 class="modal-title mt-2" id="resume-preview-modal-title">
                            <strong>Select a template for the preview</strong>
                        </h6>
                    </div>

                    <div class="col-6">
                        <div class="buttons text-right">
                            <button type="button" class="btn btn-light" data-dismiss="modal" aria-label="Close">Back</button>
                            <button type="button" class="btn btn-primary">
                                <i class="fa-download"></i>&nbsp;Download
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-sm-2"
                            v-for="(template, index) in templates"
                            v-bind:index="index"
                            v-bind:key="template.name">
                            <div class="text-center"
                                v-bind:class="{'active': template.name === resume.getTemplate()}">
                                <img class="img-thumbnail img-fluid rounded cursor-pointer mx-auto d-block" v-bind:src="template.preview">

                                <p class="font-weight-bold text-capitalize text-muted mt-2 mb-0" v-text="template.name"></p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="img-thumbnail resume-preview">
                                <h5 class="font-weight-bold text-muted text-center my-5">Click on the above above resume designs to generate a preview.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        computed: {
            ...mapGetters([
                "resume",
                "templates"
            ]),
        },
    };
</script>

<style lang="sass" scoped>
    .img-thumbnail

        &:hover
            border: 1px solid var(--primary)

    .active
        .img-thumbnail
            border: 1px solid var(--primary)

    .resume-preview
        height: 100%
        min-height: 1035px
</style>
