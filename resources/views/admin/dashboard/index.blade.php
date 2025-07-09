@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')
@section('page-title', 'Dashboard Overview')

@section('css')

@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="row g-4 mb-4 mt-3">
        <div class="col-md-6 col-lg-3 animate__animated animate__fadeInUp">
          <div class="card card-glass card-stat h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="text-uppercase text-muted mb-2">Total Sales</h6>
                  <h3 class="mb-0 fw-bold swippy-highlight">$24,66</h3>
                  <span class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> 12.5%</span>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded">
                  <i class="bi bi-currency-dollar fs-4 swippy-highlight"></i>
                </div>
              </div>
              <div class="mt-3">
                <div class="progress">
                  <div class="progress-bar" style="width: 75%"></div>
                </div>
                <small class="text-muted">vs last month</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 animate__animated animate__fadeInUp animate__fast">
          <div class="card card-glass card-stat h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="text-uppercase text-muted mb-2">Total Orders</h6>
                  <h3 class="mb-0 fw-bold swippy-highlight">1,426</h3>
                  <span class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> 8.3%</span>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded">
                  <i class="bi bi-cart-check fs-4 swippy-highlight"></i>
                </div>
              </div>
              <div class="mt-3">
                <div class="progress">
                  <div class="progress-bar" style="width: 65%"></div>
                </div>
                <small class="text-muted">vs last month</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 animate__animated animate__fadeInUp animate__faster">
          <div class="card card-glass card-stat h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="text-uppercase text-muted mb-2">Products</h6>
                  <h3 class="mb-0 fw-bold swippy-highlight">289</h3>
                  <span class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> 5.2%</span>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded">
                  <i class="bi bi-box-seam fs-4 swippy-highlight"></i>
                </div>
              </div>
              <div class="mt-3">
                <div class="progress">
                  <div class="progress-bar" style="width: 45%"></div>
                </div>
                <small class="text-muted">vs last month</small>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 animate__animated animate__fadeInUp animate__fast">
          <div class="card card-glass card-stat h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="text-uppercase text-muted mb-2">Customers</h6>
                  <h3 class="mb-0 fw-bold swippy-highlight">3,892</h3>
                  <span class="text-success small fw-bold"><i class="bi bi-arrow-up"></i> 15.7%</span>
                </div>
                <div class="bg-primary bg-opacity-10 p-3 rounded">
                  <i class="bi bi-people fs-4 swippy-highlight"></i>
                </div>
              </div>
              <div class="mt-3">
                <div class="progress">
                  <div class="progress-bar" style="width: 85%"></div>
                </div>
                <small class="text-muted">vs last month</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Charts Row -->
      <div class="row g-4 mb-4">
        <div class="col-lg-8 animate__animated animate__fadeInLeft">
          <div class="card card-glass h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Sales Analytics</h5>
                <div class="btn-group">
                  <button class="btn btn-sm btn-outline-secondary active">Daily</button>
                  <button class="btn btn-sm btn-outline-secondary">Weekly</button>
                  <button class="btn btn-sm btn-outline-secondary">Monthly</button>
                </div>
              </div>
              <div class="chart-container">
                <canvas id="salesChart"></canvas>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 animate__animated animate__fadeInRight">
          <div class="card card-glass h-100">
            <div class="card-body">
              <h5 class="card-title mb-3">Revenue Sources</h5>
              <div class="chart-container">
                <canvas id="revenueChart"></canvas>
              </div>
              <div class="mt-3">
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-primary rounded me-2" style="width: 15px; height: 15px;"></div>
                  <span class="small">Electronics</span>
                  <span class="ms-auto fw-bold">42%</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-success rounded me-2" style="width: 15px; height: 15px;"></div>
                  <span class="small">Fashion</span>
                  <span class="ms-auto fw-bold">28%</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                  <div class="bg-warning rounded me-2" style="width: 15px; height: 15px;"></div>
                  <span class="small">Home & Garden</span>
                  <span class="ms-auto fw-bold">18%</span>
                </div>
                <div class="d-flex align-items-center">
                  <div class="bg-danger rounded me-2" style="width: 15px; height: 15px;"></div>
                  <span class="small">Others</span>
                  <span class="ms-auto fw-bold">12%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Orders & Top Products -->
      <div class="row g-4">
        <div class="col-lg-8 animate__animated animate__fadeInUp">
          <div class="card card-glass">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0"><i class="bi bi-clock-history me-2"></i>Recent Orders</h5>
                <a href="#" class="btn btn-sm btn-swippy-outline">View All</a>
              </div>
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Order ID</th>
                      <th>Customer</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="fw-bold">#ORD-7894</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" class="rounded-circle me-2" width="30" height="30">
                          <span>Ali Raza</span>
                        </div>
                      </td>
                      <td>12 May 2023</td>
                      <td class="fw-bold">$249.99</td>
                      <td><span class="badge bg-success">Completed</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td class="fw-bold">#ORD-7893</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="https://ui-avatars.com/api/?name=Sara+Khan&background=random" class="rounded-circle me-2" width="30" height="30">
                          <span>Sara Khan</span>
                        </div>
                      </td>
                      <td>11 May 2023</td>
                      <td class="fw-bold">$149.50</td>
                      <td><span class="badge bg-warning text-dark">Processing</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td class="fw-bold">#ORD-7892</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="https://ui-avatars.com/api/?name=Umar+Sheikh&background=random" class="rounded-circle me-2" width="30" height="30">
                          <span>Umar Sheikh</span>
                        </div>
                      </td>
                      <td>10 May 2023</td>
                      <td class="fw-bold">$89.99</td>
                      <td><span class="badge bg-primary">Shipped</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td class="fw-bold">#ORD-7891</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="https://ui-avatars.com/api/?name=Fatima+Ahmed&background=random" class="rounded-circle me-2" width="30" height="30">
                          <span>Fatima Ahmed</span>
                        </div>
                      </td>
                      <td>9 May 2023</td>
                      <td class="fw-bold">$199.99</td>
                      <td><span class="badge bg-danger">Cancelled</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td class="fw-bold">#ORD-7890</td>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="https://ui-avatars.com/api/?name=Hassan+Malik&background=random" class="rounded-circle me-2" width="30" height="30">
                          <span>Hassan Malik</span>
                        </div>
                      </td>
                      <td>8 May 2023</td>
                      <td class="fw-bold">$349.99</td>
                      <td><span class="badge bg-success">Completed</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 animate__animated animate__fadeInUp animate__fast">
          <div class="card card-glass h-100">
            <div class="card-body">
              <h5 class="card-title mb-3"><i class="bi bi-trophy me-2"></i>Top Products</h5>

              <div class="d-flex align-items-center mb-3">
                <div class="flex-shrink-0">
                  <img src="https://via.placeholder.com/60" class="rounded" width="60" height="60" alt="Product">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Wireless Headphones</h6>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Electronics</span>
                    <span class="fw-bold swippy-highlight">$129.99</span>
                  </div>
                  <div class="progress mt-1" style="height: 5px;">
                    <div class="progress-bar bg-primary" style="width: 85%"></div>
                  </div>
                  <div class="d-flex justify-content-between small mt-1">
                    <span>154 sold</span>
                    <span>85%</span>
                  </div>
                </div>
              </div>

              <div class="d-flex align-items-center mb-3">
                <div class="flex-shrink-0">
                  <img src="https://via.placeholder.com/60" class="rounded" width="60" height="60" alt="Product">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Smart Watch</h6>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Electronics</span>
                    <span class="fw-bold swippy-highlight">$199.99</span>
                  </div>
                  <div class="progress mt-1" style="height: 5px;">
                    <div class="progress-bar bg-success" style="width: 72%"></div>
                  </div>
                  <div class="d-flex justify-content-between small mt-1">
                    <span>128 sold</span>
                    <span>72%</span>
                  </div>
                </div>
              </div>

              <div class="d-flex align-items-center mb-3">
                <div class="flex-shrink-0">
                  <img src="https://via.placeholder.com/60" class="rounded" width="60" height="60" alt="Product">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Running Shoes</h6>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Fashion</span>
                    <span class="fw-bold swippy-highlight">$89.99</span>
                  </div>
                  <div class="progress mt-1" style="height: 5px;">
                    <div class="progress-bar bg-warning" style="width: 65%"></div>
                  </div>
                  <div class="d-flex justify-content-between small mt-1">
                    <span>98 sold</span>
                    <span>65%</span>
                  </div>
                </div>
              </div>

              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <img src="https://via.placeholder.com/60" class="rounded" width="60" height="60" alt="Product">
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1">Bluetooth Speaker</h6>
                  <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Electronics</span>
                    <span class="fw-bold swippy-highlight">$59.99</span>
                  </div>
                  <div class="progress mt-1" style="height: 5px;">
                    <div class="progress-bar bg-danger" style="width: 58%"></div>
                  </div>
                  <div class="d-flex justify-content-between small mt-1">
                    <span>76 sold</span>
                    <span>58%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('js')
<script>
    console.log("how are you")
</script>
@endsection
