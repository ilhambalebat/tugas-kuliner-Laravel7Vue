<template>
  <div class="container">

      <div class="row">
          <div class="col-md-6">
                <div class="card mb-3" v-for="post in posts" :key="post.id">
                    <div class="card-header">
                        {{post.title}}
                    </div>
                    <div class="card-body">
                        {{post.body}}
                        <div class="mt-3">

                        </div>
                        <router-link to="abc">Read More!</router-link>
                    </div>
                </div>

                <button class="btn-primary">Load More</button>
          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    data()
    {
        return {
            posts: [],
        }
    },
    mounted()
    {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts()
        {
            let response = await axios.get('api/posts');
            this.posts = response.data.data;
        }
    }
}
</script>