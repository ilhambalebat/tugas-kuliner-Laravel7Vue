<template>
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <div class="alert alert-success" role="alert" v-if="message">
                  {{message}}
              </div>
              <div class="card">
                  <div class="card-header">New Post</div>
                  <form action="#" method="post" @submit.prevent="update">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" v-model="post.title" id="title" class="form-control">
                            <div class="text-danger mt-2" v-if="errors.title">
                                {{errors.title[0]}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Subject</label>
                            <select id="subject" class="form-control" @change="selectedSubject">
                                <option 
                                    v-for="subject in subjects" 
                                    :key="subject.id" 
                                    :selected="subject.id == post.subject.id"
                                    :value="subject.id"
                                    >
                                    {{subject.name}}
                                </option>
                            </select>
                            <div class="text-danger mt-2" v-if="errors.subject">
                                {{errors.subject[0]}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" v-model="post.body" id="body" rows="5" placeholder="Tuliskan Apapun" class="form-control"></textarea>
                            <div class="text-danger mt-2" v-if="errors.body">
                                {{errors.body[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                  </form>
              </div>
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
            post: {
                subject: []
            },
            subjects: [],
            message: "",
            errors: [],
            selected: ""
        }
    },
    mounted()
    {
        this.fetchSubjects(),
        this.fetchPost()
    },
    methods: {
        selectedSubject(e)
        {
            this.selected = e.target.value
        },
        request(key)
        {
            return this.$route.params[key];
        },

        async update()
        {
            this.post['subject'] = this.selected || this.post.subject.id
            let response = await axios.patch(`api/posts/${this.request('postSlug')}/edit`,this.post)
            this.message = response.data.success
        },

        async fetchPost()
        {
            let {data} = await axios.get(`api/posts/${this.request('subjectSlug')}/${this.request('postSlug')}`)
            this.post = data.data
        },
        async store()
        {
            try
            {
                let response = await axios.post('api/posts/create',this.post)
                this.message = response.data.success
                this.errors = [];
                this.post.title = '';
                this.post.body = '';
                this.post.subject = '';
            }
            catch(e)
            {
                this.errors = e.response.data.errors
            }

        },
        async fetchSubjects()
        {
            let response = await axios.get('api/posts/subjects')
            this.subjects = response.data
        }
    },
}
</script>