<div class="main-panel">
          <div class="content-wrapper">

            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_product}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{ route('show_product') }}" class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Products</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_order}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <a href="{{ route('show_order') }}" class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </a>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Orders</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_user}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Users</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_delivered}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <a href="http://127.0.0.1:8000/search_order?_token=Qm7v6CUqsuL0kNsClbfRDSmLNywcUtblR1Z5OCt8&search=Delivered" class="mdi mdi-arrow-top-right icon-item"></a>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Order Delivered</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_outofdelivery}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <a href="http://127.0.0.1:8000/search_order?_token=Qm7v6CUqsuL0kNsClbfRDSmLNywcUtblR1Z5OCt8&search=Out+of+delivery" class="mdi mdi-arrow-top-right icon-item"></a>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Order Out of Delivery</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_processing}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <a href="http://127.0.0.1:8000/search_order?_token=Qm7v6CUqsuL0kNsClbfRDSmLNywcUtblR1Z5OCt8&search=Processing" class="mdi mdi-arrow-top-right icon-item"></a>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Order Processing</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_returned}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <a href="http://127.0.0.1:8000/search_order?_token=Qm7v6CUqsuL0kNsClbfRDSmLNywcUtblR1Z5OCt8&search=Returned" class="mdi mdi-arrow-top-right icon-item"></a>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Order Returned</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{$total_cancelled}}</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <a href="http://127.0.0.1:8000/search_order?_token=Qm7v6CUqsuL0kNsClbfRDSmLNywcUtblR1Z5OCt8&search=Cancelled" class="mdi mdi-arrow-top-right icon-item"></a>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Order Cancelled</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">{{number_format($total_revenue,2)}} ฿</h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Revenue</h6>
                  </div>
                </div>
              </div>
            </div>
            
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Devpooz 2023</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
</div>