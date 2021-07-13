<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->

            <li class="nav-item start {{ request()->is('dashboard') ? 'active': null }}">
                <a href="{{route('dashboard.index')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{__('dashboard.Dashboard')}}</span>
                </a>
            </li>

            <li class="nav-item  {{ request()->is('admin') ? 'active': null }}">
                <a href="{{route('admin.index')}}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">{{__('dashboard.Admins')}}</span>
                </a>
            </li>

            <li class="nav-item  {{ request()->is('user') ? 'active': null }}">
                <a href="{{route('user.index')}}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">{{__('dashboard.Users')}}</span>
                </a>
            </li>
            
            
            
            
<!--
            <li class="nav-item  {{ request()->is('city') ? 'active': null }}">
                <a href="{{route('city.index')}}" class="nav-link nav-toggle">
                    <i class="icon-pointer"></i>
                    <span class="title">{{__('dashboard.Cities')}}</span>

                </a>
            </li>
           
            
            
            <li class="nav-item  {{ request()->is('nationality') ? 'active': null }}">
                <a href="{{route('nationality.index')}}" class="nav-link nav-toggle">
                    <i class="icon-flag"></i>
                    <span class="title">{{__('dashboard.Nationalities')}}</span>
                </a>

            </li>
            
          
             
             
             
             
            <li class="nav-item  {{ request()->is('language') ? 'active': null }}">
                <a href="{{route('language.index')}}" class="nav-link nav-toggle">
                    <i class="fa fa-language"></i>
                    <span class="title">{{__('dashboard.Languages')}}</span>
                </a>
            </li>
               -->
               
               
               
               
               
