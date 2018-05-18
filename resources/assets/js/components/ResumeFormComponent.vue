<template>
  <form name="resume-new" :action="form_action_url" method="POST">
    <input name="_token" type="hidden" :value="$CSRF_TOKEN" />

    <div class="row">
      <div class="col-sm">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-sm">
                  <h5 class="font-weight-bold d-inline my-0 mr-2" style="border-bottom: 1px dashed;">My Resume</h5>
                  <i class="fa-pencil"></i>
              </div>

              <div class="col-sm-4">
                <div class="progress" style="height: 10px;">
                  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="col-sm">
                <div class="buttons text-right">
                  <button type="button" class="btn btn-secondary shadow-sm" data-toggle="button" aria-pressed="false" autocomplete="off">Preview</button>
                  <button type="button" class="btn btn-primary shadow-sm" data-toggle="button" aria-pressed="false" autocomplete="off">Download</button>
                </div>
              </div>
            </div>

            <resume-navigation-tabs-component></resume-navigation-tabs-component>

            <div class="py-4">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="nav-contact-info" role="tabpanel" aria-labelledby="nav-contact-info">
                  <div class="row align-items-center mb-3">
                    <div class="col-sm text-muted">
                        <h6 class="font-weight-bold d-inline mr-2" style="border-bottom: 1px dashed;">Contact Info</h6>
                        <i class="fa-pencil"></i>
                    </div>
                  </div>

                  <form-contact-information-component></form-contact-information-component>

                  <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="col-form-label font-weight-bold">Register now?</label>

                      <p class="text-muted card-text">Registered users enjoys the lifetime access to their resume.</p>
                    </div>

                    <div class="col-sm-8">
                      <span class="custom-control custom-radio d-inline mr-3">
                        <input id="yes" name="registration" class="custom-control-input" checked="" required="" type="radio">
                        <label class="custom-control-label" for="yes">Yes</label>
                      </span>

                      <span class="custom-control custom-radio d-inline">
                        <input id="no" name="registration" class="custom-control-input" required="" type="radio">
                        <label class="custom-control-label" for="no">No</label>
                      </span>
                    </div>
                  </div>

                  <form-user-registration-component></form-user-registration-component>
                </div>

                <div class="tab-pane fade" id="nav-work-experience" role="tabpanel" aria-labelledby="nav-work-experience">...</div>
              </div>
            </div>

            <div class="text-right">
              <button type="button" class="btn btn-outline-secondary shadow-sm" data-toggle="button" aria-pressed="false" autocomplete="off">Continue <i class="fa-angle-right ml-1"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import FormContactInformationComponent from "./ResumeForms/ContactInformationComponent.vue";
import FormUserRegistrationComponent from "./ResumeForms/UserRegistrationComponent.vue";
import ResumeNavigationTabsComponent from "./ResumeNavigationTabsComponent.vue";

export default {
  components: {
    FormContactInformationComponent,
    FormUserRegistrationComponent,
    ResumeNavigationTabsComponent
  },

  mounted() {
    //
  },

  props: {
    form_action_url: String
  }
};
</script>
