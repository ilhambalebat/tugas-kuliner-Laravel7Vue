<template>
  <div class="container p-5">
      <div class="row">
          <div class="col-md-12">
              <div class="alert alert-success" role="alert" v-if="message">
                  {{message}}
              </div>
              <div class="card">
                  <div class="card-header">Edit Menu</div>
                  <form action="#" method="post" @submit.prevent="update" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" v-model="post.title" id="title" class="form-control">
                                    <div class="text-danger mt-2" v-if="errors.title">
                                        {{errors.title[0]}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" v-model="post.price" id="price" class="form-control">
                                    <div class="text-danger mt-2" v-if="errors.price">
                                        {{errors.price[0]}}
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

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea type="text" v-model="post.body" id="body" rows="5" placeholder="Tuliskan Apapun" class="form-control"></textarea>
                                    <div class="text-danger mt-2" v-if="errors.body">
                                        {{errors.body[0]}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Foto</label> <strong>(abaikan jika tidak ingin ganti)</strong>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="file" name="photo" id="photo" class="form-control" @change="upload">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <center>
                                                <img :src="previewimage" width="70px">
                                            </center>
                                        </div>
                                    </div>                                    
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
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
            selected: "",
            previewimage: null,
        }
    },
    mounted()
    {
        document.title = "Edit Menu"
        this.fetchSubjects(),
        this.fetchPost()
    },
    methods: {
        selectedSubject(e)
        {
            this.selected = e.target.value
            alert(this.selected)
        },
        request(key)
        {
            return this.$route.params[key];
        },
        upload(e)
        {
            let files = e.target.files[0]
            this.previewimage = URL.createObjectURL(files)
            this.post.photo = files
            console.log('file diterima')
        },
        async update()
        {
            try
            {
                this.post['subject'] = this.selected || this.post.subject.id
                let formData = await new FormData()
                formData.append('title',this.post.title)
                formData.append('price',this.post.price)
                formData.append('body',this.post.body)
                formData.append('subject',this.post.subject)
                formData.append('photo',this.post.photo)
                let response = await axios.post(`api/posts/${this.request('postSlug')}/edit`,formData)
                this.message = response.data.success
                console.log(response.data)
            }
            catch(e)
            {
                this.errors = e.response.data.errors
            }

        },
        async fetchPost()
        {
            let {data} = await axios.get(`api/posts/${this.request('subjectSlug')}/${this.request('postSlug')}`)
            this.post = data.data
        },
        async fetchSubjects()
        {
            let response = await axios.get('api/posts/subjects')
            this.subjects = response.data
        }        
    },
}
</script>