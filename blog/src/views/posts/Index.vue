<template>
<div class="container p-5">
    <post-block endpoint="api/posts"></post-block>
</div>
</template>

<script>
import PostBlock from '@/components/posts/Block'
export default {
    mounted()
    {
        document.title = "Posts"
    },
    components:
    {
        PostBlock
    }
}
</script>