<template>
    <div>
        <div
                v-if="showTitleInputField === false">
            <h6 class="font-weight-bold d-inline mr-2" style="border-bottom: 1px dashed;"
                    v-text="title"></h6>

            <div class="d-inline">
                <a class="btn btn-light" href="#" role="button"
                        v-on:click="showTitleInputField = true">
                    <i class="fa-pencil"></i>
                </a>
            </div>
        </div>

        <div
                v-else>
            <div class="form-inline">
                <div class="form-group mr-2">
                    <label class="sr-only"
                            v-bind:for="getHashedElementId('section-title')">Section Title</label>
                    <input type="text" class="form-control" placeholder="Section Title"
                            v-bind:id="getHashedElementId('section-title')"
                            v-model="cachedTitle">
                </div>

                <div class="d-inline">
                    <a class="btn btn-outline-primary" href="#" role="button"
                            v-on:click="updateTitle()">
                        <i class="fa-check"></i>
                    </a>

                    <a class="btn btn-outline-secondary" href="#" role="button"
                            v-on:click="discardTitle()">
                        <i class="fa-times"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../mixins/ComponentHashMixin.js";

    export default {
        created() {
            this.cachedTitle = this.title;
        },

        data() {
            return {
                cachedTitle: '',
                showTitleInputField: false
            };
        },

        methods: {
            discardTitle() {
                this.cachedTitle = this.title;

                this.$emit('title-update-discarded', this.cachedTitle);

                this.showTitleInputField = false;
            },

            updateTitle() {
                this.$emit('title-updated', this.cachedTitle);

                this.showTitleInputField = false;
            }
        },

        mixins: [ComponentHashMixin],

        props: {
            title: {
                default: '',
                type: String
            }
        }
    };
</script>