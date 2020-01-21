<template lang="html">
  <div id="parentx">
    <vs-button
      color="primary"
      type="filled"
      @click="active=!active"
    >
      Open Sidebar
    </vs-button>
    <vs-sidebar
      v-model="active"
      parent="body"
      default-index="1"
      color="primary"
      class="sidebarx"
      spacer
    >
      <div
        slot="header"
        class="header-sidebar"
      >
        <vs-avatar
          size="70px"
          src="https://randomuser.me/api/portraits/men/85.jpg"
        />

        <h4>
          My Name
          <vs-button
            color="primary"
            icon="more_horiz"
            type="flat"
          />
        </h4>
      </div>

      <vs-sidebar-item
        index="1"
        icon="question_answer"
      >
        Dashboard
      </vs-sidebar-item>

      <vs-sidebar-item
        index="2"
        icon="gavel"
      >
        History
      </vs-sidebar-item>

      <vs-divider
        icon="person"
        position="left"
      >
        User
      </vs-divider>

      <vs-sidebar-item
        index="3"
        icon="verified_user"
      >
        Configurations
      </vs-sidebar-item>
      <vs-sidebar-item
        index="4"
        icon="account_box"
      >
        Profile
      </vs-sidebar-item>
      <vs-sidebar-item index="5">
        Card
      </vs-sidebar-item>

      <div
        slot="footer"
        class="footer-sidebar"
      >
        <vs-button
          icon="reply"
          color="danger"
          type="flat"
        >
          log out
        </vs-button>
        <vs-button
          icon="settings"
          color="primary"
          type="border"
        />
      </div>
    </vs-sidebar>
  </div>
</template>

<script>
export default {
  name: "App",
  data:()=>({
    active:false,
  })
};
</script>

<style>
  .header-sidebar {
    display: flex; align-items: center; justify-content: center; flex-direction: column; width: 100%;
  }

  .header-sidebar h4 {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
  }

  .header-sidebar h4>button {
    margin-left: 10px;
  }

  .header-sidebar .footer-sidebar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
  }

  .header-sidebar .footer-sidebar>button {
    border: 0 solid rgba(0,0,0,0) !important;
    border-left: 1px solid rgba(0,0,0,.07) !important;
    border-radius: 0 !important;
  }
</style>
