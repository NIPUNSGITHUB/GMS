<template>
  <div>
    <notifications group="foo" />
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
          <a
            href
            @click="logout"
            class="nav-link dropdown-toggle"
            data-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              src="dist/img/user2-160x160.jpg"
              class="user-image img-circle elevation-2"
              alt="User Image"
            />
            Sign Out
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
  </div>
</template>
<script>
export default {
  data: () => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content")
  }),
  methods: {
    logout: function() {
     
      this.$confirm("Are you sure?").then(() => {
        axios
          .post("logout")
          .then(response => {
              
            if (response.status === 302 || 401) {
              
            } else {
              // throw error and go to catch block
            }
          })
          .catch(error => {
             location.reload();
          });
      });
    }
  }
};
</script>