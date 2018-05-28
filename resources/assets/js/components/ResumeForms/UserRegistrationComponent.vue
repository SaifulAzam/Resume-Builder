<template>
    <div class="form-user-registration">
        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('email')">Email address</label>

                <p class="text-muted card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>

            <div class="col-sm-8">
                <input type="text" class="form-control" placeholder="email@example.com"
                       v-bind:id="getHashedElementId('email')">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4">
                <label class="col-form-label font-weight-bold"
                       v-bind:for="getHashedElementId('password')">Password</label>
            </div>

            <div class="col-sm-8">
                <input type="password" class="form-control" placeholder="Password"
                       v-bind:id="getHashedElementId('password')">
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
