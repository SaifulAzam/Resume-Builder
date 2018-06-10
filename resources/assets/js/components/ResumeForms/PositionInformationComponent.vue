<template>
    <div class="form-position-information">
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('position-title')">Position title</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Enter position title"
                       v-bind:id="getHashedElementId('position-title')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold">Start date</label>
            </div>

            <div class="col-sm-8">
                <div class="form-row">
                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('month')">
                            <option value="">Choose month...</option>
                            <option>January</option>
                            <option>February</option>
                        </select>
                    </div>

                    <div class="col">
                        <select class="custom-select d-block w-100"
                                v-bind:id="getHashedElementId('year')">
                            <option value="">Choose year...</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold">Still work here?</label>
            </div>

            <div class="col-sm-8">
                <span class="custom-control custom-radio d-inline mr-3">
                    <input name="still-work" class="custom-control-input" checked="" required="" type="radio"
                           v-bind:id="getHashedElementId('yes')">
                    <label class="custom-control-label"
                           v-bind:for="getHashedElementId('yes')">Yes</label>
                </span>

                <span class="custom-control custom-radio d-inline">
                    <input name="still-work" class="custom-control-input" required="" type="radio"
                           v-bind:id="getHashedElementId('no')">
                    <label class="custom-control-label"
                           v-bind:for="getHashedElementId('no')">No</label>
                </span>
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
