<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap Gallery - Bootstrap Admin Templates</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="images/favicon.svg" />

    <!-- *************
			************ Common Css Files *************
		************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="fonts/bootstrap/bootstrap-icons.css" />

    <!-- Main css -->
    <link rel="stylesheet" href="css/main.min.css" />

    <!-- *************
			************ Vendor Css Files *************
		************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="vendor/overlay-scroll/OverlayScrollbars.min.css" />
  </head>

  <body>

    <!-- Loading wrapper start -->
    <div id="loading-wrapper">
      <div class="spinner">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
        <div class="line4"></div>
        <div class="line5"></div>
        <div class="line6"></div>
      </div>
    </div>
    <!-- Loading wrapper end -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- Page header starts -->
      <div class="page-header">

        <!-- Sidebar brand starts -->
        <div class="brand">
          <a href="index.html" class="logo">
            <img src="images/logo.svg" class="d-none d-md-block me-4" alt="Bloom Admin Dashboard" />
            <img src="images/logo-sm.svg" class="d-block d-md-none me-4" alt="Bloom Admin Dashboard" />
          </a>
        </div>
        <!-- Sidebar brand ends -->

        <div class="toggle-sidebar" id="toggle-sidebar">
          <i class="bi bi-list"></i>
        </div>

        <!-- Header actions ccontainer start -->
        <div class="header-actions-container">

          <!-- Search container start -->
          <div class="search-container me-4 d-xl-block d-lg-none">

            <!-- Search input group start -->
            <input type="text" class="form-control" placeholder="Search" />
            <!-- Search input group end -->

          </div>
          <!-- Search container end -->

          <!-- Header actions start -->
          <div class="header-actions d-xl-flex d-lg-none gap-4">
            <div class="dropdown">
              <a class="dropdown-toggle" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-envelope-open fs-5 lh-1"></i>
                <span class="count-label"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end shadow-lg">
                <div class="dropdown-item">
                  <div class="d-flex py-2 border-bottom">
                    <img src="images/user.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                    <div class="m-0">
                      <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                      <p class="mb-1">Membership has been ended.</p>
                      <p class="small m-0 text-secondary">Today, 07:30pm</p>
                    </div>
                  </div>
                </div>
                <div class="dropdown-item">
                  <div class="d-flex py-2 border-bottom">
                    <img src="images/user2.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                    <div class="m-0">
                      <h6 class="mb-1 fw-semibold">Benjamin Michiels</h6>
                      <p class="mb-1">Congratulate, James for new job.</p>
                      <p class="small m-0 text-secondary">Today, 08:00pm</p>
                    </div>
                  </div>
                </div>
                <div class="dropdown-item">
                  <div class="d-flex py-2">
                    <img src="images/user1.png" class="img-3x me-3 rounded-3" alt="Admin Dashboards" />
                    <div class="m-0">
                      <h6 class="mb-1 fw-semibold">Jehovah Roy</h6>
                      <p class="mb-1">Lewis added new schedule release.</p>
                      <p class="small m-0 text-secondary">Today, 09:30pm</p>
                    </div>
                  </div>
                </div>
                <div class="d-grid mx-3 my-1">
                  <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                </div>
              </div>
            </div>
            <a href="account-settings.html" data-bs-toggle="tooltip" data-bs-placement="bottom"
              data-bs-custom-class="custom-tooltip-blue" data-bs-title="Settings">
              <i class="bi bi-gear fs-5"></i>
            </a>
          </div>
          <!-- Header actions start -->

          <!-- Header profile start -->
          <div class="header-profile d-flex align-items-center">
            <div class="dropdown">
              <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                <span class="user-name d-none d-md-block">Michelle White</span>
                <span class="avatar">
                  <img src="images/user7.png" alt="User Avatar" />
                  <span class="status online"></span>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                <div class="header-profile-actions">
                  <a href="profile.html">Profile</a>
                  <a href="account-settings.html">Settings</a>
                  <a href="login.html">Logout</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Header profile end -->

        </div>
        <!-- Header actions ccontainer end -->

      </div>
      <!-- Page header ends -->

      <!-- Main container start -->
      <div class="main-container">

        <!-- Sidebar wrapper start -->
        <nav class="sidebar-wrapper">

          <!-- Sidebar menu starts -->
          <div class="sidebar-menu">
            <div class="sidebarMenuScroll">
              <ul>
                <li class="active-page-link">
                  <a href="index.html">
                    <i class="bi bi-house"></i>
                    <span class="menu-text">Analytics</span>
                  </a>
                </li>
                <li>
                  <a href="widgets.html">
                    <i class="bi bi-box"></i>
                    <span class="menu-text">Widgets</span>
                  </a>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-collection"></i>
                    <span class="menu-text">UI Elements</span>
                    <span class="badge red">15</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="accordions.html">Accordions</a>
                      </li>
                      <li>
                        <a href="alerts.html">Alerts</a>
                      </li>
                      <li>
                        <a href="buttons.html">Buttons</a>
                      </li>
                      <li>
                        <a href="badges.html">Badges</a>
                      </li>
                      <li>
                        <a href="cards.html">Cards</a>
                      </li>
                      <li>
                        <a href="advanced-cards.html">Advanced Cards</a>
                      </li>
                      <li>
                        <a href="carousel.html">Carousel</a>
                      </li>
                      <li>
                        <a href="dropdowns.html">Dropdowns</a>
                      </li>
                      <li>
                        <a href="icons.html">Icons</a>
                      </li>
                      <li>
                        <a href="list-items.html">List Items</a>
                      </li>
                      <li>
                        <a href="modals.html">Modals</a>
                      </li>
                      <li>
                        <a href="offcanvas.html">Off Canvas</a>
                      </li>
                      <li>
                        <a href="placeholders.html">Placeholders</a>
                      </li>
                      <li>
                        <a href="progress.html">Progress Bars</a>
                      </li>
                      <li>
                        <a href="spinners.html">Spinners</a>
                      </li>
                      <li>
                        <a href="tabs.html">Tabs</a>
                      </li>
                      <li>
                        <a href="tooltips.html">Tooltips</a>
                      </li>
                      <li>
                        <a href="typography.html">Typography</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-stickies"></i>
                    <span class="menu-text">Pages</span>
                    <span class="badge blue">8</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="support.html">Support</a>
                      </li>
                      <li>
                        <a href="create-invoice.html">Create Invoice</a>
                      </li>
                      <li>
                        <a href="view-invoice.html">View Invoice</a>
                      </li>
                      <li>
                        <a href="invoice-list.html">Invoice List</a>
                      </li>
                      <li>
                        <a href="subscribers.html">Subscribers</a>
                      </li>
                      <li>
                        <a href="contacts.html">Contacts</a>
                      </li>
                      <li>
                        <a href="pricing.html">Pricing</a>
                      </li>
                      <li>
                        <a href="profile.html">Profile</a>
                      </li>
                      <li>
                        <a href="account-settings.html">Account Settings</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-calendar4"></i>
                    <span class="menu-text">Events</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="events.html">Events List</a>
                      </li>
                      <li>
                        <a href="calendar.html">Daygrid</a>
                      </li>
                      <li>
                        <a href="calendar-draggable.html">External Draggable</a>
                      </li>
                      <li>
                        <a href="calendar-google.html">Google Calendar</a>
                      </li>
                      <li>
                        <a href="calendar-list-view.html">List View</a>
                      </li>
                      <li>
                        <a href="calendar-selectable.html">Selectable</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-columns-gap"></i>
                    <span class="menu-text">Forms</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="form-inputs.html">Form Inputs</a>
                      </li>
                      <li>
                        <a href="form-checkbox-radio.html">Checkbox &amp; Radio</a>
                      </li>
                      <li>
                        <a href="form-file-input.html">File Input</a>
                      </li>
                      <li>
                        <a href="form-validations.html">Validations</a>
                      </li>
                      <li>
                        <a href="bs-select.html">Bootstrap Select</a>
                      </li>
                      <li>
                        <a href="date-time-pickers.html">Date Time Pickers</a>
                      </li>
                      <li>
                        <a href="input-mask.html">Input Masks</a>
                      </li>
                      <li>
                        <a href="input-tags.html">Input Tags</a>
                      </li>
                      <li>
                        <a href="summernote.html">Summernote</a>
                      </li>
                      <li>
                        <a href="form-layouts.html">Form Layouts</a>
                      </li>
                      <li>
                        <a href="form-layout2.html">Form Layout 2</a>
                      </li>
                      <li>
                        <a href="form-layout3.html">Form Layout 3</a>
                      </li>
                      <li>
                        <a href="form-layout4.html">Form Layout Horizontal</a>
                      </li>
                      <li>
                        <a href="form-layout5.html">Form Layout Tabs</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-window-split"></i>
                    <span class="menu-text">Tables</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="tables.html">Tables</a>
                      </li>
                      <li>
                        <a href="data-tables.html">Data Tables</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-map"></i>
                    <span class="menu-text">Graphs &amp; Maps</span>
                    <span class="badge green">15</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="apex.html">Apex</a>
                      </li>
                      <li>
                        <a href="morris.html">Morris</a>
                      </li>
                      <li>
                        <a href="maps.html">Maps</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-layout-sidebar"></i>
                    <span class="menu-text">Layouts</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="layout.html">Default Layout</a>
                      </li>
                      <li>
                        <a href="layout-grid.html">Grid Layout</a>
                      </li>
                      <li>
                        <a href="layout-mega-menu.html">Mega Menu</a>
                      </li>
                      <li>
                        <a href="layout-full-screen.html">Full Screen</a>
                      </li>
                      <li>
                        <a href="hero-header.html">Hero Header</a>
                      </li>
                      <li>
                        <a href="layout-datepicker.html">Layout Datepicker</a>
                      </li>
                      <li>
                        <a href="layout-welcome.html">Welcome Layout</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="bi bi-upc-scan"></i>
                    <span class="menu-text">Authentication</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="login.html">Login</a>
                      </li>
                      <li>
                        <a href="signup.html">Signup</a>
                      </li>
                      <li>
                        <a href="forgot-password.html">Forgot Password</a>
                      </li>
                      <li>
                        <a href="error.html">Error</a>
                      </li>
                      <li>
                        <a href="maintenance.html">Maintenance</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li>
                  <a href="support.html">
                    <i class="bi bi-code-square"></i>
                    <span class="menu-text">Support</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- Sidebar menu ends -->

        </nav>
        <!-- Sidebar wrapper end -->

        <!-- Content wrapper scroll start -->
        <div class="content-wrapper-scroll">

          <!-- Main header starts -->
          <div class="main-header d-flex align-items-center justify-content-between position-relative">
            <div class="d-flex align-items-center justify-content-center">
              <div class="page-icon">
                <i class="bi bi-house"></i>
              </div>
              <div class="page-title d-none d-md-block">
                <h5>Welcome back, David</h5>
              </div>
            </div>
            <!-- Live updates start -->
            <ul class="updates d-flex align-items-end flex-column overflow-hidden" id="updates">
              <li>
                <a href="javascript:void(0)">
                  <i class="bi bi-envelope-paper text-red font-1x me-2"></i>
                  <span>12 emails from David Michaiah.</span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <i class="bi bi-bar-chart text-blue font-1x me-2"></i>
                  <span>15 new features updated successfully.</span>
                </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <i class="bi bi-folder-check text-yellow font-1x me-2"></i>
                  <span>The media folder is created successfully.</span>
                </a>
              </li>
            </ul>
            <!-- Live updates end -->

          </div>
          <!-- Main header ends -->

          <!-- Content wrapper start -->
          <div class="content-wrapper">

            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title">Analytics</div>
                    <div id="analytics"></div>
                    <!-- Row start -->
                    <div class="row gx-3">
                      <div class="col-lg-3 col-sm-6 col-12">
                        <div class="d-flex align-items-center">
                          <div id="sparkline1"></div>
                          <div class="ms-3">
                            <h3>75k</h3>
                            <p class="m-0">Visitors</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                        <div class="d-flex align-items-center">
                          <div id="sparkline2"></div>
                          <div class="ms-3">
                            <h3>98k</h3>
                            <p class="m-0">Sessions</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                        <div class="d-flex align-items-center">
                          <div id="sparkline3"></div>
                          <div class="ms-3">
                            <h3>65k</h3>
                            <p class="m-0">Clicks</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-12">
                        <div class="d-flex align-items-center">
                          <div id="sparkline12"></div>
                          <div class="ms-3">
                            <h3>49k</h3>
                            <p class="m-0">Conversion</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Row end -->

                  </div>
                </div>
              </div>
              <div class="col-xl-8 col-sm-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Visitors</div>
                  </div>
                  <div class="card-body">
                    <div id="visitors"></div>
                    <!-- Row start -->
                    <div class="row gx-2 mt-3">
                      <div class="col-sm-4 col-6">
                        <div class="box-bdr-red rounded-2">
                          <div class="d-flex justify-content-center align-items-center p-3">
                            <div class="v-curve-seperator p-2 pe-4 me-3 text-red">
                              <i class="bi bi-tv font-2xx"></i>
                            </div>
                            <div>
                              <h3>560</h3>
                              <p class="m-0">Desktop</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 col-6">
                        <div class="box-bdr-blue rounded-2">
                          <div class="d-flex justify-content-center align-items-center p-3">
                            <div class="v-curve-seperator p-2 pe-4 me-3 text-blue">
                              <i class="bi bi-tablet font-2xx"></i>
                            </div>
                            <div>
                              <h3>268</h3>
                              <p class="m-0">iPad</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4 col-6">
                        <div class="box-bdr-yellow rounded-2">
                          <div class="d-flex justify-content-center align-items-center p-3">
                            <div class="v-curve-seperator p-2 pe-4 me-3 text-yellow">
                              <i class="bi bi-phone font-2xx"></i>
                            </div>
                            <div>
                              <h3>957</h3>
                              <p class="m-0">Mobile</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Row end -->

                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-sm-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Sales</div>
                  </div>
                  <div class="card-body">
                    <div id="sales" class="auto-align-graph"></div>
                    <div class="mt-2">
                      <div class="d-flex align-items-center py-2">
                        <div class="me-3">
                          <i class="bi bi-arrow-up-right-circle-fill text-green font-2x"></i>
                        </div>
                        <div class="d-flex flex-column">
                          <h5>Wednesday</h5>
                          <p>High Sales</p>
                        </div>
                        <h3 class="m-0 ms-auto">45k</h3>
                      </div>
                      <div class="d-flex align-items-center py-2">
                        <div class="me-3">
                          <i class="bi bi-arrow-down-right-circle-fill text-red font-2x"></i>
                        </div>
                        <div class="d-flex flex-column">
                          <h5>Monday</h5>
                          <p>Low Sales</p>
                        </div>
                        <h3 class="m-0 ms-auto">21k</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-sm-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Income</div>
                  </div>
                  <div class="card-body">
                    <div id="income" class="auto-align-graph"></div>
                    <div class="text-center">
                      <h2>
                        5690
                        <i class="bi bi-arrow-up-right-circle-fill text-green ms-2"></i>
                      </h2>
                      <p class="text-truncate">18% higher than last month.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-sm-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Browser Stats</div>
                  </div>
                  <div class="card-body">
                    <div class="d-grid gap-4">
                      <div class="d-flex">
                        <div>
                          <img class="me-2 img-3xx" src="images/browser/chrome.svg" alt="Chrome" />
                          Chrome
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                          <h5 class="m-0 me-3">87,590</h5>
                          <span class="badge shade-light-blue"><i class="bi bi-arrow-up-circle-fill me-2"></i>6%</span>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div>
                          <img class="me-2 img-3xx" src="images/browser/firefox.svg" alt="Firefox" />
                          Firefox
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                          <h5 class="m-0 me-3">34,450</h5>
                          <span class="badge shade-light-red"><i class="bi bi-arrow-down-circle-fill me-2"></i>3%</span>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div>
                          <img class="me-2 img-3xx" src="images/browser/opera.svg" alt="Opera" />
                          Opera
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                          <h5 class="m-0 me-3">26,619</h5>
                          <span class="badge shade-light-blue"><i class="bi bi-arrow-up-circle-fill me-2"></i>2%</span>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div>
                          <img class="me-2 img-3xx" src="images/browser/safari.svg" alt="Safari" />
                          Safari
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                          <h5 class="m-0 me-3">21,725</h5>
                          <span class="badge shade-light-blue"><i class="bi bi-arrow-up-circle-fill me-2"></i>3%</span>
                        </div>
                      </div>
                      <div class="d-flex">
                        <div>
                          <img class="me-2 img-3xx" src="images/browser/ie.svg" alt="Edge" />
                          Edge
                        </div>
                        <div class="d-flex align-items-center ms-auto">
                          <h5 class="m-0 me-3">12,481</h5>
                          <span class="badge shade-light-red"><i class="bi bi-arrow-down-circle-fill me-2"></i>5%</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-sm-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Orders</div>
                  </div>
                  <div class="card-body">
                    <div id="orders"></div>
                    <div class="text-center">
                      <h2>
                        890
                        <i class="bi bi-arrow-down-right-circle-fill text-red ms-2"></i>
                      </h2>
                      <p class="text-truncate">2% lower than yesterday.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-xxl-6 col-sm-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Budget</div>
                  </div>
                  <div class="card-body">

                    <!-- Row start -->
                    <div class="row gx-3 gy-3">
                      <div class="col-sm-6 col-12">
                        <div class="card light-shadow m-0">
                          <div class="d-flex align-items-center flex-row p-3">
                            <div class="me-2">
                              <div id="sparkline4"></div>
                            </div>
                            <div class="m-0">
                              <h3 class="d-flex align-items-center">
                                $450
                                <span class="ms-2 text-green font-1x"><i class="bi bi-arrow-up-circle-fill"></i>
                                  10%</span>
                              </h3>
                              <p class="m-0">Yearly Sales</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-12">
                        <div class="card light-shadow m-0">
                          <div class="d-flex align-items-center flex-row p-3">
                            <div class="me-2">
                              <div id="sparkline5"></div>
                            </div>
                            <div class="m-0">
                              <h3 class="d-flex align-items-center">
                                $265
                                <span class="ms-2 text-green font-1x"><i class="bi bi-arrow-up-circle-fill"></i>
                                  15%</span>
                              </h3>
                              <p class="m-0">Overall Purchases</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-12">
                        <div class="card light-shadow m-0">
                          <div class="d-flex align-items-center flex-row p-3">
                            <div class="me-2">
                              <div id="sparkline6"></div>
                            </div>
                            <div class="m-0">
                              <h3 class="d-flex align-items-center">
                                325
                                <span class="ms-2 text-red font-1x"><i class="bi bi-arrow-down-circle-fill"></i>
                                  8%</span>
                              </h3>
                              <p class="m-0">Pending Invoices</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 col-12">
                        <div class="card light-shadow m-0">
                          <div class="d-flex align-items-center flex-row p-3">
                            <div class="me-2">
                              <div id="sparkline7"></div>
                            </div>
                            <div class="m-0">
                              <h3 class="d-flex align-items-center">
                                $58k
                                <span class="ms-2 text-green font-1x"><i class="bi bi-arrow-up-circle-fill"></i>
                                  9%</span>
                              </h3>
                              <p class="m-0">Monthly Billing</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Row end -->

                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-sm-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Revenue</div>
                  </div>
                  <div class="card-body">

                    <!-- Row start -->
                    <div class="row gy-3">
                      <div class="col-xxl-12 col-12">
                        <div class="card light-shadow m-0">
                          <div class="d-flex flex-row p-3">
                            <div class="d-flex align-items-center">
                              <div class="box-light-red rounded-4 icon-box md">
                                <i class="bi bi-check-circle text-red font-1xx"></i>
                              </div>
                              <div class="ms-3 me-3">
                                <h3>$450</h3>
                                <p class="m-0">Revenue</p>
                              </div>
                            </div>
                            <div class="ms-auto" id="sparkline8"></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-12 col-12">
                        <div class="card light-shadow m-0">
                          <div class="d-flex flex-row p-3">
                            <div class="d-flex align-items-center">
                              <div class="box-light-blue rounded-4 icon-box md">
                                <i class="bi bi-check-circle text-blue font-1xx"></i>
                              </div>
                              <div class="ms-3 me-3">
                                <h3>$200</h3>
                                <p class="m-0">Expenses</p>
                              </div>
                            </div>
                            <div class="ms-auto" id="sparkline9"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Row end -->

                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-sm-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Conversion</div>
                  </div>
                  <div class="card-body">
                    <div id="conversion"></div>
                    <div class="text-center">
                      <span class="badge shade-red mb-3">65% Conversion Rate in 2022</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-md-6 col-sm-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Transactions</div>
                  </div>
                  <div class="card-body">
                    <div class="scroll370">
                      <div class="d-grid gap-4 mt-4">
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg box-bdr-red me-3 rounded-3">
                            <i class="bi bi-credit-card text-red font-2x"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h5>Visa Card</h5>
                            <p class="text-truncate m-0">Laptop Ordered</p>
                          </div>
                          <h3 class="m-0 ms-auto text-red">$500</h3>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg box-bdr-blue me-3 rounded-3">
                            <i class="bi bi-paypal text-blue font-2x"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h5>Paypal</h5>
                            <p class="text-truncate m-0">Payment Received</p>
                          </div>
                          <h3 class="m-0 ms-auto text-green">$350</h3>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg box-bdr-green me-3 rounded-3">
                            <i class="bi bi-pin-map text-green font-2x"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h5>Travel</h5>
                            <p class="text-truncate m-0">Yosemite Trip</p>
                          </div>
                          <h3 class="m-0 ms-auto text-green">$700</h3>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg box-bdr-yellow me-3 rounded-3">
                            <i class="bi bi-bag-check text-yellow font-2x"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h5>Shopping</h5>
                            <p class="text-truncate m-0">Bills Paid</p>
                          </div>
                          <h3 class="m-0 ms-auto text-red">$285</h3>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg box-bdr-red me-3 rounded-3">
                            <i class="bi bi-boxes text-red font-2x"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h5>Bank</h5>
                            <p class="text-truncate m-0">Investment</p>
                          </div>
                          <h3 class="m-0 ms-auto text-red">$150</h3>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg box-bdr-yellow me-3 rounded-3">
                            <i class="bi bi-paypal text-yellow font-2x"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h5>Paypal</h5>
                            <p class="text-truncate m-0">Payment Received</p>
                          </div>
                          <h3 class="m-0 ms-auto text-green">$790</h3>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg box-bdr-blue me-3 rounded-3">
                            <i class="bi bi-credit-card-2-front text-blue font-2x"></i>
                          </div>
                          <div class="d-flex flex-column">
                            <h5>Credit Card</h5>
                            <p class="text-truncate m-0">Online Shopping</p>
                          </div>
                          <h3 class="m-0 ms-auto text-green">$510</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-md-6 col-sm-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Activity</div>
                  </div>
                  <div class="card-body">
                    <div class="scroll370">
                      <div class="mt-4">
                        <div class="activity-log">
                          <h5>
                            Rustik Tasgall<small class="text-light ms-2">- 12 mins ago</small>
                          </h5>
                          <p>Crowdnub dashboard has been created</p>
                          <span class="badge shade-red">#New</span>
                        </div>
                        <div class="activity-log">
                          <h5>
                            Ollie Miller<small class="text-light ms-2">- 2 hrs ago</small>
                          </h5>
                          <p>Farewell day photos uploaded.</p>
                          <div class="stacked-images mt-3">
                            <img src="images/user.png" alt="Profile Image" />
                            <img src="images/user2.png" alt="Profile Image" />
                            <img src="images/user3.png" alt="Profile Image" />
                            <img src="images/user4.png" alt="Profile Image" />
                            <span class="plus shade-primary">+5</span>
                          </div>
                          <span class="badge shade-green ms-1 mt-3">150 Photos Uploaded</span>
                        </div>
                        <div class="activity-log">
                          <h5>
                            Candace Sullivan<small class="text-light ms-2">- 7 hrs ago</small>
                          </h5>
                          <p>
                            Developed 30 multipurpose Bootstrap 5 Admin
                            Templates
                          </p>
                        </div>
                        <div class="activity-log">
                          <h5>
                            Arnold Maxwell<small class="text-light ms-2">- 9 hrs ago</small>
                          </h5>
                          <p>Best Design Award</p>
                        </div>
                        <div class="activity-log">
                          <h5>
                            Lillian Gonzales<small class="text-light ms-2">- 11 hrs ago</small>
                          </h5>
                          <p>Farewell day photos uploaded.</p>
                          <div class="stacked-images mt-1">
                            <img src="images/user7.png" alt="Profile Image" />
                            <img src="images/user10.png" alt="Profile Image" />
                            <img src="images/user3.png" alt="Profile Image" />
                            <span class="plus shade-green">+27</span>
                          </div>
                          <span class="badge shade-red ms-1 mt-4">30 Photos Uploaded</span>
                        </div>
                        <div class="activity-log">
                          <h5>
                            Mercedes Powell<small class="text-light ms-2">- 15 hrs ago</small>
                          </h5>
                          <p>
                            Developed 30 multipurpose Bootstrap 5 Admin
                            Templates
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-sm-12 col-12">
                <div class="row gx-3">
                  <div class="col-sm-6 col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="m-0">2500</h3>
                        <p class="m-0">Signups</p>
                      </div>
                      <div class="card-body">
                        <div id="sparkline10"></div>
                        <span class="badge shade-light-blue mt-3 w-100">+21.7%</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="m-0">485</h3>
                        <p class="m-0">Products</p>
                      </div>
                      <div class="card-body">
                        <div id="sparkline11"></div>
                        <span class="badge shade-light-red mt-3 w-100">-15.8%</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-12">
                    <div class="card">
                      <div class="card-header">
                        <div class="card-title">Projects</div>
                      </div>
                      <div class="card-body">
                        <div class="scroll160">
                          <ul class="m-0">
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">10:30 am</p>
                                <span class="badge shade-red">75%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>Bloom - Admin Dashboard</h5>
                                <p class="m-0">by Elnathan Lois</p>
                              </div>
                            </li>
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">11:30 am</p>
                                <span class="badge shade-blue">50%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>Apex Mobile App</h5>
                                <p class="m-0">by Patrobus Nicole</p>
                              </div>
                            </li>
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">12:50 pm</p>
                                <span class="badge shade-yellow">90%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>Material Design Kit</h5>
                                <p class="m-0">by Abilene Omega</p>
                              </div>
                            </li>
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">02:30 pm</p>
                                <span class="badge shade-green">50%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>Invoice Design</h5>
                                <p class="m-0">by Shelomi Sarah</p>
                              </div>
                            </li>
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">03:45 pm</p>
                                <span class="badge shade-red">77%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>Landing Page Design</h5>
                                <p class="m-0">by Anaiah Edrei</p>
                              </div>
                            </li>
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">04:10 pm</p>
                                <span class="badge shade-blue">89%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>APS Backend Development</h5>
                                <p class="m-0">by Mareshah Nicole</p>
                              </div>
                            </li>
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">04:45 pm</p>
                                <span class="badge shade-yellow">25%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>Dashboard Testing</h5>
                                <p class="m-0">by Andrew Seth</p>
                              </div>
                            </li>
                            <li class="activity-list d-flex">
                              <div class="activity-time pt-2 pe-3 me-3">
                                <p class="date m-0">05:30 pm</p>
                                <span class="badge shade-green">85%</span>
                              </div>
                              <div class="d-flex flex-column py-2">
                                <h5>Product Launch</h5>
                                <p class="m-0">by Berechiah Philip</p>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row end -->

          </div>
          <!-- Content wrapper end -->

        </div>
        <!-- Content wrapper scroll end -->

        <!-- App Footer start -->
        <div class="app-footer">
          <span>© Bootstrap Gallery 2024</span>
        </div>
        <!-- App footer end -->

      </div>
      <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
			************ Required JavaScript Files *************
		************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/moment.js"></script>

    <!-- *************
			************ Vendor Js Files *************
		************* -->

    <!-- Overlay Scroll JS -->
    <script src="vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
    <script src="vendor/overlay-scroll/custom-scrollbar.js"></script>

    <!-- News ticker -->
    <script src="vendor/newsticker/newsTicker.min.js"></script>
    <script src="vendor/newsticker/custom-newsTicker.js"></script>

    <!-- Apex Charts -->
    <script src="vendor/apex/apexcharts.min.js"></script>
    <script src="vendor/apex/custom/dash1/analytics.js"></script>
    <script src="vendor/apex/custom/dash1/visitors.js"></script>
    <script src="vendor/apex/custom/dash1/income.js"></script>
    <script src="vendor/apex/custom/dash1/orders.js"></script>
    <script src="vendor/apex/custom/dash1/sales.js"></script>
    <script src="vendor/apex/custom/dash1/sparkline.js"></script>
    <script src="vendor/apex/custom/dash1/conversion.js"></script>

    <!-- Main Js Required -->
    <script src="js/main.js"></script>
  </body>

</html>
