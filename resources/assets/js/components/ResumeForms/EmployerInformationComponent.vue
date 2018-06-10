<template>
    <div class="form-employer-information">
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('employer-name')">Employer name</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter employer name"
                       v-bind:id="getHashedElementId('employer-name')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('industry')">Industry</label>
            </div>

            <div class="col-sm-8">
                <select class="custom-select d-block w-100"
                        v-bind:id="getHashedElementId('industry')">
                    <option value="">Choose...</option>
                    <option>Administrative</option>
                    <option>Animal</option>
                    <option>Banking</option>
                </select>
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
    </div>
</template>

<script>
    import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";

    export default {
        mixins: [ComponentHashMixin]
    };
</script>
