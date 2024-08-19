<template>
<Head title="Profile" />
  <AppLayout>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>

          <UploadProfilePhoto v-if="$root.hasPermission('profile.updatePhoto')" />

          <hr class="my-0" />

          <UpdateProfileInformation v-if="$root.hasPermission('profile.updateInfo')" />

        </div>
        <UpdatePassword class="mb-4" v-if="$root.hasPermission('profile.updatePassword')"/>
        <TwoStepVerification class="mb-4" v-if="$root.hasPermission('profile.2faAuth')"/>
          <DeactivateAccount class="mb-4" v-if="$root.hasPermission('profile.deactivate')"/>
          <DeleteAccount v-if="$root.hasPermission('profile.delete')"/>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout";
import UploadProfilePhoto from "./Partials/UploadProfilePhoto";
import UpdateProfileInformation from "./Partials/UpdateProfileInformation";
import UpdatePassword from "./Partials/UpdatePassword";
import TwoStepVerification from "./Partials/TwoStepVerification";
import DeactivateAccount from "./Partials/DeactivateAccount";
import DeleteAccount from "./Partials/DeleteAccount";
export default {
  components: {
    Head,
    AppLayout,
    UploadProfilePhoto,
    UpdateProfileInformation,
    UpdatePassword,
    TwoStepVerification,
    DeactivateAccount,
    DeleteAccount,
  },
};
</script>

<style>
</style>