{{--            <li class="nav-item  {{ request()->is('plan') ? 'active': null }}">--}}
{{--                <a href="{{route('plan.index')}}" class="nav-link nav-toggle">--}}
{{--                    <i class="fa fa-sticky-note"></i>--}}
{{--                    <span class="title">{{__('dashboard.Plans')}}</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="nav-item  {{ request()->is('department') ? 'active': null }}">
                <a href="{{route('departments.index')}}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">{{__('dashboard.Departments')}}</span>
                </a>
            </li>
            <li class="nav-item  {{ request()->is('departmentslider') ? 'active': null }}">
                <a href="{{route('dept.slider.index')}}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">{{__('dashboard.Departments sliders')}}</span>
                </a>
            </li>



{{--            <li class="nav-item  {{ request()->is('classes') ? 'active': null }}">--}}
{{--                <a href="{{route('class.index')}}" class="nav-link nav-toggle">--}}
{{--                    <i class="fa fa-calendar-plus-o"></i>--}}
{{--                    <span class="title">{{__('dashboard.Classes')}}</span>--}}
{{--                </a>--}}

{{--            </li>--}}

{{--            <li class="nav-item  {{ request()->is('departmentplan') ? 'active': null }}">--}}
{{--                <a href="{{route('dept.plan.index')}}" class="nav-link nav-toggle">--}}
{{--                    <i class="icon-layers"></i>--}}
{{--                    <span class="title">{{__('dashboard.Departments Plans')}}</span>--}}
{{--                </a>--}}

{{--            </li>--}}

            <li class="nav-item  {{ request()->is('resturant') ? 'active': null }}">
                <a href="{{route('resturant.index')}}" class="nav-link nav-toggle">
                    <i class="fa fa-cutlery"></i>
                    <span class="title">{{__('dashboard.Resturants')}}</span>
                </a>
           
           <!--
           
            <li class="nav-item  {{ request()->is('mealingredient') ? 'active': null }}">
                <a href="{{route('meal.ingredient.index')}}" class="nav-link ">
                    <i class="fa fa-cutlery"></i>
                    <span class="title">{{__('dashboard.Meals Ingredients')}}</span>
                </a>
            </li>
            
            
            <li class="nav-item  {{ request()->is('modifier') ? 'active': null }}">
                <a href="{{route('modifier.index')}}" class="nav-link ">
                    <i class="fa fa-cutlery"></i>
                    <span class="title">{{__('dashboard.Modifiers')}}</span>
                </a>
            </li>
            
            
            <li class="nav-item  {{ request()->is('mealmodifier') ? 'active': null }}">
                <a href="{{route('meal.modifier.index')}}" class="nav-link ">
                    <i class="fa fa-cutlery"></i>
                    <span class="title">{{__('dashboard.Meal Modifiers')}}</span>
                </a>
            </li>
            -->
            
            <li class="nav-item  {{ request()->is('mealday') ? 'active': null }}">
                <a href="{{route('mealday.index')}}" class="nav-link ">
                    <i class="fa fa-cutlery"></i>
                    <span class="title">{{__('dashboard.Monthly Meal')}}</span>
                </a>
            </li>
{{--                <ul class="sub-menu">--}}
{{--                    <li class="nav-item  {{ Request()->is('resturant') ? 'active': null }}">--}}
{{--                        <a href="{{route('resturant.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Main Data')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item  {{ Request::url() == url('resturant/slider') ? 'active': null }}">--}}
{{--                        <a href="{{route('resturant.sliders.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Sliders')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item  {{Request::url() == url('resturant/Branch')? 'active': null }}">--}}
{{--                            <a href="{{route('branch.index')}}" class="nav-link ">--}}
{{--                                <span class="title">{{__('dashboard.Branch')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    <li class="nav-item  {{ Request::url() == url('resturant/category') ? 'active': null }}">--}}
{{--                        <a href="{{route('resturant.categories.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Categories')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item  {{ request()->is('day') ? 'active': null }}">--}}
{{--                        <a href="{{route('day.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Days')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item  {{ request()->is('meal') ? 'active': null }}">--}}
{{--                        <a href="{{route('meals.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Meals')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li class="nav-item  {{ request()->is('mealingredient') ? 'active': null }}">--}}
{{--                        <a href="{{route('meal.ingredient.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Meals Ingredients')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item  {{ request()->is('modifier') ? 'active': null }}">--}}
{{--                        <a href="{{route('modifier.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Modifiers')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item  {{ request()->is('mealmodifier') ? 'active': null }}">--}}
{{--                        <a href="{{route('meal.modifier.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.Meal Modifiers')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item  {{ request()->is('mealday') ? 'active': null }}">--}}
{{--                        <a href="{{route('mealday.index')}}" class="nav-link ">--}}
{{--                            <span class="title">{{__('dashboard.mealday')}}</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--      </li>--}}

     <li class="nav-item  {{ request()->is('fitnessclub') ? 'active': null }}">
         <a href="javascript:;" class="nav-link nav-toggle">
             <i class="fa fa-home"></i>
             <span class="title">{{__('dashboard.Fitness Club')}}</span>
             <span class="arrow"></span>
         </a>
         <ul class="sub-menu">
             <li class="nav-item  {{ request()->is('fitnessclub') ? 'active': null }}">
                 <a href="{{route('fitness.club.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Fitness Clubs List')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request()->is('activity') ? 'active': null }}">
                 <a href="{{route('activity.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Activities')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ Request::url() == url('club/slider') ? 'active': null }}">
                 <a href="{{route('club.sliders.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Sliders')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('club/subscription') ? 'active': null }}">
                 <a href="{{route('clubsubscription.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Subscriptions')}}</span>
                 </a>
             </li>

             <li class="nav-item  {{ request()->is('subscription') ? 'active': null }}">
                 <a href="{{route('subscriptions.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Subscriptions Types')}}</span>
                 </a>
             </li>
         </ul>
     </li>


     <li class="nav-item  {{ request()->is('nutritionist') ? 'active': null }}">
         <a href="javascript:;" class="nav-link nav-toggle">
             <i class="fa fa-stethoscope"></i>
             <span class="title">{{__('dashboard.Nutritionists')}}</span>
             <span class="arrow"></span>
         </a>
         <ul class="sub-menu">
             <li class="nav-item  {{ request()->is('nutritionist') ? 'active': null }}">
                 <a href="{{route('nutritionist.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Nutritionists List')}}</span>
                 </a>
             </li>

             <!--

             <li class="nav-item  ">
                 <a href="{{route('nutritionist.class.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Classes')}}</span>
                 </a>
             </li>
             -->

             <li class="nav-item  {{ request()->is('nutritionistlanguage') ? 'active': null }}">
                 <a href="{{route('nutritionist.language.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Languages')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('nutritionist/slider') ? 'active': null }}">
                 <a href="{{route('nutritionist.sliders.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Sliders')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('nutritionist/video') ? 'active': null }}">
                 <a href="{{route('nutritionist.videos.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Images')}}</span>
                 </a>
             </li>


         </ul>
     </li>


     <li class="nav-item {{ request()->is('trainer') ? 'active': null }}">
         <a href="javascript:;" class="nav-link nav-toggle">
             <i class="fa fa-heartbeat"></i>
             <span class="title">{{__('dashboard.Trainers')}}</span>
             <span class="arrow"></span>
         </a>
         <ul class="sub-menu">
             <li class="nav-item {{ request()->is('trainer') ? 'active': null }}">
                 <a href="{{route('trainer.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Trainers List')}}</span>
                 </a>
             </li>

            <!--
             <li class="nav-item  ">
                 <a href="{{ route('trainer.class.index') }}" class="nav-link ">
                     <span class="title">{{__('dashboard.Classes')}}</span>
                 </a>
             </li>
             -->

             <li class="nav-item  {{ request()->is('trainerlanguage') ? 'active': null }}">
                 <a href="{{ route('trainer.language.index') }}" class="nav-link ">
                     <span class="title">{{__('dashboard.Languages')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('trainer/slider') ? 'active': null }}">
                 <a href="{{route('trainer.sliders.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Sliders')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('trainer/video') ? 'active': null }}">
                 <a href="{{route('trainer.images.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Images')}}</span>
                 </a>
             </li>

         </ul>
     </li>

     <li class="nav-item  {{ request::url() == url('order/resturants') ? 'active': null }}">
         <a href="" class="nav-link nav-toggle">
             <i class="fa fa-gift"></i>
             <span class="title">{{__('dashboard.Orders')}}</span>
             <span class="arrow"></span>
         </a>
         <ul class="sub-menu">
             <li class="nav-item{{ request::url() == url('order/resturants') ? 'active': null }} ">
                 <a href="{{route('order.resturants.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Resturants')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('order/clubs') ? 'active': null }} ">
                 <a href="{{route('order.clubs.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Clubs')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('order/trainers') ? 'active': null }}">
                 <a href="{{route('order.trainers.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Trainers')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request::url() == url('order/nutritionists') ? 'active': null }}">
                 <a href="{{route('order.nutritionists.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Nutritionist')}}</span>
                 </a>
             </li>
         </ul>
     </li>

     <li class="nav-item  {{ request()->is('coupon') ? 'active': null }}">
         <a href="{{route('coupon.index')}}" class="nav-link nav-toggle">
             <i class="icon-star"></i>
             <span class="title">{{__('dashboard.Coupons')}}</span>
         </a>
     </li>

     <li class="nav-item {{ request()->is('settings') ? 'active': null }} ">
         <a href="{{route('settings.index')}}" class="nav-link nav-toggle">
             <i class="icon-wrench"></i>
             <span class="title">{{__('dashboard.Settings')}}</span>
         </a>
     </li>

     <li class="nav-item  {{ request()->is('clubcontact') ? 'active': null }}">
         <a href="" class="nav-link nav-toggle">
             <i class="fa fa-envelope"></i>
             <span class="title">{{__('dashboard.Contacts')}}</span>
             <span class="arrow"></span>
         </a>
         <ul class="sub-menu">
             <li class="nav-item  {{ request()->is('clubcontact') ? 'active': null }}">
                 <a href="{{route('clubcontact.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Clubs')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request()->is('resturantcontact') ? 'active': null }}">
                 <a href="{{route('resturantcontact.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Resturants')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request()->is('trainercontact') ? 'active': null }}">
                 <a href="{{route('trainercontact.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Trainers')}}</span>
                 </a>
             </li>
             <li class="nav-item  {{ request()->is('nutritionistcontact') ? 'active': null }}">
                 <a href="{{route('nutritionistcontact.index')}}" class="nav-link ">
                     <span class="title">{{__('dashboard.Nutritionists')}}</span>
                 </a>
             </li>


         </ul>
     </li>

 </ul>
 <!-- END SIDEBAR MENU -->
 <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
