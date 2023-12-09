 <div class="dlabnav">
     <div class="dlabnav-scroll">
         <ul class="metismenu" id="menu">
             <li><a href="{{ route('dashboard') }}" aria-expanded="false">
                     <i class="material-symbols-outlined">dashboard </i>
                     <span class="nav-text">{{ __('menu.dashboard') }}</span>
                 </a>
             </li>
             @role('Super-Admin')
             <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                     <i class="material-symbols-outlined">groups </i>
                     <span class="nav-text">{{ __('menu.employees') }}</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('emp.list') }}">{{ __('menu.employees') }}</a></li>
                     <li><a href="{{ route('emp.add') }}">{{ __('menu.add.employee') }}</a></li>
                 </ul>
             </li>
             
             <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                     <i class="material-symbols-outlined">store </i>
                     <span class="nav-text">{{ __('menu.supplier') }}</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('sup.list') }}">{{ __('menu.suppliers') }}</a></li>
                     <li><a href="{{ route('sup.add') }}">{{ __('menu.add.supplier') }}</a></li>
                 </ul>
             </li>
             @endrole
             <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                     <i class="material-symbols-outlined">store </i>
                     <span class="nav-text">{{ __('menu.product') }}</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('product.list') }}">{{ __('menu.products') }}</a></li>
                     <li><a href="{{ route('product.add') }}">{{ __('menu.add.product') }}</a></li>
                 </ul>
             </li>
             <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                     <i class="material-symbols-outlined">store </i>
                     <span class="nav-text">{{ __('menu.sale') }}</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{ route('order.list') }}">{{ __('menu.orders') }}</a></li>
                     <li><a href="{{ route('order.add') }}">{{ __('menu.add.order') }}</a></li>
                 </ul>
             </li>
             @role('Super-Admin')
             <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                     <i class="material-symbols-outlined">account_balance </i>
                     <span class="nav-text">{{ __('menu.accounts') }}</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="{{route('acc.index')}}">{{ __('menu.accounts') }}</a></li>
                     <li><a href="{{route('acc.create')}}">{{ __('menu.add.account') }}</a></li>
                     <li><a href="{{route('acc.incomes')}}">{{ __('menu.income') }}</a></li>
                     <li><a href="{{route('acc.expenses')}}">{{ __('menu.expense') }}</a></li>
                 </ul>
             </li>
             <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false">
                <i class="material-symbols-outlined">
                    query_stats
                </i>
                <span class="nav-text">{{ __('menu.report') }}</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="#">{{ __('menu.sale.report') }}</a></li>
            </ul>
        </li>
             @endrole
         </ul>
     </div>
 </div>
