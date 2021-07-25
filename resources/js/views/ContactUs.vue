<template>
  <div>
    <div class="bg-light p-4">
      <h1>Contact US</h1>
      <div class="row">
        <div class="col-lg-12">
          <form class="well span8">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label"
                    >First Name</label
                  >
                  <div class="inner-addon left-addon">
                    <i class="bi bi-person"></i>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Please enter your firstname *"
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label"
                    >Last Name</label
                  >
                  <div class="inner-addon left-addon">
                    <i class="bi bi-person"></i>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Please enter your lastname *"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label"
                    >Email</label
                  >
                  <div class="inner-addon left-addon">
                    <i class="bi bi-envelope"></i>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Please enter your email *"
                    />
                  </div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label"
                    >Phone</label
                  >
                  <div class="inner-addon left-addon">
                    <i class="bi bi-telephone"></i>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Please enter your phone *"
                    />
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label"
                    >Message</label
                  >
                  <div class="inner-addon left-addon">
                    <i class="bi bi-card-text"></i>
                    <textarea style="height: 120px;"
                      type="text"
                      class="form-control"
                      rows="4"
                      placeholder="Message for me *"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group mt-1">
              <button type="submit" class="btn btn-primary"><i class="bi bi-cursor"></i> Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>