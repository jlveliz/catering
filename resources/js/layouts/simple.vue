<template>
  <section class="login-block">
    <b-container fluid>
        <b-row>
            <b-col sm="12">
                <b-form class="md-float-material form-material">
                    <div class="text-center">
                        <h6>Catering</h6>
                    </div>
                    <router-view></router-view>
                </b-form>
            </b-col>
        </b-row>
    </b-container>
  </section>
</template>

<script>
    import ('./../../css/simple.css');

    import Helpers from './../helpers';



    export default {
        created(){
            (new Helpers()).setBodyTheme('theme1');
        }
    };
</script>
<style>

</style>
