<template>
    <div id="Header">


        <Header/>
        <router-link to="UserDashboard">Click Here To Redirect</router-link>
        <HeroSection/>
        <FeaturedWalkthroughs/>
        <SectionSeperator/>
        <FeaturedSoundCategories/>
        <SectionSeperator/>
        <ExploreSoundsBy/>
        <SectionSeperator/>
        <Footer/>
        <router-view></router-view>
<div class="modal  login-register-popop" id="loginModal" >
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header-top text-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="close_Login_Modal"  ></button>
      </div>
      <div class="modal-body">
        <div class="modal-header-area text-center">

          <h3>Login to your account</h3>
        </div>
        <form class="login-form">
        <div class="input-feild-area">
           <div class="form-floating mb-3">
             <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" >
             <label for="floatingInput">Username or e-mail address</label>
           </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>
           </div>
          </form>
          <div class="forgot-pass-area">
             <a href="#" class="forgot-password-link">Forgot password?</a>
          </div>

          <div class="login-register-button-area">
            <button class="btn modal-btn-popup" id="register_btn_loginPage">Register</button>
            <button class="btn modal-btn-popup popup-login-btn">Login</button>
          </div>
          <div class="or-line-text text-center">
            <hr class="or-line">
            <p class="or-text">or</p>
          </div>
          <div class="social-icon-inlie">
            <img class="socail-icon" :src="'Sound-of-cairo/img/google-icon.png'">
            <img class="socail-icon" :src="'Sound-of-cairo/img/facebook-icon.png'">
            <img class="socail-icon" :src="'Sound-of-cairo/img/apple-icon.png'">
          </div>
      </div>
    </div>
  </div>
</div>

<!-- register modal -->

<div class="modal  login-register-popop" id="RegisterModal" >
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header-top text-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="close_Login_Modal"  ></button>
      </div>
      <div class="modal-body">
        <div class="modal-header-area text-center">
          <p  v-if="errorMessage" class="text-danger">All the Fields are Required</p>
          <h3>Register</h3>
        </div>
        <form class="login-form">
        <div class="input-feild-area">
             <div class="form-floating mb-3">
             <input type="text" class="form-control"   id="floatingInput" placeholder="John Doe" v-model="Uname">
             <label for="floatingInput">Name </label>
           </div>

             <div class="form-floating">
              <input type="text" class="form-control" id="floatingPassword" placeholder="profession" v-model="profession">
              <label for="floatingPassword">Profession</label>
            </div>
            <br>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="email">
                <label for="floatingInput">Username or e-mail address</label>
            </div>

            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="password">
              <label for="floatingPassword">Password</label>
            </div>
            <div class="form-floating">
                <input type="checkbox" v-model="terms_of_service">  Terms of Service
            </div>
           </div>
          </form>
          <br>
          <br>

          <div class="login-register-button-area">
            <button class="btn modal-btn-popup" @click="saveData">Register</button>
          </div>


      </div>
    </div>
  </div>
</div>

    </div>


</template>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js">
</script>
<script>
import Header from './Header.vue';
import Footer from './Footer.vue';
import HeroSection from "./HeroSection";
import FeaturedWalkthroughs from "./FeaturedWalkthroughs";
import SectionSeperator from "./SectionSeperator";
import FeaturedSoundCategories from "./FeaturedSoundCategories";
import ExploreSoundsBy from "./ExploreSoundsBy";
export default {
    name: "Index",
    components: {
        ExploreSoundsBy,
        FeaturedSoundCategories,
        SectionSeperator,
        FeaturedWalkthroughs,
        Header,
        HeroSection,
        Footer
    },
    data: function () {
        return {
            Uname:'',
            email:'',
            profession:'',
            password:'',
            terms_of_service:'',
            errorMessage:false
        }
    },

    methods:
    {

        close_Login_Modal()
        {

            $('#loginModal').modal('hide');
            $('#loginModal').removeClass("show");
            $('#loginModal').css('display' , 'none');
        },
        saveData()
        {

            if(this.name == '' || this.email == '' || this.profession == ''  || this.password == '' || this.terms_of_service == ''     )
            {

              this.errorMessage = true
            }
            else
            {
              this.errorMessage = false
             let result = axios.post("http://127.0.0.1:8000/api/user/register",{
              email:this.email,
              password:this.password,
              name : this.Uname,
              profession : this.profession,
              agree_on_terms :this.terms_of_service
          }).then(result =>{
                 console.warn(result);
          if(result.status == 200)
          {
              this.$router.push('UserDashboard')
          }

             }).catch(error => {
                  console.log(error);
             });

            }
        }

    }

}
</script>

<style scoped>

</style>
