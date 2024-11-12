<?= $this->include('admin/common/header') ?>
<?= $this->include('admin/common/menu') ?>
<div class="content-body">
   <!-- row -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-9 col-xxl-12">
            <div class="row">
               <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                  <div class="card overflow-hidden">
                     <div class="card-body pb-0 px-4 pt-4">
                        <div class="row">
                           <div class="col">
                              <h5 class="mb-1"><?php echo $total_user; ?> </h5>
                              <span class="text-success">Total Blog</span>
                           </div>
                        </div>
                     </div>
                     <div class="chart-wrapper">
                        <canvas id="areaChart_2" class="chartjs-render-monitor  style-1" height="90"></canvas>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                  <div class="card bg-success	overflow-hidden">
                     <div class="card-body pb-0 px-4 pt-4">
                        <div class="row">
                           <div class="col">
                              <h5 class="text-white mb-1">0</h5>
                              <span class="text-white">Total </span>
                           </div>
                        </div>
                     </div>
                     <div class="chart-wrapper" style="width:100%">
                        <span class="peity-line" data-width="100%">6,2,8,4,3,8,4,3,6,5,9,2</span>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                  <div class="card bg-primary overflow-hidden">
                     <div class="card-body pb-0 px-4 pt-4">
                        <div class="row">
                           <div class="col text-white">
                              <h5 class="text-white mb-1">0</h5>
                              <span>Total </span>
                           </div>
                        </div>
                     </div>
                     <div class="chart-wrapper px-2">
                        <canvas id="chart_widget_2" height="100"></canvas>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                  <div class="card overflow-hidden">
                     <div class="card-body px-4 py-4">
                        <h5 class="mb-3">1700 / <small class="text-primary">Sales Status</small></h5>
                        <div class="chart-point">
                           <div class="check-point-area">
                              <canvas id="ShareProfit2"></canvas>
                           </div>
                           <ul class="chart-point-list">
                              <li><i class="fa fa-circle text-primary me-1"></i> 40% Candidates</li>
                              <li><i class="fa fa-circle text-danger me-1"></i> 35% Hotels</li>
                              <li><i class="fa fa-circle text-success me-1"></i> 25% Agents</li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-4 col-xxl-4 col-lg-12 col-md-12">
                  <div class="card">
                     <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Login Activities</h4>
                        <button type="button" class="btn btn-rounded btn-xs btn-primary">View All</button>
                     </div>
                     <div class="card-body p-0">
                        <div id="DZ_W_TimeLine1" class="widget-timeline dz-scroll style-1 px-4 ms-2 py-2 my-4" style="height:250px;">
                           <ul class="timeline">
                              <li>
                                 <div class="timeline-badge primary"></div>
                                 <a class="timeline-panel text-muted" href="#">
                                    <span>10 minutes ago</span>
                                    <h6 class="mb-0">Candidate Logged in. <strong class="text-info">John Doe.</strong></h6>
                                    <p class="mb-0">Last login was 8 days ago.</p>
                                 </a>
                              </li>
                              <li>
                                 <div class="timeline-badge danger"></div>
                                 <a class="timeline-panel text-muted" href="#">
                                    <span>14 minutes ago</span>
                                    <h6 class="mb-0">Hotel Logged in. <strong class="text-danger">John Doe.</strong></h6>
                                    <p class="mb-0">Last login was 2 days ago.</p>
                                 </a>
                              </li>
                              <li>
                                 <div class="timeline-badge success">
                                 </div>
                                 <a class="timeline-panel text-muted" href="#">
                                    <span>14 minutes ago</span>
                                    <h6 class="mb-0">Agent Logged in. <strong class="text-success">John Doe.</strong></h6>
                                    <p class="mb-0">Last login was 2 days ago.</p>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-8 col-xxl-8 col-lg-12 col-md-12">
                  <div class="card">
                     <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Recent Blog</h4>
                        <button type="button" class="btn btn-rounded btn-xs btn-primary">View All</button>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table table-responsive-sm mb-0">
                              <thead>
                                 <tr>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Dis.</strong></th>
                                    <th><strong>Author</strong></th>
                                    <th><strong>Date</strong></th>
                                    <th style="width:85px;"><strong>Action</strong></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><b>John Doe</b></td>
                                    <td>Raj Plaza</td>
                                    <td>Front Office</td>
                                    <td class="recent-stats">
                                       <i class="fa fa-circle text-info me-1"></i>11/12/2024
                                    </td>
                                    <td>
                                       <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                                       <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><b>John Doe</b></td>
                                    <td>Raj Plaza</td>
                                    <td>Front Office</td>
                                    <td class="recent-stats">
                                       <i class="fa fa-circle text-info me-1"></i>11/12/2024
                                    </td>
                                    <td>
                                       <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                                       <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><b>John Doe</b></td>
                                    <td>Raj Plaza</td>
                                    <td>Front Office</td>
                                    <td class="recent-stats">
                                       <i class="fa fa-circle text-info me-1"></i>11/12/2024
                                    </td>
                                    <td>
                                       <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                                       <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><b>John Doe</b></td>
                                    <td>Raj Plaza</td>
                                    <td>Front Office</td>
                                    <td class="recent-stats">
                                       <i class="fa fa-circle text-info me-1"></i>11/12/2024
                                    </td>
                                    <td>
                                       <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-eye"></i></a>
                                       <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-xxl-4 col-lg-12 col-md-12">
            <div class="card bg-primary text-white">
               <div class="card-header pb-0 border-0">
                  <h4 class="card-title text-white">TOP BLOG</h4>
                  <button type="button" class="btn text-white btn-xs btn-rounded btn-outline-light">View All</button>
               </div>
               <div class="card-body">
                  <p style="margin-top:-10px">Top BLOG Posted</p>
                  <div class="widget-media">
                     <ul class="timeline">
                        <li>
                           <div class="timeline-panel">
                              
							  <div class="media me-2 media-info">
													KG
												</div>
                             
                              <div class="media-body">
                                 <h5 class="mb-1 text-white"> Hotel Raj Palaza</h5>
                                 <small class="d-block">Total 50 Jobs Posted in last 2 Months</small>
                              </div>
                              
                                 <button type="button" class="btn btn-primary light sharp" >
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24"/>
                                          <polygon fill="#000000" points="8 6 16 12 8 18"/>
                                       </g>
                                    </svg>
                                 </button>
                              
                           </div>
                        </li>
						<li>
                           <div class="timeline-panel">
                              
							  <div class="media me-2 media-info">
													KG
												</div>
                             
                              <div class="media-body">
                                 <h5 class="mb-1 text-white"> Hotel Raj Palaza</h5>
                                 <small class="d-block">Total 50 Jobs Posted in last 2 Months</small>
                              </div>
                              
                                 <button type="button" class="btn btn-primary light sharp" >
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24"/>
                                          <polygon fill="#000000" points="8 6 16 12 8 18"/>
                                       </g>
                                    </svg>
                                 </button>
                              
                           </div>
                        </li>
						
                     </ul>
                  </div>
               </div>
               <canvas id="lineChart_3Kk"></canvas>
            </div>
         </div>
         <div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6">
            <div class="card bg-info activity_overview">
               <div class="card-header  border-0 pb-3 ">
                  <h4 class="card-title text-white">Monthly Sales</h4>
               </div>
               <div class="card-body pt-0">
                  <div class="custom-tab-1">
                     
				  <canvas id="chart_widget_4"></canvas>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-3 col-xxl-4 col-lg-6 col-md-6">
            <div class="card active_users">
               <div class="card-header bg-success border-0 pb-0">
                  <h4 class="card-title text-white">Active Users</h4>
               </div>
               <div class="bg-success">
                  <canvas id="activeUser" height="200"></canvas>
               </div>
               <div class="card-body pt-0">
                  <div class="list-group-flush mt-4">
                     <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1 font-weight-semi-bold border-top-0 border-0 border-bottom" style="border-color: rgba(255, 255, 255, 0.15)">
                        <p class="mb-0">Top Active Pages</p>
                        <p class="mb-0">Active Users</p>
                     </div>
                     <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1 border-0 border-bottom" style="border-color: rgba(255, 255, 255, 0.05)">
                        <p class="mb-0">/bootstrap-themes/</p>
                        <p class="mb-0">3</p>
                     </div>
                     <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1 border-0 border-bottom" style="border-color: rgba(255, 255, 255, 0.05)">
                        <p class="mb-0">/tags/html5/</p>
                        <p class="mb-0">3</p>
                     </div>
                     <div class="list-group-item bg-transparent d-xxl-flex justify-content-between px-0 py-1 d-none" style="border-color: rgba(255, 255, 255, 0.05)">
                        <p class="mb-0">/</p>
                        <p class="mb-0">2</p>
                     </div>
                     <div class="list-group-item bg-transparent d-xxl-flex justify-content-between px-0 py-1 d-none" style="border-color: rgba(255, 255, 255, 0.05)">
                        <p class="mb-0">/preview/falcon/dashboard/</p>
                        <p class="mb-0">2</p>
                     </div>
                     <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-1 border-0 border-bottom" style="border-color: rgba(255, 255, 255, 0.05)">
                        <p class="mb-0">/100-best-themes...all-time/</p>
                        <p class="mb-0">1</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-6 col-xxl-12 col-lg-12 col-md-12">
            <div id="user-activity" class="card">
               <div class="card-header border-0 pb-0 d-sm-flex d-block">
                  <div>
                     <h4 class="card-title"> Candidate Sign up</h4>
                  </div>
                  <div class="card-action">
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" data-bs-toggle="tab"  data-bs-target="#month" href="#user" role="tab"  aria-selected="true">
                           Month
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-bs-toggle="tab" data-bs-target="#week"  href="#bounce" role="tab" aria-selected="false">
                           Weekly
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-bs-toggle="tab" data-bs-target="#today" href="#session-duration" role="tab"  aria-selected="false">
                           Today
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="user" role="tabpanel">
                        <canvas id="activity" class="chartjs"></canvas>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->include('admin/common/footer') ?>