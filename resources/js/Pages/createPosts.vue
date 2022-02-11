<template>
  <AppLayout>
    <h1>Create Posts</h1>
    <h5 v-if="flag" class="text-center mt-3 mb-3 alert alert-success">New post created successfully.</h5>
    <form action="javascript:;">
      <div class="form-group">
        <label>Select Author</label>
        <select v-model="userId" class="form-control" @click="fetchUsers()">
          <option value="">-- Select Author --</option>
          <option :value="user.id"  v-for="(user) in users" :key="user.id" >{{ user.name }}</option>
        </select>
      </div>
      <div class="form-group mt-2">
        <label>Title</label>
        <input
          v-model="title"
          type="text"
          class="form-control"
          placeholder="Title"
        />
      </div>
      <div class="form-group mt-2">
        <label>Description</label>
        <textarea
          v-model="description"
          class="form-control"
          placeholder="description"
        >
        </textarea>
      </div>

      <div class="form-group mt-2">
        <button @click="createNewPosts()" class="btn btn-primary">
          Create Post
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
        userId     : "",
        title    : "",
        description    : "",
        users : [],
        flag     : false,
    };
  },

  watch: {
    flag : function () {
        if (this.flag == true) {
            this.userId = "";
            this.title = "";
            this.description = "";
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
            if ( this.userId != "" || this.title != "" || this.description != "" ) {
                return true;
            }
            else{
                return false;
            }
        }
  },

  methods: {

    fetchUsers : function () {

        let _this = this;
        
        let config = {
            method: 'get',
            url: 'https://jsonplaceholder.typicode.com/users/'
        };

        axios(config)
        .then(function (response) {
            _this.users = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
    },

    createNewPosts: function () {
      let _this = this;
    
      let user = {
        userId: _this.userId,
        title : _this.title,
        description: _this.description,
      };

      let config = {
        method: "post",
        url: "https://jsonplaceholder.typicode.com/posts",
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