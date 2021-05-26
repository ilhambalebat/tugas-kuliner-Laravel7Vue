<template>
  <div id="app">
    <Navigation/>
    <div class="py-4">
      <router-view/>
    </div>

  </div>
</template>

<script>
import Navigation from '@/components/Navigation'

export default {
  components: 
  {
    Navigation
  }
}
</script>
