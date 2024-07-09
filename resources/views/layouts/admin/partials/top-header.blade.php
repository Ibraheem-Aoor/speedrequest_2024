  <!-- Top Header -->
  <div class="top-header">
      <div class="header-bar d-flex justify-content-between">
          <div class="d-flex align-items-center">
              <a href="#" class="logo-icon me-3 d-none">
                  <img loading="lazy" src="{{ getAppLogo('dark') }}" height="30" class="small" alt="">
                  <span class="big">
                      <img loading="lazy" src="{{ getAppLogo('light') }}" height="24" class="logo-light-mode"
                          alt="">
                      <img loading="lazy" src="{{ getAppLogo('dark') }}" height="24" class="logo-dark-mode"
                          alt="">
                  </span>
              </a>
              <a id="close-sidebar" class="btn btn-icon btn-soft-light" href="javascript:void(0)">
                  <i class="ti ti-menu-2"></i>
              </a>
              {{-- <div class="search-bar p-0 d-none d-md-block ms-2">
                  <div id="search" class="menu-search mb-0">
                      <form role="search" method="get" id="searchform" class="searchform">
                          <div>
                              <input type="text" class="form-control border rounded" name="s" id="s"
                                  placeholder="Search Keywords...">
                              <input type="submit" id="searchsubmit" value="Search">
                          </div>
                      </form>
                  </div>
              </div> --}}
          </div>

          <ul class="list-unstyled mb-0">


              <li class="list-inline-item mb-0 ms-1">
                  <div class="dropdown dropdown-primary">
                      <button type="button" class="btn btn-icon btn-soft-light dropdown-toggle p-0"
                          data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                              class="ti ti-bell"></i></button>
                      @php
                          $auth_user = getAuthUser('admin');
                          $notifications_count = $auth_user->unReadNotifications()->count();
                      @endphp
                      @if($notifications_count > 0)
                      <span
                          class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                          <span class="visually-hidden">New alerts</span>
                      </span>
                      @endif

                      <div class="dropdown-menu dd-menu shadow rounded border-0 mt-3 p-0" data-simplebar
                          style="height: 320px; width: 290px;">
                          <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                              <h6 class="mb-0 text-dark">Notifications</h6>
                              <span
                                  class="badge bg-soft-danger rounded-pill">{{ $notifications_count }}</span>
                          </div>
                          @foreach ($auth_user->unReadNotifications as $notification)
                              <div class="p-3">
                                  <a href="{{ @$notification->data['link'] }}"
                                      class="dropdown-item features feature-primary key-feature p-0">
                                      <div class="d-flex align-items-center">
                                          <div class="icon text-center rounded-circle me-2">
                                              <i class="ti ti-shopping-cart"></i>
                                          </div>
                                          <div class="flex-1">
                                              <h6 class="mb-0 text-dark title">
                                                  {{ Str::limit(__('general.notifications.' . $notification->data['title']), 20, '...') }}
                                              </h6>
                                              <small
                                                  class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                          </div>
                                      </div>
                                  </a>
                              </div>
                          @endforeach
                      </div>
                  </div>
              </li>

              <li class="list-inline-item mb-0 ms-1">
                  <div class="dropdown dropdown-primary">
                      <button type="button" class="btn btn-soft-light dropdown-toggle p-0" data-bs-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false"><img loading="lazy"
                              src="{{ asset('assets/user/images/client/01.jpg') }}"
                              class="avatar avatar-ex-small rounded" alt=""></button>
                      <div class="dropdown-menu dd-menu dropdown-menu-end shadow border-0 mt-3 py-3"
                          style="min-width: 200px;">
                          {{-- <a class="dropdown-item d-flex align-items-center text-dark pb-3" href="profile.html">
                              <img loading="lazy" src="{{ asset('assets/user/images/client/05.jpg') }}"
                                  class="avatar avatar-md-sm rounded-circle border shadow" alt="">
                              <div class="flex-1 ms-2">
                                  <span class="d-block">Cristina Julia</span>
                                  <small class="text-muted">UI / UX Designer</small>
                              </div>
                          </a>
                          <a class="dropdown-item text-dark" href="index.html"><span
                                  class="mb-0 d-inline-block me-1"><i class="ti ti-home"></i></span> Dashboard</a>
                          <a class="dropdown-item text-dark" href="profile.html"><span
                                  class="mb-0 d-inline-block me-1"><i class="ti ti-settings"></i></span> Profile</a>
                          <a class="dropdown-item text-dark" href="email.html"><span
                                  class="mb-0 d-inline-block me-1"><i class="ti ti-mail"></i></span> Email</a>
                          <div class="dropdown-divider border-top"></div>
                          <a class="dropdown-item text-dark" href="lock-screen.html"><span
                                  class="mb-0 d-inline-block me-1"><i class="ti ti-lock"></i></span> Lockscreen</a> --}}
                          <form action="{{ route('logout') }}" method="POST" id="logout-form">
                              @csrf</form>
                          <a class="dropdown-item text-dark" href="#" onclick="$('#logout-form').submit();"><span
                                  class="mb-0 d-inline-block me-1"><i
                                      class="ti ti-logout"></i></span>{{ __('auth.logout') }}</a>
                      </div>
                  </div>
              </li>
          </ul>
      </div>
  </div>
  <!-- Top Header -->
