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

            <ul class="nav nav-tabs mt-4" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" href="#" data-toggle="tab" role="tab" aria-selected="true">Contact Info</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Work Experience</a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Education</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="tab" role="tab" aria-selected="false">Additional Skills</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-plus mr-1"></i> Extra Information</a>
              </li>
            </ul>

            <div class="py-4">
              <div class="row align-items-center mb-3">
                <div class="col-sm text-muted">
                    <h6 class="font-weight-bold d-inline mr-2" style="border-bottom: 1px dashed;">Contact Info</h6>
                    <i class="fa-pencil"></i>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticFirstName" class="col-form-label font-weight-bold">First name</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticFirstName" placeholder="John">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticLastName" class="col-form-label font-weight-bold">Last name</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticLastName" placeholder="Smith">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticCountry" class="col-form-label font-weight-bold">Country</label>
                </div>

                <div class="col-sm-8">
                  <select class="custom-select d-block w-100" id="staticCountry" required="">
                    <option value="">Choose...</option>
                    <option>India</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticPostCode" class="col-form-label font-weight-bold">Post code</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticPostCode" placeholder="244713">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticCity" class="col-form-label font-weight-bold">City/Town</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticCity" placeholder="Kashipur">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticCounty" class="col-form-label font-weight-bold">County</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticCounty" placeholder="County">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticAddress1" class="col-form-label font-weight-bold">Address Line 1</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticAddress1" placeholder="Address Line 1">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticAddress2" class="col-form-label font-weight-bold">Address Line 2</label>

                  <p class="text-muted card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticAddress2" placeholder="Address Line 2">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticPhone" class="col-form-label font-weight-bold">Phone number</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticPhone" placeholder="+353 20 911 2769">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticEmail" class="col-form-label font-weight-bold">Email address</label>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticEmail" placeholder="email@example.com">
                </div>
              </div>

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

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticEmail2" class="col-form-label font-weight-bold">Email address</label>

                  <p class="text-muted card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="staticEmail2" placeholder="email@example.com">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-4">
                  <label for="staticPassword" class="col-form-label font-weight-bold">Password</label>
                </div>

                <div class="col-sm-8">
                  <input type="password" class="form-control" id="staticPassword" placeholder="Password">
                </div>
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
export default {
  mounted() {
    //
  },

  props: {
    form_action_url: String
  }
};
</script>
