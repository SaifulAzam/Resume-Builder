<template>
    <div>
        <div
                v-show="showTitleInputField === false">
            <h5 class="font-weight-bold d-inline my-0 mr-2" style="border-bottom: 1px dashed;"
                v-text="title"
                v-if="isHighlighted"></h5>

            <h6 class="font-weight-bold d-inline mr-2" style="border-bottom: 1px dashed;"
                v-text="title"
                v-else></h6>

            <div class="d-inline">
                <a class="btn btn-sm btn-light" href="#" role="button"
                   v-on:click="showTitleInputField = true">
                    <i class="fa-pencil"></i>
                </a>
            </div>
        </div>

        <div
                v-show="showTitleInputField === true">
            <div class="form-inline">
                <div class="form-group mr-2">
                    <label class="sr-only"
                           v-bind:for="getHashedElementId('section-title')">Section Title</label>
                    <input type="text" class="form-control form-control-sm" placeholder="Section Title"
                           v-bind:id="getHashedElementId('section-title')"
                           v-model="cachedTitle">
                </div>

                <div class="d-inline">
                    <a class="btn btn-outline-primary btn-sm" href="#" role="button"
                       v-on:click="updateTitle()">
                        <i class="fa-check"></i>
                    </a>

                    <a class="btn btn-outline-secondary btn-sm" href="#" role="button"
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
            // We cache the title, so no changes are made to the original
            // title until it's accepted by the user.
            this.cachedTitle = this.title;
        },

        data() {
            return {
                cachedTitle: '',
                showTitleInputField: false
            };
        },

        methods: {
            /**
             * Discard the update title process.
             *
             * @returns {void}
             */
            discardTitle() {
                // Revert the cached title with the original title so the
                // typed title doesn't get shown on the screen.
                this.cachedTitle = this.title;
                this.$emit('title-update-discarded', this.cachedTitle);

                this.showTitleInputField = false;
            },

            /**
             * Emits an event so the parent can update the supplied title
             * on their own.
             *
             * @returns {void}
             */
            updateTitle() {
                this.$emit('title-updated', this.cachedTitle);

                this.showTitleInputField = false;
            }
        },

        mixins: [ComponentHashMixin],

        props: {
            isHighlighted: {
                default: false,
                type: Boolean
            },

            title: {
                default: '',
                type: String
            }
        }
    };
</script>