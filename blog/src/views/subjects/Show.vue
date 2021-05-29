<template>
<div class="container">
    <h4>{{subject.name}}</h4>
    <hr>
    <post-block :endpoint="`api/posts/subjects/${$route.params.subjectSlug}`"></post-block>
</div>
</template>

<script>
import axios from 'axios'
import PostBlock from '@/components/posts/Block'
export default {
    components:
    {
        PostBlock
    },
    data()
    {
        return {
            subject: []
        }
    },
    mounted()
    {
        this.fetchSubject()
    },
    methods:
    {
        async fetchSubject()
        {
            let response = await axios.get(`api/posts/subjects/${this.$route.params.subjectSlug}`);
            this.subject = response.data.subject
        }
    }
}
</script>