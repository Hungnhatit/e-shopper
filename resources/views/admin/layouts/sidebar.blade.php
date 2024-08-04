<aside class="left-sidebar" data-sidebarbg="skin5">
   <!-- Sidebar scroll-->
   <div class="scroll-sidebar">
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
         <ul id="sidebarnav">
            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/home" aria-expanded="false">
                  <i class="mdi mdi-av-timer"></i>
                  <span class="hide-menu">Dashboard</span>
               </a>
            </li>
            <li class="sidebar-item">
               @if (Auth::user())
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{url('/profile-page/'.Auth::user()->id)}}" aria-expanded="false">
                  <i class="mdi mdi-account-network"></i>
                  <span class="hide-menu">Profile</span>
               </a>
               @else
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                  <i class="mdi mdi-account-network"></i>
                  <span class="hide-menu">Profile</span>
               </a>
               @endif
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/form-basic" aria-expanded="false">
                  <i class="mdi mdi-arrange-bring-forward"></i>
                  <span class="hide-menu">Form Basic</span>
               </a>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/table" aria-expanded="false">
                  <i class="mdi mdi-border-none"></i>
                  <span class="hide-menu">Table</span>
               </a>
            </li>

            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/country" aria-expanded="false">
                  <i class="mdi mdi-table-large"></i>
                  <span class="hide-menu">Country</span>
               </a>
            </li>

            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/blog" aria-expanded="false">
                  <i class="mdi mdi-blogger"></i>
                  <span class="hide-menu">Blog</span>
               </a>
            </li>

            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/icon" aria-expanded="false">
                  <i class="mdi mdi-face"></i>
                  <span class="hide-menu">Icon</span>
               </a>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/blank" aria-expanded="false">
                  <i class="mdi mdi-file"></i>
                  <span class="hide-menu">Blank</span>
               </a>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/error" aria-expanded="false">
                  <i class="mdi mdi-alert-outline"></i>
                  <span class="hide-menu">404</span>
               </a>
            </li>
         </ul>
      </nav>
      <!-- End Sidebar navigation -->
   </div>
   <!-- End Sidebar scroll-->
</aside>