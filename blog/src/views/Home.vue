<template>
    <div class="container px-0">
	<!-- Top box -->
		<!-- Logo & Site Name -->
		<div class="placeholder">
			<div class="parallax-window" data-parallax="scroll" data-image-src="background" 
      :style="{'background-image': 'url(' + require('../assets/img/background.jpg') + ')'}"
      >
				<div class="tm-header">
					<div class="row tm-header-inner">
						<div class="col-md-6 col-12">
							<img :src="logo" alt="Logo" class="tm-site-logo" /> 
							<div class="tm-site-text-box">
								<h1 class="tm-site-title">Dinda Kuliner</h1>
								<h6 class="tm-site-description">banyak makanan enak lho!</h6>	
							</div>
						</div>
						<nav class="col-md-6 col-12 tm-nav">
							<!-- <ul class="tm-nav-ul">
								<li class="tm-nav-li"><a href="index.html" class="tm-nav-link active">Home</a></li>
								<li class="tm-nav-li"><a href="about.html" class="tm-nav-link">About</a></li>
								<li class="tm-nav-li"><a href="contact.html" class="tm-nav-link">Contact</a></li>
							</ul> -->
						</nav>	
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Selamat Datang di Dinda Kuliner</h2>
				<p class="col-12 text-center">Ada Banyak pilihanan makanan dan minuman yang enak buat dinikmatin bersama lho. yang mana favoritmu ?</p>
			</header>
<!-- 			
			<div class="tm-paging-links">
				<nav>
					<ul>
						<li class="tm-paging-item"><a href="#" class="tm-paging-link active">Pizza</a></li>
						<li class="tm-paging-item"><a href="#" class="tm-paging-link">Salad</a></li>
						<li class="tm-paging-item"><a href="#" class="tm-paging-link">Noodle</a></li>
					</ul>
				</nav>
			</div> -->

			<!-- Gallery -->
			<div class="row tm-gallery mb-0">
				<!-- gallery page 1 -->
				<div id="tm-gallery-page-pizza" class="tm-gallery-page">
					<article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item" v-for="post in posts.data" :key="post.id">
						<figure>
							<img 
              :src="image_url+post.photo" 
              alt="Image" class="img-fluid tm-gallery-img" style="height: 200px" />
							<figcaption>
								<h4 class="tm-gallery-title">{{post.title}}</h4>
								<p class="tm-gallery-description">{{post.body}}</p>
								<p class="tm-gallery-price">Rp. {{ formatPrice(Number(post.price)) }}</p>
							</figcaption>
						</figure>
					</article>          
				</div> <!-- gallery page 1 -->
			</div>
      <div class="d-flex justify-content-center mb-3">
        <button v-if="posts.hasMorePages" class="btn-primary" @click.prevent="loadMore">
            <template v-if="loading">
                Please Wait . . .
            </template>
            <template v-else>
                Load More
            </template>
        </button>
      </div><br>
			<div class="tm-section tm-container-inner">
				<div class="row">
					<div class="col-md-6">
						<figure class="tm-description-figure">
							<img src="../assets/img/female.jpg" alt="Image" class="img-fluid" />
						</figure>
					</div>
					<div class="col-md-6">
						<div class="tm-description-box"> 
							<h4 class="tm-gallery-title">Dinda </h4>
							<p class="tm-mb-45">Seorang Mahasiswi Pemilik Kuliner Makanan berkualitas yang sudah bekerjama sama dengan produsen bahan mentah untuk mengahasilkan makanan yang berkualitas</p>
							<a href="#" class="tm-btn tm-btn-default tm-right">Read More</a>
						</div>
					</div>
				</div>
			</div>
		</main>

		<footer class="tm-footer text-center">
			<p>Copyright &copy; 2021 Dinda Kuliner | Design: Dinda </p>
		</footer>
	</div>
</template>

<script>
import background from '../assets/img/background.jpg'
import logo from '../assets/img/simple-house-logo.png'
import axios from 'axios'
import store from '../store'

export default {
  data()
  {
    return {
      background: background,
      logo: logo,
      posts: [],
      perPage: 4,
      loading: false,
      auth: store.getters['auth/check'],
      delete : "",
      endpoint: "api/posts",
      image_url: "http://localhost:8000/images/"
    }
  },
  name: 'Home',
  mounted() {
    document.title = "Home",
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
            this.perPage+=4
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
        },
        formatPrice(value) 
        {
          let val = (value/1).toFixed(0).replace('.', ',')
          return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
     }
}
</script>
<style lang="">
  
</style>
