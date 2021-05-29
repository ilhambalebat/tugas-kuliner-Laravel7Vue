<template>
  <div class="container">

      <div class="row">
          <div class="col-md-6">
                <div class="card mb-3" v-for="post in posts.data" :key="post.id">
                    <div class="card-header">
                        {{post.title}}
                    </div>
                    <div class="card-body">
                        {{post.body}}
                        <div class="mt-3">

                        </div>
                        <router-link :to="`/posts/${post.subject.slug}/${post.slug}`">Read More!</router-link>
                    </div>
                </div>

                <button v-if="posts.hasMorePages" class="btn-primary" @click.prevent="loadMore">
                    <template v-if="loading">
                        Please Wait . . .
                    </template>
                    <template v-else>
                        Load More
                    </template>
                </button>
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
            perPage: 20,
            loading: false
        }
    },
    mounted()
    {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts()
        {
            let response = await axios.get('api/posts',{
                params: {perPage: this.perPage}
            });
            this.loading = false
            this.posts = response.data;
        },
        loadMore()
        {
            this.loading = true
            this.perPage+=20
            setTimeout(() => {
                this.fetchPosts()
            },1000)
        }
    }
}
</script>