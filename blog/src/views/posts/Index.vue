<template>
<div class="container">
    <post-block endpoint="api/posts"></post-block>
</div>
</template>

<script>
import PostBlock from '@/components/posts/Block'
export default {
    components:
    {
        PostBlock
    }
}
</script>