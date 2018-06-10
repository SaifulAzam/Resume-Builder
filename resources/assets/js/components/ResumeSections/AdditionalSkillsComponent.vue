<template>
    <div>
        <div class="row align-items-center mb-3">
            <div class="col-sm-12 text-muted">
                <h6 class="font-weight-bold d-inline mr-2" style="border-bottom: 1px dashed;"
                    v-text="section.getName()"></h6>
                <i class="fa-pencil"></i>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <form-bullet-list-component></form-bullet-list-component>
            </div>
        </div>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";
    import ResetSectionHashMixin from "./../../mixins/ResetSectionHashMixin.js";
    import FormBulletListComponent from "./../ResumeForms/BulletListComponent.vue";

    export default {
        components: {
            FormBulletListComponent
        },

        mixins: [ComponentHashMixin, ResetSectionHashMixin],

        props: {
            section: Object
        }
    };
</script>
