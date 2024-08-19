<template>
  <!-- Menu -->

  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="/admin" class="app-brand-link">
        <span class="app-brand-logo demo" style="width:100%;">
<img src="https://roomista.com/themes/default/assets/img/logo-dark.png" alt="" width="100%">
        </span>
        <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
      </a>

      <a
        href="javascript:void(0);"
        class="layout-menu-toggle menu-link text-large ms-auto"
      >
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['dashboard']) }"
      
      >
        <Link :href="route('dashboard')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-tachometer"></i>
          <div data-i18n="Dashboards">Dashboard</div>
        </Link>
      </li>

      <!-- Media Library -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['media.index']) }"
        v-if="$root.hasPermission('media.view')"
      >
        <Link :href="route('media.index', { c: 'default' })" class="menu-link">
          <i class="menu-icon tf-icons bx bx-photo-album"></i>
          <div data-i18n="Medai Library">Medai Library</div>
        </Link>
      </li>

      <!-- ********************************************************************************** -->
      <!-- Property Only Menu Items -->
      <!-- Rooms -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['room.index']) }"
        v-if="$page.props.backend_property && $root.hasPermission('room.view')"
      >
        <Link :href="route('room.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Rooms">Rooms</div>
        </Link>
      </li>
       <!-- Allotments -->
       <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['allotments.index']) }"
        v-if="
          $page.props.backend_property && $root.hasPermission('allotments.view')
        "
      >
        <Link :href="route('allotments.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-notepad"></i>
          <div data-i18n="Allotments">Allotments</div>
        </Link>
      </li>
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['offer.index']) }"
        v-if="$page.props.backend_property && $root.hasPermission('offers.view')"
      >
        <Link :href="route('offer.index')" class="menu-link">
          <i class='menu-icon tf-icons bx bxs-offer'></i>
          <div data-i18n="Offers">Offers</div>
        </Link>
      </li>
      <!-- Rates -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['rates.index']) }"
        v-if="$page.props.backend_property && $root.hasPermission('rate.view')"
      >
        <Link :href="route('rates.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-calculator"></i>
          <div data-i18n="Rates">Rates</div>
        </Link>
      </li>
      <!-- Meal Types -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['property.meal-types.index']) }"
        v-if="$page.props.backend_property  && $root.hasPermission('meal-type.view')"
      >
        <Link :href="route('property.meal-types.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-dish"></i>
          <div data-i18n="Meal Types">Meal Types</div>
        </Link>
      </li>
      <!-- Bed Types -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['property.bed-types.index']) }"
        v-if="$page.props.backend_property && $root.hasPermission('bed-type.view')"
      >
        <Link :href="route('property.bed-types.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-bed"></i>
          <div data-i18n="Bed Types">Bed Types</div>
        </Link>
      </li>
      <!-- Amenities -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['amenities.index']) }"
        v-if="$page.props.backend_property && $root.hasPermission('amenitiy.view')"
      >
        <Link :href="route('amenities.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-bath"></i>
          <div data-i18n="Amenities">Amenities</div>
        </Link>
      </li>
      <!-- Facilities -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['facilities.index']) }"
        v-if="$page.props.backend_property && $root.hasPermission('facility.view')"
      >
        <Link :href="route('facilities.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-bath"></i>
          <div data-i18n="Facilities">Facilities</div>
        </Link>
      </li>
      <!-- Property Only Menu Items End -->
      <!-- ********************************************************************************** -->

      <!-- Property -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['properties.index']) }"
        v-if="!$page.props.backend_property && $root.hasPermission('property.view')"
      >
        <Link :href="route('properties.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-city"></i>
          <div data-i18n="Properties">Properties</div>
        </Link>
      </li>
      <!-- Blogs -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['blogs.index']) }"
        v-if="!$page.props.backend_property && $root.hasPermission('blog.view')"
      >
        <Link :href="route('blogs.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-news"></i>
          <div data-i18n="Blogs">Blogs</div>
        </Link>
      </li>
      
      <!-- Partners -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['partners.index']) }"
        v-if="!$page.props.backend_property && $root.hasPermission('partner.view')"
      >
        <Link :href="route('partners.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
          <div data-i18n="Partners">Partners</div>
        </Link>
      </li>
      <!-- Partners -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['operators.index']) }"
        v-if="!$page.props.backend_property && $root.hasPermission('operator.view')"
      >
        <Link :href="route('operators.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
          <div data-i18n="Operator">Operator</div>
        </Link>
      </li>
      <!-- Careers -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['careers.index']) }"
        v-if="!$page.props.backend_property && $root.hasPermission('career.view')"
      >
        <Link :href="route('careers.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
          <div data-i18n="Careers">Careers</div>
        </Link>
      </li>
      <!-- Bookings -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['booking.index']) }"
        v-if="$root.hasPermission('booking.view')"
      >
        <Link :href="route('booking.index')" class="menu-link">
          <i class='menu-icon tf-icons bx bx-book-bookmark'></i>
          <div data-i18n="Bookings">Bookings</div>
        </Link>
      </li>
      <!-- BookingForcast -->
      <li
        class="menu-item"
        v-bind:class="{ active: addActiveClass(['bookingforcast.index']) }"
        v-if="$root.hasPermission('bookingforcast.view')"
      >
        <Link :href="route('bookingforcast.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-calendar-event"></i>
          <div data-i18n="BookingForcast">Booking Forecast</div>
        </Link>
      </li>
      <!-- Roomista Config -->
      <li
        class="menu-item"
        v-bind:class="{
          'active open': addActiveClass([
            'meal.types.index',
            'meal.types.create',
            'bed.types.index',
            'bed.types.create',
            'activity.index',
            'activity.create',
            'property.types.index',
            'property.types.create',
            'destinations.index',
            'destinations.create',
            'destination.features.index',
            'destination.features.create',
            'property.policy.index'
          ]),
        }"
        v-if="!$page.props.backend_property && ($page.props?.user?.roles?.length > 0 && $page.props?.user?.roles[0].type == 'admin')"
      >
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-wrench"></i>
          <div data-i18n="Roomista Configurations">Roomista Configurations</div>
        </a>

        <ul class="menu-sub">
          <!-- Meal types -->
          <li
            class="menu-item"
            v-bind:class="{
              'active open': addActiveClass(['meal.types.index']),
            }"
            v-if="$root.hasPermission('meal-type.view')"
          >
            <Link :href="route('meal.types.index')" class="menu-link">
              <i class="menu-icon tf-icons bx bx-dish"></i>
              <div data-i18n="Meal Types">Meal Types</div>
            </Link>
          </li>
          <!-- Bed types -->
          <li
            class="menu-item"
            v-bind:class="{
              'active open': addActiveClass(['bed.types.index']),
            }"
            v-if="$root.hasPermission('bed-type.view')"
          >
            <Link :href="route('bed.types.index')" class="menu-link">
              <i class="menu-icon tf-icons bx bx-bed"></i>
              <div data-i18n="Bed Types">Bed Types</div>
            </Link>
          </li>

          <!-- Activities -->
          <li
            class="menu-item"
            v-bind:class="{
              'active open': addActiveClass(['activity.index']),
            }"
            v-if="$root.hasPermission('activity.view')"
          >
            <Link :href="route('activity.index')" class="menu-link">
              <i class="menu-icon tf-icons bx bx-cycling"></i>
              <div data-i18n="Activities">Activities</div>
            </Link>
          </li>
          <!-- Property Types -->
          <li
            class="menu-item"
            v-bind:class="{
              'active open': addActiveClass(['property.types.index']),
            }"
            v-if="$root.hasPermission('property-type.view')"
          >
            <Link :href="route('property.types.index')" class="menu-link">
              <i class="menu-icon tf-icons bx bx-buildings"></i>
              <div data-i18n="Property Types">Property Types</div>
            </Link>
          </li>
          <!-- Destinations -->
          <li
            class="menu-item"
            v-bind:class="{
              'active open': addActiveClass(['destinations.index']),
            }"
            v-if="$root.hasPermission('destination.view')"
          >
            <Link :href="route('destinations.index')" class="menu-link">
              <i class="menu-icon tf-icons bx bx-map"></i>
              <div data-i18n="Destinations">Destinations</div>
            </Link>
          </li>
          <!-- Destination Features -->
          <li
            class="menu-item"
            v-bind:class="{
              'active open': addActiveClass(['destination.features.index']),
            }"
            v-if="$root.hasPermission('destination-feature.view')"
          >
            <Link :href="route('destination.features.index')" class="menu-link">
              <i class="menu-icon tf-icons bx bx-swim"></i>
              <div data-i18n="Destination features">Destination features</div>
            </Link>
          </li>
          <!-- Destination Features -->
          <li
            class="menu-item"
            v-bind:class="{
              'active open': addActiveClass(['property.policy.index']),
            }"
            v-if="$root.hasPermission('hotel-policy.view')"
          >
            <Link :href="route('property.policy.index')" class="menu-link">
              <i class='menu-icon tf-icons bx bx-file'></i>
              <div data-i18n="Default Hotel Policy">Default Hotel Policy</div>
            </Link>
          </li>
        </ul>
      </li>

      <!-- Settings -->
      <li
        class="menu-item"
        v-bind:class="{
          'active open': addActiveClass([
            'settings.users',
            'settings.roles',
            'settings.general',
            'settings.social-auth',
            'settings.mail',
            'payment-options.index',
            'currencies..index',
          ]),
        }"

      >
      <!--         v-if="
          $root.hasPermission('backend-user.view') &&
          $root.hasPermission('roles.view') &&
          $root.hasPermission('settings.view')
        " -->
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-cog"></i>
          <div data-i18n="Settings">Settings</div>
        </a>

        <ul class="menu-sub">
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['settings.users']),
            }"
            v-if="$root.hasPermission('backend-user.view')"
          >
            <Link :href="route('settings.users')" class="menu-link">
              <div data-i18n="Backend Users">Backend Users</div>
            </Link>
          </li>
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['settings.roles']),
            }"
            v-if="$root.hasPermission('roles-permissions.view')"
          >
            <Link :href="route('settings.roles')" class="menu-link">
              <div data-i18n="Roles & Permissions">Roles & Permissions</div>
            </Link>
          </li>
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['settings.general']),
            }"
            v-if="$root.hasPermission('system-setting.view')"
          >
            <Link :href="route('settings.general')" class="menu-link">
              <div data-i18n="General Settings">General Settings</div>
            </Link>
          </li>
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['settings.content-pages']),
            }"
            v-if="$root.hasPermission('system-setting.view')"
          >
            <Link :href="route('settings.content-pages')" class="menu-link">
              <div data-i18n="Pages">Pages</div>
            </Link>
          </li>
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['settings.social-auth']),
            }"
            v-if="$root.hasPermission('system-setting.view')"
          >
            <Link :href="route('settings.social-auth')" class="menu-link">
              <div data-i18n="Social Auth Settings">Social Auth Settings</div>
            </Link>
          </li>
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['currencies.index']),
            }"
            v-if="$root.hasPermission('currencies.view')"
          >
            <Link :href="route('currencies.index')" class="menu-link">
              <div data-i18n="Currencies">Currencies</div>
            </Link>
          </li>
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['settings.mail']),
            }"
            v-if="$root.hasPermission('system-setting.view')"
          >
            <Link :href="route('settings.mail')" class="menu-link">
              <div data-i18n="Mail Settings">Mail Settings</div>
            </Link>
          </li>
          <li
            class="menu-item"
            v-bind:class="{
              active: addActiveClass(['payment-options.index']),
            }"
            v-if="$root.hasPermission('system-setting.view')"
          >
            <Link :href="route('payment-options.index')" class="menu-link">
              <div data-i18n="Payment Options">Payment Options</div>
            </Link>
          </li>
        </ul>
      </li>
      <!-- Offers -->

    </ul>
  </aside>
  <!-- / Menu -->
</template>
<script>
import SidebarItemCard from "@/Layouts/Partials/SidebarItemCard";
import { Link } from "@inertiajs/inertia-vue3";
export default {
  components: {
    Link,
    SidebarItemCard,
  },
  data() {
    return {
      showingNavigationDropdown: false,
      expanded: true,
      collapsed: false,
      hidden: true,
      currentRoute: "",
    };
  },
  mounted() {
    new PerfectScrollbar(".menu-inner", {
      wheelPropagation: false,
      wheelSpeed: 0.5,
    });
  },
  methods: {
    addActiveClass(routes) {
      if (routes.includes(route().current())) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>

<style>
.rotate {
  transform: rotate(90deg);
}
.main-menu-content {
  max-height: 100vh;
  overflow-y: scroll;
  overflow-x: hidden;
}
</style>
