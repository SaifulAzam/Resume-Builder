<template>
    <ul id="resume-sections-tabs" class="nav nav-tabs mt-4" role="tablist">
        <li class="nav-item"
            v-for="(section, index) in resume.getSections()"
            v-bind:index="index"
            v-bind:key="index">
            <a class="nav-link" data-toggle="tab" role="tab" aria-selected="true"
               v-bind:href="'#' + section.getComponentHash()"
               v-bind:aria-controls="section.getComponentHash()"
               v-text="section.getName()"></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" role="button" data-toggle="modal" data-target="#add-section-modal"><i
                    class="fa-plus mr-1"></i> Extra Information</a>
        </li>
    </ul>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        computed: {
            ...mapGetters(["resume"])
        }
    };
</script>
