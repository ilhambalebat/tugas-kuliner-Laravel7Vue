<template>
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <div class="alert alert-success" role="alert" v-if="message">
                  {{message}}
              </div>
              <div class="card">
                  <div class="card-header">New Post</div>
                  <form action="#" method="post" @submit.prevent="store">
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
                            <select v-model="post.subject" id="subject" class="form-control">
                                <option value="" selected>Pilih Subject</option>
                                <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{subject.name}}</option>
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
                            Create
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
                title: "",
                body: "",
                subject: ""
            },
            subjects: [],
            message: "",
            errors: []
        }
    },
    mounted()
    {
        this.fetchSubjects()
    },
    methods: {
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