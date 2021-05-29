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
                        </div>
                        <div class="form-group">
                            <label for="title">Subject</label>
                            <select v-model="post.subject" id="subject" class="form-control">
                                <option value="" selected>Pilih Subject</option>
                                <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{subject.name}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" v-model="post.body" id="body" rows="5" placeholder="Tuliskan Apapun" class="form-control"></textarea>
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
            message: ""
        }
    },
    mounted()
    {
        this.fetchSubjects()
    },
    methods: {
        async store()
        {
            let response = await axios.post('api/posts/create',this.post)
            this.message = response.data.success
        },
        async fetchSubjects()
        {
            let response = await axios.get('api/posts/subjects')
            this.subjects = response.data
        }
    },
}
</script>