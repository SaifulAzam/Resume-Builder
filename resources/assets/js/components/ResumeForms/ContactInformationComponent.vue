<template>
    <div class="form-contact-information">
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('first-name')">First name</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="John"
                       v-bind:id="getHashedElementId('first-name')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('last-name')">Last name</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Smith"
                       v-bind:id="getHashedElementId('last-name')">
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
                       v-bind:for="getHashedElementId('post-code')">Post code</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="244713"
                       v-bind:id="getHashedElementId('post-code')">
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
                       v-bind:for="getHashedElementId('address-1')">Address Line 1</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Address Line 1"
                       v-bind:id="getHashedElementId('address-1')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('address-2')">Address Line 2</label>

                <p class="text-muted card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="Address Line 2"
                       v-bind:id="getHashedElementId('address-2')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('phone')">Phone number</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="+353 20 911 2769"
                       v-bind:id="getHashedElementId('phone')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('email')">Email address</label>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="email@example.com"
                       v-bind:id="getHashedElementId('email')">
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
