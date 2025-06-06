<x-app-layout>
    @section('title')
        Dashboard
    @endsection

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.35.3/dist/apexcharts.min.css">
        
    @endpush

    <!-- Breadcrumb -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100 bg-primary-subtle overflow-hidden shadow-none">
            <div class="card-body position-relative">
                <div class="row">
              <div class="col-sm-7">
                <div class="d-flex align-items-center mb-7">
                  <div class="rounded-circle overflow-hidden me-6">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('storage/uploads/user_avatars/' . Auth::user()->avatar) }}" alt="modernize-img" width="40" height="40">
                    @else
                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="modernize-img" width="40" height="40">
                    @endif
                  </div>
                  <h5 class="fw-semibold mb-0 fs-5">Welcome,  {{ Auth::user()->name }}!</h5>
                </div>
                <div class="d-flex align-items-center">
                  <div class="border-end pe-4 border-muted border-opacity-10">
                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">0<i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                    </h3>
                    <p class="mb-0 text-dark">Today's Requisition Slip</p>
                  </div>
                  <div class="ps-4">
                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">0<i class="ti ti-arrow-up-right fs-5 lh-base text-success"></i>
                    </h3>
                    <p class="mb-0 text-dark">Overall Requisition Slip</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="welcome-bg-img mb-n7 text-end">
                  <img src="{{ asset('assets/images/backgrounds/welcome-bg.svg') }}" alt="modernize-img" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h4 class="fw-semibold">Pre MPDR</h4>
            <p class="mb-2 fs-3">Pending Requests</p>
            <div id="expense"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body p-4">
            <h4 class="fw-semibold">MPDR</h4>
            <p class="mb-1 fs-3">Approved Requests</p>
            <div id="sales" class="sales-chart mx-n2"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <h4 class="card-title fw-semibold">Requisition Slip Updates</h4>
            <p class="card-subtitle mb-4">Overview of Requests</p>
            <div class="d-flex align-items-center">
              <div class="me-4">
                <span class="round-8 text-bg-primary rounded-circle me-2 d-inline-block"></span>
                <span class="fs-2">Pending</span>
              </div>
              <div>
                <span class="round-8 text-bg-secondary rounded-circle me-2 d-inline-block"></span>
                <span class="fs-2">Approved</span>
              </div>
            </div>
            <div id="revenue-chart" class="revenue-chart mx-n3"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <h4 class="card-title fw-semibold">Pre MPDR Overview</h4>
            <p class="card-subtitle mb-2">Monthly Requests</p>
            <div id="sales-overview" class="mb-4"></div>
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="bg-primary-subtle text-primary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots fs-6"></i>
                </div>
                <div>
                  <h6 class="fw-semibold text-dark fs-4 mb-0">Pending</h6>
                  <p class="fs-3 mb-0 fw-normal">Requests</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="bg-secondary-subtle text-secondary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                  <i class="ti ti-grid-dots fs-6"></i>
                </div>
                <div>
                  <h6 class="fw-semibold text-dark fs-4 mb-0">Approved</h6>
                  <p class="fs-3 mb-0 fw-normal">Requests</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="row">
          <div class="col-sm-6 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body">
                <div class="p-2 bg-primary-subtle rounded-2 d-inline-block mb-3">
                  <img src="../assets/images/svgs/icon-cart.svg" alt="modernize-img" class="img-fluid" width="24" height="24">
                </div>
                <div id="sales-two" class="mb-3 mx-n4"></div>
                <h4 class="mb-1 fw-semibold d-flex align-content-center">Pending<i class="ti ti-arrow-up-right fs-5 text-success"></i>
                </h4>
                <p class="mb-0">Requisitions</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body">
                <div class="p-2 bg-info-subtle rounded-2 d-inline-block mb-3">
                  <img src="../assets/images/svgs/icon-bar.svg" alt="modernize-img" class="img-fluid" width="24" height="24">
                </div>
                <div id="growth" class="mb-3"></div>
                <h4 class="mb-1 fw-semibold d-flex align-content-center">Approved<i class="ti ti-arrow-up-right fs-5 text-success"></i>
                </h4>
                <p class="mb-0">Requisitions</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row align-items-start">
              <div class="col-8">
                <h4 class="card-title mb-9 fw-semibold"> Monthly Requisitions </h4>
                <div class="d-flex align-items-center mb-3">
                  <h4 class="fw-semibold mb-0 me-8">Pending</h4>
                  <div class="d-flex align-items-center">
                    <span class="me-2 rounded-circle bg-success-subtle text-success round-20 d-flex align-items-center justify-content-center">
                      <i class="ti ti-arrow-up-left"></i>
                    </span>
                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="d-flex justify-content-end">
                  <div class="p-2 bg-primary-subtle rounded-2 d-inline-block">
                    <img src="../assets/images/svgs/icon-master-card-2.svg" alt="modernize-img" class="img-fluid" width="24" height="24">
                  </div>
                </div>
              </div>
            </div>
            <div id="monthly-earning"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <h4 class="card-title fw-semibold">Weekly Requisition Stats</h4>
            <p class="card-subtitle mb-0">Average Requests</p>
            <div id="weekly-stats" class="mb-4 mt-7"></div>
            <div class="position-relative">
              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex">
                  <div class="p-6 bg-primary-subtle text-primary rounded-2 me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots fs-6"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">Top Requests</h6>
                    <p class="fs-3 mb-0">Johnathan Doe</p>
                  </div>
                </div>
                <div class="bg-primary-subtle text-primary badge">
                  <p class="fs-3 fw-semibold mb-0">+68</p>
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex">
                  <div class="p-6 bg-success-subtle text-success rounded-2 me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots fs-6"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">Best Request</h6>
                    <p class="fs-3 mb-0">Footware</p>
                  </div>
                </div>
                <div class="bg-success-subtle text-success badge">
                  <p class="fs-3 fw-semibold mb-0">+68</p>
                </div>
              </div>
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex">
                  <div class="p-6 bg-danger-subtle text-danger rounded-2 me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots fs-6"></i>
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">Most Commented</h6>
                    <p class="fs-3 mb-0">Fashionware</p>
                  </div>
                </div>
                <div class="bg-danger-subtle text-danger badge">
                  <p class="fs-3 fw-semibold mb-0">+68</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <div>
              <h4 class="card-title fw-semibold">Yearly Requisitions</h4>
              <p class="card-subtitle">Every month</p>
              <div id="salary" class="mb-7 pb-8 mx-n4"></div>
              <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                  <div class="bg-primary-subtle text-primary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots fs-6"></i>
                  </div>
                  <div>
                    <p class="fs-3 mb-0 fw-normal">Total Requests</p>
                    <h6 class="fw-semibold text-dark fs-4 mb-0">$36,358</h6>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <div class="bg-light-subtle text-muted rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                    <i class="ti ti-grid-dots fs-6"></i>
                  </div>
                  <div>
                    <p class="fs-3 mb-0 fw-normal">Expenses</p>
                    <h6 class="fw-semibold text-dark fs-4 mb-0">$5,296</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <h4 class="card-title fw-semibold">MPDR Approval Tracking</h4>
            <p class="card-subtitle mb-7">Track MPDR Approvals</p>
            <div class="position-relative">
              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex">
                  <div class="p-8 bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                    <img src="../assets/images/svgs/icon-paypal2.svg" alt="modernize-img" class="img-fluid" width="24" height="24">
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">PayPal</h6>
                    <p class="fs-3 mb-0">Big Brands</p>
                  </div>
                </div>
                <h6 class="mb-0 fw-semibold">+$6,235</h6>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex">
                  <div class="p-8 bg-success-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                    <img src="../assets/images/svgs/icon-wallet.svg" alt="modernize-img" class="img-fluid" width="24" height="24">
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">Wallet</h6>
                    <p class="fs-3 mb-0">Bill payment</p>
                  </div>
                </div>
                <h6 class="mb-0 fw-semibold text-muted">+$345</h6>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex">
                  <div class="p-8 bg-warning-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                    <img src="../assets/images/svgs/icon-credit-card.svg" alt="modernize-img" class="img-fluid" width="24" height="24">
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">Credit card</h6>
                    <p class="fs-3 mb-0">Money reversed</p>
                  </div>
                </div>
                <h6 class="mb-0 fw-semibold">+$2,235</h6>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-7 pb-1">
                <div class="d-flex">
                  <div class="p-8 bg-danger-subtle rounded-2 d-flex align-items-center justify-content-center me-6">
                    <img src="../assets/images/svgs/icon-pie2.svg" alt="modernize-img" class="img-fluid" width="24" height="24">
                  </div>
                  <div>
                    <h6 class="mb-1 fs-4 fw-semibold">Refund</h6>
                    <p class="fs-3 mb-0">Bill payment</p>
                  </div>
                </div>
                <h6 class="mb-0 fw-semibold text-muted">-$32</h6>
              </div>
            </div>
            <button class="btn btn-outline-primary w-100">View all transactions</button>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <div class="mb-4">
              <h4 class="card-title fw-semibold">Recent MPDR Transactions</h4>
              <p class="card-subtitle">Track Recent MPDR Approvals</p>
            </div>
            <ul class="timeline-widget mb-0 position-relative mb-n5">
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2  border-primary flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1">MPDR Created</div>
              </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">MPDR Approved By BOD</div>
              </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1">MPDR Approved By BOD</div>
              </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">MPDR Approved By BOD</div>
              </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">MPDR Approved By BOD</div>
              </li>
              <li class="timeline-item d-flex position-relative overflow-hidden">
                <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                  <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                  <span class="timeline-badge-border d-block flex-shrink-0"></span>
                </div>
                <div class="timeline-desc fs-3 text-dark mt-n1">MPDR Approved By BOD</div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
          <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
              <div class="mb-3 mb-sm-0">
                <h4 class="card-title fw-semibold">MPDR Product Performances</h4>
                <p class="card-subtitle">Current MPDR Projects</p>
              </div>
              <div>
                <select class="form-select fw-semibold">
                  <option value="1">March 2024</option>
                  <option value="2">April 2024</option>
                  <option value="3">May 2024</option>
                  <option value="4">June 2024</option>
                </select>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-middle text-nowrap mb-0">
                <thead>
                  <tr class="text-muted fw-semibold">
                    <th scope="col" class="ps-0">Assigned</th>
                    <th scope="col">Progress</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Budget</th>
                    <th scope="col">Chart</th>
                  </tr>
                </thead>
                <tbody class="border-top">
                  <tr>
                    <td class="ps-0">
                      <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                          <img src="../assets/images/products/product-1.jpg" class="rounded-2" width="48" height="48" alt="modernize-img">
                        </div>
                        <div>
                          <h6 class="fw-semibold mb-1">MPDR App</h6>
                          <p class="fs-2 mb-0 text-muted">Jason Roy</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="mb-0 fs-3 text-dark">73.2%</p>
                    </td>
                    <td>
                      <span class="badge fw-semibold py-1 w-85 bg-success-subtle text-success">Low</span>
                    </td>
                    <td>
                      <p class="fs-3 text-dark mb-0">$3.5k</p>
                    </td>
                    <td>
                      <div id="table-chart"></div>
                    </td>
                  </tr>
                  <tr>
                    <td class="ps-0">
                      <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                          <img src="../assets/images/products/product-2.jpg" class="rounded-2" width="48" height="48" alt="modernize-img">
                        </div>
                        <div>
                          <h6 class="fw-semibold mb-1">Pre MPDR Project</h6>
                          <p class="fs-2 mb-0 text-muted">Mathew Flintoff</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="mb-0 fs-3 text-dark">56.8%</p>
                    </td>
                    <td>
                      <span class="badge fw-semibold py-1 w-85 bg-warning-subtle text-warning">Medium</span>
                    </td>
                    <td>
                      <p class="fs-3 text-dark mb-0">$3.5k</p>
                    </td>
                    <td>
                      <div id="table-chart-1"></div>
                    </td>
                  </tr>
                  <tr>
                    <td class="ps-0">
                      <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                          <img src="../assets/images/products/product-3.jpg" class="rounded-2" width="48" height="48" alt="modernize-img">
                        </div>
                        <div>
                          <h6 class="fw-semibold mb-1">MPDR Dashboard</h6>
                          <p class="fs-2 mb-0 text-muted">Anil Kumar</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="mb-0 fs-3 text-dark">25%</p>
                    </td>
                    <td>
                      <span class="badge fw-semibold py-1 w-85 bg-info-subtle text-info">Very high</span>
                    </td>
                    <td>
                      <p class="fs-3 text-dark mb-0">$3.5k</p>
                    </td>
                    <td>
                      <div id="table-chart-2"></div>
                    </td>
                  </tr>
                  <tr>
                    <td class="ps-0 border-bottom-0">
                      <div class="d-flex align-items-center">
                        <div class="me-2 pe-1">
                          <img src="../assets/images/products/product-4.jpg" class="rounded-2" width="48" height="48" alt="modernize-img">
                        </div>
                        <div>
                          <h6 class="fw-semibold mb-1">Dashboard Co</h6>
                          <p class="fs-2 mb-0 text-muted">George Cruize</p>
                        </div>
                      </div>
                    </td>
                    <td class="border-bottom-0">
                      <p class="mb-0 fs-3 text-dark">96.3%</p>
                    </td>
                    <td class="border-bottom-0">
                      <span class="badge fw-semibold py-1 w-85 bg-danger-subtle text-danger">High</span>
                    </td>
                    <td class="border-bottom-0">
                      <p class="fs-3 text-dark mb-0">$3.5k</p>
                    </td>
                    <td class="border-bottom-0">
                      <div id="table-chart-3"></div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    @push('scripts')

    @endpush

</x-app-layout>
