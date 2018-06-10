<template>
    <div class="form-school-information">
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('education-type')">Education Types</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-100"
                        v-bind:id="getHashedElementId('education-type')">
                    <option>Secondary School</option>
                    <option>University</option>
                    <option>BTEC</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('school-name')">School name</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter school name"
                       v-bind:id="getHashedElementId('school-name')">
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

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('country')">Country</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-100"
                        v-bind:id="getHashedElementId('country')">
                    <option value="">Choose...</option>
                    <option>India</option>
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
                       v-bind:for="getHashedElementId('still-enrolled')">Still enrolled?</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-25"
                        v-bind:id="getHashedElementId('still-enrolled')">
                    <option value="">N/A</option>
                    <option>Yes</option>
                    <option>No</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";

    export default {
        mixins: [ComponentHashMixin]
    };
</script>
