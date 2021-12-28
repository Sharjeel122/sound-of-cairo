<template>
    <!-- Navbar html   -->
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="logo-text">Sound Of</span> <img class="logo" :src="'Sound-of-cairo/img/logo.png'" ></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex">
                    <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                    <div class="search nav-border-left"> <i class="fa fa-search"></i> <input type="text" class="form-control" placeholder="Search Sounds">
                    </div>
                </form>


                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-border-left" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-border-left" href="#">Walkthroughs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-border-left login-register-modal" id="open_login_modal" href="#" @click="open_login_modal" >Login/Join </a>
                    </li>
                    <!--  <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         Dropdown
                       </a>
                       <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <li><a class="dropdown-item" href="#">Action</a></li>
                         <li><a class="dropdown-item" href="#">Another action</a></li>
                         <li><hr class="dropdown-divider"></li>
                         <li><a class="dropdown-item" href="#">Something else here</a></li>
                       </ul>
                     </li> -->
                </ul>

            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Header",
    data: {
        logo_src: 'Sound-of-cairo/img/logo.png',
    }
}
</script>

<style scoped>

</style>
