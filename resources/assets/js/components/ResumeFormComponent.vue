<template>
    <div class="container">
        <form name="resume-new" :action="form_action_url" method="POST">
            <input name="_token" type="hidden" :value="$CSRF_TOKEN" />
        </form>
    </div>
</template>

<script>
export default {
  mounted() {
    //
  },

  props: {
    form_action_url: String
  }
};
</script>
