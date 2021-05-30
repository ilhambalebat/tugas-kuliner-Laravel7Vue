<template>
    <div class="container">
        <div class="d-flex justify-content-between">
            <h4>All Menus</h4>
            <div>
                <template v-if="auth">          
                    <router-link :to="{name: 'posts.new'}" class="btn btn-primary" >New Post</router-link>
                </template>        
                <template v-else>          
                    <router-link :to="{name: 'posts.new'}" class="btn btn-primary">Login to create new post</router-link>
                </template>
            </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4" v-for="post in posts.data" :key="post.id">
                <div class="card mb-4">
                    <div class="card-header">
                        {{post.title}}
                    </div>
                    <div class="card-body">
                        <div>
                            {{post.body}}
                        </div>
                        <router-link :to="`/posts/${post.subject.slug}/${post.slug}`">Read More!</router-link>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        Published on {{ post.published }}

                        <template v-if="auth">          
                            <router-link class="btn btn-success btn-sm" :to="`/posts/${post.subject.slug}/${post.slug}/edit`">Edit</router-link> 
                            <a class="btn btn-danger btn-sm" @click.prevent="hapus(post.slug)">Delete</a>
                        </template> 
                    </div>
                </div>

          </div>
        </div>
        <div class="d-flex justify-content-center">
            <div>
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
import store from '../../store'

export default {
    props: ['endpoint'],
    data()
    {
        return {
            posts: [],
            perPage: 6,
            loading: false,
            auth: store.getters['auth/check'],
            delete : ""
        }
    },
    mounted()
    {
        this.fetchPosts();
    },
    methods: {
        async fetchPosts()
        {
            let response = await axios.get(this.endpoint,{
                params: {perPage: this.perPage}
            });
            this.loading = false
            this.posts = response.data;
            console.log(this.posts)
        },
        loadMore()
        {
            this.loading = true
            this.perPage+=6
            setTimeout(() => {
                this.fetchPosts()
            },1000)
        },
        async hapus(slug)
        {
            if(confirm('Yakin menghapus ?'))
            {
                let response = await axios.delete('api/posts/'+slug+'/delete');
                console.log(response.data.success)
                this.fetchPosts()
            }
        }
    }
}
</script>