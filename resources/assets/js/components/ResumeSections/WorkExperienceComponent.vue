<template>
    <div>
        <div class="row align-items-center mb-3">
            <div class="col-sm text-muted">
                <h6 class="font-weight-bold d-inline mr-2" style="border-bottom: 1px dashed;"
                    v-text="section.getName()"></h6>
                <i class="fa-pencil"></i>
            </div>
        </div>
    </div>
</template>

<script>
import ComponentHashMixin from "./../../mixins/ComponentHashMixin.js";

export default {
  created() {
    if (this.section.getHash() !== undefined) {
      this.setSecretHash(this.section.getHash());
    }
  },

  mixins: [ComponentHashMixin],

  props: {
    section: Object
  }
};
</script>
