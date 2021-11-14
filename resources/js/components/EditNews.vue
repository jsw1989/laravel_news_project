<template>
    <div>
        <h3 class="text-center">Edit News</h3>
        <div class="row">
            <div class="col-md-6">
                <form-news :news="news"></form-news>
            </div>
        </div>
    </div>
</template>

<script>
import FormNews from "./FormNews";
export default {
    name : "EditNews",
    components: {
        FormNews
    },
    data() {
        return {
            news: {}
        }
    },
    created() {
        if (this.$route.params.id) {
            this.axios
                .get(`http://localhost:8000/api/news/${this.$route.params.id}`)
                .then((res) => {
                    this.news = res.data;
                });
        }

    }
}
</script>
