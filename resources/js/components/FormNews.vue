<template>
    <div>
        <form @submit.prevent="submitFormNews">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" required v-model="news.title">

            </div>
            <div class="alert-danger" v-if="$v.news.title.$invalid">Title is required</div>
            <div class="form-group">
                <label>Content</label>
                <vue-editor  v-model="news.content"></vue-editor>
            </div>
            <div class="alert-danger" v-if="$v.news.content.$invalid">Content is required</div>
            <div class="form-group">
                <label>Is Published</label>
                <input type="checkbox" class="form-control" v-model="news.is_published">
            </div>
            <div style="float: left;">
                <button type="submit" :disabled="$v.news.$invalid" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger" @click="closeModal()">Close</button>
            </div>

        </form>
    </div>

</template>

<script>
import { VueEditor } from "vue2-editor";
import { required } from 'vuelidate/lib/validators'
export default {
    name: "FormNews",
    props: ['news','editMode'],
    components: {
        VueEditor
    },
    data() {
        return {

        }
    },
    methods: {
        submitFormNews() {
            if (this.editMode) {
                this.updateNews();
            } else{
                this.addNews();
            }

        },
        addNews() {
            this.closeModal();
            let that = this;
            this.axios
                .post('http://localhost:8000/api/news', this.news)
                .then((response) => {
                    that.$router.go(0);
                    })
                    //this.$router.push({ name: 'home' })
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        },
        updateNews() {
            this.closeModal();
            let that = this;
            this.axios
                .patch(`http://localhost:8000/api/news/${this.news.id}`, this.news)
                .then((res) => {
                   that.$router.go(0);
                });
        },
        closeModal() {
            $('#idmodal').modal('hide');
        }
    },
    validations: {
        news: {
            title: {
                required : required,
            },
            content: {
                required
            }
        }

    }
}
</script>

<style scoped>

</style>
