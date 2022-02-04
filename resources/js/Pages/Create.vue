<template>
  <AppLayout>
    <h1>Create User</h1>
    <h4 v-if="flag" class="text-center mt-3 mb-3">New user created successfully.</h4>
    <form action="javascript:;">
      <div class="form-group mb-3">
        <label>Enter name</label>
        <input
          v-model="name"
          type="text"
          class="form-control"
          placeholder="Enter name"
        />
      </div>
      <div class="form-group mb-3">
        <label>Enter username</label>
        <input
          v-model="username"
          type="text"
          class="form-control"
          placeholder="Enter username"
        />
      </div>
      <div class="form-group mb-3">
        <label>Enter email</label>
        <input
          v-model="email"
          type="email"
          class="form-control"
          placeholder="Enter email"
        />
      </div>
      <div class="form-group mb-3">
        <label>Phone</label>
        <input
          v-model="phone"
          type="number"
          class="form-control"
          placeholder="Enter Phone Number"
        />
      </div>
      <div class="form-group mb-3">
        <label>Website</label>
        <input
          v-model="website"
          type="text"
          class="form-control"
          placeholder="Enter Website Link"
        />
      </div>
      <div class="form-group mb-3">
        <button @click="createNewUser()" class="btn btn-primary">
          Create User
        </button>
      </div>
    </form>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  components: {
    AppLayout
  },

  data() {
    return {
        name     : "",
        username : "",
        email    : "",
        phone    : "",
        website  : "",
        flag     : false,
    };
  },

  watch: {
    flag : function () {
        if (this.flag == true) {
            this.name = "";
            this.username = "";
            this.email = "";
            this.phone = "";
            this.website = "";
        }
    },

    isTyping : function () {
        if (this.isTyping && this.flag == true) {
            this.flag = false;
        }
    }
  },

  computed: {
        isTyping : function () {
            if (this.name != "" || this.username != "" || this.email != "" || this.phone != "" || this.website != "") {
                return true;
            }
            else{
                return false;
            }
        }
  },

  methods: {
    createNewUser: function () {
      let _this = this;

      let user = {
        name: _this.name,
        username: _this.username,
        email: _this.email,
        phone: _this.phone,
        website: _this.website,
      };

      let config = {
        method: "post",
        url: "https://jsonplaceholder.typicode.com/users",
        data: JSON.stringify(user),
        headers: {
          "Content-type": "application/json; charset=UTF-8",
        },
      };

      axios(config)
        .then(function (response) {
           _this.flag = true;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>