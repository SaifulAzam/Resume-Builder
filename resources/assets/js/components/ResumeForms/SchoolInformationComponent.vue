<template>
    <div class="form-school-information">
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('education-type')">Education Types</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-100"
                        v-bind:id="getHashedElementId('education-type')"
                        v-model="selectedEducationType">
                        <option v-for="(education_type, index) in EducationType"
                                v-bind:index="index"
                                v-bind:key="index"
                                v-bind:value="education_type"
                                v-text="education_type"></option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('school-name')"
                       v-text="schoolNameLabel"></label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control"
                       v-bind:id="getHashedElementId('school-name')"
                       v-bind:placeholder="schoolNamePlaceholder">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('city')">City/Town</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Kashipur"
                       v-bind:id="getHashedElementId('city')">
            </div>
        </div>

        <div class="form-group row"
            v-if="selectedEducationType !== EducationType.SECONDARY_SCHOOL">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('program-name')">Degree/Program</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control"
                       v-bind:id="getHashedElementId('program-name')"
                       v-bind:placeholder="programNamePlaceholder">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('country')">Country</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-100"
                        v-bind:id="getHashedElementId('country')">
                    <option value="" selected disabled>Choose...</option>
                    <option v-for="(country, index) in countries"
                            v-bind:index="index"
                            v-bind:key="index"
                            v-bind:value="country"
                            v-text="country"></option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('county')">County</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="County"
                       v-bind:id="getHashedElementId('county')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('is-enrolled')">Still enrolled?</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-25"
                        v-bind:id="getHashedElementId('is-enrolled')"
                        v-model="isEnrolled">
                    <option value="N/A">N/A</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </div>
        </div>

        <div class="form-group row" v-if="isEnrolled === 'true'">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold">Expected completion date</label>
            </div>

            <div class="col-sm-8">
                <div class="form-row">
                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('expected-completed-month')">
                            <option value="" selected disabled>Choose month...</option>
                            <option v-for="(month, index) in months"
                                    v-bind:index="index"
                                    v-bind:key="index"
                                    v-bind:value="month"
                                    v-text="month"></option>
                        </select>
                    </div>

                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('expected-completion-year')">
                            <option value="" selected disabled>Choose year...</option>
                            <option v-for="(year, index) in years"
                                    v-bind:index="index"
                                    v-bind:key="index"
                                    v-bind:value="year"
                                    v-text="year"></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="isEnrolled === 'false'">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('is-completed')">Completed?</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-25"
                        v-bind:id="getHashedElementId('is-completed')"
                        v-model="isCompleted">
                    <option value="N/A">N/A</option>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                </select>
            </div>
        </div>

        <div class="form-group row" v-if="isEnrolled === 'false' && isCompleted === 'true'">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold">Completion date</label>
            </div>

            <div class="col-sm-8">
                <div class="form-row">
                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('completion-month')">
                            <option value="" selected disabled>Choose month...</option>
                            <option v-for="(month, index) in months"
                                    v-bind:index="index"
                                    v-bind:key="index"
                                    v-bind:value="month"
                                    v-text="month"></option>
                        </select>
                    </div>

                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('completion-year')">
                            <option value="" selected disabled>Choose year...</option>
                            <option v-for="(year, index) in years"
                                    v-bind:index="index"
                                    v-bind:key="index"
                                    v-bind:value="year"
                                    v-text="year"></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row" v-if="isEnrolled === 'false' && isCompleted === 'false'">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold">Last year of enrollment</label>
            </div>

            <div class="col-sm-8">
                <div class="form-row">
                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('last-year-of-enrollment-month')">
                            <option value="" selected disabled>Choose month...</option>
                            <option v-for="(month, index) in months"
                                    v-bind:index="index"
                                    v-bind:key="index"
                                    v-bind:value="month"
                                    v-text="month"></option>
                        </select>
                    </div>

                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('last-year-of-enrollment-year')">
                            <option value="" selected disabled>Choose year...</option>
                            <option v-for="(year, index) in years"
                                    v-bind:index="index"
                                    v-bind:key="index"
                                    v-bind:value="year"
                                    v-text="year"></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    import EducationType from "./../../enums/EducationType.js";
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";

    export default {
        computed: {
            ...mapGetters(["countries", "months", "years"]),

            programNamePlaceholder() {
                switch (this.selectedEducationType) {
                    case EducationType.UNIVERSITY:
                        return "E.g.: B.Sc. Biology";
                    case EducationType.BTEC:
                        return "E.g.: Lv-5 in Graphics Design";
                    default:
                        return "Enter course title";
                }
            },

            schoolNameLabel() {
                switch (this.selectedEducationType) {
                    case EducationType.SECONDARY_SCHOOL:
                        return "School name";
                    case EducationType.UNIVERSITY:
                        return "University name";
                    default:
                        return "Institution name";
                }
            },

            schoolNamePlaceholder() {
                return "Enter " + this.schoolNameLabel.toLowerCase();
            }
        },

        data() {
            return {
                EducationType: EducationType,
                isCompleted: "N/A",
                isEnrolled: "N/A",
                selectedEducationType: EducationType.SECONDARY_SCHOOL
            };
        },

        mixins: [ComponentHashMixin]
    };
</script>
