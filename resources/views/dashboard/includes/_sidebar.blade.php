<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ auth_admin()->imagepath }}" alt="{{ auth_admin()->name }}">
        <div>
          <p class="app-sidebar__user-name">{{ auth_admin()->name }}</p>
          <p class="app-sidebar__user-designation">{{ auth_admin()->position }}</p>
        </div>
      </div>
      <ul class="app-menu">
        <li class="treeview is-expanded"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{ trans('dashboard.adminpanel') }}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="{{ aurl('') }}"><i class="icon fa fa-home"></i>{{ trans('dashboard.home') }}</a></li>
            <li><a class="treeview-item" href="{{ aurl('setting') }}"  rel="noopener"><i class="icon fa fa-gear"></i>{{ trans('dashboard.settings') }}</a></li>
          </ul>
        </li>      
        
        @foreach ( sidebarLinks() as $link => $icon )

            <li class="treeview {{ is_active($link) }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa {{ $icon }}"></i><span class="app-menu__label">{{ trans("dashboard.$link") }}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ aurl($link) }}"><i class="icon fa fa-list"></i>{{ trans('dashboard.list',['plural' =>  ucfirst($link) ]) }}</a></li>
                <li><a class="treeview-item" href="{{ aurl($link) }}/create"  rel="noopener"><i class="icon fa fa-plus"></i>{{ trans('dashboard.add',['singular' => ucfirst(str_singular($link)) ]) }}</a></li>
              </ul>
            </li>

        @endforeach


        <li class="treeview {{ is_active('contacts') }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">{{ trans("dashboard.contacts") }}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ aurl('contacts') }}"><i class="icon fa fa-list"></i>{{ trans('dashboard.list',['plural' =>  ucfirst('contacts') ]) }}</a></li>
              </ul>
        </li>


      </ul>
    </aside>