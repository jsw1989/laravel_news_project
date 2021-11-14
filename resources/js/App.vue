<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">News List</router-link>
<!--                    <router-link to="/edit" class="nav-item nav-link">Create News</router-link>-->
                    <a href="#"  class="nav-item nav-link"  @click="openModalWindow()">Create News</a>
                </div>
            </div>
        </nav>
        <router-view> </router-view>
        <modal-news :edit-mode="editMode" :news="currentnews"></modal-news>
    </div>

</template>

<script>
import ModalNews from "./components/ModalNews";
export default {
    name: "App",
    components: {ModalNews},
    data() {
        return {
            editMode: false,
            currentnews:{}
        }
    },
    methods :{
        openModalWindow(){
            this.editMode = false;
            $('#idmodal').modal('show');
        }
    }
}
</script>

<style scoped>

</style>
