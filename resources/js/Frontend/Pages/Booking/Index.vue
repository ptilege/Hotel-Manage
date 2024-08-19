<template>
  <app-layout>
          <div class="container">
    
      <div class="row my-5">
        
        <div class="col-lg-11 mx-auto">
        <!-- Steps Progress bar
        ============================================= -->
        <div class="row widget-steps">
                <div class="col-3 step active">
                  <div class="step-name">Order</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-3 step disabled"><!-- complete -->
                  <div class="step-name">Summary</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-3 step disabled"><!-- complete -->
                  <div class="step-name">Payment</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
                
                <div class="col-3 step disabled"><!-- active -->
                  <div class="step-name">Done</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="step-dot"></a>
                </div>
            </div>
        </div>
        <!-- Steps Progress bar end -->
        <div class="col-md-10 col-lg-8 mx-auto mt-5">
        <p class="text-4">Enter the receiver mobile number</p>
        <form id="mobileTopup" method="post">
                <div class="row no-gutters search-input-2 mb-4">
                  <div class="col-lg-9 col-xl-10 form-group">
                    <input type="text" class="form-control shadow form-control-lg" id="mobilenumber" required="" placeholder="Enter Mobile Number">
                  </div>
                  <div class="col-lg-3 col-xl-2 form-group">
                    <button class="btn btn-primary shadow btn-block btn-lg" type="submit"><i class="fas fa-arrow-right"></i></button>
                  </div>
                </div>
                </form>
        <div class="accordion accordion-alternate" id="accordionDefault">
              
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h5 class="mb-0"> <a href="#" class="collapsed text-4" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Operator Detected (Vodafone)</a> </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionDefault">
                  <div class="card-body pt-4">
                  	<div class="row operator-selection">
              <div class="col-4 col-sm-3 col-lg-2 mb-4">
              	<div class="custom-radio">
                  <input id="operator1" name="operatorSelection" class="custom-control-input" required="" type="radio">
                  <label class="custom-control-label" for="operator1"><img class="img-fluid rounded-circle border" src="images/brands/operator/operator-1.png" alt="operator 1"></label>
                </div>
              </div>
              <div class="col-4 col-sm-3 col-lg-2 mb-4">
              	<div class="custom-radio">
                  <input id="operator2" name="operatorSelection" class="custom-control-input" required="" type="radio">
                  <label class="custom-control-label" for="operator2"><img class="img-fluid rounded-circle border" src="images/brands/operator/operator-2.png" alt="operator 2"></label>
                </div>
              </div>
              
              <div class="col-4 col-sm-3 col-lg-2 mb-4">
              	<div class="custom-radio">
                  <input id="operator3" name="operatorSelection" class="custom-control-input" required="" type="radio">
                  <label class="custom-control-label" for="operator3"><img class="img-fluid rounded-circle border" src="images/brands/operator/operator-3.png" alt="operator 3"></label>
                </div>
              </div>
              
              <div class="col-4 col-sm-3 col-lg-2 mb-4">
              	<div class="custom-radio">
                  <input id="operator4" name="operatorSelection" class="custom-control-input" required="" type="radio">
                  <label class="custom-control-label" for="operator4"><img class="img-fluid rounded-circle border" src="images/brands/operator/operator-4.png" alt="operator 4"></label>
                </div>
              </div>
              
              <div class="col-4 col-sm-3 col-lg-2 mb-4">
              	<div class="custom-radio">
                  <input id="operator5" name="operatorSelection" class="custom-control-input" required="" type="radio">
                  <label class="custom-control-label" for="operator5"><img class="img-fluid rounded-circle border" src="images/brands/operator/operator-5.png" alt="operator 5"></label>
                </div>
              </div>
              
              <div class="col-4 col-sm-3 col-lg-2 mb-4">
              	<div class="custom-radio">
                  <input id="operator6" name="operatorSelection" class="custom-control-input" checked="" required="" type="radio">
                  <label class="custom-control-label" for="operator6"><img class="img-fluid rounded-circle border" src="images/brands/operator/operator-6.png" alt="operator 6"></label>
                </div>
              </div>
              
              <div class="col-4 col-sm-3 col-lg-2 mb-4">
              	<div class="custom-radio">
                  <input id="operator7" name="operatorSelection" class="custom-control-input" required="" type="radio">
                  <label class="custom-control-label" for="operator7"><img class="img-fluid rounded-circle border" src="images/brands/operator/operator-7.png" alt="operator 7"></label>
                </div>
              </div>
              
            </div>
                  </div>
                </div>
              </div>
              
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0"> <a href="#" class="collapsed text-4" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Select Top-up (5.10 USD)</a> </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionDefault">
                  <div class="card-body pt-4">
                  	<div class="row">
                      <div class="col-sm-6 col-md-4 mb-4">
                      <div class="bg-white border rounded text-center p-3">
                        <h5 class="card-title text-5 font-weight-500 mb-4 mt-2">3.98 USD</h5>
                        <hr class="mx-n3">
                      <p class="mb-0 text-3">199.00 INR</p>
                      <p class="mb-3 text-black-50">Mobile Top Up</p>
                      <button class="btn btn-sm btn-block btn-outline-primary shadow-none stretched-link" type="submit">Choose</button>
                      </div>
                          </div>
                      <div class="col-sm-6 col-md-4 mb-4">
                      <div class="bg-white border rounded text-center p-3">
                        <h5 class="card-title text-5 font-weight-500 mb-4 mt-2">4.90 USD</h5>
                        <hr class="mx-n3">
                      <p class="mb-0 text-3">245.00 INR</p>
                      <p class="mb-3 text-black-50">Mobile Top Up</p>
                      <button class="btn btn-sm btn-block btn-outline-primary shadow-none stretched-link" type="submit">Choose</button>
                      </div>
                          </div>
                      <div class="col-sm-6 col-md-4 mb-4">
                      <div class="bg-white border rounded text-center border-success p-3">
                        <h5 class="card-title text-5 font-weight-500 mb-4 mt-2">5.10 USD</h5>
                        <hr class="mx-n3">
                      <p class="mb-0 text-3">255.00 INR</p>
                      <p class="mb-3 text-black-50">Mobile Top Up</p>
                      <button class="btn btn-sm btn-block btn-outline-primary shadow-none stretched-link" type="submit">Choose</button>
                      </div>
                          </div>
                      <div class="col-sm-6 col-md-4 mb-4">
                      <div class="bg-white border rounded text-center p-3">
                        <h5 class="card-title text-5 font-weight-500 mb-4 mt-2">6.98 USD</h5>
                        <hr class="mx-n3">
                      <p class="mb-0 text-3">349.00 INR</p>
                      <p class="mb-3 text-black-50">Mobile Top Up</p>
                      <button class="btn btn-sm btn-block btn-outline-primary shadow-none stretched-link" type="submit">Choose</button>
                      </div>
                          </div>
                      <div class="col-sm-6 col-md-4 mb-4">
                      <div class="bg-white border rounded text-center p-3">
                        <h5 class="card-title text-5 font-weight-500 mb-4 mt-2">10.22 USD</h5>
                        <hr class="mx-n3">
                      <p class="mb-0 text-3">511.00 INR</p>
                      <p class="mb-3 text-black-50">Mobile Top Up</p>
                      <button class="btn btn-sm btn-block btn-outline-primary shadow-none stretched-link" type="submit">Choose</button>
                      </div>
                          </div>
                      <div class="col-sm-6 col-md-4 mb-4">
                      <div class="bg-white border rounded text-center p-3">
                        <h5 class="card-title text-5 font-weight-500 mb-4 mt-2">20.00 USD</h5>
                        <hr class="mx-n3">
                      <p class="mb-0 text-3">1000.00 INR</p>
                      <p class="mb-3 text-black-50">Mobile Top Up</p>
                      <button class="btn btn-sm btn-block btn-outline-primary shadow-none stretched-link" type="submit">Choose</button>
                      </div>
                          </div>
                    </div>
                    <div class="text-center"><a href="#" class="btn-link text-3">See more Top Up<i class="fas fa-chevron-right text-2 ml-2"></i></a></div>
                  </div>
                </div>
              </div>
              
            </div>
        
          <p class="text-center mt-4 mb-0"><a href="recharge-order-summary.html" class="btn btn-primary">Proceesd to checkout</a></p>
		  
      </div>
    </div>
          </div>
  </app-layout>
</template>

<script>
export default {

}
</script>

<style>

</style>